<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard – DriveEase</title>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    /* ===================== CSS VARIABLES (sama dengan landing page) ===================== */
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
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--sand); }
    ::-webkit-scrollbar-thumb { background: var(--clay); border-radius: 4px; }

    /* ===================== NAVBAR DASHBOARD ===================== */
    .navbar-dashboard {
      background: rgba(253,248,242,0.92);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(200,180,160,0.2);
      padding: 12px 0;
      position: sticky;
      top: 0;
      z-index: 1000;
      transition: box-shadow 0.3s;
    }
    .navbar-dashboard.scrolled { box-shadow: 0 4px 24px rgba(100,80,60,0.10); }
    .navbar-brand {
      font-family: var(--font-display);
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--text-dark);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .brand-dot {
      width: 9px; height: 9px;
      background: var(--accent);
      border-radius: 50%;
      display: inline-block;
    }
    .nav-dashboard-links {
      display: flex;
      align-items: center;
      gap: 4px;
      list-style: none;
      margin: 0; padding: 0;
    }
    .nav-dashboard-links .nav-link {
      font-size: 0.88rem;
      font-weight: 500;
      color: var(--text-mid);
      padding: 7px 14px;
      border-radius: var(--radius-sm);
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 7px;
    }
    .nav-dashboard-links .nav-link:hover,
    .nav-dashboard-links .nav-link.active {
      color: var(--accent);
      background: rgba(212,134,106,0.08);
    }
    .nav-dashboard-links .nav-link i { font-size: 0.85rem; }

    /* Avatar dropdown */
    .nav-avatar-wrap {
      position: relative;
    }
    .nav-avatar-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      background: var(--sand);
      border: 1.5px solid var(--clay);
      border-radius: 50px;
      padding: 6px 14px 6px 6px;
      cursor: pointer;
      transition: all 0.2s;
    }
    .nav-avatar-btn:hover { border-color: var(--accent); }
    .nav-avatar-circle {
      width: 32px; height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--peach), var(--blush));
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-display);
      font-size: 0.9rem; font-weight: 700;
      color: var(--accent);
      flex-shrink: 0;
      overflow: hidden;
    }
    .nav-avatar-circle img {
      width: 100%; height: 100%; object-fit: cover; border-radius: 50%;
    }
    .nav-avatar-name {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--text-dark);
      max-width: 120px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .nav-avatar-btn .fa-chevron-down {
      font-size: 0.65rem;
      color: var(--text-soft);
    }
    .nav-dropdown {
      position: absolute;
      top: calc(100% + 10px);
      right: 0;
      background: var(--white);
      border: 1.5px solid var(--clay);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-soft);
      min-width: 200px;
      padding: 8px;
      display: none;
      z-index: 999;
    }
    .nav-dropdown.open { display: block; }
    .nav-dropdown-header {
      padding: 10px 12px 12px;
      border-bottom: 1px solid var(--clay);
      margin-bottom: 6px;
    }
    .nav-dropdown-name {
      font-size: 0.9rem; font-weight: 600; color: var(--text-dark);
    }
    .nav-dropdown-email {
      font-size: 0.78rem; color: var(--text-soft);
    }
    .nav-dropdown a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 12px;
      border-radius: var(--radius-sm);
      font-size: 0.85rem;
      color: var(--text-mid);
      transition: all 0.18s;
    }
    .nav-dropdown a:hover { background: var(--sand); color: var(--accent); }
    .nav-dropdown a i { font-size: 0.85rem; width: 16px; }
    .nav-dropdown .divider { border: none; border-top: 1px solid var(--clay); margin: 6px 0; }
    .nav-dropdown .logout-link { color: #C05050 !important; }
    .nav-dropdown .logout-link:hover { background: rgba(192,80,80,0.08) !important; }

    /* Badge pelanggan lama */
    .badge-pelanggan-lama {
      font-size: 0.65rem; font-weight: 600;
      background: linear-gradient(135deg, var(--peach), var(--blush));
      color: var(--accent);
      padding: 2px 9px;
      border-radius: 50px;
      margin-left: 6px;
    }

    /* Mobile toggle */
    .navbar-toggler-dash {
      background: none; border: 1.5px solid var(--clay);
      border-radius: var(--radius-sm);
      padding: 6px 10px; cursor: pointer;
      color: var(--text-mid);
    }
    .mobile-nav {
      display: none;
      background: var(--white);
      border-top: 1px solid var(--clay);
      padding: 12px 0;
    }
    .mobile-nav.open { display: block; }
    .mobile-nav a {
      display: flex; align-items: center; gap: 10px;
      padding: 11px 24px;
      font-size: 0.9rem; font-weight: 500;
      color: var(--text-mid);
      transition: all 0.18s;
    }
    .mobile-nav a:hover,
    .mobile-nav a.active { color: var(--accent); background: rgba(212,134,106,0.06); }
    .mobile-nav .divider { border: none; border-top: 1px solid var(--clay); margin: 6px 0; }
  </style>
</head>
<body>

<!-- ===================== NAVBAR DASHBOARD ===================== -->
<nav class="navbar-dashboard" id="dashNav">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between">

      <!-- Brand -->
      <a href="<?= base_url('/') ?>" class="navbar-brand">
        <span class="brand-dot"></span>DriveEase
      </a>

      <!-- Desktop Nav Links -->
      <ul class="nav-dashboard-links d-none d-lg-flex">
        <li>
          <a href="<?= base_url('customer/dashboard') ?>"
             class="nav-link <?= (uri_string() == 'customer/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-home"></i> Beranda
          </a>
        </li>
        <li>
          <a href="<?= base_url('customer/mobil') ?>"
             class="nav-link <?= (strpos(uri_string(), 'customer/mobil') !== false) ? 'active' : '' ?>">
            <i class="fas fa-car"></i> Pesan Mobil
          </a>
        </li>
        <li>
          <a href="<?= base_url('customer/transaksi') ?>"
             class="nav-link <?= (strpos(uri_string(), 'customer/transaksi') !== false) ? 'active' : '' ?>">
            <i class="fas fa-list-check"></i> Riwayat Sewa
          </a>
        </li>
        <li>
          <a href="<?= base_url('customer/profil') ?>"
             class="nav-link <?= (strpos(uri_string(), 'customer/profil') !== false) ? 'active' : '' ?>">
            <i class="fas fa-user"></i> Profil
          </a>
        </li>
      </ul>

      <!-- Avatar Dropdown -->
      <div class="d-none d-lg-flex align-items-center gap-3">
        <div class="nav-avatar-wrap">
          <div class="nav-avatar-btn" onclick="toggleDropdown()">
            <div class="nav-avatar-circle">
              <?php if (!empty($customer) && !empty($customer->foto_profil)): ?>
                <img src="<?= base_url('assets/upload/profil/'.$customer->foto_profil) ?>" alt="foto"/>
              <?php else: ?>
                <?= strtoupper(substr($this->session->userdata('nama_lengkap'), 0, 1)) ?>
              <?php endif; ?>
            </div>
            <span class="nav-avatar-name">
              <?= $this->session->userdata('nama_lengkap') ?>
              <?php if (isset($is_pelanggan_lama) && $is_pelanggan_lama): ?>
                <span class="badge-pelanggan-lama">⭐ Setia</span>
              <?php endif; ?>
            </span>
            <i class="fas fa-chevron-down"></i>
          </div>

          <div class="nav-dropdown" id="navDropdown">
            <div class="nav-dropdown-header">
              <div class="nav-dropdown-name"><?= $this->session->userdata('nama_lengkap') ?></div>
              <div class="nav-dropdown-email"><?= $this->session->userdata('email') ?></div>
            </div>
            <a href="<?= base_url('customer/profil') ?>">
              <i class="fas fa-user-circle"></i> Profil Saya
            </a>
            <a href="<?= base_url('customer/transaksi') ?>">
              <i class="fas fa-receipt"></i> Riwayat Sewa
            </a>
            <hr class="divider"/>
            <a href="<?= base_url('auth/logout') ?>" class="logout-link">
              <i class="fas fa-right-from-bracket"></i> Keluar
            </a>
          </div>
        </div>
      </div>

      <!-- Mobile Toggle -->
      <button class="navbar-toggler-dash d-lg-none" onclick="toggleMobileNav()">
        <i class="fas fa-bars"></i>
      </button>

    </div>
  </div>

  <!-- Mobile Nav -->
  <div class="mobile-nav" id="mobileNav">
    <a href="<?= base_url('customer/dashboard') ?>" class="<?= (uri_string() == 'customer/dashboard') ? 'active' : '' ?>">
      <i class="fas fa-home"></i> Beranda
    </a>
    <a href="<?= base_url('customer/mobil') ?>"><i class="fas fa-car"></i> Pesan Mobil</a>
    <a href="<?= base_url('customer/transaksi') ?>"><i class="fas fa-list-check"></i> Riwayat Sewa</a>
    <a href="<?= base_url('customer/profil') ?>"><i class="fas fa-user"></i> Profil</a>
    <hr class="divider"/>
    <a href="<?= base_url('auth/logout') ?>" style="color:#C05050;">
      <i class="fas fa-right-from-bracket"></i> Keluar
    </a>
  </div>
</nav>

<script>
function toggleDropdown() {
  document.getElementById('navDropdown').classList.toggle('open');
}
function toggleMobileNav() {
  document.getElementById('mobileNav').classList.toggle('open');
}
document.addEventListener('click', function(e) {
  const wrap = document.querySelector('.nav-avatar-wrap');
  if (wrap && !wrap.contains(e.target)) {
    document.getElementById('navDropdown').classList.remove('open');
  }
});
window.addEventListener('scroll', function() {
  document.getElementById('dashNav').classList.toggle('scrolled', window.scrollY > 20);
});
</script>