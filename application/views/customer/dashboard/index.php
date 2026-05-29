<style>
  /* ===================== DASHBOARD LAYOUT ===================== */
  .dash-wrap { padding: 40px 0 60px; }

  /* Greeting */
  .dash-greeting {
    background: linear-gradient(135deg, var(--sand) 0%, var(--clay) 100%);
    border-radius: var(--radius-xl);
    padding: 32px 36px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    border: 1.5px solid rgba(200,180,160,0.2);
  }
  .dash-greeting::after {
    content: '';
    position: absolute;
    right: -40px; top: -40px;
    width: 200px; height: 200px;
    background: var(--blush);
    border-radius: 50%;
    opacity: 0.4;
    filter: blur(40px);
  }
  .dash-greeting-title {
    font-family: var(--font-display);
    font-size: 1.7rem; font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
  }
  .dash-greeting-sub {
    font-size: 0.9rem;
    color: var(--text-mid);
  }
  .badge-status-profil {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.78rem; font-weight: 600;
    padding: 5px 14px;
    border-radius: 50px;
    margin-top: 14px;
  }
  .badge-verified   { background: rgba(122,200,140,0.18); color: #3A8A50; }
  .badge-unverified { background: rgba(212,134,106,0.15); color: var(--accent); }
  .badge-incomplete { background: rgba(180,160,80,0.15); color: #8A7020; }

  /* Stat Cards */
  .stat-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 36px; }
  .stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 24px;
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card);
    display: flex;
    align-items: center;
    gap: 18px;
    transition: transform 0.25s, box-shadow 0.25s;
  }
  .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 36px rgba(100,80,60,0.14); }
  .stat-icon {
    width: 52px; height: 52px;
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
  }
  .icon-total   { background: rgba(184,212,232,0.35); color: #4A7FA0; }
  .icon-aktif   { background: rgba(122,200,140,0.25); color: #3A8A50; }
  .icon-selesai { background: rgba(200,216,195,0.4);  color: var(--accent2); }
  .icon-pending { background: rgba(250,213,181,0.4);  color: var(--accent); }
  .stat-num {
    font-family: var(--font-display);
    font-size: 1.9rem; font-weight: 700;
    color: var(--text-dark);
    line-height: 1;
  }
  .stat-label { font-size: 0.8rem; color: var(--text-soft); margin-top: 3px; }

  /* Section Title */
  .dash-section-title {
    font-family: var(--font-display);
    font-size: 1.2rem; font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 18px;
    display: flex; align-items: center; gap: 10px;
  }
  .dash-section-title i { font-size: 1rem; color: var(--accent); }

  /* Riwayat Table */
  .riwayat-wrap {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    margin-bottom: 32px;
  }
  .riwayat-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--clay);
    display: flex; align-items: center; justify-content: space-between;
  }
  .riwayat-table { width: 100%; border-collapse: collapse; }
  .riwayat-table th {
    padding: 12px 20px;
    font-size: 0.75rem; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.06em;
    color: var(--text-soft);
    background: var(--sand);
    text-align: left;
  }
  .riwayat-table td {
    padding: 16px 20px;
    font-size: 0.88rem;
    color: var(--text-mid);
    border-bottom: 1px solid rgba(200,180,160,0.12);
    vertical-align: middle;
  }
  .riwayat-table tr:last-child td { border-bottom: none; }
  .riwayat-table tr:hover td { background: rgba(245,239,230,0.5); }

  .mobil-thumb {
    width: 52px; height: 38px;
    object-fit: contain;
    background: var(--sand);
    border-radius: var(--radius-sm);
    padding: 3px;
  }
  .mobil-info-name { font-weight: 600; color: var(--text-dark); font-size: 0.88rem; }
  .mobil-info-plat { font-size: 0.75rem; color: var(--text-soft); }

  /* Status Badge */
  .status-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 0.73rem; font-weight: 600;
    padding: 4px 12px; border-radius: 50px;
  }
  .status-badge::before { content: '●'; font-size: 0.6rem; }
  .s-pending  { background: rgba(250,213,181,0.3); color: #B06020; }
  .s-aktif    { background: rgba(122,200,140,0.2); color: #3A8A50; }
  .s-selesai  { background: rgba(184,212,232,0.3); color: #4A7FA0; }
  .s-ditolak  { background: rgba(220,100,100,0.15); color: #C05050; }

  /* Empty state */
  .empty-state {
    padding: 48px 24px;
    text-align: center;
    color: var(--text-soft);
  }
  .empty-state i { font-size: 2.5rem; color: var(--clay); margin-bottom: 12px; display: block; }
  .empty-state p { font-size: 0.9rem; margin-bottom: 16px; }

  /* Alert profil */
  .alert-profil {
    background: rgba(250,213,181,0.25);
    border: 1.5px solid rgba(212,134,106,0.25);
    border-radius: var(--radius-lg);
    padding: 18px 22px;
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 32px;
  }
  .alert-profil i { font-size: 1.3rem; color: var(--accent); flex-shrink: 0; }
  .alert-profil-text { font-size: 0.88rem; color: var(--text-mid); }
  .alert-profil-text strong { color: var(--text-dark); }
  .btn-lengkapi {
    background: var(--accent); color: var(--white);
    border: none; border-radius: 50px;
    padding: 9px 22px; font-size: 0.82rem; font-weight: 600;
    white-space: nowrap; cursor: pointer;
    transition: all 0.2s; text-decoration: none;
    display: inline-block; margin-left: auto; flex-shrink: 0;
  }
  .btn-lengkapi:hover { background: #C07358; color: var(--white); }

  /* Link lihat semua */
  .link-semua {
    font-size: 0.82rem; font-weight: 600;
    color: var(--accent);
    display: flex; align-items: center; gap: 5px;
    transition: gap 0.2s;
  }
  .link-semua:hover { gap: 8px; }

  /* Quick actions */
  .quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; margin-bottom: 36px; }
  .quick-btn {
    background: var(--white);
    border: 1.5px solid rgba(200,180,160,0.2);
    border-radius: var(--radius-lg);
    padding: 22px 18px;
    text-align: center;
    color: var(--text-mid);
    font-size: 0.85rem; font-weight: 500;
    transition: all 0.25s;
    cursor: pointer;
    text-decoration: none;
    display: flex; flex-direction: column; align-items: center; gap: 10px;
    box-shadow: var(--shadow-card);
  }
  .quick-btn i { font-size: 1.5rem; }
  .quick-btn:hover { transform: translateY(-4px); color: var(--accent); border-color: rgba(212,134,106,0.3); box-shadow: 0 12px 32px rgba(100,80,60,0.14); }
  .quick-btn .q-icon { width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
</style>

<div class="dash-wrap">
  <div class="container">

    <!-- Alert Profil Belum Lengkap -->
    <?php
      $profil_lengkap = !empty($customer) && !empty($customer->id_number) && !empty($customer->nomor_sim);
      $is_verified    = !empty($customer) && $customer->is_verified == 1;
    ?>
    <?php if (empty($customer) || !$profil_lengkap): ?>
    <div class="alert-profil">
      <i class="fas fa-circle-exclamation"></i>
      <div class="alert-profil-text">
        <strong>Lengkapi data profil kamu terlebih dahulu.</strong><br>
        Identitas (KTP & SIM) diperlukan sebelum bisa melakukan pemesanan mobil.
      </div>
      <a href="<?= base_url('customer/profil') ?>" class="btn-lengkapi">
        Lengkapi Sekarang
      </a>
    </div>
    <?php elseif ($profil_lengkap && !$is_verified): ?>
    <div class="alert-profil" style="background:rgba(184,212,232,0.2); border-color:rgba(74,127,160,0.25);">
      <i class="fas fa-clock" style="color:#4A7FA0;"></i>
      <div class="alert-profil-text">
        <strong>Profil kamu sedang diverifikasi admin.</strong><br>
        Kamu akan bisa memesan setelah identitas disetujui. Biasanya 1×24 jam.
      </div>
    </div>
    <?php endif; ?>

    <!-- Greeting -->
    <div class="dash-greeting">
      <div class="position-relative" style="z-index:1;">
        <div class="dash-greeting-title">
          Halo, <?= explode(' ', $this->session->userdata('nama_lengkap'))[0] ?>! 👋
        </div>
        <div class="dash-greeting-sub">
          Selamat datang di dashboard DriveEase kamu.
          <?php if ($is_pelanggan_lama): ?>
            Kamu adalah <strong>pelanggan setia</strong> kami — terima kasih!
          <?php else: ?>
            Kamu sudah melakukan <strong><?= $total_sewa ?> kali</strong> penyewaan.
          <?php endif; ?>
        </div>
        <div>
          <?php if ($is_verified): ?>
            <span class="badge-status-profil badge-verified">
              <i class="fas fa-circle-check" style="font-size:.7rem;"></i> Terverifikasi
            </span>
          <?php elseif ($profil_lengkap): ?>
            <span class="badge-status-profil badge-unverified">
              <i class="fas fa-clock" style="font-size:.7rem;"></i> Menunggu Verifikasi
            </span>
          <?php else: ?>
            <span class="badge-status-profil badge-incomplete">
              <i class="fas fa-triangle-exclamation" style="font-size:.7rem;"></i> Profil Belum Lengkap
            </span>
          <?php endif; ?>
          <?php if ($is_pelanggan_lama): ?>
            <span class="badge-status-profil badge-verified" style="margin-left:6px;">
              ⭐ Pelanggan Setia
            </span>
          <?php endif; ?>
        </div>
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
      <a href="<?= base_url('customer/mobil') ?>"
         class="quick-btn <?= (!$is_verified) ? 'disabled' : '' ?>"
         <?= (!$is_verified) ? 'style="opacity:.5;pointer-events:none;" title="Profil belum terverifikasi"' : '' ?>>
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
        Ke Landing Page
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
        <div class="empty-state">
          <i class="fas fa-car-burst"></i>
          <p>Belum ada riwayat penyewaan.</p>
          <?php if ($is_verified): ?>
            <a href="<?= base_url('customer/mobil') ?>" class="btn-lengkapi">Pesan Sekarang</a>
          <?php endif; ?>
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
                    <img src="<?= base_url('assets/upload/'.$r->gambar) ?>"
                         alt="<?= $r->merk ?>"
                         class="mobil-thumb"/>
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
                      0 => ['label' => 'Pending',  'class' => 's-pending'],
                      1 => ['label' => 'Aktif',    'class' => 's-aktif'],
                      2 => ['label' => 'Selesai',  'class' => 's-selesai'],
                      3 => ['label' => 'Ditolak',  'class' => 's-ditolak'],
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