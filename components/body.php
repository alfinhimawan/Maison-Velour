<?php require_once __DIR__ . '/../config/config.php'; ?>
<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content-wrapper">
        <a href="#collection" class="hero-btn">SHOP NOW</a>
    </div>
</section>

<!-- MARQUEE STRIP -->
<div class="marquee-wrapper">
    <div class="marquee-text">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAISON VELOUR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PREMIUM FRAGRANCE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PARIS, FRANCE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAISON VELOUR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PREMIUM FRAGRANCE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PARIS, FRANCE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAISON VELOUR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PREMIUM FRAGRANCE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PARIS, FRANCE&nbsp;&nbsp;
    </div>

</div>

<!-- ALL PRODUCTS SECTION -->
<section id="products" style="padding: 80px 50px; max-width:1440px; margin: 0 auto;">

    <!-- Section Header -->
    <div id="collection" class="section-header">
        <p class="section-header-subtitle">OUR COLLECTION</p>
        <h2 class="section-header-title">ALL PRODUCTS</h2>
        <div class="section-header-line"></div>
    </div>


    <!-- Filter Bar -->
    <form method="GET" action="" id="filter-form">
        <div class="filter-wrap" style="justify-content:center; margin-bottom:48px;">
            <?php
            $cat = isset($_GET['category']) ? $_GET['category'] : '';
            $price_val = isset($_GET['price']) ? $_GET['price'] : '';
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
            ?>
            <select name="category" class="v-select" onchange="applyFilter()">
                <option value="">CATEGORY : ALL</option>
                <option value="EAU DE PARFUM" <?= $cat == 'EAU DE PARFUM' ? 'selected' : '' ?>>EAU DE PARFUM</option>
                <option value="EAU DE TOILETTE" <?= $cat == 'EAU DE TOILETTE' ? 'selected' : '' ?>>EAU DE TOILETTE</option>
                <option value="EAU FRAÎCHE" <?= $cat == 'EAU FRAÎCHE' ? 'selected' : '' ?>>EAU FRAÎCHE</option>
                <option value="EXTRAIT" <?= $cat == 'EXTRAIT' ? 'selected' : '' ?>>ESSENCE / EXTRAIT</option>
            </select>

            <select name="price" class="v-select" onchange="applyFilter()">
                <option value="">PRICE : ALL</option>
                <option value="tier1" <?= $price_val == 'tier1' ? 'selected' : '' ?>>UNDER IDR 1,000K</option>
                <option value="tier2" <?= $price_val == 'tier2' ? 'selected' : '' ?>>IDR 1,000K - 2,000K</option>
                <option value="tier3" <?= $price_val == 'tier3' ? 'selected' : '' ?>>ABOVE IDR 2,000K</option>
            </select>

            <select class="v-select">
                <option>AVAILABILITY : ALL</option>
                <option>IN STOCK</option>
            </select>

            <select name="sort" class="v-select" onchange="applyFilter()">
                <option value="">SORT : FEATURED</option>
                <option value="newest" <?= $sort == 'newest' ? 'selected' : '' ?>>NEWEST</option>
                <option value="price_asc" <?= $sort == 'price_asc' ? 'selected' : '' ?>>PRICE: LOW TO HIGH</option>
                <option value="price_desc" <?= $sort == 'price_desc' ? 'selected' : '' ?>>PRICE: HIGH TO LOW</option>
            </select>
        </div>
    </form>

    <script>
        function applyFilter() {
            var form = document.getElementById('filter-form');
            var formData = new FormData(form);
            var params = new URLSearchParams(formData);
            window.location.href = '?' + params.toString() + '#collection';
        }
    </script>


    <!-- Product Grid from DB -->
    <div class="row">
        <?php
        // Build query dynamically based on filters
        $sql = "SELECT * FROM products WHERE 1=1";

        if ($cat != '') {
            if ($cat == 'EXTRAIT') {
                $sql .= " AND (type LIKE '%Extrait%' OR type LIKE '%Essence%' OR type LIKE '%Parfum Extraordinaire%')";
            } else {
                $cat_esc = mysqli_real_escape_string($db, $cat);
                $sql .= " AND type = '$cat_esc'";
            }
        }

        if ($price_val != '') {
            if ($price_val == 'tier1') {
                $sql .= " AND price < 1000000";
            } elseif ($price_val == 'tier2') {
                $sql .= " AND price >= 1000000 AND price <= 2000000";
            } elseif ($price_val == 'tier3') {
                $sql .= " AND price > 2000000";
            }
        }

        if ($sort == 'price_asc') {
            $sql .= " ORDER BY price ASC";
        } elseif ($sort == 'price_desc') {
            $sql .= " ORDER BY price DESC";
        } elseif ($sort == 'newest') {
            $sql .= " ORDER BY id DESC";
        } else {
            $sql .= " ORDER BY id ASC";
        }

        $sql .= " LIMIT 6";

        $result = mysqli_query($db, $sql);
        if ($result && mysqli_num_rows($result) > 0):

            while ($p = mysqli_fetch_assoc($result)):
        ?>
                <div class="col-md-4 col-sm-6">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="images/products/<?php echo htmlspecialchars($p['image']); ?>"
                                class="product-img"
                                alt="<?php echo htmlspecialchars($p['name']); ?>"
                                onerror="this.src='images/products/perfume_noir_lifestyle.jpg'">
                            <?php if (!empty($p['label'])): ?>
                                <div class="product-badge"><?php echo htmlspecialchars($p['label']); ?></div>
                            <?php endif; ?>
                            <button class="product-add-btn" onclick="showDevModal(event)"><i class="fa fa-shopping-bag" style="margin-right: 8px;"></i>ADD TO CART</button>
                        </div>
                        <div class="product-info">
                            <div class="product-type"><?php echo strtoupper(htmlspecialchars($p['type'])); ?></div>
                            <div class="product-name"><?php echo htmlspecialchars($p['name']); ?></div>
                            <div class="product-price">IDR <?php echo number_format($p['price'], 0, ',', '.'); ?></div>
                            <div class="product-rating">
                                <?php for ($i = 1; $i <= 5; $i++) echo '<span class="' . ($i <= (int)$p['rating'] ? 'filled' : '') . '">★</span>'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
        else:
            ?>
            <div class="col-12 product-empty-state">
                <p>NO PRODUCTS FOUND</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- View More -->
    <div style="text-align:center; margin-top:20px;">
        <button class="view-more-btn" onclick="showDevModal(event)">VIEW MORE</button>
    </div>
</section>