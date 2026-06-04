<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg-premium"></div>
      
      <nav class="navbar navbar-expand-lg main-navbar-premium">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg toggle-btn-premium"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element search-premium">
            <input class="form-control" type="search" placeholder="Cari data sewa mobil..." aria-label="Search" data-width="280">
            <button class="btn btn-search-premium" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">Histories</div>
              <div class="search-item">
                <a href="#">DriveEase.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
            </div>
          </div>
        </form>
        
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep icon-premium"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right shadow-premium">
              <div class="dropdown-header">Messages
                <div class="float-right"><a href="#">Mark All As Read</a></div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
              </div>
            </div>
          </li>
          
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep icon-premium"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right shadow-premium">
              <div class="dropdown-header">Notifications
                <div class="float-right"><a href="#">Mark All As Read</a></div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white"><i class="fas fa-code"></i></div>
                  <div class="dropdown-item-desc">Template update is available now!<div class="time text-primary">2 Min Ago</div></div>
                </a>
              </div>
            </div>
          </li>
          
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user profile-premium">
              <img alt="image" src="<?= base_url('assets/assets_admin/assets/img/avatar/avatar-1.png') ?>" class="rounded-circle mr-2 profile-img-shadow">
              <div class="d-sm-none d-lg-inline-block user-name-premium">Hi, Fajar Raihandhika</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-premium">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="#" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
              <a href="#" class="dropdown-item has-icon"><i class="fas fa-cog"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </li>
        </ul>
      </nav>
      
      <div class="main-sidebar sidebar-style-2 sidebar-premium">
        <aside id="sidebar-wrapper">
          
          <div class="sidebar-brand brand-premium">
            <a href="<?= base_url('admin/dashboard') ?>">
              <i class="fas fa-car-side mr-2 logo-icon-anim"></i>DriveEase
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm brand-sm-premium">
            <a href="<?= base_url('admin/dashboard') ?>">DE</a>
          </div>
          
          <ul class="sidebar-menu menu-list-premium">
            
            <li class="menu-header-premium"><span>Main Menu</span></li>
            <li class="<?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
              </a>
            </li>
            
            <li class="menu-header-premium"><span>Master Data</span></li>
            <li class="<?= (strpos(uri_string(), 'data_mobil') !== false) ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url('admin/data_mobil') ?>">
                <i class="fas fa-car"></i> <span>Data Mobil</span>
              </a>
            </li>
            <li class="<?= (strpos(uri_string(), 'data_supir') !== false) ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url('admin/data_supir') ?>">
                <i class="fas fa-user-tie"></i> <span>Data Sopir</span>
              </a>
            </li>
            <li class="<?= (strpos(uri_string(), 'Customer') !== false) ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url('admin/Customer') ?>">
                <i class="fas fa-users"></i> <span>Data Pelanggan</span>
              </a>
            </li>
            
            <li class="menu-header-premium"><span>Reports & Trans</span></li>
            <li class="<?= (strpos(uri_string(), 'transaksi') !== false) ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url('admin/transaksi') ?>">
                <i class="fas fa-exchange-alt"></i> <span>Kelola Transaksi</span>
              </a>
            </li>
            <li class="<?= (strpos(uri_string(), 'laporan') !== false) ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url('admin/laporan/pendapatan') ?>">
                <i class="fas fa-file-invoice-dollar"></i> <span>Laporan Pendapatan</span>
              </a>
            </li>

          </ul>     
        </aside>
      </div>

      <!-- Konten view di-inject di sini oleh masing-masing view -->

      <style>
/* ── NAVBAR PREMIUM SYSTEM ── */
.navbar-bg-premium {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 125px;
    background: #1a2236;
    z-index: -1;
}
.main-navbar-premium { background-color: transparent !important; padding-top: 15px; }
.toggle-btn-premium { color: #ffffff !important; }

.search-premium input.form-control {
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.15) !important;
    border-radius: 30px !important;
    color: #fff !important;
    padding-left: 20px !important;
    transition: all 0.3s ease;
}
.search-premium input.form-control::placeholder { color: rgba(255,255,255,0.5); }
.search-premium input.form-control:focus {
    background: rgba(255,255,255,0.15) !important;
    border-color: rgba(255,255,255,0.4) !important;
    box-shadow: none !important;
}
.btn-search-premium { background: transparent !important; color: rgba(255,255,255,0.6) !important; }

.icon-premium {
    background: rgba(255,255,255,0.07);
    border-radius: 50%; width: 42px; height: 42px;
    display: flex; align-items: center; justify-content: center;
    margin-right: 8px; transition: all 0.3s; color: #fff !important;
}
.icon-premium:hover { background: rgba(255,255,255,0.18) !important; }
.icon-premium i { color: #fff !important; }

.profile-premium {
    padding: 5px 15px !important;
    background: rgba(255,255,255,0.08);
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.12);
}
.profile-img-shadow { border: 2px solid rgba(255,255,255,0.3); }
.user-name-premium { font-weight: 600; color: #fff !important; }


/* ── SIDEBAR PREMIUM COUTURE (DARK NAVY THEME) ── */
.sidebar-premium {
    background: #1a2236 !important;
    box-shadow: 6px 0 25px rgba(0,0,0,0.25) !important;
    border-right: none !important;
    transition: all 0.3s ease-in-out;
}

/* Header Brand / Logo */
.brand-premium, .brand-sm-premium {
    background: #141a29 !important;
    border-bottom: 1px solid rgba(255,255,255,0.04) !important;
    padding: 20px !important;
    height: 70px !important;
    display: flex;
    align-items: center;
    justify-content: center;
}
.brand-premium a, .brand-sm-premium a {
    font-size: 19px !important; 
    font-weight: 800 !important;
    letter-spacing: 1.5px !important;
    color: #ffffff !important; 
    text-transform: uppercase;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
.logo-icon-anim {
    color: #4c6fff;
    transition: transform 0.3s ease;
}
.brand-premium:hover .logo-icon-anim {
    transform: translateX(3px);
}

/* Pembatas Kategori Menu (Header) */
.menu-header-premium {
    color: rgba(255,255,255,0.25) !important;
    font-weight: 700 !important; 
    text-transform: uppercase;
    font-size: 10px !important; 
    letter-spacing: 1.5px !important;
    padding: 24px 20px 8px 25px !important;
    opacity: 0.8;
}

/* List Item Menu Styling */
.menu-list-premium li {
    position: relative;
    margin-bottom: 3px;
}
.menu-list-premium li a {
    color: rgba(255,255,255,0.65) !important;
    font-weight: 500 !important; 
    font-size: 13.5px !important;
    margin: 2px 14px !important;
    padding: 0 18px !important;
    height: 46px !important;
    line-height: 46px !important;
    border-radius: 8px !important; 
    display: flex !important;
    align-items: center;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* Penataan Icon Di Dalam Menu */
.menu-list-premium li a i { 
    color: rgba(255,255,255,0.4) !important; 
    font-size: 15px !important;
    width: 24px !important;
    margin-right: 12px !important;
    transition: all 0.25s ease !important;
}

/* Efek State Hover (Mengambang Premium) */
.menu-list-premium li a:hover {
    background: rgba(255,255,255,0.06) !important;
    color: #ffffff !important;
    padding-left: 22px !important;
}
.menu-list-premium li a:hover i {
    color: #ffffff !important;
    transform: scale(1.1);
}

/* Efek State Active (Menu Yang Sedang Dibuka) */
.menu-list-premium li.active a {
    background: rgba(255,255,255,0.12) !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}
.menu-list-premium li.active a i { 
    color: #ffffff !important; 
}

/* Garis Indikator Vertikal Khusus Item Aktif */
.menu-list-premium li.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    height: 28px;
    width: 4px;
    background: #ffffff;
    border-radius: 0 4px 4px 0;
    z-index: 5;
}

.shadow-premium {
    border: none !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12) !important;
    border-radius: 12px !important;
}


/* ── DASHBOARD BLOCKS & CARDS ── */
.db * { box-sizing: border-box; }
.db { padding: 0.5rem 0 1.5rem; }

.db-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px; margin-bottom: 14px;
}
.db-stat {
    background: #fff; border: 1px solid rgba(0,0,0,0.07);
    border-radius: 12px; padding: 1.1rem 1.2rem;
    display: flex; align-items: center; gap: 14px;
    position: relative; overflow: hidden;
}
.db-stat::before {
    content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%;
}
.db-stat.s-blue::before  { background: #378ADD; }
.db-stat.s-green::before { background: #1D9E75; }
.db-stat.s-amber::before { background: #e6a817; }
.db-stat.s-red::before   { background: #E24B4A; }
.db-stat-icon {
    width: 44px; height: 44px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.db-stat-icon.s-blue  { background: #E6F1FB; color: #185FA5; }
.db-stat-icon.s-green { background: #E1F5EE; color: #0F6E56; }
.db-stat-icon.s-amber { background: #FEF3C7; color: #92400E; }
.db-stat-icon.s-red   { background: #FCEBEB; color: #A32D2D; }
.db-stat-label { font-size: 11px; color: #94a3b8; display: block; margin-bottom: 3px; }
.db-stat-value { font-size: 26px; font-weight: 700; color: #1e293b; line-height: 1; }

.db-summary {
    background: #fff; border: 1px solid rgba(0,0,0,0.07);
    border-radius: 12px; padding: 1.1rem 1.4rem; margin-bottom: 14px;
}
.db-summary-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
.db-summary-head h4 { font-size: 13px; font-weight: 600; color: #1e293b; margin: 0; }
.db-live-pill {
    font-size: 11px; font-weight: 600; background: #E1F5EE; color: #0F6E56;
    padding: 3px 10px; border-radius: 99px;
    display: inline-flex; align-items: center; gap: 5px;
}
.db-live-dot { width: 6px; height: 6px; background: #1D9E75; border-radius: 50%; display: inline-block; }
.db-summary-grid {
    display: grid; grid-template-columns: repeat(4, minmax(0, 1fr));
    border: 1px solid rgba(0,0,0,0.07); border-radius: 10px;
    overflow: hidden; margin-bottom: 12px;
}
.db-sitem { padding: 0.85rem 1rem; text-align: center; border-right: 1px solid rgba(0,0,0,0.07); }
.db-sitem:last-child { border-right: none; }
.db-snum { font-size: 22px; font-weight: 700; line-height: 1; display: block; margin-bottom: 4px; }
.db-snum.c-blue  { color: #185FA5; }
.db-snum.c-green { color: #0F6E56; }
.db-snum.c-amber { color: #92400E; }
.db-snum.c-red   { color: #A32D2D; }
.db-ssub { font-size: 11px; color: #94a3b8; }
.db-hr { height: 1px; background: rgba(0,0,0,0.06); margin-bottom: 10px; }
.db-desc { font-size: 12px; color: #64748b; line-height: 1.6; margin: 0; }

.db-tables { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
.db-card {
    background: #fff; border: 1px solid rgba(0,0,0,0.07);
    border-radius: 12px; overflow: hidden;
}
.db-card-head {
    padding: 0.85rem 1.2rem; border-bottom: 1px solid rgba(0,0,0,0.06);
    display: flex; align-items: center; gap: 8px;
}
.db-card-head i { font-size: 14px; color: #94a3b8; }
.db-card-head span { font-size: 13px; font-weight: 600; color: #1e293b; }
.db-tbl { width: 100%; border-collapse: collapse; font-size: 12px; table-layout: fixed; }
.db-tbl thead tr { background: #f8fafc; }
.db-tbl th {
    padding: 0.55rem 0.9rem; text-align: left;
    font-size: 10px; font-weight: 700; color: #94a3b8;
    letter-spacing: 0.5px; text-transform: uppercase;
    border-bottom: 1px solid rgba(0,0,0,0.06);
}
.db-tbl td {
    padding: 0.65rem 0.9rem; color: #334155;
    border-top: 1px solid rgba(0,0,0,0.05);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    vertical-align: middle;
}
.db-tbl tbody tr:hover { background: #f8fafc; }
.db-plate {
    font-family: 'Courier New', monospace; font-size: 11px; font-weight: 700;
    background: #f1f5f9; border: 1px solid #e2e8f0;
    padding: 2px 7px; border-radius: 4px; color: #334155; display: inline-block;
}
.db-name { font-weight: 600; font-size: 12px; color: #1e293b; }
.db-muted { font-size: 11px; color: #94a3b8; margin-top: 1px; }
.db-badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 10px; font-weight: 700;
    padding: 3px 9px; border-radius: 99px;
}
.db-badge i { font-size: 9px; }
.db-badge.ok   { background: #E1F5EE; color: #0F6E56; }
.db-badge.no   { background: #FCEBEB; color: #A32D2D; }
.db-badge.run  { background: #FEF3C7; color: #92400E; }
.db-badge.done { background: #E1F5EE; color: #0F6E56; }
.db-badge.other { background: #f1f5f9; color: #64748b; }
.db-empty { text-align: center !important; color: #94a3b8 !important; font-style: italic; padding: 2rem 1rem !important; }


/* ==================== FIX STISLA SIDEBAR MINI STATE ==================== */

/* Mengunci latar belakang pembungkus logo mini tetap gelap uniform */
body.sidebar-mini .main-sidebar .sidebar-brand-sm {
    background: #141a29 !important;
    padding: 0 !important;
    height: 70px !important;
    display: flex !important;
    align-items: center;
    justify-content: center;
}

/* Modifikasi singkatan text DE di pojok atas */
body.sidebar-mini .main-sidebar .sidebar-brand-sm a {
    color: #ffffff !important;
    font-weight: 800 !important;
    letter-spacing: 0px !important;
}

/* Penyesuaian blok link agar berada tepat di tengah grid 65px */
body.sidebar-mini .main-sidebar .sidebar-menu li a {
    margin: 4px 5px !important;
    padding: 0 !important;
    display: flex !important;
    align-items: center;
    justify-content: center;
    height: 45px !important;
    border-radius: 8px !important;
}

/* Menetralkan margin horizontal bawaan agar icon center lurus */
body.sidebar-mini .main-sidebar .sidebar-menu li a i {
    margin-right: 0 !important;
    font-size: 16px !important;
    width: auto !important;
}

/* Sembunyikan garis indikator samping dan teks kategori header */
body.sidebar-mini .menu-list-premium li.active::before {
    display: none !important;
}

/* Reset micro-interaction hover agar tidak terjadi distorsi geser ke kanan */
body.sidebar-mini .main-sidebar .sidebar-menu li a:hover {
    padding-left: 0 !important;
    background: rgba(255, 255, 255, 0.08) !important;
}

/* Proteksi penuh agar teks span tidak meluber keluar kotak saat di-hover */
body.sidebar-mini .main-sidebar .sidebar-menu li a span,
body.sidebar-mini .main-sidebar .sidebar-menu li.menu-header-premium {
    display: none !important;
}
</style>