<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails Produit | L'art du Cookie</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="produitdetails.css">
  <script src="../assets/js/script.js" defer></script>
  <script src="produitdetails.js" defer></script>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- GSAP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
</head>
<body>

  <!-- Custom cursor -->
  <div class="cursor" id="cursor"></div>
  <div class="cursor-ring" id="cursorRing"></div>

  <!-- ═══ NAVBAR ════════════════════════════════════════════════ -->
  <nav class="navbar" id="navbar">
    <a href="../index.html" class="navbar-brand">
      <img src="../assets/images/logo2.png" alt="L'art du Cookie">
    </a>
    <div class="navbar-menu">
      <a href="../index.html">Accueil</a>
      <a href="produits.html">Produits</a>
      <a href="../index.html#contact">Contact</a>
    </div>
  </nav>

  <!-- ═══ BREADCRUMB ════════════════════════════════════════════ -->
  <div class="breadcrumb">
    <a href="../index.html">Accueil</a>
    <span>›</span>
    <a href="produits.html">Produits</a>
    <span>›</span>
    <span id="breadcrumbName">Cookie</span>
  </div>

  <!-- ═══ PRODUCT DETAILS ═══════════════════════════════════════ -->
  <section class="product-section">
    <div class="product-container">

      <!-- Image Gallery -->
      <div class="product-gallery">
        <div class="main-image">
          <img id="mainImage" src="../assets/images/Cookie-ChocoNoisettes-Modifier.jpg" alt="Cookie">
        </div>
       
      </div>

      <!-- Product Info -->
      <div class="product-info">

        <!-- Badge & Title -->
        <div class="product-header">
          <span id="productBadge" class="product-badge">Bestseller</span>
          <h1 id="productName" class="product-title">Cookie Brownie</h1>
        </div>

        <!-- Rating & Reviews -->
        <div class="product-rating">
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <span class="rating-text">4.8 / 5 (127 avis)</span>
        </div>

        <!-- Description -->
        <p id="productDescription" class="product-description">
          Éclats de chocolat noir, cœur fondant intense. Chaque cookie est préparé à partir d'ingrédients soigneusement sélectionnés pour créer un équilibre parfait entre douceur et intensité.
        </p>

        <!-- Price & Availability -->
        <div class="product-pricing">
          <div class="price-container">
            <span class="price-label">Prix:</span>
            <span id="productPrice" class="price">4,90 €</span>
          </div>
          <div class="availability">
            <i class="fas fa-check-circle"></i>
            <span>En stock</span>
          </div>
        </div>

        <!-- Quantity & Actions -->
        <div class="product-actions">
          <div class="quantity-selector">
            <button id="decreaseQty" class="qty-btn">−</button>
            <input type="number" id="quantity" value="1" min="1" readonly>
            <button id="increaseQty" class="qty-btn">+</button>
          </div>
          <button id="addToCartBtn" class="add-to-cart-btn">
            <i class="fas fa-shopping-cart"></i> Ajouter au panier
          </button>
        </div>

        <!-- Details Tabs -->
        <div class="product-tabs">
          <button class="tab-btn active" data-tab="ingredients">Ingrédients</button>
          <button class="tab-btn" data-tab="nutrition">Nutrition</button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
          <div id="ingredients" class="tab-pane active">
            <ul>
              <li>Farine de blé biologique</li>
              <li>Beurre AOP Normandie</li>
              <li>Chocolat noir grand cru 72%</li>
              <li>Sucre de canne complet</li>
              <li>Œufs fermiers</li>
              <li>Extrait de vanille Bourbon</li>
              <li>Sel de Guérande</li>
              <li>Levure naturelle</li>
            </ul>
          </div>
          <div id="nutrition" class="tab-pane">
            <table class="nutrition-table">
              <tr>
                <td>Valeur énergétique</td>
                <td>480 kcal / 2010 kJ</td>
              </tr>
              <tr>
                <td>Matières grasses</td>
                <td>24g</td>
              </tr>
              <tr>
                <td>Glucides</td>
                <td>58g</td>
              </tr>
              <tr>
                <td>Protéines</td>
                <td>6g</td>
              </tr>
              <tr>
                <td>Sel</td>
                <td>0.8g</td>
              </tr>
            </table>
          </div>
          
        </div>
    
      </div>

    </div>
  </section>

  <!-- ═══ RECOMMENDED PRODUCTS ══════════════════════════════════ -->
  <section class="recommended-section">
    <div class="section-header">
      <h2>Vous aimerez aussi</h2>
      <p>D'autres cookies à découvrir</p>
    </div>

    <div class="recommended-grid">
      <div class="cookie-card">
        <div class="cookie-img">
          <img src="../assets/images/DOUBLE CHOCOLATE COOKIES_108755_1120_1460.jpg" alt="Noisette Praliné">
          <span class="cookie-tag">Nouveau</span>
        </div>
        <div class="cookie-info">
          <h3>Noisette & Praliné</h3>
          <p>Praliné maison, noisettes torréfiées du Piémont</p>
          <div class="cookie-footer">
            <span class="price">5,20 €</span>
            <button class="add-btn">+</button>
          </div>
        </div>
      </div>

      <div class="cookie-card">
        <div class="cookie-img">
          <img src="../assets/images/doublechocolatechipcookies_overhead.jpg" alt="Caramel Beurre Salé">
        </div>
        <div class="cookie-info">
          <h3>Caramel Beurre Salé</h3>
          <p>Fleur de sel de Guérande, caramel onctueux fait maison</p>
          <div class="cookie-footer">
            <span class="price">5,50 €</span>
            <button class="add-btn">+</button>
          </div>
        </div>
      </div>

      <div class="cookie-card">
        <div class="cookie-img">
          <img src="../assets/images/cookie2.jpg" alt="Red Velvet Cookie">
          <span class="cookie-tag">Signature</span>
        </div>
        <div class="cookie-info">
          <h3>Red Velvet Cookie</h3>
          <p>Éclats de framboise, cream cheese fondant</p>
          <div class="cookie-footer">
            <span class="price">5,90 €</span>
            <button class="add-btn">+</button>
          </div>
        </div>
      </div>

      <div class="cookie-card">
        <div class="cookie-img">
          <img src="../assets/images/Cookie-ChocoNoisettes-Modifier.jpg" alt="Cookie Brownie">
          <span class="cookie-tag">Bestseller</span>
        </div>
        <div class="cookie-info">
          <h3>Cookie Brownie</h3>
          <p>Éclats de chocolat noir, cœur fondant intense</p>
          <div class="cookie-footer">
            <span class="price">4,90 €</span>
            <button class="add-btn">+</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  

</body>
</html>