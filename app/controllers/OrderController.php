<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once(__DIR__ . '/../models/Cart.php');
require_once(__DIR__ . '/../models/Order.php');
require_once(__DIR__ . '/AuthController.php');

class OrderController {

    public function placeOrder() {
        AuthController::requireLogin('cart');

        $cart = new Cart();
        $items = $cart->getItems();

        if (empty($items)) {
            header('Location: /Cookies-Shop/app/views/products/cart.php');
            exit;
        }

        $order = new Order();
        $commandeId = $order->create($_SESSION['user']['id'], $items);

        if ($commandeId) {
            $cart->clear();
            $_SESSION['order_success'] = $commandeId;
            header('Location: /Cookies-Shop/app/views/products/orderSuccess.php');
            exit;
        }

        $_SESSION['order_error'] = "Erreur lors de l'envoi de la commande.";
        header('Location: /Cookies-Shop/app/views/products/cart.php');
        exit;
    }

    public function changeStatus() {
        AuthController::requireAdmin();
        $id = (int)($_POST['id'] ?? 0);
        $statut = $_POST['statut'] ?? '';
        if ($id > 0) {
            (new Order())->updateStatus($id, $statut);
        }
        header('Location: /Cookies-Shop/app/views/admin/dashboard.php');
        exit;
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === 'OrderController.php') {
    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    $ctrl = new OrderController();
    switch ($action) {
        case 'place':
            $ctrl->placeOrder();
            break;
        case 'status':
            $ctrl->changeStatus();
            break;
        default:
            header('Location: /Cookies-Shop/index.php');
            exit;
    }
}
?>
