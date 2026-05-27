<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1> Form Update Data Mobil</h1>
          </div>

          <div class="card"></div>
          <div class="card body">

          <?php foreach ($mobil as $m) : ?>
            <form method ="POST" action="<?php echo base_url('admin/data_mobil/update_mobil_aksi') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form group">
                        <label>Type Mobil</label>
                        <input type="Hidden" name="id_mobil" value="<?php echo $m->id_mobil ?>">
                        <select name="kode_type" class="form-control">
                            <option value="<?php echo $m->kode_type?>"><?php echo $m->kode_type?></option>
                            <?php foreach($type as $t) : ?>
                                <option value="<?php echo $t->kode_type ?>">
                                    <?php echo $t->nama_type ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('kode_type','<div class="text-small text-danger">','</div>') ?>
                    </div>
                    <div class="form group">
                        <label>Merk</label>
                        <input type="text" name="merk" class="form-control" value="<?php echo $m->merk ?>">
                        <?php echo form_error('merk','<div class="text-small text-danger">','</div>') ?>
                    </div>

                    <div class="form group">
                        <label>Nomor Plat</label>
                        <input type="text" name="no_plat" class="form-control" value="<?php echo $m->no_plat?>">
                        <?php echo form_error('no_plat','<div class="text-small text-danger">','</div>') ?>
                    </div>

                    <div class="form group">
                        <label>Warna</label>
                        <input type="text" name="warna" class="form-control" value = "<?php echo $m->warna?>">
                        <?php echo form_error('warna','<div class="text-small text-danger">','</div>') ?>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form group">
                        <label>Tahun</label>
                        <input type="text" name="tahun" class="form-control" value = "<?php echo $m->tahun ?>">
                        <?php echo form_error('tahun','<div class="text-small text-danger">','</div>') ?>
                    </div>

                    <div class="form group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option <?php if($m-> status == "1"){echo "selected = 'selected'";}
                            echo $m->status; ?> value = "1">Tersedia</option>
                            <option <?php if($m-> status == "0"){echo "selected = 'selected'";}
                            echo $m->status; ?> value = "0">Tidak Tersedia</option>
                        </select>
                        <?php echo form_error('status','<div class="text-small text-danger">','</div>') ?>
                    </div>
                    
                    <div class="form group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>

                </div>
            </div>
            </form>
            <?php endforeach; ?>
          </div>
</section>
</div>