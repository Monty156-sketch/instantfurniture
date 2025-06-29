<?php
$id = $_GET['id'];
$galleryFile = '../data/gallery.json';
$gallery = json_decode(file_get_contents($galleryFile), true);

// Delete image file
$filename = $gallery[$id]['filename'];
unlink('uploads/' . $filename);

// Remove from array
array_splice($gallery, $id, 1);

// Save updated data
file_put_contents($galleryFile, json_encode($gallery, JSON_PRETTY_PRINT));

// Redirect
header('Location: dashboard.php');
exit;
