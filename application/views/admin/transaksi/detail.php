<!-- application/views/admin/transaksi/detail.php -->
<?php
  $t = $transaksi;

  $durasi_label = [
    'jam'    => 'Jam',
    'hari'   => 'Hari',
    'minggu' => 'Minggu',
    'bulan'  => 'Bulan',
  ];
  $satuan = $durasi_label[$t->jenis_durasi] ?? $t->jenis_durasi;

  $fmt_tgl = function($dt) {
    return $dt ? date('d M Y, H:i', strtotime($dt)) : '-';
  };

  $status_map = [
    'pending' => ['label'=>'Pending',    'class'=>'badge-warning'],
    'aktif'   => ['label'=>'Aktif',      'class'=>'badge-success'],
    'selesai' => ['label'=>'Selesai',    'class'=>'badge-primary'],
    'ditolak' => ['label'=>'Ditolak',    'class'=>'badge-danger'],
  ];
  $bayar_map = [
    0 => ['label'=>'Belum Upload',        'class'=>'badge-danger'],
    1 => ['label'=>'Menunggu Konfirmasi', 'class'=>'badge-warning'],
    2 => ['label'=>'Terkonfirmasi',       'class'=>'badge-success'],
  ];
  $s = $status_map[$t->status_rental] ?? ['label'=>'-','class'=>'badge-secondary'];
  $b = $bayar_map[$t->status_bayar]   ?? ['label'=>'-','class'=>'badge-secondary'];

  // Hitung biaya luar kota dari breakdown kolom DB
  $biaya_luar_kota = $t->total_harga - $t->biaya_mobil - $t->biaya_supir - $t->biaya_tambahan;
?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Transaksi</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?= base_url('admin/transaksi') ?>">Transaksi</a></div>
        <div class="breadcrumb-item active">#TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></div>
      </div>
    </div>

    <div class="section-body">

      <!-- Flash -->
      <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert"><span>×</span></button>
          <?= $this->session->flashdata('success') ?>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert"><span>×</span></button>
          <?= $this->session->flashdata('error') ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- Action Buttons -->
      <div class="d-flex gap-2 mb-4 flex-wrap">
        <a href="<?= base_url('admin/transaksi') ?>" class="btn btn-outline-secondary">
          <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <?php if ($t->status_bayar == 1): ?>
        <a href="<?= base_url('admin/transaksi/konfirmasi_bayar/'.$t->id_rental) ?>"
           class="btn btn-warning"
           onclick="return confirm('Konfirmasi pembayaran ini sudah masuk?')">
          <i class="fas fa-circle-check me-1"></i> Konfirmasi Pembayaran
        </a>
        <?php endif; ?>

        <?php if ($t->status_rental == 'pending' && $t->status_bayar == 2): ?>
        <a href="<?= base_url('admin/transaksi/approve/'.$t->id_rental) ?>"
           class="btn btn-success"
           onclick="return confirm('Setujui dan aktifkan transaksi ini?')">
          <i class="fas fa-check me-1"></i> Approve & Aktifkan
        </a>
        <?php endif; ?>

        <?php if ($t->status_rental == 'aktif'): ?>
        <a href="<?= base_url('admin/transaksi/selesai/'.$t->id_rental) ?>"
           class="btn btn-primary"
           onclick="return confirm('Tandai transaksi ini sebagai selesai?')">
          <i class="fas fa-flag-checkered me-1"></i> Tandai Selesai
        </a>
        <?php endif; ?>

        <?php if ($t->status_rental == 'pending'): ?>
        <a href="<?= base_url('admin/transaksi/tolak/'.$t->id_rental) ?>"
           class="btn btn-danger"
           onclick="return confirm('Tolak transaksi ini?')">
          <i class="fas fa-xmark me-1"></i> Tolak
        </a>
        <?php endif; ?>
      </div>

      <div class="row">

        <!-- KIRI -->
        <div class="col-lg-8">

          <!-- Info Customer -->
          <div class="card">
            <div class="card-header"><h4><i class="fas fa-user me-2"></i>Informasi Customer</h4></div>
            <div class="card-body">
              <table class="table table-sm table-borderless">
                <tr><td class="text-muted" width="35%">Nama</td><td><strong><?= $t->nama_lengkap ?></strong></td></tr>
                <tr><td class="text-muted">Email</td><td><?= $t->email ?></td></tr>
                <tr><td class="text-muted">No. HP</td><td><?= $t->no_hp ?></td></tr>
              </table>
            </div>
          </div>

          <!-- Info Mobil -->
          <div class="card">
            <div class="card-header"><h4><i class="fas fa-car me-2"></i>Informasi Mobil</h4></div>
            <div class="card-body">

              <?php if ($t->is_upgrade): ?>
              <div class="alert alert-success py-2 px-3 mb-3" style="font-size:.85rem;">
                <i class="fas fa-circle-up me-1"></i>
                <strong>Upgrade Kendaraan</strong> —
                Mobil asal (<strong><?= $t->merk_asal ?> · <?= $t->type_asal ?></strong>)
                tidak tersedia, di-upgrade ke kendaraan ini dengan harga yang sama.
              </div>
              <?php endif; ?>

              <div class="d-flex gap-3 align-items-center mb-3">
                <img src="<?= base_url('assets/upload/'.$t->gambar) ?>"
                     style="width:100px;height:72px;object-fit:contain;background:#f5efe6;border-radius:10px;padding:6px;"/>
                <div>
                  <h5 class="mb-1"><?= $t->merk ?></h5>
                  <span class="badge badge-light"><?= $t->kode_type ?></span>
                  <span class="badge badge-light ms-1"><?= $t->no_plat ?></span>
                  <?php if ($t->is_upgrade): ?>
                    <span class="badge badge-success ms-1">Upgrade</span>
                  <?php endif; ?>
                </div>
              </div>

              <table class="table table-sm table-borderless">
                <tr>
                  <td class="text-muted" width="35%">Jenis Sewa</td>
                  <td><strong><?= ucfirst($t->jenis_durasi) ?></strong></td>
                </tr>
                <tr>
                  <td class="text-muted">Durasi</td>
                  <td><strong><?= $t->jumlah_durasi ?> <?= $satuan ?></strong></td>
                </tr>
                <tr>
                  <td class="text-muted">Mulai Sewa</td>
                  <td><strong><?= $fmt_tgl($t->tanggal_rental) ?></strong></td>
                </tr>
                <tr>
                  <td class="text-muted">Jadwal Kembali</td>
                  <td><strong><?= $fmt_tgl($t->tanggal_kembali) ?></strong></td>
                </tr>
                <?php if (!empty($t->tanggal_pengembalian)): ?>
                <tr>
                  <td class="text-muted">Dikembalikan</td>
                  <td><strong><?= $fmt_tgl($t->tanggal_pengembalian) ?></strong></td>
                </tr>
                <?php endif; ?>
                <?php if ($t->is_luar_kota): ?>
                <tr>
                  <td class="text-muted">Lokasi</td>
                  <td><span class="badge badge-warning">Luar Kota +20%</span></td>
                </tr>
                <?php endif; ?>
                <?php if (!empty($t->nama_supir)): ?>
                <tr>
                  <td class="text-muted">Supir</td>
                  <td><strong><?= $t->nama_supir ?></strong> · <?= $t->telp_supir ?></td>
                </tr>
                <?php endif; ?>
                <?php if (!empty($t->catatan)): ?>
                <tr>
                  <td class="text-muted">Catatan</td>
                  <td><?= $t->catatan ?></td>
                </tr>
                <?php endif; ?>
              </table>
            </div>
          </div>

          <!-- Bukti Pembayaran -->
          <div class="card">
            <div class="card-header">
              <h4><i class="fas fa-image me-2"></i>Bukti Pembayaran</h4>
              <div class="card-header-action">
                <span class="badge <?= $b['class'] ?>"><?= $b['label'] ?></span>
              </div>
            </div>
            <div class="card-body text-center">
              <?php if (!empty($t->bukti_pembayaran)): ?>
                <?php $ext = pathinfo($t->bukti_pembayaran, PATHINFO_EXTENSION); ?>
                <?php if (in_array(strtolower($ext), ['jpg','jpeg','png'])): ?>
                  <img src="<?= base_url('assets/upload/'.$t->bukti_pembayaran) ?>"
                       class="img-fluid rounded"
                       style="max-height:400px;cursor:zoom-in;"
                       onclick="window.open(this.src)"/>
                  <p class="text-muted mt-2" style="font-size:.8rem;">Klik gambar untuk memperbesar</p>
                <?php else: ?>
                  <a href="<?= base_url('assets/upload/'.$t->bukti_pembayaran) ?>"
                     target="_blank" class="btn btn-outline-primary">
                    <i class="fas fa-file-pdf me-1"></i> Lihat File PDF
                  </a>
                <?php endif; ?>
              <?php else: ?>
                <div class="py-4 text-muted">
                  <i class="fas fa-image fa-3x mb-3 d-block" style="opacity:.3;"></i>
                  Customer belum mengupload bukti pembayaran.
                </div>
              <?php endif; ?>
            </div>
          </div>

        </div>

        <!-- KANAN -->
        <div class="col-lg-4">

          <!-- Status -->
          <div class="card">
            <div class="card-header"><h4><i class="fas fa-info-circle me-2"></i>Status</h4></div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Status Transaksi</span>
                <span class="badge <?= $s['class'] ?> badge-lg"><?= $s['label'] ?></span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Status Pembayaran</span>
                <span class="badge <?= $b['class'] ?>"><?= $b['label'] ?></span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Pengembalian</span>
                <?php if ($t->status_pengembalian == 'sudah'): ?>
                  <span class="badge badge-success">Sudah</span>
                <?php else: ?>
                  <span class="badge badge-light">Belum</span>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Ringkasan Biaya -->
          <div class="card">
            <div class="card-header"><h4><i class="fas fa-receipt me-2"></i>Ringkasan Biaya</h4></div>
            <div class="card-body">
              <table class="table table-sm table-borderless">
                <tr>
                  <td class="text-muted">Biaya Mobil</td>
                  <td class="text-right">
                    <strong>Rp <?= number_format($t->biaya_mobil, 0, ',', '.') ?></strong>
                  </td>
                </tr>
                <?php if ($t->biaya_supir > 0): ?>
                <tr>
                  <td class="text-muted">Biaya Supir</td>
                  <td class="text-right">
                    <strong>Rp <?= number_format($t->biaya_supir, 0, ',', '.') ?></strong>
                  </td>
                </tr>
                <?php endif; ?>
                <?php if ($t->is_luar_kota && $biaya_luar_kota > 0): ?>
                <tr>
                  <td class="text-muted">Luar Kota (+20%)</td>
                  <td class="text-right">
                    <strong>Rp <?= number_format($biaya_luar_kota, 0, ',', '.') ?></strong>
                  </td>
                </tr>
                <?php endif; ?>
                <?php if ($t->biaya_tambahan > 0): ?>
                <tr>
                  <td class="text-muted" style="color:#C05050;">Biaya Keterlambatan</td>
                  <td class="text-right" style="color:#C05050;">
                    <strong>Rp <?= number_format($t->biaya_tambahan, 0, ',', '.') ?></strong>
                  </td>
                </tr>
                <?php endif; ?>
                <tr style="border-top:2px solid #eee;">
                  <td><strong>Total</strong></td>
                  <td class="text-right">
                    <strong style="color:#D4866A;font-size:1.1rem;">
                      Rp <?= number_format($t->total_harga, 0, ',', '.') ?>
                    </strong>
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <!-- ID Info -->
          <div class="card">
            <div class="card-body">
              <small class="text-muted d-block mb-1">ID Transaksi</small>
              <strong>#TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></strong>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>