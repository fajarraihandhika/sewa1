<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Hasil Search</h1>
    </div>

    <div class="section-body">

        <div class="card">
            <div class="card-header">
                <h4>Keyword: "<?= $keyword ?>"</h4>
            </div>

            <div class="card-body">

                <?php if(empty($mobil) && empty($sopir) && empty($pelanggan) && empty($transaksi)): ?>

                    <div class="alert alert-warning text-center">
                        Data dengan keyword <b>"<?= $keyword ?>"</b> tidak ditemukan.
                    </div>

                <?php endif; ?>


                <?php if(!empty($mobil)): ?>
                    <h5>Data Mobil</h5>

                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Merk</th>
                                <th>No Plat</th>
                                <th>Harga</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($mobil as $m): ?>
                            <tr>
                                <td><?= $m->merk ?></td>
                                <td><?= $m->no_plat ?></td>
                                <td>Rp <?= number_format($m->harga, 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>


                <?php if(!empty($sopir)): ?>
                    <h5>Data Sopir</h5>

                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($sopir as $s): ?>
                            <tr>
                                <td><?= $s->nama ?></td>
                                <td><?= $s->no_telepon ?></td>
                                <td><?= $s->alamat ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>


                <?php if(!empty($pelanggan)): ?>
                    <h5>Data Pelanggan</h5>

                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($pelanggan as $p): ?>
                            <tr>
                                <td><?= $p->nama_lengkap ?></td>
                                <td><?= $p->email ?></td>
                                <td><?= $p->no_hp ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>


                <?php if(!empty($transaksi)): ?>
                    <h5>Data Transaksi</h5>

                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>ID Rental</th>
                                <th>Customer</th>
                                <th>Mobil</th>
                                <th>No Plat</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($transaksi as $t): ?>
                            <tr>
                                <td><?= $t->id_rental ?></td>
                                <td><?= $t->nama_lengkap ?></td>
                                <td><?= $t->merk ?></td>
                                <td><?= $t->no_plat ?></td>
                                <td><?= $t->status_rental ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>
        </div>

    </div>

</section>
</div>