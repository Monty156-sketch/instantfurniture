<?php
$id = $_POST['id'];
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);

$galleryFile = '../data/gallery.json';
$gallery = json_decode(file_get_contents($galleryFile), true);

$gallery[$id]['title'] = $title;
$gallery[$id]['description'] = $description;

file_put_contents($galleryFile, json_encode($gallery, JSON_PRETTY_PRINT));

header('Location: dashboard.php');
exit;
