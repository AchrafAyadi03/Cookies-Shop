<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>L'art du Cookie | Pâtisserie artisanale</title>
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/cart.css" rel="stylesheet">
  <script src="assets/js/script.js" defer></script>
  <script src="assets/js/cart.js" defer></script>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- GSAP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

  <?php
  require_once('app/models/Product.php');
  $product = new cookies();
  $stmt = $product->listCookies();
  $cookiesList = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

</head>
<body>

<!-- Custom cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- ═══ NAVBAR ════════════════════════════════════════════════ -->
<nav class="navbar" id="navbar">
  <a href="index.php" class="navbar-brand">
    <img src="assets/images/logo2.png" alt="L'art du Cookie">
  </a>
  <div class="navbar-menu">
    <a href="index.php">Accueil</a>
    <a href="app/views/products/listCookies.php">Produits</a>
    <a href="#contact">Contact</a>
    <a href="app/views/products/cart.php" class="cart-link">
      <i class="fas fa-shopping-cart"></i>
      <span id="cart-count" class="cart-count">0</span>
    </a>
  </div>
</nav>

<!-- ═══ HERO ══════════════════════════════════════════════════ -->
<section class="video-background" id="accueil">
  <div class="left-content" id="heroContent">
    <div class="hero-badge">
      <span class="hero-badge-dot"></span>
      Artisanal · Paris
    </div>
    <h1 class="bbh-hegarty-regular">
      TASTE THE<br><em>DIFFERENCE</em>
    </h1>
    <p class="description">
      Chaque cookie est préparé à partir d'ingrédients soigneusement sélectionnés pour créer un équilibre parfait entre douceur et intensité.
    </p>
    <div class="hero-actions">
      <button class="cta-button" id="ctaBtn">
        Découvrir
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M3 8h10M9 4l4 4-4 4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
      <a href="#contact" class="hero-link">Commander une box</a>
    </div>
  </div>

  <video class="bg-video" autoplay muted loop playsinline>
    <source src="assets/videos/intro.mp4" type="video/mp4">
  </video>

  <div class="scroll-indicator">
    <span>Scroll</span>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- ═══ MARQUEE 1 ═════════════════════════════════════════════ -->
<div class="marquee-strip">
  <div class="marquee-track" id="marqueeTrack">
    <span>Beurre AOP</span><span class="sep">✦</span>
    <span>Fait maison chaque matin</span><span class="sep">✦</span>
    <span>Chocolat grand cru</span><span class="sep">✦</span>
    <span>Livraison Paris</span><span class="sep">✦</span>
    <span>Depuis 2018</span><span class="sep">✦</span>
    <span>Sans conservateurs</span><span class="sep">✦</span>
    <span>Beurre AOP</span><span class="sep">✦</span>
    <span>Fait maison chaque matin</span><span class="sep">✦</span>
    <span>Chocolat grand cru</span><span class="sep">✦</span>
    <span>Livraison Paris</span><span class="sep">✦</span>
    <span>Depuis 2018</span><span class="sep">✦</span>
    <span>Sans conservateurs</span><span class="sep">✦</span>
  </div>
</div>

<section class="next-section" id="produits">
  <div class="section-title">
    <div class="section-label">L'Artisanat du Cookie</div>
    <h2>Des cookies croquants,<br><em>fondants</em> & généreux</h2>
    <p>
      Conçus pour offrir une texture fondante et un goût généreux, chaque cookie est une expérience gourmande qui ravira les amateurs de douceurs.
    </p>
  </div>

  <div class="cookie">
    <img src="assets/images/cookies.png" alt="Cookie artisanal" class="cookie-imgg">
  </div>
</section>

<div class="marquee-strip-dark">
  <div class="marquee-track">
    <span>Cookie Brownie</span><span class="sep">◆</span>
    <span>Noisette & Praliné</span><span class="sep">◆</span>
    <span>Caramel Beurre Salé</span><span class="sep">◆</span>
    <span>Red Velvet</span><span class="sep">◆</span>
    <span>Matcha & Yuzu</span><span class="sep">◆</span>
    <span>Pistache & Framboise</span><span class="sep">◆</span>
    <span>Cookie Brownie</span><span class="sep">◆</span>
    <span>Noisette & Praliné</span><span class="sep">◆</span>
    <span>Caramel Beurre Salé</span><span class="sep">◆</span>
    <span>Red Velvet</span><span class="sep">◆</span>
    <span>Matcha & Yuzu</span><span class="sep">◆</span>
    <span>Pistache & Framboise</span><span class="sep">◆</span>
  </div>
</div>

<!-- ═══ SHOWCASE ══════════════════════════════════════════════ -->
<div class="showcase" id="showcase">
  <div class="section-title2">
    <div class="section-label">Nos créations</div>
    <h2>Les cookies qui font<br><em>chavirer les cœurs</em></h2>
  </div>

  <div class="showcase-grid">
    <?php
      $limit = min(4, count($cookiesList));
      for ($i = 0; $i < $limit; $i++):
    ?>
      <div class="cookie-card">
        <div class="cookie-img">
         
          <img
            src="assets/images/<?php echo htmlspecialchars($cookiesList[$i]['image']);?>"
            alt="<?php echo htmlspecialchars($cookiesList[$i]['nom']); ?>"
          >
          <span class="cookie-tag">Nouveau</span>
        </div>

        <div class="cookie-info">
          <h3><?php echo htmlspecialchars($cookiesList[$i]['nom']); ?></h3>
          <p><?php  $desc = htmlspecialchars($cookiesList[$i]['description']);
              echo strlen($desc) > 60 ? substr($desc, 0, 60) . '...' : $desc;?></p>

          <div class="cookie-footer">
            <span class="price"><?php echo number_format($cookiesList[$i]['prix'], 2, ',', ' '); ?> Dt</span>
            <button class="add-btn" aria-label="Ajouter au panier">+</button>
          </div>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</div>

<a href="./app/views/products/listCookies.php" class="produits-btn">Voir les produits</a>

<!-- ═══ CONTACT ═══════════════════════════════════════════════ -->
<section class="contact-section" id="contact">
  <div class="contact-container">

    <div class="contact-left">
      <div class="contact-eyebrow">Commander</div>
      <h2>Croquez la<br><em>gourmandise</em></h2>
      <p>Commandez vos cookies artisanaux ou venez nous rendre visite dans notre atelier. Fraîcheur et passion vous attendent chaque matin.</p>
      <div class="contact-details">
        <a href="#">
          <span class="contact-icon"><i class="fas fa-map-marker-alt"></i></span>
          12 Rue des Gourmandises, 75001 Paris
        </a>
        <a href="tel:+33123456789">
          <span class="contact-icon"><i class="fas fa-phone-alt"></i></span>
          +33 1 23 45 67 89
        </a>
        <a href="mailto:hello@cookielart.com">
          <span class="contact-icon"><i class="fas fa-envelope"></i></span>
          hello@cookielart.com
        </a>
        <a href="#">
          <span class="contact-icon"><i class="fab fa-instagram"></i></span>
          @cookielart_paris
        </a>
      </div>
    </div>

    <div class="contact-right">
      <h3>Réservez votre box</h3>
      <form >
        <div class="form-group">
          <input type="text" name="nom" placeholder="Votre nom" required>
        </div>
        <div class="form-group">
          <input type="email" name="email" placeholder="Adresse e-mail" required>
        </div>
        <div class="form-group">
          <textarea name="message" rows="4" placeholder="Quel cookie vous fait envie ? Dites-nous tout…"></textarea>
        </div>
        <button type="submit">
          Envoyer ma commande
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M3 8h10M9 4l4 4-4 4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </form>
    </div>

  </div>
</section>

<!-- ═══ FOOTER ════════════════════════════════════════════════ -->
<footer>
  <p>© 2025 L'art du Cookie — Fraîchement préparé avec passion & beurre AOP</p>
  <span>Paris, France</span>
</footer>

<script>
  // Définir le chemin du contrôleur du panier pour la page d'accueil
  window.CART_CONTROLLER_URL = 'app/controllers/CartController.php';
  
  // Gestion du panier depuis la page d'accueil
  document.addEventListener('DOMContentLoaded', function() {
    // Initialiser le compteur du panier
    updateCartCount();
    
    // Ajouter au panier depuis les produits en vedette
    document.querySelectorAll('.add-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Chercher l'ID du produit le plus proche
        const cookieCard = this.closest('[data-product-id], .cookie-card');
        if (cookieCard && cookieCard.dataset.productId) {
          addToCart(cookieCard.dataset.productId, 1);
        }
      });
    });
  });
</script>

</body>
</html>