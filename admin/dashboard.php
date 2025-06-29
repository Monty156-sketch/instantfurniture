<?php
$gallery = json_decode(file_get_contents('../data/gallery.json'), true);
?>
<?php require_once('auth.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h2>🛠️ Admin Panel – Uploaded Images</h2>
  <a href="upload.php" class="btn btn-primary mb-3">Upload New</a>
  <a href="logout.php" class="btn btn-outline-danger">Logout</a>

  <?php foreach ($gallery as $index => $item): ?>
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="uploads/<?= htmlspecialchars($item['filename']) ?>" class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5><?= htmlspecialchars($item['title']) ?></h5>
            <p><?= htmlspecialchars($item['description']) ?></p>
            <a href="edit.php?id=<?= $index ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="delete.php?id=<?= $index ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this image?')">Delete</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</body>
</html>
