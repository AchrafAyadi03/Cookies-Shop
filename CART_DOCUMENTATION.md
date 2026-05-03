# 🛒 SYSTÈME DE PANIER - Documentation

## ✅ Fichiers Créés

### 1. **Modèles** (`app/models/`)
- **`Cart.php`** - Classe pour gérer les données du panier en session PHP

### 2. **Contrôleurs** (`app/controllers/`)
- **`CartController.php`** - Gère les opérations AJAX du panier

### 3. **Vues** (`app/views/products/`)
- **`cart.php`** - Page du panier avec résumé et gestion des articles

### 4. **JavaScript** (`assets/js/`)
- **`cart.js`** - Toutes les fonctions du panier (AJAX)

### 5. **CSS** (`assets/css/`)
- **`cart.css`** - Styles du panier et notifications

---

## 📋 Fonctionnalités du Panier

### ✨ Fonctionnalités Principales
✅ Ajouter des produits au panier  
✅ Voir tous les articles du panier  
✅ Modifier les quantités (+/-)  
✅ Supprimer des articles  
✅ Vider le panier complètement  
✅ Calcul automatique du total  
✅ Compteur du panier en temps réel  
✅ Notifications visuelles  
✅ Responsive design  

---

## 🚀 Comment Utiliser

### **1. Ajouter un Produit au Panier**

#### Option A : Depuis la page de détails
```javascript
addToCart(productId, quantity);
```
Le bouton "Ajouter au panier" est présent automatiquement.

#### Option B : Depuis n'importe quel endroit
```javascript
// Ajouter 1 produit
addToCart(5, 1);

// Ajouter 3 produits
addToCart(5, 3);
```

### **2. Voir le Panier**
- Cliquez sur l'icône du panier dans la navbar
- Lien : `/app/views/products/cart.php`

### **3. Modifier les Quantités**
- Utilisez les boutons `+` et `-`
- Modifiez directement le champ de saisie

### **4. Retirer un Produit**
- Cliquez sur la corbeille rouge à droite du produit

### **5. Vider le Panier**
- Bouton "Vider le panier" en bas du résumé

---

## 🔧 Intégration dans le Code Existant

### **Navbar (déjà intégrée)**
```html
<a href="app/views/products/cart.php" class="cart-link">
    <i class="fas fa-shopping-cart"></i>
    <span id="cart-count" class="cart-count">0</span>
</a>
```

### **Page de Produits (déjà intégrée)**
Le bouton "Ajouter au panier" appelle automatiquement :
```javascript
addToCart(productId, quantity);
```

### **Charger dans Vos Pages**
```html
<!-- CSS -->
<link rel="stylesheet" href="assets/css/cart.css">

<!-- JavaScript -->
<script src="assets/js/cart.js" defer></script>
```

---

## 🗂️ Structure Technique

### **Sessions PHP**
- Clé de session : `panier`
- Format de stockage :
```php
$_SESSION['panier'] = [
    'id' => [
        'id' => 1,
        'nom' => 'Cookie Chocolat',
        'prix' => 5.99,
        'image' => 'cookie.jpg',
        'quantite' => 2
    ]
]
```

### **Communications AJAX**
Les fonctions JavaScript communiquent via POST avec `CartController.php` :

| Action | Description |
|--------|-------------|
| `add` | Ajouter un produit |
| `remove` | Retirer un produit |
| `update` | Modifier la quantité |
| `clear` | Vider le panier |
| `get` | Récupérer le contenu |

---

## 📱 Fonctions JavaScript Principales

### **addToCart(productId, quantity = 1)**
Ajoute un produit au panier
```javascript
addToCart(5, 2);
```

### **removeFromCart(productId)**
Retire un produit du panier
```javascript
removeFromCart(5);
```

### **updateQuantity(button, delta)**
Modifie la quantité avec +/- 
```javascript
updateQuantity(element, 1);   // +1
updateQuantity(element, -1);  // -1
```

### **clearCart()**
Vide complètement le panier
```javascript
clearCart();
```

### **updateCartCount()**
Synchronise le compteur du panier
```javascript
updateCartCount();
```

---

## 🎨 Personnalisation

### **Couleurs Principales**
- Or principal : `#d4a574`
- Noir texte : `#2c2c2c`
- Gris clair : `#f5f1e8`

### **Modifier les Styles**
Éditez `assets/css/cart.css` pour personnaliser :
- Couleurs
- Espacements
- Polices
- Animations

---

## ⚠️ Points Important

1. **Session PHP** : Doit être initialisée au démarrage
2. **Font Awesome** : Required pour les icônes
3. **Panier persistent** : Reste pendant la session
4. **Prix** : Calculés côté serveur pour la sécurité

---

## 🔗 Fichiers Modifiés

✏️ **Files Updated:**
- `index.php` - Ajout du lien panier
- `app/views/products/cookiesDetails.php` - Bouton "Ajouter au panier"
- `app/views/products/listCookies.php` - Intégration du panier

---

## 📞 Support

Pour ajouter :
- Coupon de réduction
- Calcul de taxes
- Livraison variable
- Stock réel des produits

Modifiez le `CartController.php` et le modèle `Cart.php`.

---

**🎉 Votre panier est prêt à l'emploi !**
