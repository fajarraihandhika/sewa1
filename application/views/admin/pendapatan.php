<div class="main-content">
    <section class="section">
        <div class="section-header print-hide d-flex justify-content-between align-items-center" style="box-shadow: 0 4px 8px rgba(0,0,0,.03); background-color: #fff; border-radius: 3px; padding: 15px 25px;">
            <h1 style="color: #1e2235; font-size: 24px; font-weight: 700; letter-spacing: -0.5px;">Laporan Pendapatan</h1>
            <!-- Menggunakan kelas btn-navy custom -->
            <button onclick="window.print()" class="btn btn-navy btn-icon icon-left shadow-cpu print-hide">
                <i class="fas fa-print"></i> Cetak Laporan Finansial
            </button>
        </div>

       <!-- ==================== PREMIUM DUAL-MODE FILTER CONTROL ==================== -->
<div class="card shadow-sm mb-4 print-hide border-0" style="border-radius: 8px; background: #fff;">
    <div class="card-body py-4 px-4">
        <form method="GET" action="<?= base_url('admin/laporan/pendapatan') ?>" id="filterForm">
            <div class="row align-items-center justify-content-between row-gap-3">
                
                <!-- Sisi Kiri: Kontrol Utama -->
                <div class="col-lg-8 d-flex align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center mr-3">
                        <div class="bg-navy-light text-navy d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; border-radius: 50%;">
                            <i class="fas fa-filter" style="font-size: 14px;"></i>
                        </div>
                        <span class="font-weight-bold style-navy-text" style="font-size: 14px;">Metode Sortir:</span>
                    </div>
                    
                    <!-- Dropdown Pilihan Utama -->
                    <div class="position-relative mr-2">
                        <select name="periode" id="periodeSelect" class="form-control premium-select pr-4" style="min-width: 180px;">
                            <option value="hari_ini" <?= $current_filter == 'hari_ini' ? 'selected' : '' ?>>Hari Ini</option>
                            <option value="minggu_ini" <?= $current_filter == 'minggu_ini' ? 'selected' : '' ?>>7 Hari Terakhir</option>
                            <option value="bulan_ini" <?= $current_filter == 'bulan_ini' ? 'selected' : '' ?>>Bulan Ini</option>
                            <option value="tahun_ini" <?= $current_filter == 'tahun_ini' ? 'selected' : '' ?>>Tahun Ini</option>
                            <option value="semua" <?= $current_filter == 'semua' ? 'selected' : '' ?>>Semua (All-Time)</option>
                            <option value="kustom" <?= $current_filter == 'kustom' ? 'selected' : '' ?>>📅 Pilih Tanggal Kustom</option>
                        </select>
                    </div>

                    <!-- Input Rentang Tanggal Kustom (Otomatis Muncul/Sembunyi lewat JS) -->
                    <div id="customDateWrapper" class="d-flex align-items-center gap-2 mr-2" style="display: none !important;">
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control premium-input" value="<?= $this->input->get('tanggal_mulai') ?>">
                        <span class="text-muted font-weight-bold px-1">s/d</span>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control premium-input" value="<?= $this->input->get('tanggal_selesai') ?>">
                    </div>

                    <button type="submit" class="btn btn-navy font-weight-bold shadow-cpu px-4">
                        Terapkan Filter
                    </button>
                </div>

                <!-- Sisi Kanan: Status Badge Aktif -->
                <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                    <span class="badge premium-badge shadow-sm">
                        <i class="fas fa-calendar-alt mr-1 text-navy"></i> Status: <?= $label_periode ?>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

        <!-- ==================== HEADER NOTA FORMAL (KHUSUS MODE CETAK) ==================== -->
        <div class="print-title text-center">
            <h2 class="mb-1" style="color: #000; font-weight: 800; letter-spacing: 1px;">DRIVEEASE RENTAL MOBIL</h2>
            <p class="mb-1 text-uppercase font-weight-bold" style="letter-spacing: 0.5px; color: #444;">Laporan Analisis Pendapatan Admin</p>
            <p class="mb-2">Rentang Waktu: <strong><?= $label_periode ?></strong></p>
            <div class="text-muted small">Generasi Dokumen: <?= date('d-m-Y H:i:s') ?></div>
            <hr class="my-3" style="border: 1px solid #111;">
        </div>

        <!-- ==================== TABEL DATA VALIDASI TRANSAKSI ==================== -->
        <div class="card shadow-sm border-0" style="border-radius: 8px; overflow: hidden; background: #fff;">
            <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <!-- Garis indikator diubah warnanya menjadi Navy Gelap -->
                    <div class="mr-3" style="width: 4px; height: 20px; background-color: #1e2235; border-radius: 2px;"></div>
                    <h5 class="mb-0 font-weight-bold" style="color: #191d21; font-size: 16px;">Rincian Transaksi Pendapatan Masuk</h5>
                </div>
                <span class="badge badge-light border text-muted font-weight-600 px-3 py-2 print-hide" style="font-size: 11px; border-radius: 30px;">
                    <?= count($rincian_pendapatan) ?> Transaksi Terdata
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 premium-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="70">NO</th>
                                <th>ID RENTAL</th>
                                <th>NAMA CUSTOMER</th>
                                <th>ARMADA MOBIL</th>
                                <th>NO. PLAT</th>
                                <th class="text-center">TANGGAL SEWA</th>
                                <th class="text-right">SUBTOTAL OMZET</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rincian_pendapatan)): ?>
                                <?php $no = 1; foreach ($rincian_pendapatan as $rp): ?>
                                    <tr>
                                        <td class="text-center text-muted font-weight-600"><?= $no++ ?></td>
                                        <!-- ID Rental link/text menjadi warna Navy Gelap -->
                                        <td class="font-weight-700 text-navy" style="font-size: 13px;"><?= $rp->id_rental ?></td>
                                        <td class="font-weight-600" style="color: #495057;"><?= $rp->nama_lengkap ?></td>
                                        <td class="font-weight-600" style="color: #495057;"><?= $rp->merk ?></td>
                                        <td><span class="badge badge-light font-weight-bold text-uppercase" style="letter-spacing: 0.5px; border: 1px solid #e3eaef; padding: 5px 10px; color: #6c757d;"><?= $rp->no_plat ?></span></td>
                                        <td class="text-center text-secondary" style="font-size: 13px;"><?= date('d M Y', strtotime($rp->tanggal_rental)) ?></td>
                                        <td class="text-right font-weight-700 text-dark" style="font-size: 14px;">Rp <?= number_format($rp->total_harga, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                
                               <!-- GRAND TOTAL ROW SINKRON NAVY GELAP -->
<tr class="premium-total-row">
    <td colspan="6" class="text-right text-uppercase font-weight-bold" style="font-size: 12px; letter-spacing: 1px; color: #4a5568; vertical-align: middle;">
        Total Akumulasi Pendapatan Bersih:
    </td>
    <td class="text-right font-weight-800 grand-total-amount">
        Rp <?= number_format($total_pendapatan, 0, ',', '.') ?>
    </td>
</tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted p-5 bg-white">
                                        <div class="py-4">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-light"></i>
                                            <p class="mb-0 font-weight-600" style="color: #a8b4c0;">Tidak ada transaksi pendapatan pada rentang periode ini.</p>
                                        </div>
                                    </td>
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
/* ==================== CUSTOM CUSTOMIZED CUSTOM STYLE (SINKRON SIDEBAR) ==================== */
/* ==================== SCREEN CSS (WEB INTERFACE ELEGAN) ==================== */
.print-title { display: none; }

/* Warna Navy Mengikuti Sidebar Kamu */
.btn-navy {
    background-color: #1e2235 !important;
    border-color: #1e2235 !important;
    color: #fff !important;
    border-radius: 6px;
    padding: 0.55rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-navy:hover {
    background-color: #121420 !important;
    box-shadow: 0 4px 12px rgba(30, 34, 53, 0.15);
}
.btn-icon.btn-navy {
    border-radius: 30px !important;
}

.text-navy { color: #1e2235 !important; }
.style-navy-text { color: #1e2235 !important; }
.bg-navy-light { background-color: #f0f2f5; }
.shadow-cpu { box-shadow: 0 4px 6px rgba(50,50,93,.05), 0 1px 3px rgba(0,0,0,.03) !important; }

/* Premium Dropdown Filter */
.premium-select {
    background-color: #fdfdff !important;
    border: 1px solid #e4e6fc !important;
    border-radius: 6px !important;
    height: 42px !important;
    padding: 0 15px !important;
    font-weight: 600 !important;
    color: #495057 !important;
    font-size: 13px !important;
}

/* Premium Status Badge */
.premium-badge {
    background-color: #f4f6f9 !important;
    border: 1px solid #e3eaef !important;
    color: #1e2235 !important;
    font-size: 12px !important;
    padding: 10px 18px !important;
    border-radius: 30px !important;
    font-weight: 700 !important;
}

/* ==================== MASTER RE-DESIGN TABEL PREMIUM ==================== */

/* 1. Desain Header Tabel: Lebih Tegas & Kontras */
.premium-table thead th {
    background-color: #1e2235 !important; /* Kita bikin gelap solid biar mewah */
    color: #ffffff !important;            /* Teks putih bersih */
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: 0.8px !important;
    padding: 16px 20px !important;
    border: none !important;
    text-transform: uppercase;
}

/* Sudut melengkung halus untuk header tabel */
.premium-table thead tr th:first-child { border-top-left-radius: 6px; }
.premium-table thead tr th:last-child { border-top-right-radius: 6px; }

/* 2. Desain Baris & Sel Data (Isi Tabel) */
.premium-table tbody td {
    padding: 18px 20px !important; /* Ruang vertikal lebih longgar */
    vertical-align: middle !important;
    border-top: 1px solid #f1f3f9 !important;
    border-bottom: 1px solid #f1f3f9 !important;
    color: #2d3748 !important; /* Warna teks gelap charcoal, bukan abu-abu pudar */
    font-size: 13.5px;
}

/* Bikin selang-seling warna baris (Zebra Striping) yang sangat soft */
.premium-table tbody tr:nth-of-type(even) {
    background-color: #fcfdfe !important;
}

/* Efek Hover Mengambang Halus */
.premium-table tbody tr {
    transition: all 0.2s ease;
}
.premium-table tbody tr:hover {
    background-color: #f4f6ff !important; /* Efek highlight biru-navy super tipis */
    transform: scale(1.002);
}

/* Kustomisasi Badge No Plat (Biar kelihatan boxy modern) */
.premium-table .badge-light {
    background-color: #f1f3f9 !important;
    border: 1px solid #cbd5e0 !important;
    color: #4a5568 !important;
    font-weight: 700 !important;
    font-size: 11px !important;
    border-radius: 4px !important; /* Kotak rounded tipis ala plat nomor asli */
    padding: 6px 12px !important;
}

/* 3. Desain Baris Grand Total Finansial (Highlight Section) */
.premium-table tbody tr.premium-total-row {
    background-color: #f8fafc !important; /* Background abu-abu terang premium */
}
.premium-table tbody tr.premium-total-row td {
    border-top: 3px double #1e2235 !important; /* Garis akuntansi ganda tipis */
    border-bottom: 3px solid #1e2235 !important;
    padding: 22px 20px !important; /* Lebih tebal */
}

/* Style teks Tampilan Uang Utama */
.grand-total-amount {
    font-size: 22px !important;
    font-weight: 800 !important;
    color: #1e2235 !important; /* Warna disamakan dengan Navy Sidebar */
    text-shadow: 0 1px 2px rgba(0,0,0,0.02);
}
/* Style Tambahan untuk Input Tanggal Premium */
.premium-input {
    background-color: #fdfdff !important;
    border: 1px solid #e4e6fc !important;
    border-radius: 6px !important;
    height: 42px !important;
    padding: 0 12px !important;
    font-weight: 600 !important;
    color: #495057 !important;
    font-size: 13px !important;
    transition: all 0.2s;
}
.premium-input:focus {
    border-color: #1e2235 !important;
    box-shadow: 0 0 10px rgba(30, 34, 53, 0.1) !important;
}
.gap-2 { gap: 8px; }
/* ==================== CSS PRINT PRIVILEGE (PERBAIKAN GARIS) ==================== */
@media print {
    @page {
        size: portrait;
        margin: 15mm;
    }
    
    /* Sembunyikan elemen dashboard yang tidak perlu */
    .main-sidebar, .navbar, .navbar-bg, .main-footer, .section-header, .print-hide, .btn, .badge {
        display: none !important;
    }
    
    /* Lebarkan konten utama */
    .main-content {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
    }
    
    .card-header {
        display: none !important;
    }
    
    /* Munculkan judul nota formal */
    .print-title {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
    }
    
    /* ================= FORCE BORDER UNTUK CETAK ================= */
    table.premium-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 12px !important;
        margin-top: 10px !important;
        border: 2px solid #000000 !important; /* Garis luar tabel hitam tegas */
    }
    
    /* Paksa semua header kolom pakai border hitam */
    table.premium-table thead th {
        background-color: #f2f2f2 !important; /* Background abu-abu tipis formal */
        color: #000000 !important;
        border: 1px solid #000000 !important; /* Garis pembatas box header */
        padding: 10px !important;
        font-weight: bold !important;
        text-transform: uppercase !important;
    }
    
    /* Paksa semua sel isi data memiliki garis horizontal dan vertikal */
    table.premium-table tbody td {
        border: 1px solid #000000 !important; /* Memunculkan kembali garis horizontal & vertikal */
        padding: 10px !important;
        color: #000000 !important;
        background-color: #ffffff !important;
    }
    
    /* Berikan warna teks hitam pekat untuk ID Rental */
    table.premium-table tbody td.text-navy, 
    table.premium-table tbody td.font-weight-700 {
        color: #000000 !important;
    }
    
    /* Baris Grand Total Finansial */
    table.premium-table tbody tr.premium-total-row td {
        background-color: #ffffff !important;
        border-top: 2px solid #000000 !important; /* Garis atas totalan lebih tebal */
        border-bottom: 2px solid #000000 !important;
        font-weight: bold !important;
    }

    .grand-total-amount {
        color: #000000 !important;
        font-size: 16px !important;
    }
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const periodeSelect = document.getElementById('periodeSelect');
    const customDateWrapper = document.getElementById('customDateWrapper');

    function toggleCustomDate() {
        if (periodeSelect.value === 'kustom') {
            // Tampilkan rentang tanggal dengan transisi flex
            customDateWrapper.style.setProperty('display', 'flex', 'important');
        } else {
            // Sembunyikan jika memilih filter instan biasa
            customDateWrapper.style.setProperty('display', 'none', 'important');
        }
    }

    // Jalankan saat pertama kali halaman dimuat (menjaga state tetap terbuka jika sedang memfilter kustom)
    toggleCustomDate();

    // Jalankan setiap kali pilihan dropdown diubah
    periodeSelect.addEventListener('change', toggleCustomDate);
});
</script>