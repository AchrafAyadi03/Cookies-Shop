<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // 1. Recuperation correcte de l id (isset retourne bool, pas la valeur)
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    if (!$id) {
        header('Location: ../../../index.php');
        exit;
    }

    require_once('../../models/Product.php');
    $product = new cookies();

    // 2. getCookieById retourne deja un tableau => pas besoin de ->fetch() apres
    $cookie = $product->getCookieById($id);
    if (!$cookie) {
        header('Location: ../../../index.php');
        exit;
    }

    // 3. listCookies() retourne un PDOStatement => appeler fetchAll()
    $stmt        = $product->listCookies();
    $cookiesList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 4. Exclure le produit courant des recommandations
    $recommended = array_filter($cookiesList, fn($c) => (int)$c['id'] !== $id);
    $recommended = array_slice(array_values($recommended), 0, 4);
    ?>

    <title><?php echo htmlspecialchars($cookie['nom']); ?> | L'art du Cookie</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/produitdetails.css">
    <link rel="stylesheet" href="../../../assets/css/cart.css">
    <script src="../../../assets/js/script.js" defer></script>
    <script src="../../../assets/js/produitdetails.js" defer></script>
    <script src="../../../assets/js/cart.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
</head>
<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <a href="../../../index.php" class="navbar-brand">
            <img src="../../../assets/images/logo2.png" alt="L'art du Cookie">
        </a>
        <div class="navbar-menu">
            <a href="../../../index.php">Accueil</a>
            <a href="listCookies.php">Produits</a>
            <a href="../../../index.php#contact">Contact</a>
            <a href="cart.php" class="cart-link">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-count" class="cart-count">0</span>
            </a>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="../../../index.php">Accueil</a>
        <span>&#8250;</span>
        <a href="listCookies.php">Produits</a>
        <span>&#8250;</span>
      
        <span><?php echo htmlspecialchars($cookie['nom']); ?></span>
    </div>

    <!-- PRODUCT DETAILS -->
    <section class="product-section">
        <div class="product-container">

            <!-- Image -->
            <div class="product-gallery">
                <div class="main-image">
                    <!-- 6. $cookie au lieu de $stmt -->
                    <img id="mainImage"
                         src="../../../assets/images/<?php echo htmlspecialchars($cookie['image']); ?>"
                         alt="<?php echo htmlspecialchars($cookie['nom']); ?>">
                </div>
            </div>

            <!-- Info -->
            <div class="product-info">

                <div class="product-header">
                    <span class="product-badge">Bestseller</span>
                    <h1 class="product-title"><?php echo htmlspecialchars($cookie['nom']); ?></h1>
                </div>

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

                <p class="product-description">
                    <?php echo htmlspecialchars($cookie['description']); ?>
                </p>

                <div class="product-pricing">
                    <div class="price-container">
                        <span class="price-label">Prix :</span>
                        <span class="price">
                            <?php echo number_format($cookie['prix'], 2, ',', ' '); ?> Dt
                        </span>
                    </div>
                    <div class="availability">
                        <i class="fas fa-check-circle"></i>
                        <span>En stock</span>
                    </div>
                </div>

                <div class="product-actions">
                    <div class="quantity-selector">
                        <button id="decreaseQty" class="qty-btn">-</button>
                        <input type="number" id="quantity" value="1" min="1" readonly>
                        <button id="increaseQty" class="qty-btn">+</button>
                    </div>
                    <button id="addToCartBtn" class="add-to-cart-btn"
                            data-product-id="<?php echo (int)$cookie['id']; ?>"
                            data-product-name="<?php echo htmlspecialchars($cookie['nom']); ?>"
                            data-product-price="<?php echo (float)$cookie['prix']; ?>">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                </div>

                <!-- Tabs -->
                <div class="product-tabs">
                    <button class="tab-btn active" data-tab="ingredients">Ingredients</button>
                </div>

                <div class="tab-content">
                    <div id="ingredients" class="tab-pane active">
                        <?php if (!empty($cookie['ingredient'])): ?>
                            <div class="ingredients-tags">
                                <?php foreach ($cookie['ingredient'] as $ingredient): ?>
                                    <span class="ingredient-badge"><?php echo htmlspecialchars($ingredient['ingredient']); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>Informations non disponibles.</p>
                        <?php endif; ?>
                    </div>

                    
                </div>

            </div>
        </div>
    </section>

    <?php if (!empty($recommended)): ?>
    <section class="recommended-section">
        <div class="section-header">
            <h2>Vous aimerez aussi</h2>
            <p>D'autres cookies a decouvrir</p>
        </div>

        <div class="showcase-grid">
            <?php foreach ($recommended as $rec): ?>
                <div class="cookie-card" data-product-id="<?php echo (int)$rec['id']; ?>" style="cursor:pointer">
                    <div class="cookie-img">
                        <img src="../../../assets/images/<?php echo htmlspecialchars($rec['image']); ?>"
                             alt="<?php echo htmlspecialchars($rec['nom']); ?>">
                        <span class="cookie-tag">Nouveau</span>
                    </div>
                    <div class="cookie-info">
                        <h3><?php echo htmlspecialchars($rec['nom']); ?></h3>
                        <p><?php
                            $desc = htmlspecialchars($rec['description']);
                            echo mb_strlen($desc) > 100 ? mb_substr($desc, 0, 100) . '...' : $desc;
                        ?></p>
                        <div class="cookie-footer">
                            <span class="price">
                                <?php echo number_format($rec['prix'], 2, ',', ' '); ?> Dt
                            </span>
                            <button class="add-btn" aria-label="Ajouter au panier">+</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <script>
        // Définir le chemin du contrôleur du panier
        window.CART_CONTROLLER_URL = '../../controllers/CartController.php';
        
        document.querySelectorAll('.cookie-card[data-product-id]').forEach(card => {
            card.querySelector('.cookie-img')?.addEventListener('click', () => {
                window.location.href = 'cookiesDetails.php?id=' + card.dataset.productId;
            });
            card.querySelector('.cookie-info h3')?.addEventListener('click', () => {
                window.location.href = 'cookiesDetails.php?id=' + card.dataset.productId;
            });
            
            // Ajouter au panier depuis les recommandations
            card.querySelector('.add-btn')?.addEventListener('click', (e) => {
                e.stopPropagation();
                addToCart(card.dataset.productId, 1);
            });
        });
        
        // Ajouter au panier depuis la page détail
        document.getElementById('addToCartBtn')?.addEventListener('click', function() {
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            const productId = this.dataset.productId;
            addToCart(productId, quantity);
        });
        
        // Contrôle de la quantité
        document.getElementById('decreaseQty')?.addEventListener('click', () => {
            const qty = document.getElementById('quantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        });
        
        document.getElementById('increaseQty')?.addEventListener('click', () => {
            const qty = document.getElementById('quantity');
            qty.value = parseInt(qty.value) + 1;
        });
    </script>

</body>
</html>