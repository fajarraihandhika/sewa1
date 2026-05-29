<style>
  .detail-wrap { padding: 40px 0 60px; }

  .back-link {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: .85rem; font-weight: 500; color: var(--text-mid);
    margin-bottom: 24px; transition: color 0.2s;
    text-decoration: none;
  }
  .back-link:hover { color: var(--accent); }

  /* Layout 2 kolom */
  .detail-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 24px;
    align-items: start;
  }
  @media(max-width:991px) { .detail-grid { grid-template-columns: 1fr; } }

  /* Card */
  .detail-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    margin-bottom: 20px;
  }
  .detail-card-head {
    padding: 18px 24px;
    border-bottom: 1px solid var(--clay);
    display: flex; align-items: center; gap: 10px;
  }
  .detail-card-head h5 {
    font-family: var(--font-display);
    font-size: 1rem; font-weight: 700;
    color: var(--text-dark); margin: 0;
  }
  .detail-card-head i { color: var(--accent); }
  .detail-card-body { padding: 24px; }

  /* Mobil hero */
  .mobil-hero {
    background: linear-gradient(135deg, var(--sand), var(--clay));
    border-radius: var(--radius-lg);
    padding: 24px;
    text-align: center;
    margin-bottom: 20px;
  }
  .mobil-hero img {
    width: 70%; max-height: 180px;
    object-fit: contain;
  }

  /* Info rows */
  .info-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(200,180,160,.12);
    font-size: .88rem;
  }
  .info-row:last-child { border-bottom: none; }
  .info-label { color: var(--text-soft); }
  .info-val   { font-weight: 600; color: var(--text-dark); text-align: right; }

  /* Status */
  .status-big {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: .82rem; font-weight: 600;
    padding: 6px 16px; border-radius: 50px;
  }
  .status-big::before { content: '●'; font-size: .6rem; }
  .sb-0 { background: rgba(250,213,181,.3); color: #B06020; }
  .sb-1 { background: rgba(122,200,140,.2); color: #3A8A50; }
  .sb-2 { background: rgba(184,212,232,.3); color: #4A7FA0; }
  .sb-3 { background: rgba(220,100,100,.15); color: #C05050; }

  /* Total box */
  .total-detail-box {
    background: linear-gradient(135deg, rgba(212,134,106,.1), rgba(212,134,106,.04));
    border: 1.5px solid rgba(212,134,106,.2);
    border-radius: var(--radius-lg);
    padding: 20px 24px;
  }
  .total-detail-label { font-size: .78rem; color: var(--text-soft); margin-bottom: 4px; }
  .total-detail-harga {
    font-family: var(--font-display);
    font-size: 2rem; font-weight: 700;
    color: var(--accent);
  }

  /* Supir card */
  .supir-detail {
    display: flex; align-items: center; gap: 14px;
    background: var(--sand);
    border-radius: var(--radius-md);
    padding: 14px;
    border: 1px solid var(--clay);
  }
  .supir-detail-avatar {
    width: 52px; height: 52px; border-radius: 50%;
    overflow: hidden; background: var(--clay);
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display); font-size: 1.2rem;
    font-weight: 700; color: var(--accent); flex-shrink: 0;
  }
  .supir-detail-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .supir-detail-name { font-weight: 600; color: var(--text-dark); }
  .supir-detail-info { font-size: .78rem; color: var(--text-soft); margin-top: 2px; }

  /* Timeline status */
  .timeline { position: relative; padding-left: 24px; }
  .timeline::before {
    content: '';
    position: absolute; left: 8px; top: 0; bottom: 0;
    width: 2px; background: var(--clay);
  }
  .timeline-item { position: relative; margin-bottom: 20px; }
  .timeline-item::before {
    content: '';
    position: absolute; left: -20px; top: 4px;
    width: 12px; height: 12px; border-radius: 50%;
    background: var(--clay); border: 2px solid var(--white);
    box-shadow: 0 0 0 2px var(--clay);
  }
  .timeline-item.done::before { background: var(--accent); box-shadow: 0 0 0 2px rgba(212,134,106,.3); }
  .timeline-label { font-size: .82rem; font-weight: 600; color: var(--text-dark); }
  .timeline-desc  { font-size: .75rem; color: var(--text-soft); margin-top: 2px; }
</style>

<?php
  $t = $transaksi;
  $status_map = [
    0 => ['label'=>'Pending',    'class'=>'sb-0'],
    1 => ['label'=>'Aktif',      'class'=>'sb-1'],
    2 => ['label'=>'Selesai',    'class'=>'sb-2'],
    3 => ['label'=>'Dibatalkan', 'class'=>'sb-3'],
  ];
  $s = $status_map[$t->status_rental] ?? ['label'=>'-','class'=>''];
  $hari = ceil((strtotime($t->tanggal_kembali) - strtotime($t->tanggal_rental)) / 86400);
?>

<div class="detail-wrap">
  <div class="container">

    <a href="<?= base_url('customer/transaksi') ?>" class="back-link">
      <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
    </a>

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
      <div>
        <span style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--accent);">Detail Transaksi</span>
        <h2 style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;margin:0;">#TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></h2>
      </div>
      <span class="status-big <?= $s['class'] ?>"><?= $s['label'] ?></span>
    </div>

    <div class="detail-grid">

      <!-- KIRI -->
      <div>

        <!-- Info Mobil -->
        <div class="detail-card">
          <div class="detail-card-head">
            <i class="fas fa-car"></i><h5>Informasi Mobil</h5>
          </div>
          <div class="detail-card-body">
            <div class="mobil-hero">
              <img src="<?= base_url('assets/upload/'.$t->gambar) ?>" alt="<?= $t->merk ?>"/>
            </div>
            <div class="info-row">
              <span class="info-label">Nama Mobil</span>
              <span class="info-val"><?= $t->merk ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Tipe</span>
              <span class="info-val"><?= $t->kode_type ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Plat Nomor</span>
              <span class="info-val"><?= $t->no_plat ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Harga per Hari</span>
              <span class="info-val">Rp <?= number_format($t->harga, 0, ',', '.') ?></span>
            </div>
          </div>
        </div>

        <!-- Supir (jika ada) -->
        <?php if (!empty($t->nama_supir)): ?>
        <div class="detail-card">
          <div class="detail-card-head">
            <i class="fas fa-user-tie"></i><h5>Supir</h5>
          </div>
          <div class="detail-card-body">
            <div class="supir-detail">
              <div class="supir-detail-avatar">
                <?php if (!empty($t->foto_supir)): ?>
                  <img src="<?= base_url('assets/upload/'.$t->foto_supir) ?>"/>
                <?php else: ?>
                  <?= strtoupper(substr($t->nama_supir, 0, 1)) ?>
                <?php endif; ?>
              </div>
              <div>
                <div class="supir-detail-name"><?= $t->nama_supir ?></div>
                <div class="supir-detail-info">
                  ⭐ <?= $t->rating_supir ?? '5.0' ?> · <?= $t->telp_supir ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Catatan -->
        <?php if (!empty($t->catatan)): ?>
        <div class="detail-card">
          <div class="detail-card-head">
            <i class="fas fa-note-sticky"></i><h5>Catatan</h5>
          </div>
          <div class="detail-card-body">
            <p style="font-size:.88rem;color:var(--text-mid);margin:0;"><?= $t->catatan ?></p>
          </div>
        </div>
        <?php endif; ?>

      </div>

      <!-- KANAN -->
      <div>

        <!-- Ringkasan Biaya -->
        <div class="detail-card">
          <div class="detail-card-head">
            <i class="fas fa-receipt"></i><h5>Ringkasan Biaya</h5>
          </div>
          <div class="detail-card-body">
            <div class="info-row">
              <span class="info-label">Durasi Sewa</span>
              <span class="info-val"><?= $hari ?> hari</span>
            </div>
            <div class="info-row">
              <span class="info-label">Biaya Mobil</span>
              <span class="info-val">Rp <?= number_format($t->harga * $hari, 0, ',', '.') ?></span>
            </div>
            <?php if (!empty($t->nama_supir)): ?>
            <div class="info-row">
              <span class="info-label">Biaya Supir</span>
              <span class="info-val">Rp <?= number_format(150000 * $hari, 0, ',', '.') ?></span>
            </div>
            <?php endif; ?>
            <div style="margin-top:16px;">
              <div class="total-detail-box">
                <div class="total-detail-label">Total Pembayaran</div>
                <div class="total-detail-harga">
                  Rp <?= number_format($t->total_harga, 0, ',', '.') ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Jadwal -->
        <div class="detail-card">
          <div class="detail-card-head">
            <i class="fas fa-calendar-days"></i><h5>Jadwal Sewa</h5>
          </div>
          <div class="detail-card-body">
            <div class="info-row">
              <span class="info-label">Tanggal Sewa</span>
              <span class="info-val"><?= date('d M Y', strtotime($t->tanggal_rental)) ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Tanggal Kembali</span>
              <span class="info-val"><?= date('d M Y', strtotime($t->tanggal_kembali)) ?></span>
            </div>
            <?php if (!empty($t->tanggal_pengembalian)): ?>
            <div class="info-row">
              <span class="info-label">Dikembalikan</span>
              <span class="info-val"><?= date('d M Y', strtotime($t->tanggal_pengembalian)) ?></span>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Timeline Status -->
        <div class="detail-card">
          <div class="detail-card-head">
            <i class="fas fa-timeline"></i><h5>Status Pemesanan</h5>
          </div>
          <div class="detail-card-body">
            <div class="timeline">
              <div class="timeline-item done">
                <div class="timeline-label">Pesanan Dibuat</div>
                <div class="timeline-desc">Menunggu konfirmasi admin</div>
              </div>
              <div class="timeline-item <?= $t->status_rental >= 1 ? 'done' : '' ?>">
                <div class="timeline-label">Disetujui Admin</div>
                <div class="timeline-desc">Mobil siap diambil</div>
              </div>
              <div class="timeline-item <?= $t->status_rental >= 2 ? 'done' : '' ?>">
                <div class="timeline-label">Selesai</div>
                <div class="timeline-desc">Mobil telah dikembalikan</div>
              </div>
            </div>

            <!-- Tombol batal jika masih pending -->
            <?php if ($t->status_rental == 0): ?>
            <button onclick="batalTransaksi(<?= $t->id_rental ?>)"
                    style="width:100%;background:none;border:1.5px solid rgba(192,80,80,.3);border-radius:50px;padding:10px;font-size:.82rem;font-weight:600;color:#C05050;cursor:pointer;margin-top:16px;transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(192,80,80,.08)'"
                    onmouseout="this.style.background='none'">
              <i class="fas fa-xmark me-1"></i> Batalkan Pesanan
            </button>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
function batalTransaksi(id) {
  if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;
  fetch('<?= base_url("customer/transaksi/batal/") ?>' + id)
    .then(r => r.json())
    .then(d => {
      alert(d.message);
      if (d.status === 'success') window.location.href = d.redirect;
    });
}
</script>