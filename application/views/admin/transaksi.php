<div class="main-content">
    <section class="section">

```
    <div class="section-header">
        <h1>Data Transaksi</h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <div class="section-body">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h4>Daftar Transaksi Rental</h4>

                <a href="<?= base_url('admin/transaksi/tambah'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Transaksi
                </a>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped table-hover align-middle">

                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>ID Rental</th>
                                <th>Customer</th>
                                <th>Mobil</th>
                                <th>No Plat</th>
                                <th>Tgl Rental</th>
                                <th>Tgl Kembali</th>
                                <th>Tgl Pengembalian</th>
                                <th>Status Rental</th>
                                <th>Status Pengembalian</th>
                                <th width="18%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php
                        $no = 1;
                        foreach($transaksi as $tr) :
                        ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td>
                                    <?= $tr->id_rental ?>
                                </td>

                                <td>
                                    <?= $tr->nama_lengkap ?>
                                </td>

                                <td>
                                    <?= $tr->merk ?>
                                </td>

                                <td>
                                    <?= $tr->no_plat ?>
                                </td>

                                <td>
                                    <?= date('d-m-Y', strtotime($tr->tanggal_rental)) ?>
                                </td>

                                <td>
                                    <?= date('d-m-Y', strtotime($tr->tanggal_kembali)) ?>
                                </td>

                                <td>
                                    <?php if($tr->tanggal_pengembalian == '0000-00-00' || empty($tr->tanggal_pengembalian)) : ?>

                                        <span class="badge badge-secondary">
                                            Belum Kembali
                                        </span>

                                    <?php else : ?>

                                        <?= date('d-m-Y', strtotime($tr->tanggal_pengembalian)) ?>

                                    <?php endif; ?>
                                </td>

                                <td>

                                    <?php if($tr->status_rental == 'Berjalan') : ?>

                                        <span class="badge badge-primary">
                                            Berjalan
                                        </span>

                                    <?php elseif($tr->status_rental == 'Selesai') : ?>

                                        <span class="badge badge-success">
                                            Selesai
                                        </span>

                                    <?php else : ?>

                                        <span class="badge badge-danger">
                                            <?= $tr->status_rental ?>
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?php if($tr->status_pengembalian == 'Sudah Kembali') : ?>

                                        <span class="badge badge-success">
                                            Sudah Kembali
                                        </span>

                                    <?php else : ?>

                                        <span class="badge badge-warning">
                                            Belum Kembali
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <!-- Detail -->
                                    <a href="<?= base_url('admin/transaksi/detail/'.$tr->id_rental) ?>"
                                       class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <!-- Pengembalian -->
                                    <?php if($tr->status_pengembalian != 'Sudah Kembali') : ?>

                                    <a href="<?= base_url('admin/transaksi/pengembalian/'.$tr->id_rental) ?>"
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Konfirmasi pengembalian mobil?')">

                                        <i class="fas fa-undo"></i>

                                    </a>

                                    <?php endif; ?>

                                    <!-- Hapus -->
                                    <a href="<?= base_url('admin/transaksi/hapus/'.$tr->id_rental) ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin hapus transaksi ini?')">

                                        <i class="fas fa-trash"></i>

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

</section>
```

</div>
