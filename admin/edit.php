<?php
$id = $_GET['id'];
$gallery = json_decode(file_get_contents('../data/gallery.json'), true);
$item = $gallery[$id];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Image</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h3>Edit Image</h3>
  <form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="mb-3">
      <label>Title:</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($item['title']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Description:</label>
      <textarea name="description" class="form-control" required><?= htmlspecialchars($item['description']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
