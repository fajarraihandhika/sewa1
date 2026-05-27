<body>

<!-- ==================== NAVBAR ==================== -->
<nav class="navbar navbar-expand-lg" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="#">
      <span class="brand-dot"></span>DriveEase
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#daftar-mobil">Daftar Mobil</a></li>
        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <a href="#" class="btn-nav-login">Login</a>
        <a href="<?php echo base_url('register') ?>" class="btn-nav-daftar">Daftar</a>
      </div>
    </div>
  </div>
</nav>

<!-- ==================== HERO ==================== -->
<section class="hero">
  <div class="hero-bg-blob blob-1"></div>
  <div class="hero-bg-blob blob-2"></div>
  <div class="hero-bg-blob blob-3"></div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 hero-content">
        <div class="hero-eyebrow animate-fadeup"><i class="fas fa-circle-dot"></i> #1 Platform Rental Mobil</div>
        <h1 class="hero-title animate-fadeup delay-1">
          Sewa Mobil <span>Mudah</span><br>& Cepat
        </h1>
        <p class="hero-subtitle animate-fadeup delay-2">
          Pilihan kendaraan terbaik untuk perjalanan Anda. Armada premium, harga terjangkau, proses booking dalam hitungan menit.
        </p>
        <div class="hero-stats animate-fadeup delay-3">
          <div>
            <div class="hero-stat-num">200+</div>
            <div class="hero-stat-label">Armada Mobil</div>
          </div>
          <div style="width:1px;background:var(--clay);"></div>
          <div>
            <div class="hero-stat-num">15K+</div>
            <div class="hero-stat-label">Pelanggan Puas</div>
          </div>
          <div style="width:1px;background:var(--clay);"></div>
          <div>
            <div class="hero-stat-num">4.9★</div>
            <div class="hero-stat-label">Rating Rata-rata</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img-wrap animate-fadeup delay-4">
        <div class="hero-img-card">
          <div class="hero-badge badge-top">
            <div class="badge-icon bi-peach"><i class="fas fa-shield-halved"></i></div>
            <div>
              <div class="badge-label">Asuransi</div>
              <div class="badge-value">Full Coverage</div>
            </div>
          </div>
          <img src="<?= base_url('assets/upload/mercedes.png') ?>" 
     alt="Hero Car" 
     class="hero-main-img"/>
          <div class="hero-badge badge-bot">
            <div class="badge-icon bi-sage"><i class="fas fa-clock"></i></div>
            <div>
              <div class="badge-label">Proses</div>
              <div class="badge-value">5 Menit Booking</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==================== SEARCH BOX ==================== -->
<div class="search-section">
  <div class="container">
    <div class="search-box">
      <div class="row g-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label">Lokasi Penjemputan</label>
          <div class="input-icon">
            <i class="fas fa-map-marker-alt"></i>
            <input type="text" class="form-control" placeholder="Kota atau Bandara"/>
          </div>
        </div>
        <div class="col-md-3">
          <label class="form-label">Tanggal Sewa</label>
          <div class="input-icon">
            <i class="fas fa-calendar"></i>
            <input type="date" class="form-control"/>
          </div>
        </div>
        <div class="col-md-3">
          <label class="form-label">Tanggal Kembali</label>
          <div class="input-icon">
            <i class="fas fa-calendar-check"></i>
            <input type="date" class="form-control"/>
          </div>
        </div>
        <div class="col-md-3">
          <button class="btn-search">
            <i class="fas fa-search"></i> Cari Mobil
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ==================== DAFTAR MOBIL ==================== -->
<section id="daftar-mobil">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-5">
      <div>
        <span class="section-eyebrow">Armada Kami</span>
        <h2 class="section-title mb-0">Mobil <i style="color:var(--accent)">Populer</i></h2>
      </div>
      <a href="#" class="mt-3 mt-md-0" style="font-size:.88rem;font-weight:600;color:var(--accent);display:flex;align-items:center;gap:6px;">
        Lihat Semua <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">

    <span class="filter-label">
        <i class="fas fa-sliders me-2"></i>Filter:
    </span>
    <form method="GET" action="<?= base_url('dashboard') ?>" id="filterForm">
    <select name="type" id="filterTipe" onchange="filterCars()">

    <option value="">Pilih Type Mobil</option>
                            <?php foreach($type as $t) : ?>
                                <option value="<?php echo $t->kode_type ?>">
                                    <?php echo $t->kode_type ?></option>
                                <?php endforeach; ?>

    </select>
    <select name="status" id="filterStatus" onchange="filterCars()">

        <option value="">Semua Status</option>

        <option value="1">Tersedia</option>

        <option value="0">Tidak Tersedia</option>

    </select>
    <select name="harga" id="filterHarga" onchange="filterCars()">

    <option value="">Semua Harga</option>

    <option value="low">
        < Rp 500.000
    </option>

    <option value="mid">
        Rp 500.000 - Rp 1.000.000
    </option>

    <option value="high">
        > Rp 1.000.000
    </option>

</select>
      <button class="btn-reset-filter" onclick="resetFilter()"><i class="fas fa-rotate-left me-1"></i> Reset</button>
      <div class="active-filters" id="activeFilters"></div>
    </div>

    <!-- Cars Grid -->
    <div class="cars-grid" id="carsGrid"></div>
  </div>
</section>

<!-- ==================== WHY US ==================== -->
<section class="why-us" id="tentang">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-eyebrow">Mengapa Kami</span>
      <h2 class="section-title">Keunggulan <i style="color:var(--accent)">DriveEase</i></h2>
      <p class="section-sub mx-auto">Kami hadir dengan komitmen memberikan pengalaman sewa mobil terbaik di kelasnya.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="why-card">
          <div class="why-icon icon-peach"><i class="fas fa-tag"></i></div>
          <h4 class="why-title">Harga Terjangkau</h4>
          <p class="why-desc">Tarif transparan tanpa biaya tersembunyi. Nikmati harga terbaik dengan kualitas armada premium.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="why-card">
          <div class="why-icon icon-sage"><i class="fas fa-car"></i></div>
          <h4 class="why-title">Banyak Pilihan Mobil</h4>
          <p class="why-desc">Lebih dari 200 unit armada dari berbagai kategori: SUV, MPV, Sedan, hingga City Car.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="why-card">
          <div class="why-icon icon-sky"><i class="fas fa-bolt"></i></div>
          <h4 class="why-title">Proses Cepat</h4>
          <p class="why-desc">Booking online dalam 5 menit. Konfirmasi instan dan kendaraan siap di lokasi pilihan Anda.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="why-card">
          <div class="why-icon icon-blush"><i class="fas fa-headset"></i></div>
          <h4 class="why-title">Support 24 Jam</h4>
          <p class="why-desc">Tim kami siap membantu kapan pun Anda membutuhkan, 24 jam sehari, 7 hari seminggu.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==================== TESTIMONI ==================== -->
<section>
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-eyebrow">Testimoni</span>
      <h2 class="section-title">Kata Mereka Tentang <i style="color:var(--accent)">Kami</i></h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="testi-card">
          <div class="testi-stars">★★★★★</div>
          <p class="testi-text">"Pengalaman sewa mobil yang luar biasa! Prosesnya cepat, mobil bersih dan terawat. Pasti akan sewa lagi untuk perjalanan berikutnya."</p>
          <div class="testi-author">
            <div class="testi-avatar">A</div>
            <div>
              <div class="testi-name">Andika Pratama</div>
              <div class="testi-loc"><i class="fas fa-map-pin me-1" style="font-size:.7rem;color:var(--accent)"></i>Jakarta Selatan</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testi-card">
          <div class="testi-stars">★★★★★</div>
          <p class="testi-text">"Harganya sangat bersaing, pelayanannya ramah sekali. CS responsif dan membantu. Rekomendasikan banget buat yang mau liburan keluarga."</p>
          <div class="testi-author">
            <div class="testi-avatar" style="background:linear-gradient(135deg,var(--sage),var(--sky))">S</div>
            <div>
              <div class="testi-name">Sari Maharani</div>
              <div class="testi-loc"><i class="fas fa-map-pin me-1" style="font-size:.7rem;color:var(--accent)"></i>Surabaya</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testi-card">
          <div class="testi-stars">★★★★☆</div>
          <p class="testi-text">"Armadanya lengkap banget, pilihan banyak. Booking via website sangat mudah dan intuitif. Driver-nya juga profesional dan tepat waktu!"</p>
          <div class="testi-author">
            <div class="testi-avatar" style="background:linear-gradient(135deg,var(--lavender),var(--sky))">R</div>
            <div>
              <div class="testi-name">Rizky Firmansyah</div>
              <div class="testi-loc"><i class="fas fa-map-pin me-1" style="font-size:.7rem;color:var(--accent)"></i>Bandung</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==================== CTA ==================== -->
<section class="cta-section">
  <div class="container">
    <div class="cta-inner">
      <span class="section-eyebrow">Ayo Mulai</span>
      <h2 class="cta-title">Siap Berangkat?<br>Sewa Mobil Sekarang!</h2>
      <p class="cta-sub">Ribuan kendaraan menunggu Anda. Booking mudah, perjalanan menyenangkan.</p>
      <div class="d-flex gap-3 justify-content-center flex-wrap">
        <a href="#daftar-mobil" class="btn-cta">
          <i class="fas fa-car"></i> Pilih Mobil Sekarang
        </a>
        <a href="#" class="btn-cta-outline">
          <i class="fas fa-phone"></i> Hubungi Kami
        </a>
      </div>
    </div>
  </div>
</section>