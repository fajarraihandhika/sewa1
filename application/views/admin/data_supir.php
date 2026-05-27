<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Supir</h1>
          </div>

          <a href="<?php echo base_url('admin/data_supir/tambah_supir') ?>" class="btn btn-primary mb-3">Tambah Data</a>

          <?php echo $this->session->flashdata('pesan') ?>

          <table class = "table table-hover table-striped table-bordered">
            <thead>
                <tr>
                <th class="text-center">No</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Nomor Telepon</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
</tr>
            </thead>
        <tbody>
            <?php
            $no = 1;
            foreach($supir as $s): ?>
            <tr>
            <td class="text-center"><?php echo $no++ ?></td>
            <td class="text-center"> 
                <img width="60px" src="<?php echo base_url().'assets/upload/'.$s->foto ?>">
            </td>
            <td class="text-center"><?php echo $s->nama ?></td>
            <td class="text-center"><?php echo $s->no_telepon ?></td>
            <td class="text-center"><?php echo $s->alamat ?></td>
            <td class="text-center"><?php
            if($s->status == "0"){
                echo "<span class = 'badge badge-danger'> Tidak Tersedia </span>";
            }else{
                echo "<span class = 'badge badge-primary'> Tersedia </span>";
            }
            ?></td>
            <td class="text-center">

                <a href="<?php echo base_url('admin/data_supir/detail_supir/').$s->id_supir ?>"class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                <a href="<?php echo base_url('admin/data_supir/delete_supir/').$s->id_supir ?>"class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                <a href="<?php echo base_url('admin/data_supir/update_supir/').$s->id_supir ?>"class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

            
            <?php endforeach; ?>
            </td>
            </tr>
            </tbody>
            </table>
</section>
</div>