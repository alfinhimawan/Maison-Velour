<?php
require 'config/config.php';
require 'components/header.php';
?>

<!-- HERO SECTION -->
<div style="position:relative; width:100%; height:50vh; overflow:hidden; background-color:#111; display:flex; align-items:center; justify-content:center;">
    <img src="images/hero_banner_lifestyle.jpg" alt="Maison Velour Heritage" style="position:absolute; width:100%; height:100%; object-fit:cover; opacity:0.4;">
    <h1 style="position:relative; color:#fff; font-size:3rem; font-weight:800; letter-spacing:8px; text-transform:uppercase; z-index:2;">Our Heritage</h1>
</div>

<!-- CONTENT SECTION -->
<div style="background-color: #fff; padding: 100px 5%; display: flex; justify-content: center;">
    <div style="max-width: 1200px; width: 100%; display: flex; flex-wrap: wrap; gap: 60px; align-items: center;">

        <!-- LEFT: IMAGE -->
        <div style="flex: 1; min-width: 300px; position:relative;">
            <img src="images/hero_option_2_close_up.jpg" alt="Craftsmanship" style="width:100%; height:auto; border-radius:4px; box-shadow: 0 20px 50px rgba(0,0,0,0.1);">
        </div>

        <!-- RIGHT: TEXT -->
        <div style="flex: 1; min-width: 300px; color: #111;">
            <h2 style="font-family:'Montserrat', sans-serif; font-size:24px; font-weight:700; margin-bottom:20px; letter-spacing:2px; text-transform:uppercase;">The Art of Perfumery</h2>
            <div style="width: 50px; height: 2px; background-color: #000; margin-bottom: 30px;"></div>

            <p style="font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 500; line-height: 2.2; margin-bottom: 30px; color: #444;">
                Maison Velour is an independent luxury perfume house conceptualized in Paris, France. Established with a vision to translate raw emotions into olfactory masterpieces, every bottle is a testament to uncompromising craftsmanship and the rarest ingredients sourced globally.
            </p>
            <p style="font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 500; line-height: 2.2; color: #444;">
                Since its inception, Maison Velour has cultivated a devoted presence among modern fragrance connoisseurs. We go beyond merely creating scents; we curate deeply personal sensory experiences by blending timeless Parisian perfumery techniques with cutting-edge modern aesthetics.
            </p>

            <p style="font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 700; line-height: 2.2; color: #111; margin-top:40px; letter-spacing:1px; text-transform:uppercase;">
                — The Founder, Maison Velour
            </p>
        </div>

    </div>
</div>

<!-- BOTTOM BANNER -->
<div style="width:100%; padding: 80px 20px; background-color:#f9f9f9; text-align:center;">
    <h3 style="font-size:20px; font-weight:600; letter-spacing:4px; margin-bottom:20px;">DISCOVER YOUR SIGNATURE SCENT</h3>
    <a href="collection.php" style="display:inline-block; padding:15px 40px; background-color:#000; color:#fff; text-decoration:none; font-weight:600; letter-spacing:2px; font-size:12px; transition: opacity 0.3s;" onmouseover="this.style.opacity=0.7" onmouseout="this.style.opacity=1">EXPLORE COLLECTION</a>
</div>

<?php require 'components/footer.php'; ?>