<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1> Form Input Data Customer</h1>
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
            <h4>Form Tambah Customer</h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url('admin/customer/simpan'); ?>" 
                  method="POST"
                  enctype="multipart/form-data">

                <div class="row">

                    <!-- NAMA -->
                    <div class="form-group col-md-6">

                        <label>Nama Lengkap</label>

                        <input type="text"
                               name="nama_lengkap"
                               class="form-control"
                               required>

                    </div>

                    <!-- EMAIL -->
                    <div class="form-group col-md-6">

                        <label>Email</label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               required>

                    </div>

                    <!-- NO HP -->
                    <div class="form-group col-md-6">

                        <label>No HP</label>

                        <input type="text"
                               name="no_hp"
                               class="form-control"
                               required>

                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group col-md-6">

                        <label>Password</label>

                        <input type="password"
                               name="password"
                               class="form-control"
                               required>

                    </div>

                    <!-- TANGGAL LAHIR -->
                    <div class="form-group col-md-6">

                        <label>Tanggal Lahir</label>

                        <input type="date"
                               name="tgl_lahir"
                               class="form-control">

                    </div>

                    <!-- JENIS KELAMIN -->
                    <div class="form-group col-md-6">

                        <label>Jenis Kelamin</label>

                        <select name="jenis_kelamin"
                                class="form-control">

                            <option value="">-- Pilih --</option>

                            <option value="Laki-laki">
                                Laki-laki
                            </option>

                            <option value="Perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>

                    <!-- ALAMAT -->
                    <div class="form-group col-md-12">

                        <label>Alamat</label>

                        <textarea name="alamat"
                                  class="form-control"
                                  rows="4"></textarea>

                    </div>

                    <!-- KOTA -->
                    <div class="form-group col-md-6">

                        <label>Kota</label>

                        <input type="text"
                               name="kota"
                               class="form-control">

                    </div>

                    <!-- PROVINSI -->
                    <div class="form-group col-md-6">

                        <label>Provinsi</label>

                        <input type="text"
                               name="provinsi"
                               class="form-control">

                    </div>

                    <!-- JENIS ID -->
                    <div class="form-group col-md-6">

                        <label>Jenis ID</label>

                        <select name="id_type"
                                class="form-control">

                            <option value="">-- Pilih --</option>

                            <option value="ktp">
                                KTP
                            </option>

                            <option value="sim">
                                SIM
                            </option>

                            <option value="paspor">
                                Paspor
                            </option>

                        </select>

                    </div>

                    <!-- NOMOR ID -->
                    <div class="form-group col-md-6">

                        <label>Nomor ID</label>

                        <input type="text"
                               name="id_number"
                               class="form-control">

                    </div>

                    <!-- NOMOR SIM -->
                    <div class="form-group col-md-6">

                        <label>Nomor SIM</label>

                        <input type="text"
                               name="nomor_sim"
                               class="form-control">

                    </div>

                    <!-- FOTO PROFIL -->
                    <div class="form-group col-md-6">

                        <label>Foto Profil</label>

                        <input type="file"
                               name="foto_profil"
                               class="form-control">

                    </div>

                    <!-- FOTO ID -->
                    <div class="form-group col-md-6">

                        <label>Foto ID</label>

                        <input type="file"
                               name="foto_id"
                               class="form-control">

                    </div>

                    <!-- FOTO SIM -->
                    <div class="form-group col-md-6">

                        <label>Foto SIM</label>

                        <input type="file"
                               name="foto_sim"
                               class="form-control">

                    </div>

                </div>

                <div class="text-right">

                    <a href="<?= base_url('admin/customer'); ?>"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save"></i>
                        Simpan Customer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>