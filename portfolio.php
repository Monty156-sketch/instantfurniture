<?php
$gallery = [];
$jsonPath = __DIR__ . '/data/gallery.json';

if (file_exists($jsonPath)) {
    $jsonContent = file_get_contents($jsonPath);
    $gallery = json_decode($jsonContent, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Portfolio | Instant Furniture</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .portfolio-gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }
    .portfolio-item {
      width: 300px;
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    .portfolio-item:hover {
      transform: scale(1.03);
    }
    .portfolio-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .caption {
      padding: 15px;
    }
    .filters {
      text-align: center;
      margin-bottom: 30px;
    }
    .filter-btn {
      margin: 5px;
    }
  </style>
</head>
<body class="container py-4">

  <h2 class="text-center mb-4">🛠️ Our Portfolio</h2>

  <div class="filters">
    <button class="btn btn-outline-primary filter-btn" data-category="all">All</button>
    <button class="btn btn-outline-primary filter-btn" data-category="wardrobe">Wardrobes</button>
    <button class="btn btn-outline-primary filter-btn" data-category="bed">Beds</button>
    <button class="btn btn-outline-primary filter-btn" data-category="kitchen">Kitchen Cabinets</button>
    <button class="btn btn-outline-primary filter-btn" data-category="tv">TV Cabinets</button>
    <button class="btn btn-outline-primary filter-btn" data-category="sofa">Sofa chairs</button>
    <button class="btn btn-outline-primary filter-btn" data-category="int & ext decor">Interior & Exterior Decoration</button>
  </div>

  <div class="portfolio-gallery" id="portfolio-gallery">
    <?php foreach ($gallery as $item): ?>
      <div class="portfolio-item" data-category="<?= htmlspecialchars($item['category']) ?>">
        <img src="uploads/<?= htmlspecialchars($item['filename']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
        <div class="caption">
          <h5><?= htmlspecialchars($item['title']) ?></h5>
          <p><?= htmlspecialchars($item['description']) ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <script>
    const buttons = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.portfolio-item');

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        const category = button.getAttribute('data-category');

        items.forEach(item => {
          item.style.display = 
            (category === 'all' || item.getAttribute('data-category') === category)
              ? 'block'
              : 'none';
        });
      });
    });
  </script>

</body>
</html>
