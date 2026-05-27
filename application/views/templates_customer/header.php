<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DriveEase – Rental Mobil Premium</title>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    /* ===================== CSS VARIABLES ===================== */
    :root {
      --blush:    #FADADD;
      --sage:     #C8D8C3;
      --sky:      #B8D4E8;
      --peach:    #FAD5B5;
      --lavender: #D9D3EE;
      --cream:    #FDF8F2;
      --sand:     #F5EFE6;
      --clay:     #E8DDD0;
      --text-dark: #2C2825;
      --text-mid:  #5C5046;
      --text-soft: #9C8E84;
      --accent:    #D4866A;
      --accent2:   #7A9E8E;
      --white:     #FFFFFF;
      --shadow-soft: 0 8px 32px rgba(100,80,60,0.10);
      --shadow-card: 0 4px 24px rgba(100,80,60,0.12);
      --radius-xl: 24px;
      --radius-lg: 16px;
      --radius-md: 12px;
      --radius-sm: 8px;
      --font-display: 'Fraunces', serif;
      --font-body:    'DM Sans', sans-serif;
    }

    /* ===================== RESET & BASE ===================== */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: var(--font-body);
      background: var(--cream);
      color: var(--text-dark);
      line-height: 1.7;
      overflow-x: hidden;
    }
    h1,h2,h3,h4 { font-family: var(--font-display); line-height: 1.2; }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; }

    /* ===================== SCROLLBAR ===================== */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--sand); }
    ::-webkit-scrollbar-thumb { background: var(--clay); border-radius: 4px; }

    /* ===================== NAVBAR ===================== */
    .navbar {
      background: rgba(253,248,242,0.88);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(200,180,160,0.18);
      padding: 14px 0;
      position: sticky;
      top: 0;
      z-index: 1000;
      transition: box-shadow 0.3s;
    }
    .navbar.scrolled { box-shadow: 0 4px 24px rgba(100,80,60,0.10); }
    .navbar-brand {
      font-family: var(--font-display);
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-dark);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .brand-dot {
      width: 10px; height: 10px;
      background: var(--accent);
      border-radius: 50%;
      display: inline-block;
    }
    .navbar-nav .nav-link {
      font-size: 0.92rem;
      font-weight: 500;
      color: var(--text-mid);
      padding: 6px 14px;
      border-radius: var(--radius-sm);
      transition: all 0.2s;
    }
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active { color: var(--accent); background: rgba(212,134,106,0.08); }
    .btn-nav-login {
      font-size: 0.88rem; font-weight: 500;
      color: var(--text-mid);
      border: 1.5px solid var(--clay);
      padding: 8px 20px;
      border-radius: 50px;
      background: transparent;
      transition: all 0.2s;
    }
    .btn-nav-login:hover { border-color: var(--accent); color: var(--accent); }
    .btn-nav-daftar {
      font-size: 0.88rem; font-weight: 600;
      color: var(--white);
      background: var(--accent);
      border: none;
      padding: 8px 22px;
      border-radius: 50px;
      transition: all 0.25s;
    }
    .btn-nav-daftar:hover { background: #C07358; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(212,134,106,0.35); }
    .navbar-toggler { border: none; outline: none !important; box-shadow: none !important; }
    .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2892%2C80%2C70%2C1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }

    /* ===================== HERO ===================== */
    .hero {
      position: relative;
      min-height: 92vh;
      display: flex;
      align-items: center;
      overflow: hidden;
      background: linear-gradient(135deg, #F5EFE6 0%, #EDE4D8 60%, #E0D5C8 100%);
    }
    .hero-bg-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(70px);
      opacity: 0.55;
      pointer-events: none;
    }
    .blob-1 { width: 520px; height: 520px; background: var(--blush); top: -120px; right: -80px; }
    .blob-2 { width: 400px; height: 400px; background: var(--peach); bottom: -100px; left: -60px; }
    .blob-3 { width: 280px; height: 280px; background: var(--lavender); top: 30%; right: 30%; }

    .hero-content { position: relative; z-index: 2; }
    .hero-eyebrow {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(212,134,106,0.12);
      color: var(--accent);
      font-size: 0.8rem; font-weight: 600;
      letter-spacing: 0.08em; text-transform: uppercase;
      padding: 6px 16px; border-radius: 50px;
      margin-bottom: 20px;
    }
    .hero-title {
      font-size: clamp(2.6rem, 6vw, 5rem);
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 18px;
    }
    .hero-title span { color: var(--accent); font-style: italic; }
    .hero-subtitle {
      font-size: 1.1rem;
      color: var(--text-mid);
      font-weight: 300;
      margin-bottom: 40px;
      max-width: 480px;
    }
    .hero-stats {
      display: flex; gap: 32px; margin-top: 40px;
    }
    .hero-stat-num {
      font-family: var(--font-display);
      font-size: 1.8rem; font-weight: 700;
      color: var(--text-dark);
    }
    .hero-stat-label { font-size: 0.8rem; color: var(--text-soft); font-weight: 400; }

    /* Hero car image */
    .hero-img-wrap {
      position: relative; z-index: 2;
      display: flex; align-items: center; justify-content: center;
    }
    .hero-img-card {
      background: rgba(255,255,255,0.55);
      backdrop-filter: blur(12px);
      border: 1.5px solid rgba(255,255,255,0.7);
      border-radius: var(--radius-xl);
      padding: 24px;
      box-shadow: var(--shadow-soft);
      position: relative;
    }
    .hero-img-card img { border-radius: var(--radius-lg); width: 100%; }
    .hero-badge {
      position: absolute;
      background: var(--white);
      border-radius: var(--radius-md);
      padding: 10px 16px;
      box-shadow: var(--shadow-card);
      display: flex; align-items: center; gap: 10px;
      font-size: 0.82rem;
    }
    .hero-badge.badge-top { top: -16px; right: 24px; }
    .hero-badge.badge-bot { bottom: -16px; left: 24px; }
    .badge-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
    .bi-peach { background: rgba(250,213,181,0.5); color: var(--accent); }
    .bi-sage  { background: rgba(200,216,195,0.5); color: var(--accent2); }
    .badge-label { font-size: 0.7rem; color: var(--text-soft); }
    .badge-value { font-weight: 600; color: var(--text-dark); }

    /* ===================== SEARCH BOX ===================== */
    .search-section {
      margin-top: -50px;
      position: relative;
      z-index: 10;
    }
    .search-box {
      background: var(--white);
      border-radius: var(--radius-xl);
      padding: 28px 32px;
      box-shadow: 0 16px 56px rgba(100,80,60,0.16);
      border: 1.5px solid rgba(200,180,160,0.15);
    }
    .search-box .form-label {
      font-size: 0.75rem; font-weight: 600; letter-spacing: 0.06em;
      text-transform: uppercase; color: var(--text-soft);
      margin-bottom: 6px;
    }
    .search-box .form-control,
    .search-box .form-select {
      border: 1.5px solid var(--clay);
      border-radius: var(--radius-md);
      padding: 12px 16px;
      font-size: 0.92rem;
      color: var(--text-dark);
      background: var(--sand);
      transition: all 0.2s;
    }
    .search-box .form-control:focus,
    .search-box .form-select:focus {
      outline: none;
      border-color: var(--accent);
      background: var(--white);
      box-shadow: 0 0 0 3px rgba(212,134,106,0.12);
    }
    .search-box .input-icon { position: relative; }
    .search-box .input-icon i {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      color: var(--text-soft); font-size: 0.9rem; pointer-events: none;
    }
    .search-box .input-icon .form-control { padding-left: 40px; }
    .btn-search {
      background: var(--accent);
      color: var(--white);
      border: none;
      border-radius: var(--radius-md);
      padding: 14px 32px;
      font-size: 0.95rem; font-weight: 600;
      width: 100%;
      transition: all 0.25s;
      display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-search:hover { background: #C07358; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(212,134,106,0.35); }

    /* ===================== SECTION GENERIC ===================== */
    .section-eyebrow {
      display: inline-block;
      font-size: 0.75rem; font-weight: 600; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--accent);
      margin-bottom: 10px;
    }
    .section-title {
      font-family: var(--font-display);
      font-size: clamp(1.8rem, 3.5vw, 2.8rem);
      font-weight: 700; color: var(--text-dark);
      margin-bottom: 14px;
    }
    .section-sub { color: var(--text-soft); font-weight: 300; max-width: 480px; }
    section { padding: 80px 0; }

    /* ===================== FILTER BAR ===================== */
    .filter-bar {
      background: var(--white);
      border-radius: var(--radius-xl);
      padding: 18px 24px;
      box-shadow: var(--shadow-card);
      display: flex; align-items: center; flex-wrap: wrap; gap: 14px;
      margin-bottom: 40px;
      border: 1.5px solid rgba(200,180,160,0.15);
    }
    .filter-label { font-size: 0.82rem; font-weight: 600; color: var(--text-mid); white-space: nowrap; }
    .filter-bar select, .filter-bar input[type=range] {
      border: 1.5px solid var(--clay);
      border-radius: var(--radius-sm);
      padding: 8px 14px;
      font-size: 0.85rem;
      color: var(--text-dark);
      background: var(--sand);
      cursor: pointer;
      transition: border-color 0.2s;
    }
    .filter-bar select:focus { outline: none; border-color: var(--accent); }
    .btn-reset-filter {
      font-size: 0.82rem; font-weight: 500;
      color: var(--text-soft); background: transparent;
      border: 1.5px solid var(--clay); border-radius: 50px;
      padding: 7px 18px; cursor: pointer; transition: all 0.2s;
    }
    .btn-reset-filter:hover { color: var(--accent); border-color: var(--accent); }
    .active-filters { display: flex; gap: 8px; flex-wrap: wrap; }
    .filter-chip {
      font-size: 0.76rem; font-weight: 500;
      color: var(--accent2); background: rgba(122,158,142,0.12);
      border-radius: 50px; padding: 4px 12px;
      display: flex; align-items: center; gap: 6px;
    }
    .filter-chip i { cursor: pointer; font-size: 0.65rem; }

    /* ===================== CAR CARDS ===================== */
    .cars-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; }
    .car-card {
      background: var(--white);
      border-radius: var(--radius-xl);
      overflow: hidden;
      box-shadow: var(--shadow-card);
      border: 1.5px solid rgba(200,180,160,0.12);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
    }
    .car-card:hover { transform: translateY(-8px); box-shadow: 0 20px 48px rgba(100,80,60,0.18); }
    .car-img-wrap {
      position: relative; overflow: hidden;
      background: linear-gradient(135deg, var(--sand), var(--clay));
      height: 190px;
      display: flex; align-items: center; justify-content: center;
    }
    .car-img-wrap img { width: 85%; object-fit: contain; transition: transform 0.4s ease; }
    .car-card:hover .car-img-wrap img { transform: scale(1.06); }
    .car-type-badge {
      position: absolute; top: 14px; left: 14px;
      font-size: 0.7rem; font-weight: 600; letter-spacing: 0.06em;
      text-transform: uppercase;
      padding: 4px 12px; border-radius: 50px;
    }
    .badge-suv  { background: rgba(185,212,232,0.7); color: #4A7FA0; }
    .badge-mpv  { background: rgba(200,216,195,0.7); color: #4A7A65; }
    .badge-sedan{ background: rgba(218,211,238,0.7); color: #6A5FA0; }
    .badge-city { background: rgba(250,218,221,0.7); color: #A05A65; }
    .car-status {
      position: absolute; top: 14px; right: 14px;
      font-size: 0.7rem; font-weight: 600;
      padding: 4px 12px; border-radius: 50px;
    }
    .status-available { background: rgba(122,200,140,0.2); color: #3A8A50; }
    .status-rented    { background: rgba(220,140,100,0.2); color: #B05030; }
    .car-body { padding: 20px; }
    .car-name { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
    .car-meta { font-size: 0.8rem; color: var(--text-soft); margin-bottom: 14px; }
    .car-specs { display: flex; gap: 12px; margin-bottom: 18px; }
    .car-spec {
      display: flex; align-items: center; gap: 5px;
      font-size: 0.78rem; color: var(--text-mid);
      background: var(--sand); border-radius: 6px;
      padding: 4px 10px;
    }
    .car-spec i { color: var(--text-soft); font-size: 0.75rem; }
    .car-footer { display: flex; align-items: center; justify-content: space-between; }
    .car-price { font-family: var(--font-display); font-size: 1.3rem; font-weight: 700; color: var(--accent); }
    .car-price span { font-family: var(--font-body); font-size: 0.75rem; font-weight: 400; color: var(--text-soft); }
    .btn-sewa {
      background: var(--accent);
      color: var(--white);
      border: none;
      border-radius: 50px;
      padding: 9px 20px;
      font-size: 0.82rem; font-weight: 600;
      transition: all 0.25s;
      cursor: pointer;
    }
    .btn-sewa:hover { background: #C07358; box-shadow: 0 4px 14px rgba(212,134,106,0.4); }
    .btn-sewa:disabled { background: var(--clay); color: var(--text-soft); cursor: not-allowed; box-shadow: none; }

    /* ===================== WHY US ===================== */
    .why-us { background: var(--sand); }
    .why-card {
      background: var(--white);
      border-radius: var(--radius-xl);
      padding: 36px 28px;
      height: 100%;
      border: 1.5px solid rgba(200,180,160,0.15);
      box-shadow: var(--shadow-card);
      transition: transform 0.3s, box-shadow 0.3s;
      position: relative; overflow: hidden;
    }
    .why-card::before {
      content: '';
      position: absolute;
      top: -40px; right: -40px;
      width: 120px; height: 120px;
      border-radius: 50%;
      opacity: 0.25;
    }
    .why-card:nth-child(1)::before { background: var(--blush); }
    .why-card:nth-child(2)::before { background: var(--sage); }
    .why-card:nth-child(3)::before { background: var(--sky); }
    .why-card:nth-child(4)::before { background: var(--peach); }
    .why-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(100,80,60,0.14); }
    .why-icon {
      width: 56px; height: 56px; border-radius: var(--radius-md);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem; margin-bottom: 18px;
    }
    .icon-blush   { background: rgba(250,218,221,0.5); color: #C0606A; }
    .icon-sage    { background: rgba(200,216,195,0.5); color: var(--accent2); }
    .icon-sky     { background: rgba(184,212,232,0.5); color: #4A7FA0; }
    .icon-peach   { background: rgba(250,213,181,0.5); color: var(--accent); }
    .why-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; margin-bottom: 10px; color: var(--text-dark); }
    .why-desc { font-size: 0.88rem; color: var(--text-soft); line-height: 1.7; }

    /* ===================== TESTIMONIALS ===================== */
    .testi-card {
      background: var(--white);
      border-radius: var(--radius-xl);
      padding: 28px 24px;
      height: 100%;
      border: 1.5px solid rgba(200,180,160,0.12);
      box-shadow: var(--shadow-card);
      transition: transform 0.3s;
    }
    .testi-card:hover { transform: translateY(-4px); }
    .testi-stars { color: #F4B860; font-size: 0.9rem; margin-bottom: 14px; letter-spacing: 2px; }
    .testi-text { font-size: 0.9rem; color: var(--text-mid); line-height: 1.75; margin-bottom: 20px; font-style: italic; }
    .testi-author { display: flex; align-items: center; gap: 14px; }
    .testi-avatar {
      width: 44px; height: 44px; border-radius: 50%;
      background: linear-gradient(135deg, var(--blush), var(--peach));
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
      color: var(--accent); flex-shrink: 0;
    }
    .testi-name { font-weight: 600; font-size: 0.9rem; color: var(--text-dark); }
    .testi-loc  { font-size: 0.78rem; color: var(--text-soft); }

    /* ===================== CTA ===================== */
    .cta-section {
      background: linear-gradient(135deg, #EDE4D8 0%, #E8DDD0 100%);
      position: relative; overflow: hidden;
      padding: 100px 0;
    }
    .cta-section::before {
      content: '';
      position: absolute; top: -80px; right: -80px;
      width: 400px; height: 400px;
      background: var(--blush); border-radius: 50%; opacity: 0.4; filter: blur(60px);
    }
    .cta-section::after {
      content: '';
      position: absolute; bottom: -80px; left: -80px;
      width: 320px; height: 320px;
      background: var(--peach); border-radius: 50%; opacity: 0.35; filter: blur(60px);
    }
    .cta-inner { position: relative; z-index: 2; text-align: center; }
    .cta-title { font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 700; color: var(--text-dark); margin-bottom: 16px; }
    .cta-sub { font-size: 1rem; color: var(--text-mid); margin-bottom: 36px; }
    .btn-cta {
      background: var(--accent);
      color: var(--white);
      border: none; border-radius: 50px;
      padding: 16px 48px;
      font-size: 1rem; font-weight: 600;
      transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px;
    }
    .btn-cta:hover { background: #C07358; transform: translateY(-3px); box-shadow: 0 12px 32px rgba(212,134,106,0.4); }
    .btn-cta-outline {
      background: transparent;
      color: var(--text-dark);
      border: 2px solid var(--clay); border-radius: 50px;
      padding: 15px 36px;
      font-size: 1rem; font-weight: 500;
      transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px;
    }
    .btn-cta-outline:hover { border-color: var(--accent); color: var(--accent); }

    /* ===================== FOOTER ===================== */
    footer {
      background: var(--text-dark);
      color: rgba(255,255,255,0.75);
      padding: 60px 0 28px;
    }
    .footer-brand { font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; color: var(--white); margin-bottom: 12px; }
    .footer-desc { font-size: 0.88rem; line-height: 1.75; max-width: 300px; }
    .footer-heading { font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.5); margin-bottom: 16px; }
    .footer-links { list-style: none; padding: 0; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a { font-size: 0.88rem; color: rgba(255,255,255,0.65); transition: color 0.2s; }
    .footer-links a:hover { color: var(--accent); }
    .footer-divider { border-color: rgba(255,255,255,0.08); margin: 40px 0 20px; }
    .footer-bottom { font-size: 0.82rem; color: rgba(255,255,255,0.35); }
    .social-links { display: flex; gap: 12px; margin-top: 20px; }
    .social-link {
      width: 38px; height: 38px; border-radius: 50%;
      background: rgba(255,255,255,0.08);
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,0.65); font-size: 0.9rem;
      transition: all 0.2s;
    }
    .social-link:hover { background: var(--accent); color: var(--white); }
    .contact-item { display: flex; gap: 12px; align-items: flex-start; margin-bottom: 14px; }
    .contact-icon { color: var(--accent); font-size: 0.9rem; margin-top: 3px; flex-shrink: 0; }
    .contact-text { font-size: 0.88rem; color: rgba(255,255,255,0.65); line-height: 1.6; }

    /* ===================== ANIMATIONS ===================== */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes float {
      0%,100% { transform: translateY(0px); }
      50%      { transform: translateY(-10px); }
    }
    .animate-fadeup { animation: fadeInUp 0.7s ease forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .hero-img-card { animation: float 6s ease-in-out infinite; }

    /* ===================== UTILITIES ===================== */
    .text-accent { color: var(--accent); }
    .bg-sand { background: var(--sand) !important; }
    .divider-soft { border: none; border-top: 1.5px solid var(--clay); margin: 0; }
    .no-cars-msg { text-align: center; padding: 60px 20px; color: var(--text-soft); grid-column: 1/-1; }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 991px) {
      .hero { min-height: auto; padding: 80px 0 40px; }
      .hero-img-wrap { margin-top: 40px; }
      .hero-stats { gap: 20px; }
      .search-section { margin-top: 40px; }
      .filter-bar { flex-direction: column; align-items: flex-start; }
    }
    @media (max-width: 767px) {
      section { padding: 56px 0; }
      .cars-grid { grid-template-columns: 1fr 1fr; }
      .hero-stats { flex-wrap: wrap; gap: 16px; }
    }
    @media (max-width: 575px) {
      .cars-grid { grid-template-columns: 1fr; }
      .search-box { padding: 20px 16px; }
    }
  </style>
</head>