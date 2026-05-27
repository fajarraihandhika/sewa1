<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Form Update Data Supir</h1>
        </div>

        <div class="card">
            <div class="card-body">

                <?php foreach ($supir as $s) : ?>

                    <form method="POST"
                          action="<?php echo base_url('admin/data_supir/update_supir_aksi') ?>"
                          enctype="multipart/form-data">

                        <input type="hidden"
                               name="id_supir"
                               value="<?php echo $s->id_supir ?>">

                        <div class="row">

                            <!-- KIRI -->
                            <div class="col-md-6">

                                <div class="form-group mb-3">
                                    <label>Nama Supir</label>
                                    <input type="text"
                                           name="nama"
                                           class="form-control"
                                           value="<?php echo $s->nama ?>">

                                    <?php echo form_error(
                                        'nama',
                                        '<div class="text-small text-danger">',
                                        '</div>'
                                    ) ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nomor Telepon</label>
                                    <input type="text"
                                           name="no_telepon"
                                           class="form-control"
                                           value="<?php echo $s->no_telepon ?>">

                                    <?php echo form_error(
                                        'no_telepon',
                                        '<div class="text-small text-danger">',
                                        '</div>'
                                    ) ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat"
                                              class="form-control"
                                              rows="4"><?php echo $s->alamat ?></textarea>

                                    <?php echo form_error(
                                        'alamat',
                                        '<div class="text-small text-danger">',
                                        '</div>'
                                    ) ?>
                                </div>

                            </div>

                            <!-- KANAN -->
                            <div class="col-md-6">

                                <div class="form-group mb-3">
                                    <label>Status</label>

                                    <select name="status" class="form-control">

                                        <option value="1"
                                            <?php echo ($s->status == "1") ? 'selected' : '' ?>>
                                            Tersedia
                                        </option>

                                        <option value="0"
                                            <?php echo ($s->status == "0") ? 'selected' : '' ?>>
                                            Tidak Tersedia
                                        </option>

                                    </select>

                                    <?php echo form_error(
                                        'status',
                                        '<div class="text-small text-danger">',
                                        '</div>'
                                    ) ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Foto Supir</label>

                                    <input type="file"
                                           name="foto"
                                           class="form-control">
                                </div>

                                <?php if ($s->foto != '') : ?>
                                    <div class="mb-3">
                                        <img src="<?php echo base_url('assets/upload/' . $s->foto) ?>"
                                             width="150"
                                             class="img-thumbnail">
                                    </div>
                                <?php endif; ?>

                                <button type="submit"
                                        class="btn btn-primary me-2">
                                    <i class="fas fa-save"></i> Simpan
                                </button>

                                <button type="reset"
                                        class="btn btn-danger">
                                    <i class="fas fa-redo"></i> Reset
                                </button>

                            </div>

                        </div>

                    </form>

                <?php endforeach; ?>

            </div>
        </div>

    </section>
</div>