<?php

class Cart {
    private $sessionKey = 'panier';
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [];
        }
    }
    
    /**
     * Ajouter un produit au panier
     */
    public function addItem($id, $nom, $prix, $image, $quantite = 1) {
        $id = (int)$id;
        
        if (isset($_SESSION[$this->sessionKey][$id])) {
            $_SESSION[$this->sessionKey][$id]['quantite'] += (int)$quantite;
        } else {
            $_SESSION[$this->sessionKey][$id] = [
                'id' => $id,
                'nom' => $nom,
                'prix' => (float)$prix,
                'image' => $image,
                'quantite' => (int)$quantite
            ];
        }
        
        return true;
    }
    
    /**
     * Retirer un produit du panier
     */
    public function removeItem($id) {
        $id = (int)$id;
        if (isset($_SESSION[$this->sessionKey][$id])) {
            unset($_SESSION[$this->sessionKey][$id]);
            return true;
        }
        return false;
    }
    
    /**
     * Mettre à jour la quantité d'un produit
     */
    public function updateQuantity($id, $quantite) {
        $id = (int)$id;
        $quantite = (int)$quantite;
        
        if ($quantite <= 0) {
            return $this->removeItem($id);
        }
        
        if (isset($_SESSION[$this->sessionKey][$id])) {
            $_SESSION[$this->sessionKey][$id]['quantite'] = $quantite;
            return true;
        }
        return false;
    }
    
    /**
     * Obtenir tous les articles du panier
     */
    public function getItems() {
        return $_SESSION[$this->sessionKey] ?? [];
    }
    
    /**
     * Obtenir un article spécifique
     */
    public function getItem($id) {
        $id = (int)$id;
        return $_SESSION[$this->sessionKey][$id] ?? null;
    }
    
    /**
     * Vérifier si un produit est dans le panier
     */
    public function hasItem($id) {
        $id = (int)$id;
        return isset($_SESSION[$this->sessionKey][$id]);
    }
    
    /**
     * Obtenir le nombre total d'articles dans le panier
     */
    public function getItemCount() {
        $count = 0;
        foreach ($_SESSION[$this->sessionKey] ?? [] as $item) {
            $count += $item['quantite'];
        }
        return $count;
    }
    
    /**
     * Obtenir le montant total du panier
     */
    public function getTotalPrice() {
        $total = 0;
        foreach ($_SESSION[$this->sessionKey] ?? [] as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        return round($total, 2);
    }
    
    /**
     * Vider le panier complètement
     */
    public function clear() {
        $_SESSION[$this->sessionKey] = [];
        return true;
    }
    
    /**
     * Obtenir le nombre d'articles uniques dans le panier
     */
    public function getUniqueItemCount() {
        return count($_SESSION[$this->sessionKey] ?? []);
    }
}
?>
