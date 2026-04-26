<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produits</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="../assets/js/script.js" defer></script>
    <!-- GSAP -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
  </head>
  <body>
    <!-- Custom cursor -->
    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- ═══ NAVBAR ════════════════════════════════════════════════ -->
    <nav class="navbar" id="navbar">
      <a href="#" class="navbar-brand">
        <img src="../assets/images/logo2.png" alt="L'art du Cookie" />
      </a>
      <div class="navbar-menu">
        <a href="../index.html">Accueil</a>
        <a href="produits.html">Produits</a>
        <a href="#contact">Contact</a>
      </div>
    </nav>

    <img src="../assets/images/wallpaperflare.jpg" alt="Bannière" class="banner-img" />

    <!-- ═══ SHOWCASE ══════════════════════════════════════════════ -->
    <div class="showcase" id="showcase">
      <div class="section-title2">
        <h2>Les cookies qui font<br /><em>chavirer les cœurs</em></h2>
      </div>

      <!-- Champ de recherche -->
      <div class="search-container">
        <input 
          type="text" 
          id="searchInput" 
          class="search-input" 
          placeholder="Rechercher un cookie..."
          aria-label="Rechercher"
        />
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <path d="m21 21-4.35-4.35"></path>
        </svg>
      </div>

      <div class="showcase-grid">
        <div class="cookie-card" data-product-id="cookie-brownie">
          <div class="cookie-img">
            <img
              src="../assets/images/Cookie-ChocoNoisettes-Modifier.jpg"
              alt="Cookie Brownie"
            />
            <span class="cookie-tag">Bestseller</span>
          </div>
          <div class="cookie-info">
            <h3>Cookie Brownie</h3>
            <p>Éclats de chocolat noir, cœur fondant intense</p>
            <div class="cookie-footer">
              <span class="price">4,90 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>

        <div class="cookie-card" data-product-id="noisette-praline">
          <div class="cookie-img">
            <img
              src="../assets/images/DOUBLE CHOCOLATE COOKIES_108755_1120_1460.jpg"
              alt="Noisette Praliné"
            />
            <span class="cookie-tag">Nouveau</span>
          </div>
          <div class="cookie-info">
            <h3>Noisette & Praliné</h3>
            <p>Praliné maison, noisettes torréfiées du Piémont</p>
            <div class="cookie-footer">
              <span class="price">5,20 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>

        <div class="cookie-card" data-product-id="caramel-beurre-sale">
          <div class="cookie-img">
            <img
              src="../assets/images/doublechocolatechipcookies_overhead.jpg"
              alt="Caramel Beurre Salé"
            />
          </div>
          <div class="cookie-info">
            <h3>Caramel Beurre Salé</h3>
            <p>Fleur de sel de Guérande, caramel onctueux fait maison</p>
            <div class="cookie-footer">
              <span class="price">5,50 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>

        <div class="cookie-card" data-product-id="red-velvet">
          <div class="cookie-img">
            <img src="../assets/images/cookie2.jpg" alt="Red Velvet Cookie" />
            <span class="cookie-tag">Signature</span>
          </div>
          <div class="cookie-info">
            <h3>Red Velvet Cookie</h3>
            <p>Éclats de framboise, cream cheese fondant</p>
            <div class="cookie-footer">
              <span class="price">5,90 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>

        <div class="cookie-card" data-product-id="cookie-brownie">
          <div class="cookie-img">
            <img
              src="../assets/images/Cookie-ChocoNoisettes-Modifier.jpg"
              alt="Cookie Brownie"
            />
            <span class="cookie-tag">Bestseller</span>
          </div>
          <div class="cookie-info">
            <h3>Cookie Brownie</h3>
            <p>Éclats de chocolat noir, cœur fondant intense</p>
            <div class="cookie-footer">
              <span class="price">4,90 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>

        <div class="cookie-card" data-product-id="noisette-praline">
          <div class="cookie-img">
            <img
              src="../assets/images/DOUBLE CHOCOLATE COOKIES_108755_1120_1460.jpg"
              alt="Noisette Praliné"
            />
            <span class="cookie-tag">Nouveau</span>
          </div>
          <div class="cookie-info">
            <h3>Noisette & Praliné</h3>
            <p>Praliné maison, noisettes torréfiées du Piémont</p>
            <div class="cookie-footer">
              <span class="price">5,20 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>

        <div class="cookie-card">
          <div class="cookie-img">
            <img
              src="../assets/images/doublechocolatechipcookies_overhead.jpg"
              alt="Caramel Beurre Salé"
            />
          </div>
          <div class="cookie-info">
            <h3>Caramel Beurre Salé</h3>
            <p>Fleur de sel de Guérande, caramel onctueux fait maison</p>
            <div class="cookie-footer">
              <span class="price">5,50 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>

        <div class="cookie-card">
          <div class="cookie-img">
            <img src="../assets/images/cookie2.jpg" alt="Red Velvet Cookie" />
            <span class="cookie-tag">Signature</span>
          </div>
          <div class="cookie-info">
            <h3>Red Velvet Cookie</h3>
            <p>Éclats de framboise, cream cheese fondant</p>
            <div class="cookie-footer">
              <span class="price">5,90 €</span>
              <button class="add-btn" aria-label="Ajouter">+</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══ FOOTER ════════════════════════════════════════════════ -->
    <footer>
      <p>
        © 2025 L'art du Cookie — Fraîchement préparé avec passion & beurre AOP
      </p>
      <span>Paris, France</span>
    </footer>

    <script>
      // Rendre les cartes produits cliquables pour aller vers la page de détails
      document.querySelectorAll('.cookie-card[data-product-id]').forEach(card => {
        // Ajouter la classe clickable pour le curseur
        card.style.cursor = 'pointer';

        // Intercepter les clics sur la carte (sauf sur le bouton "ajouter")
        const imageAndInfo = card.querySelector('.cookie-img');
        const cardInfo = card.querySelector('.cookie-info h3');

        imageAndInfo?.addEventListener('click', (e) => {
          const productId = card.dataset.productId;
          window.location.href = `produitdetails.html?id=${productId}`;
        });

        cardInfo?.addEventListener('click', (e) => {
          const productId = card.dataset.productId;
          window.location.href = `produitdetails.html?id=${productId}`;
        });

        // Garder le fonctionnement du bouton "ajouter"
        const addBtn = card.querySelector('.add-btn');
        addBtn?.addEventListener('click', (e) => {
          e.stopPropagation();
          
          const productNames = {
            'cookie-brownie': 'Cookie Brownie',
            'noisette-praline': 'Noisette & Praliné',
            'caramel-beurre-sale': 'Caramel Beurre Salé',
            'red-velvet': 'Red Velvet Cookie'
          };

          const productPrices = {
            'cookie-brownie': 4.90,
            'noisette-praline': 5.20,
            'caramel-beurre-sale': 5.50,
            'red-velvet': 5.90
          };

          const productId = card.dataset.productId;
          const productName = productNames[productId] || 'Produit';
          const price = productPrices[productId] || 0;

          // Ajouter au panier via localStorage
          let cart = JSON.parse(localStorage.getItem('cart')) || [];
          const existingItem = cart.find(item => item.id === productId);

          if (existingItem) {
            existingItem.quantity += 1;
          } else {
            cart.push({
              id: productId,
              name: productName,
              price: price,
              quantity: 1,
              image: card.querySelector('img').src
            });
          }

          localStorage.setItem('cart', JSON.stringify(cart));

          // Feedback
          const originalText = addBtn.textContent;
          addBtn.textContent = '✓';
          addBtn.style.background = '#27ae60';

          setTimeout(() => {
            addBtn.textContent = originalText;
            addBtn.style.background = '';
          }, 1500);
        });
      });
    </script>
  </body>
</html>
