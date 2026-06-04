<style>
  .detail-wrap { padding: 40px 0 60px; }

  .back-link {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: .85rem; font-weight: 500; color: var(--text-mid);
    margin-bottom: 24px; transition: color 0.2s;
    text-decoration: none;
  }
  .back-link:hover { color: var(--accent); }

  .detail-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 24px;
    align-items: start;
  }
  @media(max-width:991px) { .detail-grid { grid-template-columns: 1fr; } }

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

  .mobil-hero {
    background: linear-gradient(135deg, var(--sand), var(--clay));
    border-radius: var(--radius-lg);
    padding: 24px; text-align: center; margin-bottom: 20px;
  }
  .mobil-hero img { width: 70%; max-height: 180px; object-fit: contain; }

  .info-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(200,180,160,.12);
    font-size: .88rem;
  }
  .info-row:last-child { border-bottom: none; }
  .info-label { color: var(--text-soft); }
  .info-val   { font-weight: 600; color: var(--text-dark); text-align: right; }

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

  .total-detail-box {
    background: linear-gradient(135deg, rgba(212,134,106,.1), rgba(212,134,106,.04));
    border: 1.5px solid rgba(212,134,106,.2);
    border-radius: var(--radius-lg);
    padding: 20px 24px;
  }
  .total-detail-label { font-size: .78rem; color: var(--text-soft); margin-bottom: 4px; }
  .total-detail-harga {
    font-family: var(--font-display);
    font-size: 2rem; font-weight: 700; color: var(--accent);
  }

  .supir-detail {
    display: flex; align-items: center; gap: 14px;
    background: var(--sand); border-radius: var(--radius-md);
    padding: 14px; border: 1px solid var(--clay);
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

  /* Upgrade badge */
  .upgrade-banner {
    background: linear-gradient(135deg, rgba(122,200,140,.15), rgba(122,200,140,.05));
    border: 1.5px solid rgba(122,200,140,.3);
    border-radius: var(--radius-md);
    padding: 12px 16px;
    margin-bottom: 16px;
    display: flex; align-items: flex-start; gap: 10px;
    font-size: .82rem; color: #3A8A50;
  }
  .upgrade-banner i { margin-top: 2px; flex-shrink: 0; }

  .timeline { position: relative; padding-left: 24px; }
  .timeline::before {
    content: ''; position: absolute; left: 8px; top: 0; bottom: 0;
    width: 2px; background: var(--clay);
  }
  .timeline-item { position: relative; margin-bottom: 20px; }
  .timeline-item::before {
    content: ''; position: absolute; left: -20px; top: 4px;
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
    'pending' => ['label'=>'Pending',    'class'=>'sb-0'],
    'aktif'   => ['label'=>'Aktif',      'class'=>'sb-1'],
    'selesai' => ['label'=>'Selesai',    'class'=>'sb-2'],
    'ditolak' => ['label'=>'Dibatalkan', 'class'=>'sb-3'],
  ];
  $s = $status_map[$t->status_rental] ?? ['label'=>'-','class'=>''];

  // Label durasi
  $durasi_label = [
    'jam'    => 'Jam',
    'hari'   => 'Hari',
    'minggu' => 'Minggu',
    'bulan'  => 'Bulan',
  ];
  $satuan = $durasi_label[$t->jenis_durasi] ?? $t->jenis_durasi;

  // Format datetime
  $fmt_tgl = function($dt) {
    return $dt ? date('d M Y, H:i', strtotime($dt)) : '-';
  };
?>

<div class="detail-wrap">
  <div class="container">

    <a href="<?= base_url('customer/transaksi') ?>" class="back-link">
      <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
    </a>

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
      <div>
        <span style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--accent);">Detail Transaksi</span>
        <h2 style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;margin:0;">
          #TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?>
        </h2>
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

            <?php if ($t->is_upgrade): ?>
            <div class="upgrade-banner">
              <i class="fas fa-circle-up"></i>
              <div>
                <strong>Upgrade Kendaraan</strong><br>
                Mobil pilihan Anda (<strong><?= $t->merk_asal ?> · <?= $t->type_asal ?></strong>)
                tidak tersedia, sehingga kami upgrade ke kendaraan di bawah ini
                <strong>dengan harga yang sama</strong>.
              </div>
            </div>
            <?php endif; ?>

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
          </div>
        </div>

        <!-- Supir -->
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
              <span class="info-label">Jenis Sewa</span>
              <span class="info-val"><?= ucfirst($t->jenis_durasi) ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Durasi</span>
              <span class="info-val"><?= $t->jumlah_durasi ?> <?= $satuan ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Biaya Mobil</span>
              <span class="info-val">Rp <?= number_format($t->biaya_mobil, 0, ',', '.') ?></span>
            </div>
            <?php if ($t->biaya_supir > 0): ?>
            <div class="info-row">
              <span class="info-label">Biaya Supir</span>
              <span class="info-val">Rp <?= number_format($t->biaya_supir, 0, ',', '.') ?></span>
            </div>
            <?php endif; ?>
            <?php if ($t->is_luar_kota): ?>
            <div class="info-row">
              <span class="info-label">Biaya Luar Kota (+20%)</span>
              <span class="info-val" style="color:var(--accent);">
                Rp <?= number_format($t->total_harga - $t->biaya_mobil - $t->biaya_supir, 0, ',', '.') ?>
              </span>
            </div>
            <?php endif; ?>
            <?php if ($t->biaya_tambahan > 0): ?>
            <div class="info-row">
              <span class="info-label" style="color:#C05050;">Biaya Keterlambatan</span>
              <span class="info-val" style="color:#C05050;">
                Rp <?= number_format($t->biaya_tambahan, 0, ',', '.') ?>
              </span>
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
              <span class="info-label">Mulai Sewa</span>
              <span class="info-val"><?= $fmt_tgl($t->tanggal_rental) ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Jadwal Kembali</span>
              <span class="info-val"><?= $fmt_tgl($t->tanggal_kembali) ?></span>
            </div>
            <?php if (!empty($t->tanggal_pengembalian)): ?>
            <div class="info-row">
              <span class="info-label">Dikembalikan</span>
              <span class="info-val"><?= $fmt_tgl($t->tanggal_pengembalian) ?></span>
            </div>
            <?php endif; ?>
            <?php if ($t->is_luar_kota): ?>
            <div class="info-row">
              <span class="info-label">Lokasi</span>
              <span class="info-val" style="color:var(--accent);">🗺 Luar Kota</span>
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
              <div class="timeline-item <?= in_array($t->status_rental, ['aktif','selesai']) ? 'done' : '' ?>">
                <div class="timeline-label">Disetujui Admin</div>
                <div class="timeline-desc">Mobil siap diambil</div>
              </div>
              <div class="timeline-item <?= $t->status_rental == 'selesai' ? 'done' : '' ?>">
                <div class="timeline-label">Selesai</div>
                <div class="timeline-desc">Mobil telah dikembalikan</div>
              </div>
            </div>

            <?php if ($t->status_rental == 'ditolak'): ?>
            <div class="timeline-item done" style="margin-top:12px;">
              <div class="timeline-label" style="color:#C05050;">Pesanan Ditolak/Dibatalkan</div>
              <div class="timeline-desc">Admin menolak atau pesanan dibatalkan</div>
            </div>
            <?php endif; ?>

            <?php if ($t->status_rental == 'pending'): ?>
            <button onclick="batalTransaksi(<?= $t->id_rental ?>)"
                    style="width:100%;background:none;border:1.5px solid rgba(192,80,80,.3);
                           border-radius:50px;padding:10px;font-size:.82rem;font-weight:600;
                           color:#C05050;cursor:pointer;margin-top:16px;transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(192,80,80,.08)'"
                    onmouseout="this.style.background='none'">
              <i class="fas fa-xmark me-1"></i> Batalkan Pesanan
            </button>
            <?php endif; ?>

            <?php if ($t->status_bayar == 2): ?>
            <a href="<?= base_url('customer/transaksi/kwitansi/'.$t->id_rental) ?>"
               target="_blank"
               style="display:flex;align-items:center;justify-content:center;gap:6px;
                      width:100%;background:rgba(122,200,140,.15);color:#3A8A50;
                      border:1.5px solid rgba(122,200,140,.3);border-radius:50px;
                      padding:10px;font-size:.82rem;font-weight:600;
                      text-decoration:none;margin-top:10px;transition:all 0.2s;"
               onmouseover="this.style.background='rgba(122,200,140,.25)'"
               onmouseout="this.style.background='rgba(122,200,140,.15)'">
              <i class="fas fa-print"></i> Cetak Kwitansi
            </a>
            <?php endif; ?>

            <?php if ($t->status_rental == 'pending' && $t->status_bayar == 0 && $t->metode_bayar == 'transfer'): ?>
            <a href="<?= base_url('customer/transaksi/bayar/'.$t->id_rental) ?>"
               style="display:flex;align-items:center;justify-content:center;gap:6px;
                      width:100%;background:var(--accent);color:#fff;
                      border-radius:50px;padding:10px;font-size:.82rem;font-weight:600;
                      text-decoration:none;margin-top:10px;transition:all 0.2s;">
              <i class="fas fa-upload"></i> Upload Bukti Transfer
            </a>
            <?php endif; ?>

            <?php if ($t->status_rental == 'pending' && $t->status_bayar == 0 && $t->metode_bayar == 'tunai'): ?>
            <a href="<?= base_url('customer/transaksi/konfirmasi_tunai/'.$t->id_rental) ?>"
               style="display:flex;align-items:center;justify-content:center;gap:6px;
                      width:100%;background:rgba(212,134,106,.12);color:var(--accent);
                      border:1.5px solid rgba(212,134,106,.3);border-radius:50px;
                      padding:10px;font-size:.82rem;font-weight:600;
                      text-decoration:none;margin-top:10px;transition:all 0.2s;">
              <i class="fas fa-money-bill-wave"></i> Lihat Instruksi Bayar Tunai
            </a>
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