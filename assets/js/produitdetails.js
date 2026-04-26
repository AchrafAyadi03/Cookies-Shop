
// Gérer la quantité
document.getElementById('increaseQty')?.addEventListener('click', () => {
  const input = document.getElementById('quantity');
  input.value = parseInt(input.value) + 1;
});

document.getElementById('decreaseQty')?.addEventListener('click', () => {
  const input = document.getElementById('quantity');
  if (parseInt(input.value) > 1) {
    input.value = parseInt(input.value) - 1;
  }
});

// Gérer les onglets
document.querySelectorAll('.tab-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const tabName = this.dataset.tab;

    // Désactiver tous les onglets
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

    // Activer l'onglet sélectionné
    this.classList.add('active');
    document.getElementById(tabName).classList.add('active');
  });
});

// Animations GSAP
if (gsap && ScrollTrigger) {
  gsap.registerPlugin(ScrollTrigger);

  // Animation du titre
  gsap.from('.product-title', {
    opacity: 0,
    y: 20,
    duration: .6,
    ease: 'power2.out'
  });

  // Animation de la galerie
  gsap.from('.product-gallery', {
    opacity: 0,
    x: -30,
    duration: .7,
    ease: 'power2.out',
    delay: .1
  });

  // Animation des infos produit
  gsap.from('.product-info > *', {
    opacity: 0,
    y: 15,
    stagger: .1,
    duration: .5,
    ease: 'power2.out',
    delay: .2
  });
}


