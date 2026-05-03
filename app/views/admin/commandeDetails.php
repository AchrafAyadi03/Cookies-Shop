<?php
require_once(__DIR__ . '/../../controllers/AuthController.php');
require_once(__DIR__ . '/../../models/Order.php');

AuthController::requireAdmin();

$id = (int)($_GET['id'] ?? 0);
$commande = (new Order())->getDetails($id);

if (!$commande) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande #<?php echo $id; ?> | Admin</title>
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
        <a href="dashboard.php">Commandes</a>
        <span class="user-chip">
            <i class="fas fa-user-shield"></i>
            <?php echo htmlspecialchars($_SESSION['user']['nom']); ?>
            <a href="../../controllers/AuthController.php?action=logout" class="logout-link">Déconnexion</a>
        </span>
    </div>
</nav>

<div class="admin-wrapper">
    <div class="admin-header">
        <h1>Commande #<?php echo (int)$commande['id']; ?></h1>
        <a class="btn-action" href="dashboard.php"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>

    <div style="background:#fff;padding:24px;border-radius:12px;margin-bottom:24px;">
        <p><strong>Client :</strong> <?php echo htmlspecialchars($commande['nom'] . ' ' . $commande['prenom']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($commande['email']); ?></p>
        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($commande['telephone']); ?></p>
        <p><strong>Date :</strong> <?php echo date('d/m/Y H:i', strtotime($commande['date_commande'])); ?></p>
        <p><strong>Statut :</strong>
            <span class="statut-badge statut-<?php echo $commande['statut']; ?>">
                <?php echo str_replace('_', ' ', $commande['statut']); ?>
            </span>
        </p>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commande['lignes'] as $l): ?>
            <tr>
                <td style="display:flex;align-items:center;gap:12px;">
                    <img src="../../../assets/images/<?php echo htmlspecialchars($l['image']); ?>"
                         alt="<?php echo htmlspecialchars($l['nom']); ?>"
                         style="width:50px;height:50px;object-fit:cover;border-radius:8px;">
                    <?php echo htmlspecialchars($l['nom']); ?>
                </td>
                <td><?php echo number_format($l['prix_unitaire'], 2, ',', ' '); ?> Dt</td>
                <td><?php echo (int)$l['quantite']; ?></td>
                <td><strong><?php echo number_format($l['prix_unitaire'] * $l['quantite'], 2, ',', ' '); ?> Dt</strong></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>TOTAL</strong></td>
                <td><strong><?php echo number_format($commande['total'], 2, ',', ' '); ?> Dt</strong></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
