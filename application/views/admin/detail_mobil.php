<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Detail Mobil</h1>
          </div>
</section>
<?php foreach($detail as $d) : ?>
    <div class="card">
        <div class="card body">
            <div class="row">
                <div class="col-md-5">
                    <img width = 500px src="<?php echo base_url().'assets/upload/'.$d->gambar ?>">
                </div>
                <div class="col-md-7">
                    <table class="table">
                        <tr>
                            <td>Type Mobil</td>
                            <td>
                            <?php
                            if($d->kode_type == "SDN"){
                                echo "Sedan";
                            }elseif($d->kode_type == "HTB"){
                                echo "HatchBack";
                            }elseif($d->kode_type == "MPV"){
                                echo "Multi Purpose Vehicle";
                            }else{
                                echo "<span class='text-danger'>Type Not yet</span>";
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td><?php echo $d->merk ?></td>
                        </tr>

                        <tr>
                            <td>Nomor Plat</td>
                            <td><?php echo $d->no_plat ?></td>
                        </tr>

                        <tr>
                            <td>Warna</td>
                            <td><?php echo $d->warna ?></td>
                        </tr>

                        <tr>
                            <td>Tahun</td>
                            <td><?php echo $d->tahun ?></td>
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

                    <a class="btn btn-sm btn-danger ml-4" href = "<?php echo base_url('admin/data_mobil') ?>">Kembali </a>
                    <a class="btn btn-sm btn-primary" href = "<?php echo base_url('admin/data_mobil/update_mobil/' .$d->id_mobil) ?>">Update </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>