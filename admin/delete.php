<?php
ob_start();
session_start();

if (isset($_GET['file'])) {
    $filename = basename($_GET['file']);
    $imagePath = __DIR__ . '/../uploads/' . $filename;
    $jsonFile = __DIR__ . '/../data/gallery.json';

    if (file_exists($imagePath)) {
        unlink($imagePath); // delete image
    }

    // Load JSON and remove entry
    $gallery = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

    $gallery = array_filter($gallery, function ($item) use ($filename) {
        return $item['filename'] !== $filename;
    });

    // Try saving updated JSON
    if (is_writable(dirname($jsonFile))) {
        file_put_contents($jsonFile, json_encode(array_values($gallery), JSON_PRETTY_PRINT));
    } else {
        die("❌ JSON folder is not writable.");
    }

    header("Location: dashboard.php?deleted=1");
    exit;
}
?>
