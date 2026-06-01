<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Form Input Data Transaksi</h1>
        </div>

        <div class="section-body">

            <!-- ALERT ERROR -->
            <?php if($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="card">

                <div class="card-header">
                    <h4>Form Tambah Transaksi</h4>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('admin/transaksi/tambah_aksi'); ?>"
                          method="POST">

                        <div class="row">

                            <!-- CUSTOMER -->
                            <div class="form-group col-md-6">
                                <label>Customer</label>
                                <select name="id_customer" class="form-control" required>
                                    <option value="">-- Pilih Customer --</option>

                                    <?php foreach($customer as $c) : ?>
                                        <option value="<?= $c->id; ?>">
                                            <?= $c->nama_lengkap; ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <!-- MOBIL -->
                            <div class="form-group col-md-6">
                                <label>Mobil</label>
                                <select name="id_mobil" class="form-control" required>
                                    <option value="">-- Pilih Mobil --</option>

                                    <?php foreach($mobil as $m) : ?>
                                        <option value="<?= $m->id_mobil; ?>">
                                            <?= $m->merk; ?> - <?= $m->no_plat; ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <!-- TANGGAL RENTAL -->
                            <div class="form-group col-md-6">
                                <label>Tanggal Rental</label>
                                <input type="date"
                                       name="tanggal_rental"
                                       class="form-control"
                                       required>
                            </div>

                            <!-- TANGGAL KEMBALI -->
                            <div class="form-group col-md-6">
                                <label>Tanggal Kembali</label>
                                <input type="date"
                                       name="tanggal_kembali"
                                       class="form-control"
                                       required>
                            </div>

                        </div>

                        <div class="text-right">

                            <a href="<?= base_url('admin/transaksi'); ?>"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="fas fa-save"></i>
                                Simpan Transaksi

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>
</div>