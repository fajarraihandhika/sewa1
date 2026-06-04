<?php
  $t    = $transaksi;
  $durasi_label = ['jam'=>'Jam','hari'=>'Hari','minggu'=>'Minggu','bulan'=>'Bulan'];
  $satuan = $durasi_label[$t->jenis_durasi] ?? $t->jenis_durasi;
  $fmt_tgl = function($dt) { return $dt ? date('d M Y, H:i', strtotime($dt)) : '-'; };
?>
<style>
  .tunai-wrap { padding: 40px 0 60px; }
  .tunai-grid {
    display: grid; grid-template-columns: 1fr 360px;
    gap: 24px; align-items: start;
  }
  @media(max-width:991px) { .tunai-grid { grid-template-columns: 1fr; } }

  .tunai-card {
    background: var(--white); border-radius: var(--radius-xl);
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 20px;
  }
  .tunai-card-head {
    padding: 18px 24px; border-bottom: 1px solid var(--clay);
    display: flex; align-items: center; gap: 10px;
  }
  .tunai-card-head h5 {
    font-family: var(--font-display); font-size: 1rem; font-weight: 700;
    color: var(--text-dark); margin: 0;
  }
  .tunai-card-head i { color: var(--accent); }
  .tunai-card-body { padding: 24px; }

  /* Step bar */
  .step-bar { display: flex; align-items: center; margin-bottom: 36px; }
  .step-item { display: flex; align-items: center; gap: 10px; font-size: .82rem; font-weight: 600; }
  .step-circle {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem; font-weight: 700; flex-shrink: 0;
  }
  .step-circle.done   { background: var(--accent); color: var(--white); }
  .step-circle.active { background: var(--accent); color: var(--white); box-shadow: 0 0 0 4px rgba(212,134,106,.2); }
  .step-circle.idle   { background: var(--clay); color: var(--text-soft); }
  .step-label.done    { color: var(--accent); }
  .step-label.active  { color: var(--text-dark); }
  .step-label.idle    { color: var(--text-soft); }
  .step-line { flex: 1; height: 2px; background: var(--clay); margin: 0 10px; }
  .step-line.done { background: var(--accent); }

  /* Info box tunai */
  .tunai-info-box {
    background: linear-gradient(135deg, rgba(122,200,140,.1), rgba(122,200,140,.04));
    border: 1.5px solid rgba(122,200,140,.25);
    border-radius: var(--radius-lg);
    padding: 24px; margin-bottom: 24px;
    text-align: center;
  }
  .tunai-icon { font-size: 2.5rem; color: #3A8A50; margin-bottom: 12px; }
  .tunai-title { font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; color: var(--text-dark); margin-bottom: 8px; }
  .tunai-desc { font-size: .88rem; color: var(--text-mid); line-height: 1.6; }

  /* Total box */
  .total-tunai-box {
    background: rgba(212,134,106,.08); border: 1.5px solid rgba(212,134,106,.2);
    border-radius: var(--radius-lg); padding: 18px 22px;
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px;
  }
  .total-tunai-label { font-size: .82rem; color: var(--text-mid); }
  .total-tunai-harga { font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; color: var(--accent); }

  /* Langkah-langkah */
  .langkah-item {
    display: flex; gap: 14px; align-items: flex-start;
    padding: 14px 0; border-bottom: 1px solid rgba(200,180,160,.1);
    font-size: .88rem; color: var(--text-mid);
  }
  .langkah-item:last-child { border-bottom: none; }
  .langkah-num {
    width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
    background: rgba(212,134,106,.15); color: var(--accent);
    font-size: .8rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    margin-top: 1px;
  }
  .langkah-title { font-weight: 600; color: var(--text-dark); margin-bottom: 3px; }

  /* Info row */
  .info-row {
    display: flex; justify-content: space-between;
    padding: 10px 0; border-bottom: 1px solid rgba(200,180,160,.1); font-size: .85rem;
  }
  .info-row:last-child { border-bottom: none; }
  .info-label { color: var(--text-soft); }
  .info-val   { font-weight: 600; color: var(--text-dark); text-align: right; }

  .btn-detail {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; background: var(--accent); color: var(--white);
    border: none; border-radius: 50px; padding: 14px;
    font-size: .95rem; font-weight: 600; cursor: pointer;
    text-decoration: none; margin-top: 20px; transition: all .25s;
  }
  .btn-detail:hover { background: #C07358; color: var(--white); box-shadow: 0 6px 20px rgba(212,134,106,.35); }
</style>

<div class="tunai-wrap">
  <div class="container">

    <!-- Step Bar — tunai: Pesan → Bayar di Tempat → Aktif (tanpa konfirmasi admin upload) -->
    <div class="step-bar mb-4">
      <div class="step-item">
        <div class="step-circle done"><i class="fas fa-check"></i></div>
        <span class="step-label done">Pesan</span>
      </div>
      <div class="step-line done"></div>
      <div class="step-item">
        <div class="step-circle active">2</div>
        <span class="step-label active">Bayar di Tempat</span>
      </div>
      <div class="step-line"></div>
      <div class="step-item">
        <div class="step-circle idle">3</div>
        <span class="step-label idle">Aktif</span>
      </div>
    </div>

    <div class="tunai-grid">

      <!-- KIRI: Instruksi -->
      <div>
        <div class="tunai-card">
          <div class="tunai-card-head">
            <i class="fas fa-money-bill-wave"></i>
            <h5>Instruksi Pembayaran Tunai</h5>
          </div>
          <div class="tunai-card-body">

            <div class="tunai-info-box">
              <div class="tunai-icon"><i class="fas fa-circle-check"></i></div>
              <div class="tunai-title">Pesanan Berhasil Dibuat!</div>
              <div class="tunai-desc">
                Pesanan kamu sudah kami terima. Silakan datang ke kantor kami
                dan lakukan pembayaran tunai. Kwitansi akan diberikan setelah
                pembayaran diterima oleh admin kami.
              </div>
            </div>

            <div class="total-tunai-box">
              <div>
                <div class="total-tunai-label">Total yang harus dibayar</div>
                <div style="font-size:.75rem;color:var(--text-soft);">Siapkan uang pas jika memungkinkan</div>
              </div>
              <div class="total-tunai-harga">
                Rp <?= number_format($t->total_harga, 0, ',', '.') ?>
              </div>
            </div>

            <!-- Langkah-langkah -->
            <div style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--text-soft);margin-bottom:4px;">
              Langkah Selanjutnya
            </div>
            <div class="langkah-item">
              <div class="langkah-num">1</div>
              <div>
                <div class="langkah-title">Datang ke Kantor Kami</div>
                Kunjungi kantor DriveEase sebelum tanggal sewa dimulai.
              </div>
            </div>
            <div class="langkah-item">
              <div class="langkah-num">2</div>
              <div>
                <div class="langkah-title">Tunjukkan ID Pesanan</div>
                Tunjukkan nomor pesanan <strong>#TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></strong>
                kepada petugas kami.
              </div>
            </div>
            <div class="langkah-item">
              <div class="langkah-num">3</div>
              <div>
                <div class="langkah-title">Lakukan Pembayaran</div>
                Bayar tunai sejumlah <strong>Rp <?= number_format($t->total_harga, 0, ',', '.') ?></strong>
                kepada petugas.
              </div>
            </div>
            <div class="langkah-item">
              <div class="langkah-num">4</div>
              <div>
                <div class="langkah-title">Terima Kwitansi</div>
                Petugas akan mencetak kwitansi dan mengaktifkan pesanan kamu.
              </div>
            </div>

            <a href="<?= base_url('customer/transaksi/detail/'.$t->id_rental) ?>" class="btn-detail">
              <i class="fas fa-eye"></i> Lihat Detail Pesanan
            </a>

          </div>
        </div>
      </div>

      <!-- KANAN: Ringkasan -->
      <div>
        <div class="tunai-card">
          <div class="tunai-card-head">
            <i class="fas fa-receipt"></i>
            <h5>Ringkasan Pesanan</h5>
          </div>
          <div class="tunai-card-body">

            <div style="background:var(--sand);border-radius:var(--radius-lg);padding:16px;text-align:center;margin-bottom:18px;">
              <img src="<?= base_url('assets/upload/'.$t->gambar) ?>"
                   alt="<?= $t->merk ?>"
                   style="max-height:120px;object-fit:contain;width:80%;"/>
            </div>

            <div class="info-row">
              <span class="info-label">Mobil</span>
              <span class="info-val"><?= $t->merk ?></span>
            </div>
            <?php if ($t->is_upgrade && !empty($t->merk_asal)): ?>
            <div class="info-row">
              <span class="info-label" style="color:var(--accent);">Upgrade dari</span>
              <span class="info-val" style="color:var(--accent);"><?= $t->merk_asal ?></span>
            </div>
            <?php endif; ?>
            <div class="info-row">
              <span class="info-label">Jenis Sewa</span>
              <span class="info-val"><?= ucfirst($t->jenis_durasi) ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Durasi</span>
              <span class="info-val"><?= $t->jumlah_durasi ?> <?= $satuan ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Mulai</span>
              <span class="info-val"><?= $fmt_tgl($t->tanggal_rental) ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Selesai</span>
              <span class="info-val"><?= $fmt_tgl($t->tanggal_kembali) ?></span>
            </div>
            <?php if (!empty($t->nama_supir)): ?>
            <div class="info-row">
              <span class="info-label">Supir</span>
              <span class="info-val"><?= $t->nama_supir ?></span>
            </div>
            <?php endif; ?>
            <?php if ($t->is_luar_kota): ?>
            <div class="info-row">
              <span class="info-label">Lokasi</span>
              <span class="info-val" style="color:var(--accent);">🗺 Luar Kota (+20%)</span>
            </div>
            <?php endif; ?>

            <!-- Breakdown -->
            <div style="margin-top:12px;padding:12px;background:var(--sand);border-radius:var(--radius-md);font-size:.78rem;color:var(--text-mid);">
              <div style="font-weight:600;color:var(--text-dark);margin-bottom:6px;">Rincian Biaya</div>
              <div style="display:flex;justify-content:space-between;">
                <span>Biaya Mobil</span>
                <span>Rp <?= number_format($t->biaya_mobil, 0, ',', '.') ?></span>
              </div>
              <?php if ($t->biaya_supir > 0): ?>
              <div style="display:flex;justify-content:space-between;margin-top:4px;">
                <span>Biaya Supir</span>
                <span>Rp <?= number_format($t->biaya_supir, 0, ',', '.') ?></span>
              </div>
              <?php endif; ?>
              <?php if ($t->is_luar_kota): ?>
              <div style="display:flex;justify-content:space-between;margin-top:4px;">
                <span>Luar Kota (+20%)</span>
                <span>Rp <?= number_format($t->total_harga - $t->biaya_mobil - $t->biaya_supir - $t->biaya_tambahan, 0, ',', '.') ?></span>
              </div>
              <?php endif; ?>
            </div>

            <div class="info-row" style="border-top:2px solid var(--clay);margin-top:8px;padding-top:16px;">
              <span class="info-label" style="font-weight:600;color:var(--text-dark);">Total</span>
              <span class="info-val" style="color:var(--accent);font-size:1.1rem;">
                Rp <?= number_format($t->total_harga, 0, ',', '.') ?>
              </span>
            </div>

            <div style="margin-top:16px;padding:12px;background:rgba(250,213,181,.2);border-radius:var(--radius-md);font-size:.78rem;color:var(--text-mid);border:1px solid rgba(212,134,106,.15);">
              <i class="fas fa-clock me-2" style="color:var(--accent);"></i>
              ID Pesanan: <strong>#TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></strong>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>