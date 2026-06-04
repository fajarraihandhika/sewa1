<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Customer</h1>
        </div>

        <?php echo $this->session->flashdata('pesan') ?>

        <div class="section-body">

            <?php if($this->session->flashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <div class="trx-card">

                <div class="trx-card-head">
                    <div class="trx-card-title">Daftar Customer Rental</div>

                    <div style="display: flex; gap: 10px; align-items: center;">
                        
                        <select class="form-control" id="filterStatus" style="height: 31px; font-size: 12px; padding: 2px 10px; width: 140px; border-radius: 8px;">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="verified">Verified</option>
                            <option value="rejected">Rejected</option>
                        </select>

                        <a href="<?php echo base_url('admin/customer/tambah') ?>" class="btn btn-primary btn-sm" style="border-radius: 8px; font-weight: 600; white-space: nowrap;">
                            <i class="fas fa-plus"></i> Tambah Customer
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="trx-tbl">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th>Customer</th> <th>Kontak</th> <th>Alamat</th> <th class="text-center">Status Verifikasi</th> <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($customers as $customer) : ?>
                                <tr>
                                    <td class="text-center trx-num"><?= $no++; ?></td>

                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="width: 45px; height: 45px; background: #fff; border: 1px solid #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                                                <?php if($customer->foto_profil) : ?>
                                                    <img src="<?= base_url('uploads/profile/' . $customer->foto_profil); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                                <?php else : ?>
                                                    <img src="<?= base_url('assets/img/avatar/avatar-1.png'); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                                <?php endif; ?>
                                            </div>

                                            <div>
                                                <div class="trx-name"><?= $customer->nama_lengkap; ?></div>
                                                <div class="trx-sub">ID: #<?= $customer->id; ?></div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="trx-name" style="font-weight: 500;"><?= $customer->email; ?></div>
                                        <div class="trx-num" style="font-size: 11px;"><?= isset($customer->no_telepon) ? $customer->no_telepon : '-'; ?></div>
                                    </td>

                                    <td>
                                        <div class="trx-date" style="white-space: normal; max-width: 200px;">
                                            <?= isset($customer->alamat) ? $customer->alamat : '-'; ?>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <?php 
                                        // Contoh pengkondisian status berdasarkan data di database kamu
                                        $status = isset($customer->status) ? strtolower($customer->status) : 'pending';
                                        if($status == 'verified') : ?>
                                            <span class="trx-pill pill-green">Verified</span>
                                        <?php elseif($status == 'rejected') : ?>
                                            <span class="trx-pill pill-red">Rejected</span>
                                        <?php else : ?>
                                            <span class="trx-pill pill-amber">Pending</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <div style="display: flex; gap: 4px; justify-content: center;">
                                            <a href="<?= base_url('admin/customer/detail/' . $customer->id); ?>" class="trx-btn-icon trx-btn-info" title="Detail Customer">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <a href="<?= base_url('admin/customer/edit/' . $customer->id); ?>" class="trx-btn-icon trx-btn-info" style="background: #FEF3C7; color: #92400E;" title="Edit Customer">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="<?= base_url('admin/customer/hapus/' . $customer->id); ?>" class="trx-btn-icon trx-btn-danger" onclick="return confirm('Yakin ingin menghapus customer ini?')" title="Hapus Customer">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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