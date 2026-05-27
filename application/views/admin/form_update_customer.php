<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Customer</h1>
          </div>
</section>
<?php foreach($customer as $c) : ?>
<form method="POST" action="<?php echo base_url('admin/data_customer/update_customer_aksi') ?>">

<div class="form-group">
    <label>Nama</label>
    <input type="hidden" name="id_customer" value="<?php echo $c->id_customer ?>">
    <input type="text" name="nama" class="form-control" value="<?php echo $c->nama ?>">
    <?php echo form_error('nama','<span class="text-small text-danger">','</span>') ?>
</div>

<div class="form-group">
    <label>Username</label>
    <input type="text" name="username" class="form-control" value="<?php echo $c->username ?>">
    <?php echo form_error('username','<span class="text-small text-danger">','</span>') ?>
</div>

<div class="form-group">
    <label>Alamat</label>
    <input type="text" name="alamat" class="form-control" value="<?php echo $c->alamat ?>">
    <?php echo form_error('alamat','<span class="text-small text-danger">','</span>') ?>
</div>

<div class="form-group">
    <label>Gender</label>
    <select class="form-control" name="gender">
        <option value="<?php echo $c->gender ?>"><?php echo $c->gender ?></option>
        <option value="laki-laki">laki-laki</option>
        <option value="perempuan">perempuan</option>
    </select>
    <?php echo form_error('gender','<span class="text-small text-danger">','</span>') ?>
</div>

<div class="form-group">
    <label>Nomor Telepon</label>
    <input type="text" name="nomor_telepon" class="form-control" value="<?php echo $c->nomor_telepon ?>">
    <?php echo form_error('nomor_telepon','<span class="text-small text-danger">','</span>') ?>
</div>

<div class="form-group">
    <label>Nomor KTP</label>
    <input type="text" name="no_ktp" class="form-control" value="<?php echo $c->no_ktp ?>">
    <?php echo form_error('no_ktp','<span class="text-small text-danger">','</span>') ?>
</div>

<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" value="<?php echo $c->password ?>">
    <?php echo form_error('password','<span class="text-small text-danger">','</span>') ?>
</div>

<button type="submit" class="btn btn-sm btn-primary">Submit</button>
<button type="reset" class="btn btn-sm btn-danger">Reset</button>


</form>
<?php endforeach; ?>
</div>