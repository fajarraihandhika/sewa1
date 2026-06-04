<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Laporan Transaksi</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Filter Laporan Transaksi</h4>
            </div>

            <div class="card-body">
                <!-- Form Filter -->
                <form method="GET" action="<?= base_url('admin/laporan') ?>">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" class="form-control" value="<?= $tanggal_awal ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label>&nbsp;</label><br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="<?= base_url('admin/laporan') ?>" class="btn btn-secondary">Reset</a>
                            <button type="button" onclick="window.print()" class="btn btn-success">Cetak</button>
                        </div>
                    </div>
                </form>

                <hr class="print-hide">

                <!-- Header Cetak / Print Title -->
                <div class="print-title">
                    <h2>Laporan Transaksi Rental Mobil</h2>
                    <p>DriveEase - Sistem Informasi Rental Mobil</p>
                    <?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)): ?>
                        <p class="periode">Periode: <?= date('d-m-Y', strtotime($tanggal_awal)) ?> s/d <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Tabel Data -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">No</th>
                                <th>ID Rental</th>
                                <th>Customer</th>
                                <th>Mobil</th>
                                <th>No Plat</th>
                                <th>Tgl Rental</th>
                                <th>Tgl Kembali</th>
                                <th>Harga / Hari</th>
                                <th>Status Rental</th>
                                <th>Status Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($laporan)): ?>
                                <?php $no = 1; foreach ($laporan as $l): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= $l->id_rental ?></td>
                                        <td><?= $l->nama_lengkap ?></td>
                                        <td><?= $l->merk ?></td>
                                        <td class="text-uppercase"><?= $l->no_plat ?></td>
                                        <td><?= date('d-m-Y', strtotime($l->tanggal_rental)) ?></td>
                                        <td><?= date('d-m-Y', strtotime($l->tanggal_kembali)) ?></td>
                                        <td class="text-right">Rp <?= number_format($l->harga_perhari, 0, ',', '.') ?></td>
                                        <td>
    <?php
    $bayar_map = [
        0 => ['label' => 'Belum Bayar',   'class' => 'badge-danger'],
        1 => ['label' => 'Menunggu Cek',  'class' => 'badge-warning'],
        2 => ['label' => 'Terkonfirmasi', 'class' => 'badge-success'],
    ];
    
    // Mengubah $t->status_bayar menjadi $l->status_bayar agar sinkron dengan foreach
    $b = $bayar_map[$l->status_bayar] ?? ['label' => '-', 'class' => 'badge-secondary'];
    ?>
    <span class="badge <?= $b['class'] ?>"><?= $b['label'] ?></span>
</td>

<td>
    <?php
    $status_map = [
        'pending'    => 'badge-warning',
        'aktif'      => 'badge-success',
        'selesai'    => 'badge-primary',
        'dibatalkan' => 'badge-danger', // Sesuaikan key ini jika di DB namanya 'ditolak' atau 'dibatalkan'
    ];
    
    // Konversi dulu nilai dari DB ke huruf kecil semua agar cocok dengan key array di atas
    $status_key = strtolower($l->status_rental);
    $sc = $status_map[$status_key] ?? 'badge-secondary';
    ?>
    <span class="badge <?= $sc ?>"><?= ucfirst($l->status_rental) ?></span>
</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted">Data laporan belum ada atau tidak ditemukan untuk periode ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>
</div>

<style>
/* CSS Utama (Tampilan Web) */
.print-title {
    display: none;
}

/* CSS Khusus Mode Cetak (Print) */
@media print {
    @page {
        size: landscape;
        margin: 15mm;
    }

    body {
        background: #fff !important;
        color: #000 !important;
        font-family: Arial, sans-serif !important;
    }

    /* Menyembunyikan elemen non-cetak */
    .main-sidebar,
    .navbar,
    .navbar-bg,
    .main-footer,
    .section-header,
    .card-header,
    form,
    hr.print-hide,
    .btn,
    .badge {
        display: none !important;
    }

    .main-content {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }

    .section,
    .card,
    .card-body {
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
        background: transparent !important;
    }

    /* Pengaturan Header Laporan */
    .print-title {
        display: block !important;
        text-align: center;
        margin-bottom: 25px;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
    }

    .print-title h2 {
        margin: 0 0 5px 0;
        font-size: 24px;
        font-weight: bold;
        color: #000;
    }

    .print-title p {
        margin: 2px 0;
        font-size: 14px;
        color: #333;
    }

    .print-title p.periode {
        font-weight: bold;
        margin-top: 5px;
    }

    /* Pengaturan Tabel Saat Dicetak */
    .table-responsive {
        overflow: visible !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 11px !important;
    }

    table th,
    table td {
        border: 1px solid #333 !important;
        padding: 8px 6px !important;
        color: #000 !important;
        vertical-align: middle !important;
    }

    table thead th {
        background-color: #f2f2f2 !important;
        color: #000 !important;
        font-weight: bold !important;
        text-align: center !important;
        -webkit-print-color-adjust: exact; /* Memaksa browser mencetak warna background */
        print-color-adjust: exact;
    }

    /* Text alignment spesifik saat print */
    table td {
        text-align: center !important;
    }
    
    table td.text-right {
        text-align: right !important;
    }
}
</style>