<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$commandeId = $_SESSION['order_success'] ?? null;
unset($_SESSION['order_success']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande envoyée | L'art du Cookie</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:wght@500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<nav class="navbar" id="navbar">
    <a href="../../../index.php" class="navbar-brand">
        <img src="../../../assets/images/logo2.png" alt="L'art du Cookie">
    </a>
    <div class="navbar-menu">
        <a href="../../../index.php">Accueil</a>
        <a href="listCookies.php">Produits</a>
    </div>
</nav>

<div class="auth-wrapper">
    <div class="auth-card" style="text-align:center;">
        <i class="fas fa-check-circle" style="font-size:4rem;color:#1f6b2c;margin-bottom:20px;"></i>
        <h1>Commande envoyée !</h1>
        <?php if ($commandeId): ?>
            <p class="auth-sub">
                Ta commande <strong>#<?php echo (int)$commandeId; ?></strong>
                a bien été transmise à l'administrateur.
            </p>
        <?php else: ?>
            <p class="auth-sub">Ta commande a bien été transmise à l'administrateur.</p>
        <?php endif; ?>
        <a href="listCookies.php" class="btn-submit" style="display:inline-block;text-decoration:none;margin-top:20px;">
            Continuer les achats
        </a>
    </div>
</div>

</body>
</html>
