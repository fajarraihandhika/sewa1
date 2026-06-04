<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard – DriveEase</title>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    /* ===================== CSS VARIABLES (Dipertegas & Dikontraskan) ===================== */
    :root {
      --blush:     #FADADD;
      --sage:      #C8D8C3;
      --sky:       #B8D4E8;
      --peach:     #FAD5B5;
      --lavender:  #D9D3EE;
      --cream:     #FAF6F0; /* Sedikit dimatangkan agar kontras dengan card putih */
      --sand:      #F5EFE6;
      --clay:      #DCD1BF; /* Digelapkan sedikit dari #E8DDD0 agar border terlihat nyata */
      
      /* Kunci Ketegasan: Warna teks diubah ke Warm Dark Espresso */
      --text-dark: #2A1F17; 
      --text-mid:  #4A3B30; 
      --text-soft: #7C6C60; 
      
      --accent:    #D4866A;
      --accent2:   #5A8271; /* Dipertegas agar status hijau lebih kontras */
      --white:     #FFFFFF;
      
      /* Bayangan & Batas yang Mantap */
      --shadow-soft: 0 4px 20px rgba(74, 59, 48, 0.08);
      --shadow-card: 0 8px 30px rgba(74, 59, 48, 0.12);
      --border-bold: 1.5px solid var(--clay);
      
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
    h1,h2,h3,h4 { font-family: var(--font-display); line-height: 1.2; font-weight: 700; }
    a { text-decoration: none; color: inherit; transition: all 0.2s; }
    img { max-width: 100%; }
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: var(--sand); }
    ::-webkit-scrollbar-thumb { background: var(--clay); border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--text-soft); }

    /* ===================== NAVBAR DASHBOARD ===================== */
    .navbar-dashboard {
  background: #F5EFE6 !important; /* Mengubah transparan menjadi warna sand solid */
  border-bottom: 2px solid var(--clay); /* Batas bawah diperjelas */
  padding: 14px 0;
  position: sticky;
  top: 0;
  z-index: 1000;
  box-shadow: 0 4px 16px rgba(74, 62, 53, 0.05); /* Shadow tipis agar mengambang */
}
/* Saat di-scroll, background berubah jadi putih solid biar kontras */
.navbar-dashboard.scrolled { 
  background: var(--white) !important;
  border-bottom-color: var(--clay);
  box-shadow: 0 8px 24px rgba(74, 62, 53, 0.10);
}
    .navbar-brand {
      font-family: var(--font-display);
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--text-dark);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .brand-dot {
      width: 10px; height: 10px;
      background: var(--accent);
      border-radius: 50%;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(212,134,106,0.4);
    }
    .nav-dashboard-links {
      display: flex;
      align-items: center;
      gap: 6px;
      list-style: none;
      margin: 0; padding: 0;
    }
    .nav-dashboard-links .nav-link {
      font-size: 0.9rem;
      font-weight: 600; /* Dibuat lebih tebal agar tegas */
      color: var(--text-mid);
      padding: 8px 16px;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .nav-dashboard-links .nav-link:hover {
      color: var(--accent);
      background: rgba(212,134,106,0.1);
    }
    .nav-dashboard-links .nav-link.active {
  color: var(--white) !important;
  background: var(--accent); /* Mengubah dari hitam ke warna terracotta/oranye */
  box-shadow: 0 4px 12px rgba(212, 134, 106, 0.3); /* Shadow halus sewarna agar tidak kaku */
}
    .nav-dashboard-links .nav-link i { font-size: 0.9rem; }

    /* Avatar Dropdown Button */
    .nav-avatar-wrap { position: relative; }
    .nav-avatar-btn {
      display: flex;
      align-items: center;
      gap: 12px;
      background: var(--white);
      border: var(--border-bold);
      border-radius: 50px;
      padding: 6px 16px 6px 6px;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0,0,0,0.02);
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-avatar-btn:hover { 
      border-color: var(--text-dark);
      transform: translateY(-1px);
      box-shadow: var(--shadow-soft);
    }
    .nav-avatar-circle {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--peach), var(--blush));
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-display);
      font-size: 1rem; font-weight: 800;
      color: var(--text-dark);
      border: 1.5px solid var(--clay);
      flex-shrink: 0;
      overflow: hidden;
    }
    .nav-avatar-circle img {
      width: 100%; height: 100%; object-fit: cover; border-radius: 50%;
    }
    .nav-avatar-name {
      font-size: 0.9rem;
      font-weight: 700;
      color: var(--text-dark);
      max-width: 130px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .nav-avatar-btn .fa-chevron-down {
      font-size: 0.7rem;
      color: var(--text-soft);
      transition: transform 0.2s;
    }
    
    /* Dropdown Menu Box */
    .nav-dropdown {
      position: absolute;
      top: calc(100% + 12px);
      right: 0;
      background: var(--white);
      border: var(--border-bold);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-card);
      min-width: 230px;
      padding: 10px;
      display: none;
      z-index: 999;
      animation: menuFade 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes menuFade {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .nav-dropdown.open { display: block; }
    .nav-dropdown-header {
      padding: 12px;
      border-bottom: 1.5px solid var(--sand);
      margin-bottom: 8px;
    }
    .nav-dropdown-name {
      font-size: 0.95rem; font-weight: 700; color: var(--text-dark);
    }
    .nav-dropdown-email {
      font-size: 0.8rem; color: var(--text-soft); font-weight: 500;
    }
    .nav-dropdown a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: var(--radius-sm);
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-mid);
    }
    .nav-dropdown a:hover { 
      background: var(--sand); 
      color: var(--text-dark); 
    }
    .nav-dropdown a i { font-size: 0.95rem; width: 20px; color: var(--text-soft); }
    .nav-dropdown .divider { border: none; border-top: 1.5px solid var(--sand); margin: 8px 0; }
    .nav-dropdown .logout-link { color: #A83939 !important; }
    .nav-dropdown .logout-link:hover { background: #FFF0F0 !important; }
    .nav-dropdown .logout-link i { color: #A83939 !important; }

    /* Badge Bintang Loyalitas */
    .badge-pelanggan-lama {
      font-size: 0.7rem; font-weight: 700;
      background: var(--text-dark);
      color: var(--peach);
      padding: 3px 10px;
      border-radius: 50px;
      margin-left: 8px;
      border: 1px solid var(--clay);
    }

    /* Mobile Navigation */
    .navbar-toggler-dash {
      background: var(--white); 
      border: var(--border-bold);
      border-radius: var(--radius-sm);
      padding: 8px 12px; cursor: pointer;
      color: var(--text-dark);
      transition: all 0.2s;
    }
    .navbar-toggler-dash:hover { background: var(--sand); }
    
    .mobile-nav {
      display: none;
      background: var(--white);
      border-top: 2px solid var(--clay);
      padding: 8px 0;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .mobile-nav.open { display: block; }
    .mobile-nav a {
      display: flex; align-items: center; gap: 12px;
      padding: 12px 24px;
      font-size: 0.95rem; font-weight: 600;
      color: var(--text-mid);
    }
    .mobile-nav a:hover { color: var(--accent); background: rgba(212,134,106,0.06); }
    .mobile-nav a.active {
  color: var(--white) !important;
  background: var(--accent); /* Disamakan juga untuk tampilan mobile */
}
    .mobile-nav .divider { border: none; border-top: 1px solid var(--sand); margin: 8px 0; }
  </style>
</head>
<body>

<nav class="navbar-dashboard" id="dashNav">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between">

      <a href="<?= base_url('/') ?>" class="navbar-brand">
        <span class="brand-dot"></span>DriveEase
      </a>

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
  
      </ul>

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
              <?= explode(' ', $this->session->userdata('nama_lengkap'))[0] ?>
              <?php if (isset($is_pelanggan_lama) && $is_pelanggan_lama): ?>
                <span class="badge-pelanggan-lama">⭐ Setia</span>
              <?php endif; ?>
            </span>
            <i class="fas fa-chevron-down" id="arrowIcon"></i>
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

      <button class="navbar-toggler-dash d-lg-none" onclick="toggleMobileNav()">
        <i class="fas fa-bars"></i>
      </button>

    </div>
  </div>

  <div class="mobile-nav" id="mobileNav">
    <a href="<?= base_url('customer/dashboard') ?>" class="nav-link <?= (uri_string() == 'customer/dashboard') ? 'active' : '' ?>">
      <i class="fas fa-home"></i> Beranda
    </a>
    <a href="<?= base_url('customer/mobil') ?>" class="nav-link <?= (strpos(uri_string(), 'customer/mobil') !== false) ? 'active' : '' ?>"><i class="fas fa-car"></i> Pesan Mobil</a>
    <a href="<?= base_url('customer/transaksi') ?>" class="nav-link <?= (strpos(uri_string(), 'customer/transaksi') !== false) ? 'active' : '' ?>"><i class="fas fa-list-check"></i> Riwayat Sewa</a>
    <hr class="divider"/>
    <a href="<?= base_url('auth/logout') ?>" class="logout-link">
      <i class="fas fa-right-from-bracket"></i> Keluar
    </a>
  </div>
</nav>

<script>
function toggleDropdown() {
  const dropdown = document.getElementById('navDropdown');
  const arrow = document.getElementById('arrowIcon');
  dropdown.classList.toggle('open');
  if(dropdown.classList.contains('open')) {
    arrow.style.transform = 'rotate(180deg)';
  } else {
    arrow.style.transform = 'rotate(0deg)';
  }
}
function toggleMobileNav() {
  document.getElementById('mobileNav').classList.toggle('open');
}
document.addEventListener('click', function(e) {
  const wrap = document.querySelector('.nav-avatar-wrap');
  if (wrap && !wrap.contains(e.target)) {
    document.getElementById('navDropdown').classList.remove('open');
    document.getElementById('arrowIcon').style.transform = 'rotate(0deg)';
  }
});
window.addEventListener('scroll', function() {
  document.getElementById('dashNav').classList.toggle('scrolled', window.scrollY > 20);
});
</script>
</body>
</html>