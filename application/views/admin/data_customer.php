<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Mobil</h1>
          </div>
          <a href="<?php echo base_url('admin/Customer/tambah') ?>" class="btn btn-primary mb-3">Tambah Data</a>

          <?php echo $this->session->flashdata('pesan') ?>

<!-- ========================= MAIN CONTENT ========================= -->
<div class="section-body">

    <!-- ALERT -->
    <?php if($this->session->flashdata('success')) : ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- CARD -->
    <div class="card shadow-sm">

        <!-- CARD HEADER -->
        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>Daftar Customer</h4>

            <!-- FILTER -->
            <div class="d-flex gap-2">

                <select class="form-control" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="verified">Verified</option>
                    <option value="rejected">Rejected</option>
                </select>

            </div>

        </div>

        <!-- CARD BODY -->
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis ID</th>
                            <th>Nomor ID</th>
                            <th>Status Data</th>
                            <th>Verifikasi</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1; ?>
                        <?php foreach($customers as $customer) : ?>

                        <?php
                            // cek kelengkapan data
                            $is_complete = (
                                !empty($customer->tgl_lahir) &&
                                !empty($customer->jenis_kelamin) &&
                                !empty($customer->alamat) &&
                                !empty($customer->kota) &&
                                !empty($customer->provinsi) &&
                                !empty($customer->id_type) &&
                                !empty($customer->id_number)
                            );
                        ?>

                        <tr>

                            <!-- NO -->
                            <td><?= $no++; ?></td>

                            <!-- FOTO -->
                            <td>

                                <?php if($customer->foto_profil) : ?>

                                    <img 
                                        src="<?= base_url('uploads/profile/' . $customer->foto_profil); ?>"
                                        width="55"
                                        height="55"
                                        style="object-fit:cover; border-radius:50%;"
                                    >

                                <?php else : ?>

                                    <img 
                                        src="<?= base_url('assets/img/avatar/avatar-1.png'); ?>"
                                        width="55"
                                        height="55"
                                        style="object-fit:cover; border-radius:50%;"
                                    >

                                <?php endif; ?>

                            </td>

                            <!-- NAMA -->
                            <td>
                                <strong><?= $customer->nama_lengkap; ?></strong>
                            </td>

                            <!-- EMAIL -->
                            <td><?= $customer->email; ?></td>

                            <!-- JENIS ID -->
                            <td>
                                <?= strtoupper($customer->id_type); ?>
                            </td>

                            <!-- NOMOR ID -->
                            <td>
                                <?= $customer->id_number; ?>
                            </td>

                            <!-- STATUS DATA -->
                            <td>

                                <?php if($is_complete) : ?>

                                    <span class="badge badge-success">
                                        Lengkap
                                    </span>

                                <?php else : ?>

                                    <span class="badge badge-warning">
                                        Belum Lengkap
                                    </span>

                                <?php endif; ?>

                            </td>

                            <!-- STATUS VERIFIKASI -->
                            <td>

                                <?php if($customer->is_verified == 'pending') : ?>

                                    <span class="badge badge-warning">
                                        Pending
                                    </span>

                                <?php elseif($customer->is_verified == 'verified') : ?>

                                    <span class="badge badge-success">
                                        Verified
                                    </span>

                                <?php else : ?>

                                    <span class="badge badge-danger">
                                        Rejected
                                    </span>

                                <?php endif; ?>

                            </td>

                            <!-- AKSI -->
                            <td>

                                <!-- DETAIL -->
                                <a href="<?= base_url('admin/customer/detail/' . $customer->id); ?>"
                                   class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <!-- VERIFY -->
                                <?php if($customer->is_verified != 'verified') : ?>

                                <a href="<?= base_url('admin/customer/verify/' . $customer->id); ?>"
                                   class="btn btn-success btn-sm"
                                   onclick="return confirm('Verifikasi customer ini?')">

                                    <i class="fas fa-check"></i>

                                </a>

                                <?php endif; ?>

                                <!-- REJECT -->
                                <a href="<?= base_url('admin/customer/reject/' . $customer->id); ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Tolak customer ini?')">

                                    <i class="fas fa-times"></i>

                                </a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
                                </div>