
document.addEventListener('DOMContentLoaded', () => {
    let currentPage = 1;
        let isLoading = false;

    const grid = document.getElementById('shopGrid');
    const paginationContainer = document.getElementById('paginationContainer');
    const paginationWrapper = document.getElementById('paginationWrapper');
    const paginationStatus = document.getElementById('paginationStatus');
    const perPageDropdown = document.getElementById('perPageDropdown');
    const spinner = document.getElementById('loadingSpinner');
    
    // Inputs
    const searchInput = document.getElementById('searchInput');
    const sortDropdown = document.getElementById('sortDropdown');
    const checkboxes = document.querySelectorAll('.shop-sidebar input[type="checkbox"]');

    const radios = document.querySelectorAll('.shop-sidebar input[type="radio"]');

    function getFilters() {
        const filters = {
            search: searchInput.value,
            sort: sortDropdown.value,
            availability: document.querySelector('input[name="availability"]:checked')?.value || 'all',
            price: document.querySelector('input[name="price"]:checked')?.value || 'all',
            category: [],
            volume: [],
            marketing_label: [],
            page: currentPage,
            limit: perPageDropdown.value
        };

        checkboxes.forEach(cb => {
            if (cb.checked) {
                if (cb.name === 'category[]') filters.category.push(cb.value);
                if (cb.name === 'volume[]') filters.volume.push(cb.value);
                if (cb.name === 'marketing_label[]') filters.marketing_label.push(cb.value);
            }
        });

        return filters;
    }

    function buildQueryString(filters) {
        const params = new URLSearchParams();
        if (filters.search) params.append('search', filters.search);
        if (filters.sort) params.append('sort', filters.sort);
        if (filters.availability !== 'all') params.append('availability', filters.availability);
        if (filters.price !== 'all') params.append('price', filters.price);
        params.append('page', filters.page);
        params.append('limit', filters.limit);
        
        filters.category.forEach(cat => params.append('category[]', cat));
        filters.volume.forEach(vol => params.append('volume[]', vol));
        if (filters.marketing_label && filters.marketing_label.length > 0) {
            params.append('marketing_label', filters.marketing_label.join(','));
        }
        
        return params.toString();
    }

    async function fetchProducts(resetPage = false) {
        if (isLoading) return;
        isLoading = true;
        
        if (resetPage) {
            currentPage = 1;
        }
        
        grid.innerHTML = '';
        paginationContainer.innerHTML = '';
        spinner.style.display = 'block';

        const filters = getFilters();
        const qs = buildQueryString(filters);

        try {
            const response = await fetch(`app/services/api_products.php?${qs}`);
            const result = await response.json();

            if (result.status === 'success') {
                if (result.data.length === 0) {
                    grid.innerHTML = '<div class="no-results">No fragrances match your selection.</div>';
                } else {
                    renderProducts(result.data);
                    renderPagination(result.total_pages, result.current_page, result.total_items, result.limit);
                    
                    // Smooth scroll up if it was a pagination click
                    if (!resetPage) {
                        window.scrollTo({top: document.querySelector('.shop-layout').offsetTop - 50, behavior: 'smooth'});
                    }
                }
            } else {
                console.error(result.message);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        } finally {
            isLoading = false;
            spinner.style.display = 'none';
        }
    }

    function renderPagination(totalPages, current, totalItems, limit) {
        if (totalItems === 0) {
            paginationWrapper.style.display = 'none';
            return;
        }
        
        paginationWrapper.style.display = 'block';
        
        // Status text (1-6 of 25)
        const start = ((current - 1) * limit) + 1;
        const end = Math.min(current * limit, totalItems);
        paginationStatus.innerHTML = `${start}-${end} of ${totalItems}`;

        // Buttons
        let html = '';
        
        // Back
        const prevDisabled = current === 1 ? 'disabled' : '';
        html += `<button class="page-btn" data-page="${current - 1}" ${prevDisabled}><i class="fa fa-angle-left" style="margin-right:5px;"></i> Back</button>`;
        
        for (let i = 1; i <= totalPages; i++) {
            const activeClass = (i === current) ? 'active' : '';
            html += `<button class="page-btn ${activeClass}" data-page="${i}">${i}</button>`;
        }
        
        // Next
        const nextDisabled = current === totalPages ? 'disabled' : '';
        html += `<button class="page-btn" data-page="${current + 1}" ${nextDisabled}>Next <i class="fa fa-angle-right" style="margin-left:5px;"></i></button>`;
        
        paginationContainer.innerHTML = html;
        
        document.querySelectorAll('.page-btn:not(:disabled)').forEach(btn => {
            btn.addEventListener('click', (e) => {
                currentPage = parseInt(e.currentTarget.dataset.page);
                fetchProducts(false);
            });
        });
    }

    function renderProducts(products) {
        products.forEach(p => {
            // Dynamic Inventory Badge
            let badgeText = '';
            if (p.label === 'PRE-ORDER') {
                badgeText = 'PRE-ORDER';
            } else if (p.stock > 0) {
                badgeText = `IN STOCK: ${p.stock}`;
            } else {
                badgeText = 'SOLD OUT';
            }
            const inventoryBadge = `<span class="shop-badge label" style="${p.stock > 0 && p.label !== 'PRE-ORDER' ? 'background: #f8f8f8; color: #333; border: 1px solid #ddd;' : ''}">${badgeText}</span>`;
            
            const card = document.createElement('div');
            card.className = 'shop-product-card';
            card.innerHTML = `
                <div class="shop-product-img-wrapper">
                    <div class="shop-badge-container">
                        ${inventoryBadge}
                    </div>
                    <!-- Detail Eye Icon -->
                    <div class="shop-detail-icon" onclick="showDevModal(event)" title="View Details">
                        <i class="fa fa-eye"></i>
                    </div>
                    <img src="assets/images/products/${p.image}" alt="${p.name}" class="shop-product-img" onclick="showDevModal(event)" style="cursor:pointer;">
                    <div class="shop-quick-add" onclick="showDevModal(event)"><i class="fa fa-shopping-bag" style="margin-right: 8px;"></i>ADD TO CART</div>
                </div>
                <div class="shop-product-info" onclick="showDevModal(event)" style="cursor:pointer;">
                    <h3 class="shop-product-name">${p.name}</h3>
                    <p class="shop-product-desc">${p.volume} • ${p.category}</p>
                    <p class="shop-product-price">${p.formatted_price}</p>
                </div>
            `;
            grid.appendChild(card);
        });
    }

    // Event Listeners
    searchInput.addEventListener('input', debounce(() => fetchProducts(true), 500));
    sortDropdown.addEventListener('change', () => fetchProducts(true));
    checkboxes.forEach(cb => cb.addEventListener('change', () => fetchProducts(true)));
    radios.forEach(r => r.addEventListener('change', () => fetchProducts(true)));
    perPageDropdown.addEventListener('change', () => fetchProducts(true));
    


    // Toggle Sidebar accordions
    document.querySelectorAll('.filter-title').forEach(title => {
        title.addEventListener('click', () => {
            title.nextElementSibling.classList.toggle('collapsed');
            const icon = title.querySelector('i');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        });
    });

    // Initial load
    fetchProducts(true);
});

// Debounce helper
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
