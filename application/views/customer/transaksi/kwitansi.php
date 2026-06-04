<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kwitansi #TRX-<?= str_pad($transaksi->id_rental, 5, '0', STR_PAD_LEFT) ?></title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      font-size: 13px; color: #333;
      background: #f5f5f5;
    }

    .kwitansi-wrapper {
      max-width: 720px; margin: 30px auto;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,.08);
    }

    /* Header */
    .kwt-header {
      background: linear-gradient(135deg, #D4866A, #C07358);
      color: #fff; padding: 28px 36px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .kwt-logo { font-size: 1.5rem; font-weight: 800; letter-spacing: -.5px; }
    .kwt-logo span { opacity: .7; font-weight: 400; }
    .kwt-title-right { text-align: right; }
    .kwt-title-right h2 { font-size: 1.1rem; font-weight: 700; margin-bottom: 4px; }
    .kwt-title-right p  { font-size: .78rem; opacity: .85; }

    /* Body */
    .kwt-body { padding: 28px 36px; }

    /* Info baris */
    .kwt-section-title {
      font-size: .7rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: .08em; color: #999; margin-bottom: 10px;
      padding-bottom: 6px; border-bottom: 1px solid #eee;
    }
    .kwt-row {
      display: flex; justify-content: space-between;
      padding: 7px 0; border-bottom: 1px solid #f5f5f5; font-size: .88rem;
    }
    .kwt-row:last-child { border-bottom: none; }
    .kwt-row-label { color: #777; }
    .kwt-row-val   { font-weight: 600; color: #333; text-align: right; }

    .kwt-section { margin-bottom: 22px; }

    /* Total */
    .kwt-total {
      background: linear-gradient(135deg, rgba(212,134,106,.12), rgba(212,134,106,.05));
      border: 1.5px solid rgba(212,134,106,.25);
      border-radius: 10px; padding: 18px 24px;
      display: flex; align-items: center; justify-content: space-between;
      margin: 20px 0;
    }
    .kwt-total-label { font-size: .82rem; color: #777; margin-bottom: 3px; }
    .kwt-total-harga { font-size: 1.6rem; font-weight: 800; color: #D4866A; }
    .kwt-metode {
      font-size: .75rem; font-weight: 600; padding: 4px 12px;
      border-radius: 50px; display: inline-block; margin-top: 4px;
    }
    .kwt-metode.tunai    { background: rgba(122,200,140,.2); color: #3A8A50; }
    .kwt-metode.transfer { background: rgba(184,212,232,.3); color: #4A7FA0; }

    /* Rincian biaya */
    .kwt-biaya-item {
      display: flex; justify-content: space-between;
      font-size: .85rem; padding: 5px 0;
      border-bottom: 1px dashed #eee;
    }
    .kwt-biaya-item:last-child { border-bottom: none; }
    .kwt-biaya-item.total-row {
      border-top: 2px solid #eee; border-bottom: none;
      padding-top: 10px; margin-top: 4px;
      font-weight: 700; font-size: .95rem;
    }
    .kwt-biaya-item.total-row .kwt-row-val { color: #D4866A; }

    /* Upgrade banner */
    .kwt-upgrade {
      background: rgba(122,200,140,.1); border: 1px solid rgba(122,200,140,.3);
      border-radius: 8px; padding: 10px 14px; margin-bottom: 16px;
      font-size: .82rem; color: #3A8A50;
      display: flex; gap: 8px; align-items: flex-start;
    }

    /* Footer */
    .kwt-footer {
      background: #fafafa; border-top: 1px solid #eee;
      padding: 20px 36px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .kwt-footer-note { font-size: .75rem; color: #aaa; }
    .kwt-tanda-tangan {
      text-align: center; font-size: .78rem; color: #777;
    }
    .kwt-tanda-tangan .ttd-box {
      width: 120px; height: 60px; border-bottom: 1px solid #999;
      margin: 0 auto 6px;
    }

    /* Print button */
    .btn-print {
      display: block; margin: 20px auto;
      background: #D4866A; color: #fff;
      border: none; border-radius: 50px;
      padding: 12px 32px; font-size: .9rem; font-weight: 600;
      cursor: pointer; transition: all .2s;
    }
    .btn-print:hover { background: #C07358; }

    @media print {
      body { background: #fff; }
      .kwitansi-wrapper { box-shadow: none; border: none; margin: 0; border-radius: 0; }
      .btn-print { display: none; }
    }
  </style>
</head>
<body>

<?php
  $t = $transaksi;
  $durasi_label = ['jam'=>'Jam','hari'=>'Hari','minggu'=>'Minggu','bulan'=>'Bulan'];
  $satuan = $durasi_label[$t->jenis_durasi] ?? $t->jenis_durasi;
  $fmt_tgl = function($dt) { return $dt ? date('d M Y, H:i', strtotime($dt)) : '-'; };
  $biaya_luar_kota = $t->total_harga - $t->biaya_mobil - $t->biaya_supir - $t->biaya_tambahan;
?>

<button class="btn-print" onclick="window.print()">
  <i class="fas fa-print me-1"></i> Cetak / Simpan PDF
</button>

<div class="kwitansi-wrapper">

  <!-- Header -->
  <div class="kwt-header">
    <div>
      <div class="kwt-logo">DriveEase <span>Rental</span></div>
      <div style="font-size:.78rem;opacity:.8;margin-top:4px;">Jl. Contoh No. 123, Tangerang</div>
      <div style="font-size:.78rem;opacity:.8;">Telp: 021-1234567</div>
    </div>
    <div class="kwt-title-right">
      <h2>KWITANSI PEMBAYARAN</h2>
      <p>#TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></p>
      <p style="margin-top:4px;"><?= date('d M Y, H:i') ?></p>
    </div>
  </div>

  <!-- Body -->
  <div class="kwt-body">

    <?php if ($t->is_upgrade): ?>
    <div class="kwt-upgrade">
      <i class="fas fa-circle-up" style="margin-top:2px;flex-shrink:0;"></i>
      <div>
        <strong>Upgrade Kendaraan</strong> — Kendaraan asal
        (<strong><?= $t->merk_asal ?></strong>) tidak tersedia,
        di-upgrade ke <strong><?= $t->merk ?></strong> dengan harga yang sama.
      </div>
    </div>
    <?php endif; ?>

    <!-- Info Customer -->
    <div class="kwt-section">
      <div class="kwt-section-title">Informasi Customer</div>
      <div class="kwt-row">
        <span class="kwt-row-label">Nama</span>
        <span class="kwt-row-val"><?= $customer->nama_lengkap ?></span>
      </div>
      <div class="kwt-row">
        <span class="kwt-row-label">No. HP</span>
        <span class="kwt-row-val"><?= $customer->no_hp ?></span>
      </div>
      <div class="kwt-row">
        <span class="kwt-row-label">Email</span>
        <span class="kwt-row-val"><?= $customer->email ?></span>
      </div>
    </div>

    <!-- Info Kendaraan -->
    <div class="kwt-section">
      <div class="kwt-section-title">Informasi Kendaraan</div>
      <div class="kwt-row">
        <span class="kwt-row-label">Kendaraan</span>
        <span class="kwt-row-val"><?= $t->merk ?> (<?= $t->kode_type ?>)</span>
      </div>
      <div class="kwt-row">
        <span class="kwt-row-label">Plat Nomor</span>
        <span class="kwt-row-val"><?= $t->no_plat ?></span>
      </div>
      <?php if (!empty($t->nama_supir)): ?>
      <div class="kwt-row">
        <span class="kwt-row-label">Supir</span>
        <span class="kwt-row-val"><?= $t->nama_supir ?></span>
      </div>
      <?php endif; ?>
    </div>

    <!-- Jadwal -->
    <div class="kwt-section">
      <div class="kwt-section-title">Jadwal Sewa</div>
      <div class="kwt-row">
        <span class="kwt-row-label">Jenis Sewa</span>
        <span class="kwt-row-val"><?= ucfirst($t->jenis_durasi) ?></span>
      </div>
      <div class="kwt-row">
        <span class="kwt-row-label">Durasi</span>
        <span class="kwt-row-val"><?= $t->jumlah_durasi ?> <?= $satuan ?></span>
      </div>
      <div class="kwt-row">
        <span class="kwt-row-label">Mulai</span>
        <span class="kwt-row-val"><?= $fmt_tgl($t->tanggal_rental) ?></span>
      </div>
      <div class="kwt-row">
        <span class="kwt-row-label">Selesai</span>
        <span class="kwt-row-val"><?= $fmt_tgl($t->tanggal_kembali) ?></span>
      </div>
      <?php if ($t->is_luar_kota): ?>
      <div class="kwt-row">
        <span class="kwt-row-label">Lokasi</span>
        <span class="kwt-row-val" style="color:#D4866A;">Luar Kota (+20%)</span>
      </div>
      <?php endif; ?>
    </div>

    <!-- Rincian Biaya -->
    <div class="kwt-section">
      <div class="kwt-section-title">Rincian Biaya</div>
      <div class="kwt-biaya-item">
        <span class="kwt-row-label">Biaya Mobil (<?= $t->jumlah_durasi ?> <?= $satuan ?>)</span>
        <span class="kwt-row-val">Rp <?= number_format($t->biaya_mobil, 0, ',', '.') ?></span>
      </div>
      <?php if ($t->biaya_supir > 0): ?>
      <div class="kwt-biaya-item">
        <span class="kwt-row-label">Biaya Supir</span>
        <span class="kwt-row-val">Rp <?= number_format($t->biaya_supir, 0, ',', '.') ?></span>
      </div>
      <?php endif; ?>
      <?php if ($t->is_luar_kota && $biaya_luar_kota > 0): ?>
      <div class="kwt-biaya-item">
        <span class="kwt-row-label">Biaya Luar Kota (+20%)</span>
        <span class="kwt-row-val">Rp <?= number_format($biaya_luar_kota, 0, ',', '.') ?></span>
      </div>
      <?php endif; ?>
      <?php if ($t->biaya_tambahan > 0): ?>
      <div class="kwt-biaya-item">
        <span class="kwt-row-label" style="color:#C05050;">Biaya Keterlambatan</span>
        <span class="kwt-row-val" style="color:#C05050;">Rp <?= number_format($t->biaya_tambahan, 0, ',', '.') ?></span>
      </div>
      <?php endif; ?>
      <div class="kwt-biaya-item total-row">
        <span>Total Pembayaran</span>
        <span class="kwt-row-val">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></span>
      </div>
    </div>

    <!-- Total & Metode -->
    <div class="kwt-total">
      <div>
        <div class="kwt-total-label">Total Dibayar</div>
        <div class="kwt-total-harga">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></div>
        <span class="kwt-metode <?= $t->metode_bayar ?>">
          <?= $t->metode_bayar === 'tunai' ? '💵 Tunai' : '🏦 Transfer Bank' ?>
        </span>
      </div>
      <div style="text-align:right;">
        <div style="font-size:.75rem;color:#aaa;margin-bottom:4px;">Status</div>
        <span style="background:rgba(122,200,140,.2);color:#3A8A50;font-weight:700;padding:6px 14px;border-radius:50px;font-size:.82rem;">
          ✓ Terkonfirmasi
        </span>
      </div>
    </div>

  </div>

  <!-- Footer -->
  <div class="kwt-footer">
    <div class="kwt-footer-note">
      <div>Terima kasih telah menggunakan layanan DriveEase.</div>
      <div style="margin-top:4px;">Dokumen ini dicetak pada <?= date('d M Y, H:i') ?>.</div>
      <div style="margin-top:4px;color:#bbb;">ID: #TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></div>
    </div>
    <div class="kwt-tanda-tangan">
      <div class="ttd-box"></div>
      <div>Petugas / Admin</div>
      <div style="color:#bbb;font-size:.7rem;margin-top:2px;">DriveEase Rental</div>
    </div>
  </div>

</div>

<button class="btn-print" onclick="window.print()">
  <i class="fas fa-print me-1"></i> Cetak / Simpan PDF
</button>

</body>
</html>