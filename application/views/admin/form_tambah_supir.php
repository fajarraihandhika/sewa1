<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1> Form Input Data Supir</h1>
          </div>

          <div class="card"></div>
          <div class="card body">
            <form method ="POST" action="<?php echo base_url('admin/data_supir/tambah_supir_aksi') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control">
                        <?php echo form_error('nama','<div class="text-small text-danger">','</div>') ?>
                    </div>

                    <div class="form group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="no_telepon" class="form-control">
                        <?php echo form_error('no_telepon','<div class="text-small text-danger">','</div>') ?>
                    </div>

                    <div class="form group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                        <?php echo form_error('alamat','<div class="text-small text-danger">','</div>') ?>
                    </div>

                    <div class="form group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">--Pilih Status--</option>
                            <option value="1">Tersedia</option>
                            <option value="0">Digunakan</option>
                        </select>
                        <?php echo form_error('status','<div class="text-small text-danger">','</div>') ?>
                    </div>
                    
                    <div class="form group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>

                </div>
            </div>
            </form>
          </div>
</section>
</div>