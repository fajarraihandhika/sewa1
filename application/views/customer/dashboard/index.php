<style>
  /* ===================== NEW DESIGN SYSTEM (PERTEGAS TEMA ASLI) ===================== */
  :root {
    /* Warna Dasar Asli Kamu (Warm & Earthy) */
    --sand: #F5EFE6;            /* Krem terang */
    --clay: #E8DFD1;            /* Krem medium untuk border/header */
    --accent: #D4866A;          /* Oranye Clay khas kamu */
    --accent2: #7AA88C;         /* Hijau pastel khas kamu */
    --blush: #EADBC8;
    --white: #ffffff;

    /* REKAYASA KONTRAST (Kunci Biar Tegas): */
    --bg-main: #FAF8F5;         /* Dibuat sedikit lebih terang dari --sand agar card putih bisa "pop out" */
    --text-dark: #2F241C;       /* Cokelat espresso gelap (Mengganti hitam pudar agar teks super tajam & tegas) */
    --text-mid: #4A3E35;        /* Cokelat medium untuk sub-judul */
    --text-soft: #706256;       /* Cokelat pudar untuk label kecil */
    
    /* Border & Shadow yang Ditegaskan */
    --border-bold: 1.5px solid #D6C9B6; /* Border antar-card dipertebal dan digelapkan */
    --shadow-solid: 0 4px 12px rgba(74, 62, 53, 0.08); /* Shadow dengan tint cokelat tipis */
    --shadow-hover: 0 12px 28px rgba(74, 62, 53, 0.15);
    
    /* Radius */
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
  }

  /* ===================== DASHBOARD LAYOUT ===================== */
  body { background-color: var(--bg-main); color: var(--text-dark); }
  .dash-wrap { padding: 40px 0 60px; background-color: var(--bg-main); }

  /* Greeting Banner (Tetap Krem-Cokelat tapi Dipertegas) */
  .dash-greeting {
    background: linear-gradient(135deg, #EADBC8 0%, #D4BCA3 100%); /* Gradasi ditajamkan sedikit */
    border-radius: var(--radius-xl);
    padding: 32px 36px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    border: 2px solid #C4B29D; /* Border dipertegas */
    box-shadow: var(--shadow-solid);
  }
  .dash-greeting::after {
    content: '';
    position: absolute;
    right: -40px; top: -40px;
    width: 200px; height: 200px;
    background: var(--accent);
    border-radius: 50%;
    opacity: 0.25; /* Dibuat sedikit lebih tegas */
    filter: blur(40px);
  }
  .dash-greeting-title {
    font-family: var(--font-display), sans-serif;
    font-size: 1.8rem; font-weight: 800; /* Tebal maksimal */
    color: var(--text-dark);
    margin-bottom: 6px;
  }
  .dash-greeting-sub {
    font-size: 0.95rem;
    color: var(--text-mid);
    font-weight: 500;
  }
  
  /* Status Badges di Banner (Warna teks digelapkan agar terbaca jelas) */
  .badge-status-profil {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.8rem; font-weight: 700;
    padding: 6px 14px;
    border-radius: 50px;
    margin-top: 14px;
    border: 1px solid currentColor;
  }
  .badge-verified   { background: rgba(122,200,140,0.25); color: #225C32; }
  .badge-unverified { background: rgba(212,134,106,0.2); color: #8C4327; }
  .badge-incomplete { background: rgba(180,160,80,0.2); color: #5C4A15; }

  /* Stat Cards (Dibuat Kokoh & Berkarakter) */
  .stat-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 36px; }
  .stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 24px;
    border: var(--border-bold); /* Menggunakan border baru yang lebih gelap */
    box-shadow: var(--shadow-solid);
    display: flex;
    align-items: center;
    gap: 18px;
    transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
  }
  .stat-card:hover { 
    transform: translateY(-4px); 
    box-shadow: var(--shadow-hover);
    border-color: var(--accent); /* Highlight oranye saat hover */
  }
  .stat-icon {
    width: 52px; height: 52px;
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
  }
  /* Icon warna aslimu, tapi soliditasnya dinaikkan */
  .icon-total   { background: rgba(74, 127, 160, 0.15); color: #2E5875; }
  .icon-aktif   { background: rgba(58, 138, 80, 0.15); color: #225C32; }
  .icon-selesai { background: rgba(122, 168, 140, 0.2);  color: #386149; }
  .icon-pending { background: rgba(212, 134, 106, 0.2);  color: #8C4327; }
  
  .stat-num {
    font-family: var(--font-display), sans-serif;
    font-size: 2.1rem; font-weight: 800;
    color: var(--text-dark);
    line-height: 1;
  }
  .stat-label { font-size: 0.85rem; font-weight: 600; color: var(--text-soft); margin-top: 4px; }

  /* Section Title */
  .dash-section-title {
    font-family: var(--font-display), sans-serif;
    font-size: 1.25rem; font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 18px;
    display: flex; align-items: center; gap: 10px;
  }
  .dash-section-title i { font-size: 1.1rem; color: var(--accent); }

  /* Riwayat Table (Garis Pemisah Diperjelas) */
  .riwayat-wrap {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: var(--border-bold);
    box-shadow: var(--shadow-solid);
    overflow: hidden;
    margin-bottom: 32px;
  }
  .riwayat-header {
    padding: 20px 24px;
    border-bottom: 2px solid var(--clay);
    display: flex; align-items: center; justify-content: space-between;
    background: #FAF8F5;
  }
  .riwayat-table { width: 100%; border-collapse: collapse; }
  .riwayat-table th {
    padding: 14px 20px;
    font-size: 0.8rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.06em;
    color: var(--text-dark); /* Mengganti text-soft agar th kebaca tegas */
    background: var(--sand);
    text-align: left;
    border-bottom: 2px solid var(--clay);
  }
  .riwayat-table td {
    padding: 16px 20px;
    font-size: 0.9rem;
    color: var(--text-mid);
    border-bottom: 1px solid var(--clay);
    vertical-align: middle;
  }
  .riwayat-table tr:last-child td { border-bottom: none; }
  .riwayat-table tr:hover td { background: rgba(232, 223, 209, 0.25); }

  .mobil-thumb {
    width: 52px; height: 38px;
    object-fit: contain;
    background: var(--clay);
    border-radius: var(--radius-sm);
    padding: 3px;
    border: 1px solid rgba(0,0,0,0.05);
  }
  .mobil-info-name { font-weight: 700; color: var(--text-dark); font-size: 0.9rem; }
  .mobil-info-plat { font-size: 0.75rem; color: var(--text-soft); font-weight: 500; }

  /* Status Badge di Tabel (Lebih Tegas) */
  .status-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 0.75rem; font-weight: 700;
    padding: 5px 12px; border-radius: 50px;
    border: 1px solid currentColor;
  }
  .status-badge::before { content: '●'; font-size: 0.5rem; }
  .s-pending  { background: rgba(250,213,181,0.4); color: #8A4308; }
  .s-aktif    { background: rgba(122,200,140,0.3); color: #1E522C; }
  .s-selesai  { background: rgba(184,212,232,0.4); color: #234E69; }
  .s-ditolak  { background: rgba(220,100,100,0.25); color: #8F2424; }

  /* Alert profil */
  .alert-profil {
    background: #FFF5EE;
    border: 2px solid #E6C5B3;
    border-left: 5px solid var(--accent); /* Garis tegas di samping */
    border-radius: var(--radius-lg);
    padding: 18px 22px;
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 32px;
    box-shadow: var(--shadow-solid);
  }
  .alert-profil i { font-size: 1.4rem; color: var(--accent); flex-shrink: 0; }
  .alert-profil-text { font-size: 0.9rem; color: var(--text-mid); }
  .alert-profil-text strong { color: var(--text-dark); font-weight: 700; }
  
  .btn-lengkapi {
    background: var(--accent); color: var(--white);
    border: none; border-radius: 50px;
    padding: 10px 24px; font-size: 0.85rem; font-weight: 700;
    white-space: nowrap; cursor: pointer;
    transition: all 0.2s; text-decoration: none;
    display: inline-block; margin-left: auto; flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(212,134,106,0.3);
  }
  .btn-lengkapi:hover { background: #B86C52; transform: translateY(-1px); }

  /* Link lihat semua */
  .link-semua {
    font-size: 0.85rem; font-weight: 700;
    color: var(--accent);
    display: flex; align-items: center; gap: 5px;
    text-decoration: none;
  }
  .link-semua:hover { gap: 8px; }

  /* Quick actions */
  .quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; margin-bottom: 36px; }
  .quick-btn {
    background: var(--white);
    border: var(--border-bold);
    border-radius: var(--radius-lg);
    padding: 24px 18px;
    text-align: center;
    color: var(--text-dark); /* Mengganti text-mid biar mantap dibaca */
    font-size: 0.9rem; font-weight: 700;
    transition: all 0.25s;
    cursor: pointer;
    text-decoration: none;
    display: flex; flex-direction: column; align-items: center; gap: 12px;
    box-shadow: var(--shadow-solid);
  }
  .quick-btn:hover { 
    transform: translateY(-4px); 
    color: var(--accent); 
    border-color: var(--accent); 
    box-shadow: var(--shadow-hover); 
  }
  .quick-btn .q-icon { width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
</style>

<div class="dash-wrap">
  <div class="container">

    <!-- Greeting -->
    <div class="dash-greeting">
      <div class="position-relative" style="z-index:1;">
        <div class="dash-greeting-title">
          Halo, <?= explode(' ', $this->session->userdata('nama_lengkap'))[0] ?>! 
        </div>
        <div class="dash-greeting-sub">
          Selamat datang di dashboard DriveEase kamu.
          <?php if ($is_pelanggan_lama): ?>
            Kamu adalah <strong>pelanggan setia</strong> kami — terima kasih!
          <?php else: ?>
            Kamu sudah melakukan <strong><?= $total_sewa ?> kali</strong> penyewaan.
          <?php endif; ?>
        </div>
        
        <?php if ($is_pelanggan_lama): ?>
          <span class="badge-status-profil badge-verified" style="margin-left:0; margin-top:14px;">
            ⭐ Pelanggan Setia
          </span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Stat Cards -->
    <div class="stat-cards">
      <div class="stat-card">
        <div class="stat-icon icon-total"><i class="fas fa-car"></i></div>
        <div>
          <div class="stat-num"><?= $total_sewa ?></div>
          <div class="stat-label">Total Sewa</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon icon-aktif"><i class="fas fa-key"></i></div>
        <div>
          <div class="stat-num"><?= $sewa_aktif ?></div>
          <div class="stat-label">Sedang Aktif</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon icon-selesai"><i class="fas fa-circle-check"></i></div>
        <div>
          <div class="stat-num"><?= $sewa_selesai ?></div>
          <div class="stat-label">Selesai</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon icon-pending"><i class="fas fa-hourglass-half"></i></div>
        <div>
          <div class="stat-num"><?= $sewa_pending ?></div>
          <div class="stat-label">Menunggu</div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="dash-section-title"><i class="fas fa-bolt"></i> Aksi Cepat</div>
    <div class="quick-actions">
      <a href="<?= base_url('customer/mobil/index') ?>" class="quick-btn">
        <div class="q-icon" style="background:rgba(212,134,106,0.12); color:var(--accent);">
          <i class="fas fa-car"></i>
        </div>
        Pesan Mobil
      </a>

      <a href="<?= base_url('customer/transaksi/index') ?>" class="quick-btn">
        <div class="q-icon" style="background:rgba(122,158,142,0.12); color:var(--accent2);">
          <i class="fas fa-list-check"></i>
        </div>
        Riwayat Sewa
      </a>

      <a href="<?= base_url('customer/profil/index') ?>" class="quick-btn">
        <div class="q-icon" style="background:rgba(184,212,232,0.25); color:#4A7FA0;">
          <i class="fas fa-user-circle"></i>
        </div>
        Profil Saya
      </a>

      <a href="<?= base_url('/') ?>" class="quick-btn">
        <div class="q-icon" style="background:rgba(217,211,238,0.3); color:#6A5FA0;">
          <i class="fas fa-house"></i>
        </div>
        Landing Page
      </a>
    </div>

    <!-- Riwayat Terbaru -->
    <div class="riwayat-wrap">
      <div class="riwayat-header">
        <div class="dash-section-title mb-0"><i class="fas fa-clock-rotate-left"></i> Riwayat Terbaru</div>
        <a href="<?= base_url('customer/transaksi') ?>" class="link-semua">
          Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <?php if (empty($riwayat)): ?>
        <div class="empty-state" style="padding: 40px; text-align: center; color: var(--text-soft);">
          <i class="fas fa-car-burst" style="font-size: 2rem; margin-bottom: 10px;"></i>
          <p>Belum ada riwayat penyewaan.</p>
        </div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="riwayat-table">
            <thead>
              <tr>
                <th>Mobil</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($riwayat as $r): ?>
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <img src="<?= base_url('assets/upload/'.$r->gambar) ?>" alt="<?= $r->merk ?>" class="mobil-thumb"/>
                    <div>
                      <div class="mobil-info-name"><?= $r->merk ?></div>
                      <div class="mobil-info-plat"><?= $r->kode_type ?></div>
                    </div>
                  </div>
                </td>
                <td><?= date('d M Y', strtotime($r->tanggal_rental)) ?></td>
                <td><?= date('d M Y', strtotime($r->tanggal_kembali)) ?></td>
                <td>
                  <?php
                    $status_map = [
                      'pending' => ['label' => 'Pending',  'class' => 's-pending'],
                      'aktif'   => ['label' => 'Aktif',    'class' => 's-aktif'],
                      'selesai' => ['label' => 'Selesai',  'class' => 's-selesai'],
                      'ditolak' => ['label' => 'Ditolak',  'class' => 's-ditolak'],
                    ];
                    $s = $status_map[$r->status_rental] ?? ['label' => '-', 'class' => ''];
                  ?>
                  <span class="status-badge <?= $s['class'] ?>"><?= $s['label'] ?></span>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>