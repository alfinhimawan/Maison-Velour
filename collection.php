<?php
require 'app/config/config.php';
require 'app/components/header.php';

// Dynamically scan the lookbook directory for images
$lookbookDir = __DIR__ . '/assets/images/lookbook/';
$images = [];
if (is_dir($lookbookDir)) {
    $files = scandir($lookbookDir);
    foreach ($files as $file) {
        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
            $images[] = $file;
        }
    }
}

// Ensure we have at least one image to prevent errors
if (empty($images)) {
    $images[] = 'hero_lifestyle.jpg'; // fallback
}

shuffle($images);
$totalItems = count($images);
?>

<div class="lookbook-container">
    <?php for ($i = 0; $i < $totalItems; $i++):
        $randomImage = $images[$i];
    ?>
        <div class="lookbook-item">
            <img src="assets/images/lookbook/<?php echo htmlspecialchars($randomImage); ?>?v=<?php echo time(); ?>" alt="Brand Ambassador <?php echo $i + 1; ?>" loading="lazy">
        </div>
    <?php endfor; ?>

</div>

<?php require 'app/components/footer.php'; ?>