<div class="main-content">
<section class="section">
<div class="section-header">
    <h1>Kelola Transaksi</h1>
</div>
<div class="section-body">

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

<!-- Summary Cards -->
<div class="trx-stats">
    <div class="trx-stat s-amber">
        <div class="trx-stat-icon s-amber"><i class="fas fa-hourglass-half"></i></div>
        <div>
            <span class="trx-stat-label">Pending</span>
            <div class="trx-stat-value"><?= $counts['pending'] ?></div>
        </div>
    </div>
    <div class="trx-stat s-green">
        <div class="trx-stat-icon s-green"><i class="fas fa-key"></i></div>
        <div>
            <span class="trx-stat-label">Aktif</span>
            <div class="trx-stat-value"><?= $counts['aktif'] ?></div>
        </div>
    </div>
    <div class="trx-stat s-blue">
        <div class="trx-stat-icon s-blue"><i class="fas fa-check-circle"></i></div>
        <div>
            <span class="trx-stat-label">Selesai</span>
            <div class="trx-stat-value"><?= $counts['selesai'] ?></div>
        </div>
    </div>
    <div class="trx-stat s-red">
        <div class="trx-stat-icon s-red"><i class="fas fa-ban"></i></div>
        <div>
            <span class="trx-stat-label">Ditolak</span>
            <div class="trx-stat-value"><?= $counts['ditolak'] ?></div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="trx-card">
    <div class="trx-card-head">
        <span class="trx-card-title">Daftar Transaksi</span>
        <div class="trx-filters">
            <a href="<?= base_url('admin/transaksi') ?>"
               class="trx-filter-btn <?= empty($status_filter) ? 'active' : '' ?>">Semua</a>
            <a href="<?= base_url('admin/transaksi?status=pending') ?>"
               class="trx-filter-btn <?= $status_filter == 'pending' ? 'active-amber' : '' ?>">Pending</a>
            <a href="<?= base_url('admin/transaksi?status=aktif') ?>"
               class="trx-filter-btn <?= $status_filter == 'aktif' ? 'active-green' : '' ?>">Aktif</a>
            <a href="<?= base_url('admin/transaksi?status=selesai') ?>"
               class="trx-filter-btn <?= $status_filter == 'selesai' ? 'active-blue' : '' ?>">Selesai</a>
            <a href="<?= base_url('admin/transaksi?status=ditolak') ?>"
               class="trx-filter-btn <?= $status_filter == 'ditolak' ? 'active-red' : '' ?>">Ditolak</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="trx-tbl">
            <thead>
                <tr>
                    <th style="width:4%">#</th>
                    <th style="width:16%">Customer</th>
                    <th style="width:18%">Mobil</th>
                    <th style="width:11%">Tgl Sewa</th>
                    <th style="width:11%">Tgl Kembali</th>
                    <th style="width:11%">Total</th>
                    <th style="width:13%">Pembayaran</th>
                    <th style="width:10%">Status</th>
                    <th style="width:6%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="9" class="trx-empty">
                        <i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px;color:#cbd5e1;"></i>
                        Tidak ada transaksi.
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach($transaksi as $i => $t): ?>
                <tr>
                    <td class="trx-num"><?= $i + 1 ?></td>
                    <td>
                        <div class="trx-name"><?= $t->nama_lengkap ?></div>
                        <div class="trx-sub"><?= $t->no_hp ?></div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <img src="<?= base_url('assets/upload/'.$t->gambar) ?>"
                                 style="width:46px;height:34px;object-fit:contain;background:#f8fafc;border-radius:6px;border:1px solid #e2e8f0;padding:2px;flex-shrink:0;"/>
                            <div>
                                <div class="trx-name"><?= $t->merk ?></div>
                                <span class="trx-plate"><?= $t->no_plat ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="trx-date"><?= date('d M Y', strtotime($t->tanggal_rental)) ?></td>
                    <td class="trx-date"><?= date('d M Y', strtotime($t->tanggal_kembali)) ?></td>
                    <td class="trx-total">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
                    <td>
                        <?php
                            $bayar_map = [
                                0 => ['label' => 'Belum Bayar',   'cls' => 'pill-red'],
                                1 => ['label' => 'Menunggu Cek',  'cls' => 'pill-amber'],
                                2 => ['label' => 'Terkonfirmasi', 'cls' => 'pill-green'],
                            ];
                            $b = $bayar_map[$t->status_bayar] ?? ['label' => '-', 'cls' => 'pill-gray'];
                        ?>
                        <span class="trx-pill <?= $b['cls'] ?>"><?= $b['label'] ?></span>
                    </td>
                    <td>
                        <?php
                            $status_map = [
                                'pending' => 'pill-amber',
                                'aktif'   => 'pill-green',
                                'selesai' => 'pill-blue',
                                'ditolak' => 'pill-red',
                            ];
                            $sc = $status_map[$t->status_rental] ?? 'pill-gray';
                        ?>
                        <span class="trx-pill <?= $sc ?>"><?= ucfirst($t->status_rental) ?></span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;align-items:center;">
                            <a href="<?= base_url('admin/transaksi/detail/'.$t->id_rental) ?>"
                               class="trx-btn-icon trx-btn-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if ($t->status_rental == 'pending'): ?>
                            <a href="<?= base_url('admin/transaksi/tolak/'.$t->id_rental) ?>"
                               class="trx-btn-icon trx-btn-danger"
                               onclick="return confirm('Tolak transaksi ini?')" title="Tolak">
                                <i class="fas fa-times"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</section>
</div>

<style>
.trx-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px; margin-bottom: 20px;
}
.trx-stat {
    background: #fff; border: 1px solid rgba(0,0,0,0.07);
    border-radius: 12px; padding: 1.1rem 1.2rem;
    display: flex; align-items: center; gap: 14px;
    position: relative; overflow: hidden;
}
.trx-stat::before {
    content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%;
}
.trx-stat.s-amber::before { background: #e6a817; }
.trx-stat.s-green::before { background: #1D9E75; }
.trx-stat.s-blue::before  { background: #378ADD; }
.trx-stat.s-red::before   { background: #E24B4A; }
.trx-stat-icon {
    width: 44px; height: 44px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.trx-stat-icon.s-amber { background: #FEF3C7; color: #92400E; }
.trx-stat-icon.s-green { background: #E1F5EE; color: #0F6E56; }
.trx-stat-icon.s-blue  { background: #E6F1FB; color: #185FA5; }
.trx-stat-icon.s-red   { background: #FCEBEB; color: #A32D2D; }
.trx-stat-label { font-size: 11px; color: #94a3b8; display: block; margin-bottom: 3px; }
.trx-stat-value { font-size: 26px; font-weight: 700; color: #1e293b; line-height: 1; }

.trx-card {
    background: #fff; border: 1px solid rgba(0,0,0,0.07);
    border-radius: 12px; overflow: hidden; margin-bottom: 20px;
}
.trx-card-head {
    padding: 0.9rem 1.25rem;
    border-bottom: 1px solid rgba(0,0,0,0.06);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;
}
.trx-card-title { font-size: 14px; font-weight: 600; color: #1e293b; }

.trx-filters { display: flex; gap: 6px; flex-wrap: wrap; }
.trx-filter-btn {
    font-size: 12px; font-weight: 500;
    padding: 5px 14px; border-radius: 99px;
    border: 1px solid #e2e8f0; color: #64748b;
    background: #fff; text-decoration: none;
    transition: all 0.2s;
}
.trx-filter-btn:hover { background: #f1f5f9; color: #1e293b; text-decoration: none; }
.trx-filter-btn.active       { background: #1e293b; color: #fff; border-color: #1e293b; }
.trx-filter-btn.active-amber { background: #FEF3C7; color: #92400E; border-color: #fde68a; }
.trx-filter-btn.active-green { background: #E1F5EE; color: #0F6E56; border-color: #9FE1CB; }
.trx-filter-btn.active-blue  { background: #E6F1FB; color: #185FA5; border-color: #B5D4F4; }
.trx-filter-btn.active-red   { background: #FCEBEB; color: #A32D2D; border-color: #F7C1C1; }

.trx-tbl { width: 100%; border-collapse: collapse; font-size: 13px; }
.trx-tbl thead tr { background: #f8fafc; }
.trx-tbl th {
    padding: 0.6rem 1rem; text-align: left;
    font-size: 10px; font-weight: 700; color: #94a3b8;
    letter-spacing: 0.5px; text-transform: uppercase;
    border-bottom: 1px solid rgba(0,0,0,0.06);
    white-space: nowrap;
}
.trx-tbl td {
    padding: 0.75rem 1rem; color: #334155;
    border-top: 1px solid rgba(0,0,0,0.05);
    vertical-align: middle;
}
.trx-tbl tbody tr:hover { background: #f8fafc; }

.trx-name { font-weight: 600; font-size: 13px; color: #1e293b; }
.trx-sub  { font-size: 11px; color: #94a3b8; margin-top: 1px; }
.trx-num  { font-size: 12px; color: #94a3b8; font-weight: 600; }
.trx-date { font-size: 12px; color: #475569; white-space: nowrap; }
.trx-total { font-weight: 700; font-size: 13px; color: #1e293b; white-space: nowrap; }
.trx-plate {
    font-family: 'Courier New', monospace; font-size: 10px; font-weight: 700;
    background: #f1f5f9; border: 1px solid #e2e8f0;
    padding: 1px 6px; border-radius: 4px; color: #475569; display: inline-block;
    margin-top: 2px;
}

.trx-pill {
    display: inline-flex; align-items: center;
    font-size: 11px; font-weight: 600;
    padding: 3px 10px; border-radius: 99px;
    white-space: nowrap;
}
.pill-amber { background: #FEF3C7; color: #92400E; }
.pill-green { background: #E1F5EE; color: #0F6E56; }
.pill-blue  { background: #E6F1FB; color: #185FA5; }
.pill-red   { background: #FCEBEB; color: #A32D2D; }
.pill-gray  { background: #f1f5f9; color: #64748b; }

.trx-btn-icon {
    width: 30px; height: 30px; border-radius: 8px;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 13px; text-decoration: none; transition: opacity 0.2s;
    flex-shrink: 0;
}
.trx-btn-icon:hover { opacity: 0.8; text-decoration: none; }
.trx-btn-info   { background: #E6F1FB; color: #185FA5; }
.trx-btn-danger { background: #FCEBEB; color: #A32D2D; }

.trx-empty {
    text-align: center !important; color: #94a3b8 !important;
    font-style: italic; padding: 3rem 1rem !important;
}
</style>
PHPEOF
echo "done"