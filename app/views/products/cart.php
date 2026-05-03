<?php
session_start();
require_once('../../models/Cart.php');

$cart = new Cart();
$items = $cart->getItems();
$total = $cart->getTotalPrice();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier | L'art du Cookie</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/cart.css">

    <script src="../../../assets/js/script.js" defer></script>
    <script src="../../../assets/js/cart.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>


</head>
<body>

     <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

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

    <div class="breadcrumb">
        <a href="../../../index.php">Accueil</a>
        <span>&#8250;</span>
        <span>Mon Panier</span>
    </div>

    <!-- CART SECTION -->
    <section class="cart-section">
        <div class="cart-container">
            <h1 class="cart-title">Mon Panier</h1>

            <?php if (count($items) > 0): ?>
                <div class="cart-content">
                    <!-- Cart Items -->
                    <div class="cart-items">
                        <div class="cart-items-header">
                            <div class="header-product">Produit</div>
                            <div class="header-price">Prix</div>
                            <div class="header-quantity">Quantité</div>
                            <div class="header-total">Total</div>
                            <div class="header-action">Action</div>
                        </div>

                        <?php foreach ($items as $item): ?>
                            <div class="cart-item" data-id="<?php echo $item['id']; ?>">
                                <div class="item-product">
                                    <img src="../../../assets/images/<?php echo htmlspecialchars($item['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($item['nom']); ?>">
                                    <div class="item-info">
                                        <h3><?php echo htmlspecialchars($item['nom']); ?></h3>
                                        <p class="item-id">ID: <?php echo $item['id']; ?></p>
                                    </div>
                                </div>

                                <div class="item-price">
                                    <?php echo number_format($item['prix'], 2, ',', ' '); ?> Dt
                                </div>

                                <div class="item-quantity">
                                    <button class="qty-btn qty-minus" onclick="updateQuantity(this, -1)">−</button>
                                    <input type="number" class="qty-input" value="<?php echo $item['quantite']; ?>" 
                                           min="1" onchange="updateQuantityInput(this)">
                                    <button class="qty-btn qty-plus" onclick="updateQuantity(this, 1)">+</button>
                                </div>

                                <div class="item-total">
                                    <?php echo number_format($item['prix'] * $item['quantite'], 2, ',', ' '); ?> Dt
                                </div>

                                <div class="item-action">
                                    <button class="btn-remove" onclick="removeFromCart(<?php echo $item['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Cart Summary -->
                    <div class="cart-summary">
                        <div class="summary-card">
                            <h3>Résumé du Panier</h3>

                            <div class="summary-row">
                                <span>Sous-total:</span>
                                <span class="subtotal"><?php echo number_format($total, 2, ',', ' '); ?> Dt</span>
                            </div>

                            <div class="summary-row">
                                <span>Frais de port:</span>
                                <span class="shipping">Gratuit</span>
                            </div>

                            <div class="summary-divider"></div>

                            <div class="summary-row total-row">
                                <span>Total:</span>
                                <span class="total-amount"><?php echo number_format($total, 2, ',', ' '); ?> Dt</span>
                            </div>

                            <div class="cart-actions">
                                <a href="listCookies.php" class="btn-continue">Continuer les achats</a>
                                <a href="#" class="btn-checkout">Passer la commande</a>
                            </div>

                            <button class="btn-clear-cart" onclick="clearCart()">
                                <i class="fas fa-trash"></i> Vider le panier
                            </button>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h2>Votre panier est vide</h2>
                    <p>Découvrez nos délicieux cookies et commencez vos achats!</p>
                    <a href="listCookies.php" class="btn-shop">
                        <i class="fas fa-shopping-bag"></i> Voir nos produits
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

   

    <script>
        // Initialiser le nombre d'articles au chargement
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>

</body>
</html>
