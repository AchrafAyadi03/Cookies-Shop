/**
 * Gestion du panier - Functions JavaScript
 */

// URL du contrôleur du panier - Utiliser la variable définie dans chaque page, ou le chemin par défaut
const CART_CONTROLLER_URL = window.CART_CONTROLLER_URL || 'app/controllers/CartController.php';

/**
 * Ajouter un produit au panier
 */
function addToCart(productId, quantity = 1) {
    quantity = quantity || 1;
    
    fetch(CART_CONTROLLER_URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=add&id=' + productId + '&quantite=' + quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount();
            showNotification('Produit ajouté au panier!', 'success');
        } else {
            showNotification(data.message || 'Erreur lors de l\'ajout', 'error');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'ajout', 'error');
    });
}

/**
 * Retirer un produit du panier
 */
function removeFromCart(productId) {
    if (confirm('Êtes-vous sûr de vouloir retirer ce produit?')) {
        fetch(CART_CONTROLLER_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=remove&id=' + productId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Retirer l'élément du DOM
                const cartItem = document.querySelector('.cart-item[data-id="' + productId + '"]');
                if (cartItem) {
                    cartItem.remove();
                }
                updateCartCount();
                updateCartSummary();
                
                // Si le panier est vide, recharger la page
                const cartItemsCount = document.querySelectorAll('.cart-item').length;
                if (cartItemsCount === 0) {
                    setTimeout(() => location.reload(), 500);
                }
                
                showNotification('Produit retiré du panier', 'success');
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
}

/**
 * Mettre à jour la quantité
 */
function updateQuantity(button, delta) {
    const container = button.closest('.item-quantity');
    const input = container.querySelector('.qty-input');
    let newValue = parseInt(input.value) + delta;
    
    if (newValue < 1) newValue = 1;
    
    input.value = newValue;
    updateQuantityInput(input);
}

/**
 * Mettre à jour la quantité via input
 */
function updateQuantityInput(input) {
    const container = input.closest('.cart-item');
    const productId = container.dataset.id;
    let quantity = parseInt(input.value);
    
    if (quantity < 1) {
        quantity = 1;
        input.value = 1;
    }
    
    fetch(CART_CONTROLLER_URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=update&id=' + productId + '&quantite=' + quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartItemTotal(container);
            updateCartSummary();
            updateCartCount();
        }
    })
    .catch(error => console.error('Erreur:', error));
}

/**
 * Mettre à jour le total d'un article
 */
function updateCartItemTotal(cartItem) {
    const priceText = cartItem.querySelector('.item-price').textContent;
    const price = parseFloat(priceText.replace(/[^\d,]/g, '').replace(',', '.'));
    const quantity = parseInt(cartItem.querySelector('.qty-input').value);
    const total = (price * quantity).toFixed(2);
    
    cartItem.querySelector('.item-total').textContent = 
        total.replace('.', ',') + ' €';
}

/**
 * Mettre à jour le résumé du panier
 */
function updateCartSummary() {
    let subtotal = 0;
    
    document.querySelectorAll('.cart-item').forEach(item => {
        const totalText = item.querySelector('.item-total').textContent;
        const total = parseFloat(totalText.replace(/[^\d,]/g, '').replace(',', '.'));
        subtotal += total;
    });
    
    const formattedTotal = subtotal.toFixed(2).replace('.', ',');
    document.querySelector('.subtotal').textContent = formattedTotal + ' €';
    document.querySelector('.total-amount').textContent = formattedTotal + ' €';
}

/**
 * Vider le panier
 */
function clearCart() {
    if (confirm('Êtes-vous sûr de vouloir vider complètement votre panier?')) {
        fetch(CART_CONTROLLER_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=clear'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
}

/**
 * Mettre à jour le compteur du panier dans la navbar
 */
function updateCartCount() {
    fetch(CART_CONTROLLER_URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=get'
    })
    .then(response => response.json())
    .then(data => {
        const cartCountElement = document.getElementById('cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = data.count || 0;
            // Ajouter une classe pour l'animation
            if (data.count > 0) {
                cartCountElement.parentElement.classList.add('has-items');
            }
        }
    })
    .catch(error => console.error('Erreur:', error));
}

/**
 * Afficher une notification
 */
function showNotification(message, type = 'info') {
    // Vérifier si une notification existe déjà
    let notification = document.querySelector('.notification');
    if (!notification) {
        notification = document.createElement('div');
        notification.className = 'notification';
        document.body.appendChild(notification);
    }
    
    notification.textContent = message;
    notification.className = 'notification notification-' + type + ' show';
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

// Initialiser le compteur du panier au chargement
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
