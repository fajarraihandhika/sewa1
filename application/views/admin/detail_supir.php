<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Detail Supir</h1>
          </div>
</section>
<?php foreach($detail as $d) : ?>
    <div class="card">
        <div class="card body">
            <div class="row">
                <div class="col-md-5">
                    <img width = 500px src="<?php echo base_url().'assets/upload/'.$d->foto ?>">
                </div>
                <div class="col-md-7">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td><?php echo $d->nama ?></td>
                        </tr>

                        <tr>
                            <td>Nomor Telepon</td>
                            <td><?php echo $d->no_telepon ?></td>
                        </tr>

                        <tr>
                            <td>Alamat</td>
                            <td><?php echo $d->alamat ?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                <?php
                                 if($d->status == "0") {
                                    echo "<span class='badge badge-danger'>Tidak Tersedia</span>";
                                 }else{
                                    echo "<span class='badge badge-primary'>Tersedia</span>";
                                 } ?></td>
                        </tr>
                    </table>

                    <a class="btn btn-sm btn-danger ml-4" href = "<?php echo base_url('admin/data_supir') ?>">Kembali </a>
                    <a class="btn btn-sm btn-primary" href = "<?php echo base_url('admin/data_supir/update_supir/' .$d->id_supir) ?>">Update </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>