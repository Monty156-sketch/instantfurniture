<!-- Save this as index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instant Furniture</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
      color: #333;
    }
    header {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background: #f8f8f8;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    nav a {
      margin: 0 1rem;
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }
    .hero {
      background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c') center/cover no-repeat;
      height: 90vh;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 2rem;
      text-shadow: 0 2px 4px rgba(0,0,0,0.6);
    }
    .hero h1 {
      font-size: 3rem;
    }
    .hero p {
      font-size: 1.2rem;
      margin: 1rem 0;
    }
    .hero .buttons {
      margin-top: 1rem;
    }
    .hero button {
      background: #333;
      color: white;
      border: none;
      padding: 0.8rem 1.5rem;
      margin-right: 1rem;
      border-radius: 5px;
      cursor: pointer;
    }
    .section {
      padding: 3rem 2rem;
      max-width: 1200px;
      margin: auto;
    }
    .section h2 {
      text-align: center;
      margin-bottom: 2rem;
      font-size: 2rem;
    }
    .services {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      text-align: center;
    }
    .services div {
      background: #f9f9f9;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .portfolio img {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 1rem;
    }
    .cta {
      background: #333;
      color: white;
      text-align: center;
      padding: 3rem 2rem;
    }
    .cta button {
      background: white;
      color: #333;
      border: none;
      padding: 1rem 2rem;
      margin-top: 1rem;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    footer {
      background: #f1f1f1;
      text-align: center;
      padding: 1rem;
      font-size: 0.9rem;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }
      .hero p {
        font-size: 1rem;
      }
      .hero {
        padding: 1rem;
        text-align: center;
      }
      nav {
        width: 100%;
        margin-top: 1rem;
        text-align: center;
      }
      nav a {
        display: inline-block;
        margin: 0.5rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Instant Furniture</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="services.html">Services</a>
      <a href=portfolio.php>Portfolio</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <section class="hero">
    <h1>Crafting Modern Elegance in Wood</h1>
    <p>Beautiful wardrobes, cabinets, beds and more — handcrafted to perfection.</p>
    <p>We build wardrobes, kitchen cabinets, beds — and deliver stunning interior & exterior decoration.</p>
    <div class="buttons">
     <a href="portfolio.php" class="btn">View Portfolio</a>
    </div>
  </section>

  <section class="section">
    <h2>Our Services</h2>
    <div class="services">
      <div>
        <h3>Wardrobes</h3>
        <p>Custom-designed wardrobes for all spaces.</p>
      </div>
      <div>
        <h3>Kitchen Cabinets</h3>
        <p>Modern, sleek, and functional kitchen setups.</p>
      </div>
      <div>
        <h3>Furniture</h3>
        <p>Tables, chairs, and unique pieces for your home.</p>
      </div>
      <div>
        <h3>Wall TV Cabinets</h3>
        <p>Stylish and space-saving TV unit designs.</p>
      </div>
      <div>
        <h3>Beds</h3>
        <p>Comfort meets craftsmanship in every bed.</p>
      </div>
      <div>
        <h3>Interior and Exterior Decoration</h3>
        <p>Modern and elegant decoration for both indoor and outdoor spaces.</p>
      </div>
    </div>
  </section>
<!-- Start of Recent Works -->
<section id="recent-works">
  <h2>🧰 Recent Works</h2>
  <div class="gallery">
    <?php
    $gallery = json_decode(file_get_contents('data/gallery.json'), true);
    $recent = array_slice($gallery, 0, 4); // Only latest 4 works
    foreach ($recent as $item) {
        echo '<div class="gallery-item">';
        echo '<img src="admin/uploads/' . htmlspecialchars($item['filename']) . '" alt="' . htmlspecialchars($item['title']) . '">';
        echo '<h4>' . htmlspecialchars($item['title']) . '</h4>';
        echo '<p>' . htmlspecialchars($item['description']) . '</p>';
        echo '</div>';
    }
    ?>
  </div>
</section>

  <section class="cta">
    <h2>Ready to build your dream furniture?</h2>
    <p>Let’s bring your ideas to life with premium craftsmanship.</p>
  <div class="hero-buttons">
    <!-- Replace or add this -->
    <a href="contact.html" class="btn btn-primary">Contact Us</a>
    <a href="admin/login.php" style="opacity: 0.7;">Admin Login</a>
</div>

  </section>

  <footer>
    &copy; 2025 Instant Furniture | Phone: +233 53 027 99 09 | Email: mumtaxsamsideen0@gmail.com
  </footer>
<marquee behavior="scroll" direction="left" scrollamount="5" style="background: #f8f9fa; padding: 10px; font-size: 1.1em; font-weight: bold;">
  Welcome To InstantFurniture, Your Home of Comfortability and Durability. Your Dream Will Be Become Reality at InstantFurniture
</marquee>

</body>
</html>
