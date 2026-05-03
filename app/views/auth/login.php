<?php
require_once(__DIR__ . '/../../controllers/AuthController.php');

$auth = new AuthController();
$error = $auth->login();
$redirect = $_GET['redirect'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | L'art du Cookie</title>
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
        <a href="../products/listCookies.php">Produits</a>
        <a href="../../../index.php#contact">Contact</a>
    </div>
</nav>

<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Connexion</h1>
        <p class="auth-sub">Accède à ton compte pour passer commande.</p>

        <?php if ($error): ?>
            <div class="auth-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php<?php echo $redirect ? '?redirect=' . urlencode($redirect) : ''; ?>">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>
        </form>

        <!-- <div class="auth-hint" >
            Comptes de test :<br>
            admin → achraf@gmail.com / achraf123<br>
            client → khaled@gmail.com / khaled123<br>
            client → naceur@gmail.com / naceur123
        </div> -->
    </div>
</div>

</body>
</html>
