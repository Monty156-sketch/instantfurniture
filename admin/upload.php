<?php
ob_start();
session_start();
require_once('auth.php');

// Ensure uploads directory exists
$uploadDir = '../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $category = strtolower(trim($_POST['category']));

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Update gallery.json
            $jsonFile = '../data/gallery.json';
            $gallery = [];

            if (file_exists($jsonFile)) {
                $gallery = json_decode(file_get_contents($jsonFile), true);
            }

            $imageData = [
                "filename" => $filename,
                "title" => $title,
                "description" => $description,
                "category" => $category
            ];

            array_unshift($gallery, $imageData);
            file_put_contents($jsonFile, json_encode($gallery, JSON_PRETTY_PRINT));

            header("Location: dashboard.php?success=1");
            exit;
        } else {
            $error = "❌ Failed to move uploaded file. Make sure the uploads folder is writable.";
        }
    } else {
        $error = "❌ Please choose a valid image file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Portfolio Image</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">📤 Upload New Portfolio Item</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title">Title:</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="description">Description:</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label for="category">Category:</label>
      <select name="category" class="form-control" required>
        <option value="wardrobe">Wardrobes</option>
        <option value="bed">Beds</option>
        <option value="kitchen">Kitchen Cabinets</option>
        <option value="tv">TV Cabinets</option>
        <option value="sofa">Sofa chairs</option>
        <option value="int & ext decor">Interior & Exterior Decoration</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="image">Image File:</label>
      <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Upload</button>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
  </form>
</body>
</html>
