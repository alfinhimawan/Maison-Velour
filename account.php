<?php
include "app/config/config.php";
include "app/components/header.php";
?>

<style>
    body {
        background: #f9f9f9;
    }

    .account-container {
        max-width: 1000px;
        margin: 60px auto;
        padding: 0 30px;
        min-height: 60vh;
    }

    .account-title {
        font-size: 24px;
        font-weight: 900;
        letter-spacing: -0.5px;
        text-transform: uppercase;
        margin-bottom: 30px;
    }

    .account-banner {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .banner-text h3 {
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 8px;
        color: #000;
    }

    .banner-text p {
        font-size: 12px;
        color: #777;
        line-height: 1.6;
        max-width: 600px;
        margin: 0;
    }

    .banner-actions {
        display: flex;
        gap: 12px;
    }

    .account-tabs-wrap {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .account-tabs {
        display: flex;
        border-bottom: 1px solid #eee;
    }

    .account-tab {
        flex: 1;
        text-align: center;
        padding: 20px;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        color: #999;
        transition: color 0.2s, border-bottom 0.2s;
        border-bottom: 2px solid transparent;
    }

    .account-tab.active {
        color: #000;
        border-bottom-color: #000;
    }

    .account-content {
        padding: 40px;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 60px;
    }

    .order-header-title {
        font-size: 14px;
        font-weight: 800;
    }

    .order-filter {
        padding: 10px 16px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        outline: none;
    }

    .empty-state {
        text-align: center;
        color: #999;
        padding: 40px 0;
    }

    .empty-state i {
        font-size: 40px;
        color: #ddd;
        margin-bottom: 20px;
        display: block;
    }

    .empty-title {
        font-size: 14px;
        font-weight: 800;
        color: #000;
        margin-bottom: 8px;
    }

    .empty-desc {
        font-size: 13px;
        color: #777;
    }
</style>

<div class="account-container">
    <h1 class="account-title">My Account</h1>

    <?php if (!isset($_SESSION['Name'])): ?>
        <!-- BANNER FOR LOGGED OUT USERS -->
        <div class="account-banner">
            <div class="banner-text">
                <h3>Unlock Exclusive Privileges & Track Your Orders</h3>
                <p>Create an account to gain early access to our newest olfactory creations and effortlessly track your bespoke orders. Experience the true essence of Parisian luxury, curated exclusively for you.</p>
            </div>
            <div class="banner-actions">
                <button class="v-btn-outline" style="margin:0; padding:12px 30px; font-size:11px;" data-toggle="modal" data-target="#Modal_login">LOGIN</button>
                <button class="v-btn-dark" style="margin:0; padding:12px 30px; font-size:11px;" data-toggle="modal" data-target="#Modal_register">REGISTER</button>
            </div>
        </div>
    <?php endif; ?>

    <!-- TABS SECTION -->
    <div class="account-tabs-wrap">
        <div class="account-tabs">
            <div class="account-tab active" id="tab-orders" onclick="switchTab('orders')">Orders</div>
            <div class="account-tab" id="tab-wishlist" onclick="switchTab('wishlist')">Wishlist</div>
        </div>

        <!-- ORDERS CONTENT -->
        <div class="account-content" id="content-orders">
            <div class="order-header">
                <div class="order-header-title">My Orders (0)</div>
                <select class="order-filter">
                    <option>All Status</option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                </select>
            </div>

            <div class="empty-state">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:20px;">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                <div class="empty-title">NO ORDERS FOUND</div>
                <div class="empty-desc">Please make an order to see it here.</div>
            </div>
        </div>

        <!-- WISHLIST CONTENT (HIDDEN BY DEFAULT) -->
        <div class="account-content" id="content-wishlist" style="display:none; text-align:center; padding: 100px 40px;">
            <div class="empty-state" style="padding: 0;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:20px;">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                <div class="empty-title">WISHLIST IS EMPTY</div>
                <div class="empty-desc">Please check back later for updates.</div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tab) {
        // Update tab classes
        document.getElementById('tab-orders').classList.remove('active');
        document.getElementById('tab-wishlist').classList.remove('active');
        document.getElementById('tab-' + tab).classList.add('active');

        // Update content visibility
        document.getElementById('content-orders').style.display = 'none';
        document.getElementById('content-wishlist').style.display = 'none';
        document.getElementById('content-' + tab).style.display = 'block';
    }
</script>

<?php
include "app/components/footer.php";
