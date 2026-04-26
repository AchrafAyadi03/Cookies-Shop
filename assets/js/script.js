gsap.registerPlugin(ScrollTrigger);

/* ── Custom cursor ── */
const cursor    = document.getElementById('cursor');
const cursorRing = document.getElementById('cursorRing');
let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;

document.addEventListener('mousemove', e => {
  mouseX = e.clientX; mouseY = e.clientY;
  cursor.style.left = mouseX + 'px';
  cursor.style.top  = mouseY + 'px';
});

function animateRing() {
  ringX += (mouseX - ringX) * .12;
  ringY += (mouseY - ringY) * .12;
  cursorRing.style.left = ringX + 'px';
  cursorRing.style.top  = ringY + 'px';
  requestAnimationFrame(animateRing);
}
animateRing();

document.querySelectorAll('a, button, .cookie-card').forEach(el => {
  el.addEventListener('mouseenter', () => {
    cursor.style.width = '18px';
    cursor.style.height = '18px';
    cursorRing.style.width = '56px';
    cursorRing.style.height = '56px';
    cursorRing.style.borderColor = 'var(--caramel-lt)';
  });
  el.addEventListener('mouseleave', () => {
    cursor.style.width = '10px';
    cursor.style.height = '10px';
    cursorRing.style.width = '36px';
    cursorRing.style.height = '36px';
    cursorRing.style.borderColor = 'var(--caramel)';
  });
});

/* ── Hero entrance timeline ── */
if (document.querySelector('.hero-badge')) {
  const heroTl = gsap.timeline({ delay: .1 });
  heroTl
    .from('.hero-badge',   { opacity: 0, y: 16, duration: .5, ease: 'power2.out' })
    .from('.bbh-hegarty-regular', { opacity: 0, y: 30, duration: .75, ease: 'power3.out' }, '-=.2')
    .from('.description',  { opacity: 0, y: 20, duration: .6, ease: 'power2.out' }, '-=.4')
    .from('.hero-actions', { opacity: 0, y: 16, duration: .5, ease: 'power2.out' }, '-=.3')
    .from('.scroll-indicator', { opacity: 0, duration: .6 }, '-=.2');
}

/* ── Video parallax + bg colour ── */
if (document.querySelector('.bg-video')) {
  gsap.to('.bg-video', {
    scale: .65,
    y: 110,
    ease: 'none',
    scrollTrigger: {
      trigger: '.video-background',
      start: 'top top',
      end: 'bottom top',
      scrub: 1.4,
    }
  });
}

gsap.to('body', {
  backgroundColor: '#FAF6F0',
  ease: 'none',
  scrollTrigger: {
    trigger: '.video-background',
    start: 'top top',
    end: 'bottom top',
    scrub: true,
  }
});

/* ── Cookie rotation on scroll ── */
if (document.querySelector('.cookie-imgg')) {
  gsap.fromTo('.cookie-imgg',
    { x: 200, opacity: .4, rotation: -20, scale: .88 },
    {
      x: -30,
      opacity: 1,
      rotation: 10,
      scale: 1.05,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: '.next-section',
        start: 'top 75%',
        end: 'bottom 30%',
        scrub: 1.6,
      }
    }
  );
}

/* ── Section label reveal ── */
gsap.from('.section-label', {
  scrollTrigger: { trigger: '.next-section', start: 'top 80%', toggleActions: 'play none none reverse' },
  opacity: 0, x: -16, duration: .55
});
gsap.from('.next-section h2', {
  scrollTrigger: { trigger: '.next-section', start: 'top 75%' },
  opacity: 0, y: 24, duration: .7, delay: .1
});
gsap.from('.next-section p', {
  scrollTrigger: { trigger: '.next-section', start: 'top 72%' },
  opacity: 0, y: 16, duration: .6, delay: .2
});
gsap.from('.stat-item', {
  scrollTrigger: { trigger: '.stat-row', start: 'top 85%' },
  opacity: 0, y: 20, stagger: .12, duration: .5, delay: .3
});

/* ── Showcase title ── */
gsap.from('.section-title2 .section-label, .section-title2 h2', {
  scrollTrigger: { trigger: '.showcase', start: 'top 80%' },
  opacity: 0, y: 24, stagger: .12, duration: .65
});

/* ── Cookie cards staggered ── */
gsap.from('.cookie-card', {
  scrollTrigger: { trigger: '.showcase-grid', start: 'top 82%' },
  opacity: 0,
  y: 40,
  scale: .97,
  stagger: .1,
  duration: .65,
  ease: 'power2.out',
});

/* ── Contact reveal ── */
gsap.from('.contact-eyebrow, .contact-left h2, .contact-left > p, .contact-details a', {
  scrollTrigger: { trigger: '.contact-section', start: 'top 78%' },
  opacity: 0,
  x: -24,
  stagger: .08,
  duration: .6,
  ease: 'power2.out',
});
gsap.from('.contact-right', {
  scrollTrigger: { trigger: '.contact-section', start: 'top 75%' },
  opacity: 0,
  x: 24,
  duration: .7,
  ease: 'power2.out',
  delay: .15
});

/* ── Navbar scroll behaviour ── */
window.addEventListener('scroll', () => {
  const nav = document.getElementById('navbar');
  if (window.scrollY > 60) {
    nav.style.background    = 'rgba(250,246,240,.97)';
    nav.style.boxShadow     = '0 8px 28px rgba(0,0,0,.06)';
    nav.style.borderBottom  = '1px solid rgba(196,120,62,.15)';
  } else {
    nav.style.background   = 'rgba(250,246,240,.88)';
    nav.style.boxShadow    = 'none';
    nav.style.borderBottom = '1px solid rgba(196,120,62,.12)';
  }
});
if (document.getElementById('ctaBtn')) {
  document.getElementById('ctaBtn').addEventListener('click', () => {
    document.getElementById('produits').scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
}

document.querySelectorAll('.navbar-menu a').forEach(a => {
  a.addEventListener('click', e => {
    const hash = a.getAttribute('href');
    if (hash && hash.startsWith('#')) {
      e.preventDefault();
      const target = document.querySelector(hash);
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

/* ── Form submit (demo) ── */
if (document.getElementById('contactForm')) {
  document.getElementById('contactForm').addEventListener('submit', e => {
    e.preventDefault();
    const btn = e.target.querySelector('button');
    const orig = btn.innerHTML;
    btn.innerHTML = 'Envoyé ✓';
    btn.style.background = '#2E241F';
    setTimeout(() => { btn.innerHTML = orig; btn.style.background = ''; }, 3000);
  });
}

/* ── Search functionality ── */
const searchInput = document.getElementById('searchInput');
if (searchInput) {
  searchInput.addEventListener('keyup', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const cookieCards = document.querySelectorAll('.cookie-card');
    let visibleCount = 0;

    cookieCards.forEach(card => {
      const cookieName = card.querySelector('.cookie-info h3').textContent.toLowerCase();
      const cookieDesc = card.querySelector('.cookie-info p').textContent.toLowerCase();
      
      if (cookieName.includes(searchTerm) || cookieDesc.includes(searchTerm)) {
        card.style.display = 'flex';
        card.style.flexDirection = 'column';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    // Show message if no results
    let noResultsMsg = document.querySelector('.no-results');
    if (visibleCount === 0 && searchTerm !== '') {
      if (!noResultsMsg) {
        noResultsMsg = document.createElement('div');
        noResultsMsg.className = 'no-results';
        noResultsMsg.textContent = 'Aucun cookie trouvé...';
        document.querySelector('.showcase-grid').parentElement.appendChild(noResultsMsg);
      }
      noResultsMsg.style.display = 'block';
    } else if (noResultsMsg) {
      noResultsMsg.style.display = 'none';
    }
  });
}