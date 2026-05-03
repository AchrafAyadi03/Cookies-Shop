<?php
require_once(__DIR__ . '/../../controllers/AuthController.php');
require_once(__DIR__ . '/../../models/Order.php');

AuthController::requireAdmin();

$orders = (new Order())->listAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Commandes | L'art du Cookie</title>
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
        <h1>Commandes reçues</h1>
        <span><?php echo count($orders); ?> commande<?php echo count($orders) > 1 ? 's' : ''; ?></span>
    </div>

    <?php if (empty($orders)): ?>
        <div class="empty-orders">
            <i class="fas fa-inbox" style="font-size:3rem;color:#d8ccba;"></i>
            <p>Aucune commande pour l'instant.</p>
        </div>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): ?>
                <tr>
                    <td>#<?php echo (int)$o['id']; ?></td>
                    <td><?php echo htmlspecialchars($o['nom'] . ' ' . $o['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($o['email']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($o['date_commande'])); ?></td>
                    <td><strong><?php echo number_format($o['total'], 2, ',', ' '); ?> Dt</strong></td>
                    <td>
                        <span class="statut-badge statut-<?php echo $o['statut']; ?>">
                            <?php echo str_replace('_', ' ', $o['statut']); ?>
                        </span>
                    </td>
                    <td>
                        <a class="btn-action" href="commandeDetails.php?id=<?php echo (int)$o['id']; ?>">Détails</a>
                        <form class="statut-form" method="POST" action="../../controllers/OrderController.php?action=status">
                            <input type="hidden" name="id" value="<?php echo (int)$o['id']; ?>">
                            <select name="statut">
                                <option value="en_attente" <?php echo $o['statut']==='en_attente'?'selected':''; ?>>en attente</option>
                                <option value="validee"    <?php echo $o['statut']==='validee'?'selected':''; ?>>validée</option>
                                <option value="livree"     <?php echo $o['statut']==='livree'?'selected':''; ?>>livrée</option>
                            </select>
                            <button class="btn-action" type="submit">OK</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
