<?php
$gallery = json_decode(file_get_contents('data/gallery.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Portfolio - InstanFurniture</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .filters {
      text-align: center;
      margin-bottom: 20px;
    }

    .filters button {
      margin: 5px;
    }

    .gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .gallery-item {
      width: calc(33.33% - 20px);
      background: #f8f9fa;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 10px;
      text-align: center;
    }

    .gallery-item img {
      width: 100%;
      height: auto;
      border-radius: 8px;
    }

    @media (max-width: 768px) {
      .gallery-item {
        width: 100%;
      }
    }
  </style>
</head>
<body class="container py-5">
  
  <header>
    <h1>Instant Furniture</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="services.html">Services</a>
      <a href=portfolio.html>Portfolio</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>
  <h2 class="text-center mb-4">🖼️ Our Portfolio</h2>

  <!-- Filter Buttons -->
  <div class="filters">
    <button class="filter-btn btn btn-dark" data-category="all">All</button>
    <button class="filter-btn btn btn-outline-dark" data-category="wardrobe">Wardrobes</button>
    <button class="filter-btn btn btn-outline-dark" data-category="bed">Beds</button>
    <button class="filter-btn btn btn-outline-dark" data-category="kitchen">Kitchen Cabinets</button>
    <button class="filter-btn btn btn-outline-dark" data-category="tv">TV Cabinets</button>
    <button class="filter-btn btn btn-outline-dark" data-category="sofa">Sofa chairs</button>
    <button class="filter-btn btn btn-outline-dark" data-category="int & ext decor">Interior & Exterior Decoration</button>
  </div>

  <!-- Gallery Items -->
  <div class="gallery" id="gallery">
    <?php foreach ($gallery as $item): ?>
      <div class="gallery-item" data-category="<?= strtolower(htmlspecialchars($item['category'])) ?>">
        <img src="admin/uploads/<?= htmlspecialchars($item['filename']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
        <h5 class="mt-2"><?= htmlspecialchars($item['title']) ?></h5>
        <p><?= htmlspecialchars($item['description']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Filtering Script -->
  <script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        const category = button.getAttribute('data-category');
        galleryItems.forEach(item => {
          const itemCategory = item.getAttribute('data-category');
          if (category === 'all' || itemCategory === category) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });

        // Optional: highlight active button
        filterButtons.forEach(btn => btn.classList.remove('btn-dark'));
        button.classList.add('btn-dark');
      });
    });
  </script>
</body>
</html>
