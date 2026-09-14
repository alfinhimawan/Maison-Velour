<?php
require_once 'app/config/config.php';
require_once 'app/components/header.php';

// Fetch distinct categories and volumes from DB for dynamic scalable filtering
$cat_query = $db->query("SELECT DISTINCT category FROM products WHERE category IS NOT NULL AND category != '' ORDER BY category ASC");
$categories = [];
while ($row = $cat_query->fetch_assoc()) {
    $categories[] = $row['category'];
}

$vol_query = $db->query("SELECT DISTINCT volume FROM products WHERE volume IS NOT NULL AND volume != '' ORDER BY volume ASC");
$raw_volumes = [];
while ($row = $vol_query->fetch_assoc()) {
    // Normalize dirty database inputs (e.g., '100 ML', '100ml ', '100 ml') to a strict '100ml' format
    $clean_vol = strtolower(str_replace(' ', '', trim($row['volume'])));
    if (!in_array($clean_vol, $raw_volumes)) {
        $raw_volumes[] = $clean_vol;
    }
}
$volumes = $raw_volumes;

$lbl_query = $db->query("SELECT DISTINCT label FROM products WHERE label IS NOT NULL AND label != '' AND label != 'PRE-ORDER' ORDER BY label ASC");
$labels = [];
while ($row = $lbl_query->fetch_assoc()) {
    $labels[] = $row['label'];
}
?>

<div class="shop-page-wrapper">
    <!-- Breadcrumb & Top Bar -->
    <div class="shop-top-bar">
        <div class="shop-breadcrumb" style="font-size: 16px;">
            <span>ALL FRAGRANCES</span>
        </div>
        <div class="shop-sort">
            <label for="sortDropdown">SORT BY:</label>
            <select id="sortDropdown" class="luxury-select">
                <option value="newest">Newest</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
            </select>
        </div>
    </div>

    <div class="shop-layout">
        <!-- Left Sidebar (Filters) -->
        <aside class="shop-sidebar">
            <div class="filter-group search-group">
                <input type="text" id="searchInput" placeholder="Search fragrances..." class="luxury-input">
                <i class="fa fa-search search-icon"></i>
            </div>


            <div class="filter-group">
                <h4 class="filter-title">COLLECTIONS <i class="fa fa-chevron-down"></i></h4>
                <div class="filter-options">
                    <?php foreach ($labels as $lbl): ?>
                        <label class="luxury-checkbox">
                            <input type="checkbox" name="marketing_label[]" value="<?php echo htmlspecialchars($lbl); ?>">
                            <span class="checkmark"></span> <?php echo htmlspecialchars($lbl); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="filter-group">
                <h4 class="filter-title">OLFACTORY FAMILY <i class="fa fa-chevron-down"></i></h4>
                <div class="filter-options">
                    <?php foreach ($categories as $cat): ?>
                        <label class="luxury-checkbox">
                            <input type="checkbox" name="category[]" value="<?php echo htmlspecialchars($cat); ?>">
                            <span class="checkmark"></span> <?php echo htmlspecialchars($cat); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="filter-group">
                <h4 class="filter-title">PRICE <i class="fa fa-chevron-down"></i></h4>
                <div class="filter-options">
                    <label class="luxury-radio">
                        <input type="radio" name="price" value="all" checked>
                        <span class="radiomark"></span> All Prices
                    </label>
                    <label class="luxury-radio">
                        <input type="radio" name="price" value="under_100">
                        <span class="radiomark"></span> Under <?php echo formatPrice(100); ?>
                    </label>
                    <label class="luxury-radio">
                        <input type="radio" name="price" value="100_200">
                        <span class="radiomark"></span> <?php echo formatPrice(100); ?> - <?php echo formatPrice(200); ?>
                    </label>
                    <label class="luxury-radio">
                        <input type="radio" name="price" value="above_200">
                        <span class="radiomark"></span> Above <?php echo formatPrice(200); ?>
                    </label>
                </div>
            </div>

            <div class="filter-group">
                <h4 class="filter-title">VOLUME <i class="fa fa-chevron-down"></i></h4>
                <div class="filter-options">
                    <?php foreach ($volumes as $vol): ?>
                        <label class="luxury-checkbox">
                            <input type="checkbox" name="volume[]" value="<?php echo htmlspecialchars($vol); ?>">
                            <span class="checkmark"></span> <?php echo htmlspecialchars(strtoupper(str_replace('ml', ' ML', $vol))); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="filter-group">
                <h4 class="filter-title">AVAILABILITY <i class="fa fa-chevron-down"></i></h4>
                <div class="filter-options">
                    <label class="luxury-radio">
                        <input type="radio" name="availability" value="all" checked>
                        <span class="radiomark"></span> All
                    </label>
                    <label class="luxury-radio">
                        <input type="radio" name="availability" value="in_stock">
                        <span class="radiomark"></span> In Stock
                    </label>
                    <label class="luxury-radio">
                        <input type="radio" name="availability" value="pre_order">
                        <span class="radiomark"></span> Pre-Order
                    </label>
                </div>
            </div>
        </aside>

        <!-- Right Main Content (Product Grid) -->
        <main class="shop-main">
            <div id="shopGrid" class="shop-grid">
                <!-- Products will be injected here via AJAX -->
            </div>

            <div id="loadingSpinner" class="spinner" style="display:none; margin: 40px auto;"></div>

            <div class="shop-pagination-wrapper" style="display:none;" id="paginationWrapper">
                <div class="shop-pagination-top">
                    <div id="paginationContainer" class="luxury-pagination">
                        <!-- Pagination buttons injected here -->
                    </div>
                    <div class="shop-per-page">
                        <label>Result per page</label>
                        <select id="perPageDropdown" class="luxury-select-small">
                            <option value="6">6</option>
                            <option value="12">12</option>
                            <option value="24">24</option>
                        </select>
                    </div>
                </div>
                <div class="shop-pagination-status" id="paginationStatus">
                    <!-- e.g. 1-6 of 25 -->
                </div>
            </div>
        </main>
    </div>
</div>

<script src="assets/js/shop.js?v=<?php echo time(); ?>"></script>

<?php require_once 'app/components/footer.php'; ?>