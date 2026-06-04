<?php
$total_mobil      = $this->db->count_all('mobil');
$total_sopir      = $this->db->count_all('supir');
$total_pelanggan  = $this->db->where('role', 'customer')->count_all_results('users');
$total_transaksi  = $this->db->count_all('transaksi');

$mobil_tersedia = $this->db
    ->where('status', '1')
    ->count_all_results('mobil');

$sopir_tersedia = $this->db
    ->where('status', '1')
    ->count_all_results('supir');

$transaksi_berjalan = $this->db
    ->where('status_rental', 'aktif')
    ->count_all_results('transaksi');

$transaksi_selesai = $this->db
    ->where('status_rental', 'selesai')
    ->count_all_results('transaksi');

$mobil_terbaru = $this->db
    ->order_by('id_mobil', 'DESC')
    ->limit(5)
    ->get('mobil')
    ->result();

$transaksi_terbaru = $this->db
    ->select('transaksi.*, users.nama_lengkap, mobil.merk, mobil.no_plat')
    ->from('transaksi')
    ->join('users', 'users.id = transaksi.id_customer')
    ->join('mobil', 'mobil.id_mobil = transaksi.id_mobil')
    ->order_by('transaksi.id_rental', 'DESC')
    ->limit(5)
    ->get()
    ->result();
?>

<!-- Dashboard punya main-content sendiri karena tidak ada wrapper bawaan -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="section-body">

      <div class="db">

        <!-- Stat Cards -->
        <div class="db-stats">
            <div class="db-stat s-blue">
                <div class="db-stat-icon s-blue"><i class="fas fa-car"></i></div>
                <div>
                    <span class="db-stat-label">Total Mobil</span>
                    <div class="db-stat-value"><?= $total_mobil ?></div>
                </div>
            </div>
            <div class="db-stat s-green">
                <div class="db-stat-icon s-green"><i class="fas fa-id-card"></i></div>
                <div>
                    <span class="db-stat-label">Total Sopir</span>
                    <div class="db-stat-value"><?= $total_sopir ?></div>
                </div>
            </div>
            <div class="db-stat s-amber">
                <div class="db-stat-icon s-amber"><i class="fas fa-users"></i></div>
                <div>
                    <span class="db-stat-label">Total Pelanggan</span>
                    <div class="db-stat-value"><?= $total_pelanggan ?></div>
                </div>
            </div>
            <div class="db-stat s-red">
                <div class="db-stat-icon s-red"><i class="fas fa-exchange-alt"></i></div>
                <div>
                    <span class="db-stat-label">Total Transaksi</span>
                    <div class="db-stat-value"><?= $total_transaksi ?></div>
                </div>
            </div>
        </div>

        <!-- Summary Panel -->
        <div class="db-summary">
            <div class="db-summary-head">
                <h4>Ringkasan Sistem Rental Mobil</h4>
                <span class="db-live-pill"><span class="db-live-dot"></span> Live</span>
            </div>
            <div class="db-summary-grid">
                <div class="db-sitem">
                    <span class="db-snum c-blue"><?= $mobil_tersedia ?></span>
                    <span class="db-ssub">Mobil Tersedia</span>
                </div>
                <div class="db-sitem">
                    <span class="db-snum c-green"><?= $sopir_tersedia ?></span>
                    <span class="db-ssub">Sopir Tersedia</span>
                </div>
                <div class="db-sitem">
                    <span class="db-snum c-amber"><?= $transaksi_berjalan ?></span>
                    <span class="db-ssub">Transaksi Berjalan</span>
                </div>
                <div class="db-sitem">
                    <span class="db-snum c-red"><?= $transaksi_selesai ?></span>
                    <span class="db-ssub">Transaksi Selesai</span>
                </div>
            </div>
            <div class="db-hr"></div>
            <p class="db-desc">Dashboard ini menampilkan ringkasan data utama pada sistem rental mobil, seperti data kendaraan, sopir, pelanggan, transaksi penyewaan, serta akses menuju laporan transaksi sesuai rancangan sistem.</p>
        </div>

        <!-- Tables -->
        <div class="db-tables">

            <!-- Mobil Terbaru -->
            <div class="db-card">
                <div class="db-card-head">
                    <i class="fas fa-car"></i>
                    <span>Data Mobil Terbaru</span>
                </div>
                <table class="db-tbl">
                    <thead>
                        <tr>
                            <th style="width:33%">Mobil</th>
                            <th style="width:25%">No. Plat</th>
                            <th style="width:24%">Harga</th>
                            <th style="width:18%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($mobil_terbaru as $m): ?>
                        <tr>
                            <td class="db-name"><?= $m->merk ?></td>
                            <td><span class="db-plate"><?= $m->no_plat ?></span></td>
                            <td>Rp <?= number_format($m->harga_perhari, 0, ',', '.') ?></td>
                            <td>
                                <?php if($m->status == '1'): ?>
                                    <span class="db-badge ok"><i class="fas fa-check"></i> Tersedia</span>
                                <?php else: ?>
                                    <span class="db-badge no"><i class="fas fa-times"></i> Tidak</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="db-card">
                <div class="db-card-head">
                    <i class="fas fa-list-alt"></i>
                    <span>Transaksi Terbaru</span>
                </div>
                <table class="db-tbl">
                    <thead>
                        <tr>
                            <th style="width:28%">Customer</th>
                            <th style="width:30%">Mobil</th>
                            <th style="width:22%">Tanggal</th>
                            <th style="width:20%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($transaksi_terbaru)): ?>
                            <?php foreach($transaksi_terbaru as $t): ?>
                            <tr>
                                <td class="db-name"><?= $t->nama_lengkap ?></td>
                                <td>
                                    <div><?= $t->merk ?></div>
                                    <div class="db-muted"><?= $t->no_plat ?></div>
                                </td>
                                <td><?= date('d M Y', strtotime($t->tanggal_rental)) ?></td>
                                <td>
                                    <?php if($t->status_rental == 'aktif'): ?>
                                        <span class="db-badge run"><i class="fas fa-clock"></i> Aktif</span>
                                    <?php elseif($t->status_rental == 'selesai'): ?>
                                        <span class="db-badge done"><i class="fas fa-check"></i> Selesai</span>
                                    <?php else: ?>
                                        <span class="db-badge other"><?= ucfirst($t->status_rental) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="db-empty">Belum ada transaksi.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
      </div>

    </div>
  </section>
</div>