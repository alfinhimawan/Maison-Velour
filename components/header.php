<?php
require_once __DIR__ . "/../config/config.php";
if (session_status() === PHP_SESSION_NONE) {
}
// Handle currency save
if (isset($_GET['save_currency'])) {
    $_SESSION['user_country_code'] = $_GET['countrySelect'];
    $_SESSION['user_currency_code'] = $_GET['currencySelect'];
    if (isset($_GET['languageSelect'])) {
        $_SESSION['user_language'] = $_GET['languageSelect'];
    }
    $current_url = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: " . $current_url);
    exit();
}
$user_country_code = isset($_SESSION['user_country_code']) ? $_SESSION['user_country_code'] : 'id';
$user_currency_code = isset($_SESSION['user_currency_code']) ? $_SESSION['user_currency_code'] : 'IDR';
$user_language = isset($_SESSION['user_language']) ? $_SESSION['user_language'] : 'ID';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MAISON VELOUR — Premium Fragrance, Wear your signature scent.">
    <title>MAISON VELOUR — Premium Fragrance</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css?v=16">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #fff;
            color: #000;
            font-size: 14px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ANNOUNCEMENT */
        .announcement-bar {
            background: #000;
            color: #fff;
            text-align: center;
            padding: 9px 20px;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* NAV */
        #main-nav {
            background: #fff;
            border-bottom: 1px solid #ebebeb;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 50px;
            max-width: 1440px;
            margin: 0 auto;
        }

        .nav-left {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-left a {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #000;
            transition: opacity 0.2s;
        }

        .nav-left a:hover {
            opacity: 0.4;
        }

        .nav-left a.active {
            text-decoration: underline;
            text-underline-offset: 4px;
            text-decoration-thickness: 1.5px;
        }

        .nav-logo a {
            font-size: 17px;
            font-weight: 900;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: #000;
        }

        .nav-right {
            display: flex;
            gap: 22px;
            align-items: center;
        }

        .nav-right a {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #000;
            transition: opacity 0.2s;
        }

        .nav-right a:hover {
            opacity: 0.4;
        }

        .nav-icon {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .nav-inner {
                padding: 15px 20px;
            }

            .nav-left {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- ANNOUNCEMENT BAR -->
    <div class="announcement-bar">
        COMPLIMENTARY WORLDWIDE SHIPPING &nbsp;|&nbsp; EXPLORE THE NEW COLLECTION
    </div>

    <!-- NAVIGATION -->
    <nav id="main-nav">
        <div class="nav-inner">
            <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
            <div class="nav-left">
                <a href="index.php" class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : ''; ?>">HOME</a>
                <a href="#" onclick="showDevModal(event)">SHOPS</a>
                <a href="collection.php" class="<?php echo ($current_page == 'collection.php') ? 'active' : ''; ?>">COLLECTION</a>
                <a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">ABOUT US</a>
            </div>
            <div class="nav-logo">
                <a href="index.php">MAISON VELOUR</a>
            </div>

            <div class="nav-right">
                <div style="position: relative; display: flex; align-items: center;">
                    <a href="#" onclick="toggleCurrencyPopup(event)" style="display:flex; align-items:center; gap:6px; margin-right:4px;">
                        <img src="https://flagcdn.com/w20/<?= htmlspecialchars($user_country_code) ?>.png" alt="Flag" style="width:18px; border-radius:2px; border:1px solid #eee;">
                        <span style="font-size:12px; font-weight:800;"><?= htmlspecialchars($user_currency_code) ?></span>
                    </a>




                    <!-- CURRENCY POPUP -->
                    <?php
                    // Fetch countries from database
                    $countries_query = "SELECT * FROM shipping_countries ORDER BY country_name ASC";
                    $countries_result = mysqli_query($db, $countries_query);
                    $countries_data = [];
                    if ($countries_result) {
                        while ($row = mysqli_fetch_assoc($countries_result)) {
                            $countries_data[] = $row;
                        }
                    }
                    ?>
                    <form method="GET" action="">
                        <div id="currencyPopup" class="currency-popup">
                            <div class="popup-label">Deliver to</div>
                            <div class="real-select-container">
                                <div class="select-icon-left">
                                    <img id="countryFlag" src="https://flagcdn.com/w20/<?= htmlspecialchars($user_country_code) ?>.png" alt="Flag" style="width:20px; border-radius:2px;">
                                </div>
                                <select class="real-select" id="countrySelect" name="countrySelect" onchange="updateFlag()">
                                    <?php foreach ($countries_data as $c): ?>
                                        <option value="<?= strtolower($c['country_code']) ?>" <?= strtolower($c['country_code']) == $user_country_code ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($c['country_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="popup-label">Language</div>
                            <div class="real-select-container">
                                <div class="select-icon-left">
                                    <i class="fa fa-globe" style="font-size:18px; color:#888;"></i>
                                </div>
                                <select class="real-select" name="languageSelect">
                                    <option value="EN" <?= $user_language == 'EN' ? 'selected' : '' ?>>English</option>
                                    <option value="ID" <?= $user_language == 'ID' ? 'selected' : '' ?>>Bahasa Indonesia</option>
                                </select>
                            </div>

                            <div class="popup-label">Currency</div>
                            <div class="real-select-container dark-border">
                                <select class="real-select" style="padding-left: 16px;" id="currencySelect" name="currencySelect">
                                    <?php
                                    // Get unique currencies
                                    $currencies_query = "SELECT DISTINCT currency_code, currency_name FROM shipping_countries ORDER BY currency_code ASC";
                                    $currencies_result = mysqli_query($db, $currencies_query);
                                    if ($currencies_result) {
                                        while ($row = mysqli_fetch_assoc($currencies_result)) {
                                            $selected = ($row['currency_code'] == $user_currency_code) ? 'selected' : '';
                                            echo "<option value=\"{$row['currency_code']}\" {$selected}>{$row['currency_code']} - {$row['currency_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" name="save_currency" class="popup-save-btn">Save</button>
                        </div>
                    </form>

                    <script>
                        const countryCurrencyMap = <?php
                                                    $map = [];
                                                    foreach ($countries_data as $c) {
                                                        $map[strtolower($c['country_code'])] = $c['currency_code'];
                                                    }
                                                    echo json_encode($map);
                                                    ?>;

                        function updateFlag() {
                            var select = document.getElementById('countrySelect');
                            var code = select.value.toLowerCase();
                            document.getElementById('countryFlag').src = 'https://flagcdn.com/w20/' + code + '.png';

                            var currSelect = document.getElementById('currencySelect');
                            if (countryCurrencyMap[code]) {
                                currSelect.value = countryCurrencyMap[code];
                            }
                        }
                    </script>
                </div>

                <a href="#" onclick="openCart(event)" style="font-size:18px; margin-right:4px; display:flex; align-items:center;"><i class="fa fa-shopping-bag"></i></a>

                <?php if (isset($_SESSION['Name'])): ?>
                    <a href="account.php">HI, <?php echo strtoupper(htmlspecialchars($_SESSION['Name'])); ?></a>
                    <a href="logout.php">LOGOUT</a>
                <?php else: ?>
                    <a href="account.php">
                        <i class="fa fa-user-o nav-icon"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- MODAL LOGIN -->
    <div class="modal fade" id="Modal_login" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:440px;">
            <div class="modal-content">
                <div class="modal-form-wrap">
                    <button type="button" class="close" data-dismiss="modal" style="position:absolute;right:18px;top:14px;background:none;border:none;font-size:22px;cursor:pointer;color:#999;">&times;</button>
                    <span class="modal-tag">LOGIN</span>
                    <p class="modal-subtitle">Welcome back to MAISON VELOUR</p>
                    <?php include "components/login_form.php"; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL REGISTER -->
    <div class="modal fade" id="Modal_register" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:440px;">
            <div class="modal-content">
                <div class="modal-form-wrap">
                    <button type="button" class="close" data-dismiss="modal" style="position:absolute;right:18px;top:14px;background:none;border:none;font-size:22px;cursor:pointer;color:#999;">&times;</button>
                    <span class="modal-tag">REGISTER</span>
                    <p class="modal-subtitle">Create account to earn points, get free vouchers, and hear our news earlier.</p>
                    <?php include "components/register_form.php"; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- CART DRAWER -->
    <div class="cart-drawer-overlay" id="cartOverlay" onclick="closeCart()"></div>
    <div class="cart-drawer" id="cartDrawer">
        <div class="cart-drawer-header">
            <div class="cart-drawer-title">Your Cart</div>
            <button class="cart-drawer-close" onclick="closeCart()">&times;</button>
        </div>
        <div class="cart-drawer-body">
            <div class="cart-empty-title">Cart is Empty</div>
            <div class="cart-empty-desc">Add products or login to continue shopping.</div>
            <div class="cart-btn-group">
                <button class="v-btn-outline" style="margin:0; width:auto; padding:12px 20px; font-size:10px;" onclick="window.location.href='index.php#collection'">CONTINUE SHOPPING</button>
                <button class="v-btn-dark" style="margin:0; width:auto; padding:12px 30px; font-size:10px;" data-toggle="modal" data-target="#Modal_login" onclick="closeCart()">LOGIN</button>
            </div>

            <div class="cart-recent-title">You Might Also Like</div>
            <div class="cart-recent-grid">
                <div class="cart-recent-item">
                    <img src="images/products/perfume_amber_lifestyle.jpg" class="cart-recent-img" alt="L'Ambre Doré">
                    <div class="cart-recent-add" onclick="showDevModal(event)"><i class="fa fa-shopping-bag" style="font-size:11px; transform: translateY(-1px);"></i></div>
                    <div class="cart-recent-name">L'AMBRE DORÉ</div>
                    <div class="cart-recent-price">IDR 1.750.000</div>
                </div>
                <div class="cart-recent-item">
                    <img src="images/products/perfume_velvet_lifestyle.jpg" class="cart-recent-img" alt="Velours Cramoisi">
                    <div class="cart-recent-add" onclick="showDevModal(event)"><i class="fa fa-shopping-bag" style="font-size:11px; transform: translateY(-1px);"></i></div>
                    <div class="cart-recent-name">VELOURS CRAMOISI</div>
                    <div class="cart-recent-price">IDR 2.800.000</div>
                </div>
            </div>
        </div>
    </div>


    <!-- DEVELOPMENT MODAL OVERLAY -->
    <div id="devModalOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center; opacity:0; transition:opacity 0.3s;">
        <div id="devModalContent" style="background:#fff; width:350px; padding:40px 30px; text-align:center; box-shadow:0 15px 50px rgba(0,0,0,0.2); border-radius:4px; transform:translateY(20px); transition:transform 0.3s;">
            <i class="fa fa-paint-brush" style="font-size:36px; color:#111; margin-bottom:20px;"></i>
            <h3 style="font-family:'Montserrat', sans-serif; font-weight:800; font-size:18px; margin-bottom:12px; text-transform:uppercase; letter-spacing:1px; color:#000;">Coming Soon</h3>
            <p style="font-size:13px; color:#555; line-height:1.6; margin-bottom:30px;">This page is currently under development and will be available in the upcoming release.</p>
            <button class="v-btn-dark" onclick="closeDevModal()" style="width:100%; padding:14px; font-weight:700; letter-spacing:1px; border-radius:2px;">CLOSE</button>
        </div>
    </div>

    <script>
        function showDevModal(e) {
            e.preventDefault();
            var overlay = document.getElementById('devModalOverlay');
            var content = document.getElementById('devModalContent');
            overlay.style.display = 'flex';
            // trigger reflow
            void overlay.offsetWidth;
            overlay.style.opacity = '1';
            content.style.transform = 'translateY(0)';
        }

        function closeDevModal() {
            var overlay = document.getElementById('devModalOverlay');
            var content = document.getElementById('devModalContent');
            overlay.style.opacity = '0';
            content.style.transform = 'translateY(20px)';
            setTimeout(function() {
                overlay.style.display = 'none';
            }, 300);
        }
    </script>