<style>
  .trx-wrap { padding: 40px 0 60px; }

  /* Filter status */
  .status-filter-bar {
    display: flex; gap: 8px; flex-wrap: wrap;
    margin-bottom: 28px;
  }
  .status-filter-btn {
    padding: 8px 20px;
    border-radius: 50px;
    font-size: .82rem; font-weight: 600;
    border: 1.5px solid var(--clay);
    background: var(--white); color: var(--text-mid);
    cursor: pointer; transition: all 0.2s; text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
  }
  .status-filter-btn:hover { border-color: var(--accent); color: var(--accent); }
  .status-filter-btn.active { background: var(--accent); color: var(--white); border-color: var(--accent); }

  /* Transaksi list */
  .trx-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card);
    margin-bottom: 16px;
    overflow: hidden;
    transition: transform 0.25s, box-shadow 0.25s;
  }
  .trx-card:hover { transform: translateY(-3px); box-shadow: 0 12px 36px rgba(100,80,60,0.14); }
  .trx-card-inner {
    display: flex; align-items: center; gap: 20px;
    padding: 20px 24px;
  }
  .trx-img {
    width: 90px; height: 66px; object-fit: contain;
    background: var(--sand); border-radius: var(--radius-md);
    padding: 6px; flex-shrink: 0;
  }
  .trx-info { flex: 1; min-width: 0; }
  .trx-mobil-name { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 3px; }
  .trx-meta       { font-size: .78rem; color: var(--text-soft); margin-bottom: 8px; }
  .trx-dates      { font-size: .82rem; color: var(--text-mid); display: flex; gap: 12px; flex-wrap: wrap; }
  .trx-dates span { display: flex; align-items: center; gap: 5px; }
  .trx-dates i    { color: var(--accent); font-size: .75rem; }
  .trx-right      { text-align: right; flex-shrink: 0; }
  .trx-harga      { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--accent); margin-bottom: 6px; }
  .trx-harga span { font-size: .75rem; font-weight: 400; color: var(--text-soft); font-family: var(--font-body); }
  .trx-action     { display: flex; gap: 8px; justify-content: flex-end; margin-top: 8px; }

  /* Status badge */
  .trx-status {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .72rem; font-weight: 600;
    padding: 4px 12px; border-radius: 50px;
  }
  .trx-status::before { content: '●'; font-size: .55rem; }
  .ts-0 { background: rgba(250,213,181,.3); color: #B06020; }
  .ts-1 { background: rgba(122,200,140,.2); color: #3A8A50; }
  .ts-2 { background: rgba(184,212,232,.3); color: #4A7FA0; }
  .ts-3 { background: rgba(220,100,100,.15); color: #C05050; }

  /* Btn detail */
  .btn-detail-trx {
    font-size: .78rem; font-weight: 600;
    color: var(--accent); border: 1.5px solid rgba(212,134,106,.3);
    background: rgba(212,134,106,.07);
    border-radius: 50px; padding: 6px 16px;
    text-decoration: none; transition: all 0.2s;
    display: inline-flex; align-items: center; gap: 5px;
  }
  .btn-detail-trx:hover { background: rgba(212,134,106,.14); color: var(--accent); }
  .btn-batal-trx {
    font-size: .78rem; font-weight: 600;
    color: #C05050; border: 1.5px solid rgba(192,80,80,.25);
    background: rgba(192,80,80,.06);
    border-radius: 50px; padding: 6px 16px;
    cursor: pointer; border: 1.5px solid rgba(192,80,80,.25);
    transition: all 0.2s;
  }
  .btn-batal-trx:hover { background: rgba(192,80,80,.12); }

  /* Empty */
  .trx-empty { text-align: center; padding: 60px 20px; color: var(--text-soft); }
  .trx-empty i { font-size: 2.5rem; color: var(--clay); margin-bottom: 14px; display: block; }

  /* Supir badge */
  .supir-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .73rem; color: var(--accent2);
    background: rgba(122,158,142,.1);
    border-radius: 50px; padding: 3px 10px;
    margin-top: 5px;
  }

  /* Toast */
  .toast-notif {
    position: fixed; bottom: 28px; right: 28px;
    background: var(--text-dark); color: var(--white);
    padding: 14px 22px; border-radius: var(--radius-lg);
    font-size: .88rem; font-weight: 500;
    box-shadow: 0 8px 32px rgba(0,0,0,.2);
    z-index: 9999; transform: translateY(80px); opacity: 0;
    transition: all 0.3s; display: flex; align-items: center; gap: 10px;
  }
  .toast-notif.show { transform: translateY(0); opacity: 1; }
  .toast-notif.success i { color: #6DC87A; }
  .toast-notif.error   i { color: #E07070; }
</style>

<div class="trx-wrap">
  <div class="container">

    <!-- Title -->
    <div class="mb-4">
      <span style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--accent);">Akun Saya</span>
      <h2 style="font-family:var(--font-display);font-size:1.6rem;font-weight:700;margin:0;">Riwayat <i style="color:var(--accent)">Sewa</i></h2>
    </div>

    <!-- Filter Status -->
    <div class="status-filter-bar">
      <a href="<?= base_url('customer/transaksi') ?>"
         class="status-filter-btn <?= !isset($status_filter) || $status_filter === '' ? 'active' : '' ?>">
        <i class="fas fa-list"></i> Semua
      </a>
      <a href="<?= base_url('customer/transaksi?status=0') ?>"
         class="status-filter-btn <?= $status_filter === '0' ? 'active' : '' ?>">
        <i class="fas fa-hourglass-half"></i> Pending
      </a>
      <a href="<?= base_url('customer/transaksi?status=1') ?>"
         class="status-filter-btn <?= $status_filter === '1' ? 'active' : '' ?>">
        <i class="fas fa-key"></i> Aktif
      </a>
      <a href="<?= base_url('customer/transaksi?status=2') ?>"
         class="status-filter-btn <?= $status_filter === '2' ? 'active' : '' ?>">
        <i class="fas fa-circle-check"></i> Selesai
      </a>
      <a href="<?= base_url('customer/transaksi?status=3') ?>"
         class="status-filter-btn <?= $status_filter === '3' ? 'active' : '' ?>">
        <i class="fas fa-ban"></i> Dibatalkan
      </a>
    </div>

    <!-- List Transaksi -->
    <?php if (empty($transaksi)): ?>
      <div class="trx-empty">
        <i class="fas fa-receipt"></i>
        <p>Belum ada transaksi<?= isset($status_filter) && $status_filter !== '' ? ' dengan status ini' : '' ?>.</p>
        <a href="<?= base_url('customer/mobil') ?>"
           style="display:inline-flex;align-items:center;gap:6px;background:var(--accent);color:var(--white);border-radius:50px;padding:10px 24px;font-size:.85rem;font-weight:600;">
          <i class="fas fa-car"></i> Pesan Sekarang
        </a>
      </div>

    <?php else: ?>
      <?php
        $status_map = [
          0 => ['label' => 'Pending',     'class' => 'ts-0'],
          1 => ['label' => 'Aktif',       'class' => 'ts-1'],
          2 => ['label' => 'Selesai',     'class' => 'ts-2'],
          3 => ['label' => 'Dibatalkan',  'class' => 'ts-3'],
        ];
      ?>
      <?php foreach($transaksi as $t): ?>
      <?php $s = $status_map[$t->status_rental] ?? ['label'=>'-','class'=>'']; ?>
      <div class="trx-card">
        <div class="trx-card-inner">

          <!-- Gambar -->
          <img src="<?= base_url('assets/upload/'.$t->gambar) ?>"
               alt="<?= $t->merk ?>" class="trx-img"/>

          <!-- Info -->
          <div class="trx-info">
            <div class="trx-mobil-name"><?= $t->merk ?></div>
            <div class="trx-meta"><?= $t->kode_type ?> · <?= $t->no_plat ?></div>
            <div class="trx-dates">
              <span><i class="fas fa-calendar-day"></i><?= date('d M Y', strtotime($t->tanggal_rental)) ?></span>
              <span><i class="fas fa-arrow-right"></i></span>
              <span><i class="fas fa-calendar-check"></i><?= date('d M Y', strtotime($t->tanggal_kembali)) ?></span>
            </div>
            <?php if (!empty($t->nama_supir)): ?>
              <div class="supir-badge"><i class="fas fa-user-tie"></i><?= $t->nama_supir ?></div>
            <?php endif; ?>
          </div>

          <!-- Kanan -->
          <div class="trx-right">
            <span class="trx-status <?= $s['class'] ?>"><?= $s['label'] ?></span>
            <div class="trx-harga">
              <?= !empty($t->total_harga) ? 'Rp '.number_format($t->total_harga, 0, ',', '.') : '–' ?>
            </div>
            <div class="trx-action">
              <a href="<?= base_url('customer/transaksi/detail/'.$t->id_rental) ?>" class="btn-detail-trx">
                <i class="fas fa-eye"></i> Detail
              </a>
              <?php if ($t->status_rental == 0): ?>
                <button class="btn-batal-trx" onclick="batalTransaksi(<?= $t->id_rental ?>)">
                  <i class="fas fa-xmark"></i> Batal
                </button>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</div>

<!-- Toast -->
<div class="toast-notif" id="toastNotif">
  <i class="fas fa-circle-check"></i>
  <span id="toastMsg"></span>
</div>

<script>
function batalTransaksi(id) {
  if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;

  fetch('<?= base_url("customer/transaksi/batal/") ?>' + id, { method: 'GET' })
    .then(r => r.json())
    .then(d => {
      showToast(d.status, d.message);
      if (d.status === 'success') {
        setTimeout(() => window.location.reload(), 1200);
      }
    });
}

function showToast(type, msg) {
  const toast = document.getElementById('toastNotif');
  document.getElementById('toastMsg').innerText = msg;
  toast.className = 'toast-notif ' + type;
  toast.querySelector('i').className = type === 'success' ? 'fas fa-circle-check' : 'fas fa-circle-xmark';
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 3200);
}
</script>