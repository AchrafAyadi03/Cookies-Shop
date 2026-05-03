<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Maison Cookie — Loading</title>
  <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --black: #000000;
      --white: #ffffff;
      --cream: #f5f0e8;
    }

    html, body {
      width: 100%; height: 100%;
      background: var(--black);
      overflow: hidden;
      font-family: sans-serif;
    }

    /* ── LOADER SCREEN ── */
    #loader {
      position: fixed;
      inset: 0;
      background: var(--black);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 100;
    }

    /* Logo wrapper */
    .logo-wrap {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transform: translateY(18px);
      animation: fadeUp 1.1s cubic-bezier(0.22, 1, 0.36, 1) 0.3s forwards;
    }

    .logo-wrap img {
      width: clamp(260px, 50vw, 480px);
      filter: brightness(1);
    }

    

    /* Thin line below logo */
    .line {
      width: 0;
      height: 1px;
      background: rgba(255,255,255,0.35);
      margin-top: 28px;
      animation: expandLine 0.9s cubic-bezier(0.22, 1, 0.36, 1) 1.2s forwards;
    }

    /* Progress bar */
    .progress-track {
      position: absolute;
      bottom: 52px;
      left: 50%;
      transform: translateX(-50%);
      width: clamp(120px, 22vw, 200px);
      height: 1px;
      background: rgba(255,255,255,0.12);
      overflow: hidden;
      opacity: 0;
      animation: fadeIn 0.6s ease 1s forwards;
    }

    .progress-fill {
      height: 100%;
      width: 0%;
      background: rgba(255,255,255,0.7);
      animation: progress 2.4s cubic-bezier(0.4, 0, 0.2, 1) 1.1s forwards;
    }

    /* Percentage counter */
    .counter {
      position: absolute;
      bottom: 36px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 10px;
      letter-spacing: 0.25em;
      color: rgba(255,255,255,0.3);
      font-family: 'Courier New', monospace;
      opacity: 0;
      animation: fadeIn 0.6s ease 1s forwards;
    }

    /* Reveal overlay that slides up to reveal the page */
    #curtain {
      position: fixed;
      inset: 0;
      background: var(--black);
      transform: translateY(0);
      z-index: 99;
      pointer-events: none;
      animation: curtainUp 1s cubic-bezier(0.76, 0, 0.24, 1) 3.7s forwards;
    }

    /* ── MAIN PAGE (revealed after load) ── */
    #page {
      min-height: 100vh;
      background: var(--black);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      opacity: 0;
      animation: fadeIn 0.8s ease 4.5s forwards;
    }

    #page img {
      width: clamp(220px, 38vw, 380px);
      opacity: 0.95;
    }

    /* ── KEYFRAMES ── */
    @keyframes fadeUp {
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      to { opacity: 1; }
    }

    @keyframes expandLine {
      to { width: clamp(160px, 30vw, 300px); }
    }

    @keyframes shimmer {
      to { background-position: 200% 0; }
    }

    @keyframes progress {
      0%   { width: 0%; }
      30%  { width: 28%; }
      60%  { width: 62%; }
      85%  { width: 88%; }
      100% { width: 100%; }
    }

    @keyframes curtainUp {
      0%   { transform: translateY(0);     opacity: 1; }
      100% { transform: translateY(-100%); opacity: 1; }
    }
  </style>
</head>
<body>

  <!-- LOADER -->
  <div id="loader">
    <div class="logo-wrap">
      <img src="images/logo.png" alt="Maison Cookie" />
    </div>
    <div class="line"></div>

    <div class="progress-track">
      <div class="progress-fill" id="fill"></div>
    </div>
    <div class="counter" id="counter">0</div>
  </div>

  <!-- CURTAIN -->
  <div id="curtain"></div>

  <!-- MAIN PAGE -->
  <div id="page">
    <img src="images/logo.png" alt="Maison Cookie" />
  </div>

  <script>
    // Animated counter 0 → 100
    const counter = document.getElementById('counter');
    let start = null;
    const duration = 2400;
    const delay = 1100;

    function animateCount(timestamp) {
      if (!start) start = timestamp;
      const elapsed = timestamp - start;
      const progress = Math.min(elapsed / duration, 1);
      // ease-in-out curve
      const eased = progress < 0.5
        ? 2 * progress * progress
        : -1 + (4 - 2 * progress) * progress;
      counter.textContent = Math.round(eased * 100);
      if (progress < 1) requestAnimationFrame(animateCount);
    }

    setTimeout(() => requestAnimationFrame(animateCount), delay);

    // Hide loader after curtain completes
    setTimeout(() => {
      document.getElementById('loader').style.display = 'none';
      window.location.href = "index.php";

    }, 5000);

    // apparition au scroll
    gsap.to(".cookie-img", {
        opacity: 1,
        scale: 1,
        duration: 1.5,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".cookie",
            start: "top 80%",
            toggleActions: "play none none none"
        }
    });

    // mouvement continu
    gsap.to(".cookie-img", {
        y: -10,
        rotation: 2,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });
  </script>
</body>
</html>