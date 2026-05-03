<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produits</title>
    <link rel="stylesheet" href="../../../assets/css/style.css" />
    <link rel="stylesheet" href="../../../assets/css/cart.css" />
    <script src="../../../assets/js/script.js" defer></script>
    <script src="../../../assets/js/cart.js" defer></script>
    <!-- GSAP -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
</head>

<?php
require_once('../../models/Product.php');
$product = new cookies();
$cookiesList = $product->listCookies();
?>

<body>
    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- ═══ NAVBAR ════════════════════════════════════════════════ -->
    <nav class="navbar" id="navbar">
        <a href="#" class="navbar-brand">
            <img src="../../../assets/images/logo2.png" alt="L'art du Cookie" />
        </a>
        <div class="navbar-menu">
            <a href="../../../index.html">Accueil</a>
            <a href="listCookies.php">Produits</a>
            <a href="#contact">Contact</a>
            <a href="cart.php" class="cart-link">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-count" class="cart-count">0</span>
            </a>
        </div>
    </nav>

    <img src="../../../assets/images/wallpaperflare.jpg" alt="Bannière" class="banner-img" />

    <!-- ═══ SHOWCASE ══════════════════════════════════════════════ -->
    <div class="showcase" id="showcase">
        <div class="section-title2">
            <h2>Les cookies qui font<br /><em>chavirer les cœurs</em></h2>
        </div>

        <!-- Champ de recherche -->
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Rechercher un cookie..."
                aria-label="Rechercher" />
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
        </div>

        <div class="showcase-grid">
            <?php foreach ($cookiesList as $cookie) { ?>
                <div class="cookie-card" data-product-id="<?php echo $cookie['id']; ?>">
                    <div class="cookie-img">

                        <img src="../../../assets/images/<?php echo htmlspecialchars($cookie['image']); ?>"
                            alt="<?php echo htmlspecialchars($cookie['nom']); ?>" />
                        <span class="cookie-tag">Bestseller</span>
                    </div>
                    <div class="cookie-info">
                        <h3><?php echo htmlspecialchars($cookie['nom']); ?></h3>
                        <p><?php
                        $desc = htmlspecialchars($cookie['description']);
                        echo strlen($desc) > 60 ? substr($desc, 0, 60) . '...' : $desc;
                        ?></p>
                        <div class="cookie-footer">
                            <span class="price"><?php echo number_format($cookie['prix'], 2, ',', ' '); ?> Dt</span>
                            <button class="add-btn" aria-label="Ajouter">+</button>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>

        <script>
            // Définir le chemin du contrôleur du panier
            window.CART_CONTROLLER_URL = '../../controllers/CartController.php';
            
            document.querySelectorAll('.cookie-card[data-product-id]').forEach(card => {
                card.style.cursor = 'pointer';

                const imageAndInfo = card.querySelector('.cookie-img');
                const cardInfo = card.querySelector('.cookie-info h3');

                imageAndInfo?.addEventListener('click', () => {
                    window.location.href = `cookiesDetails.php?id=${card.dataset.productId}`;
                });
    
                // Ajouter au panier
                card.querySelector('.add-btn')?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    addToCart(card.dataset.productId, 1);
                });
            
                cardInfo?.addEventListener('click', () => {
                    window.location.href = `cookiesDetails.php?id=${card.dataset.productId}`;
                });
            });

        </script>
</body>

</html>