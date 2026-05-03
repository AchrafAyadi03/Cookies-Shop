<?php

// Démarrer la session avant tout
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../models/Cart.php');
require_once(__DIR__ . '/../models/Product.php');

class CartController {
    private $cart;
    private $product;
    
    public function __construct() {
        $this->cart = new Cart();
        $this->product = new cookies();
    }
    
    /**
     * Ajouter un produit au panier via AJAX
     */
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $quantite = isset($_POST['quantite']) ? (int)$_POST['quantite'] : 1;

            if ($id <= 0 || $quantite <= 0) {
                return [
                    'success' => false,
                    'message' => 'Quantité invalide'
                ];
            }
            
            // Récupérer les infos du produit depuis la BD
            $cookie = $this->product->getCookieById($id);
            
            if ($cookie && $cookie['quantite'] > 0) {
                $currentItem = $this->cart->getItem($id);
                $currentQuantity = $currentItem ? (int)$currentItem['quantite'] : 0;
                $stock = (int)$cookie['quantite'];

                if (($currentQuantity + $quantite) > $stock) {
                    return [
                        'success' => false,
                        'message' => 'Stock insuffisant'
                    ];
                }

                $this->cart->addItem(
                    $cookie['id'],
                    $cookie['nom'],
                    $cookie['prix'],
                    $cookie['image'],
                    $quantite
                );
                
                return [
                    'success' => true,
                    'message' => 'Produit ajouté au panier',
                    'cart_count' => $this->cart->getItemCount()
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Produit indisponible'
                ];
            }
        }
        
        return [
            'success' => false,
            'message' => 'Erreur lors de l\'ajout'
        ];
    }
    
    /**
     * Retirer un produit du panier
     */
    public function removeFromCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $this->cart->removeItem($id);
            
            return [
                'success' => true,
                'message' => 'Produit retiré du panier',
                'cart_count' => $this->cart->getItemCount(),
                'total' => $this->cart->getTotalPrice()
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Erreur lors de la suppression'
        ];
    }
    
    /**
     * Mettre à jour la quantité d'un produit
     */
    public function updateQuantity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['quantite'])) {
            $id = (int)$_POST['id'];
            $quantite = (int)$_POST['quantite'];

            if ($id <= 0) {
                return [
                    'success' => false,
                    'message' => 'Produit invalide'
                ];
            }
            
            if ($quantite < 1) {
                $this->removeFromCart();
            } else {
                $cookie = $this->product->getCookieById($id);

                if (!$cookie || $cookie['quantite'] <= 0) {
                    return [
                        'success' => false,
                        'message' => 'Produit indisponible'
                    ];
                }

                if ($quantite > (int)$cookie['quantite']) {
                    return [
                        'success' => false,
                        'message' => 'Stock insuffisant'
                    ];
                }

                if (!$this->cart->updateQuantity($id, $quantite)) {
                    return [
                        'success' => false,
                        'message' => 'Produit absent du panier'
                    ];
                }
            }
            
            return [
                'success' => true,
                'cart_count' => $this->cart->getItemCount(),
                'total' => $this->cart->getTotalPrice()
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Erreur lors de la mise à jour'
        ];
    }
    
    /**
     * Obtenir le panier en JSON (pour AJAX)
     */
    public function getCart() {
        return [
            'items' => $this->cart->getItems(),
            'total' => $this->cart->getTotalPrice(),
            'count' => $this->cart->getItemCount()
        ];
    }
    
    /**
     * Vider le panier
     */
    public function clearCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cart->clear();
            return [
                'success' => true,
                'message' => 'Panier vidé'
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Erreur'
        ];
    }
    
    /**
     * Obtenir le nombre d'articles dans le panier
     */
    public function getCartCount() {
        return $this->cart->getItemCount();
    }
}

// Gérer les appels AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $controller = new CartController();
    $action = $_POST['action'];
    
    switch ($action) {
        case 'add':
            $response = $controller->addToCart();
            break;
        case 'remove':
            $response = $controller->removeFromCart();
            break;
        case 'update':
            $response = $controller->updateQuantity();
            break;
        case 'clear':
            $response = $controller->clearCart();
            break;
        case 'get':
            $response = $controller->getCart();
            break;
        default:
            $response = ['success' => false, 'message' => 'Action inconnue'];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
