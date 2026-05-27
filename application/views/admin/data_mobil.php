<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Mobil</h1>
          </div>

          <a href="<?php echo base_url('admin/data_mobil/tambah_mobil') ?>" class="btn btn-primary mb-3">Tambah Data</a>

          <?php echo $this->session->flashdata('pesan') ?>

          <table class = "table table-hover table-striped table-bordered">
            <thead>
                <tr>
                <th class="text-center">No</th>
                <th class="text-center">Gambar</th>
                <th class="text-center">Type</th>
                <th class="text-center">Merk</th>
                <th class="text-center">Nomor Plat</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
</tr>
            </thead>
        <tbody>
            <?php
            $no = 1;
            foreach($mobil as $m): ?>
            <tr>
            <td class="text-center"><?php echo $no++ ?></td>
            <td class="text-center"> 
                <img width="60px" src="<?php echo base_url().'assets/upload/'.$m->gambar ?>">
            </td>
            <td class="text-center"><?php echo $m->kode_type ?></td>
            <td class="text-center"><?php echo $m->merk ?></td>
            <td class="text-center"><?php echo $m->no_plat ?></td>
            <td class="text-center"><?php
            if($m->status == "0"){
                echo "<span class = 'badge badge-danger'> Tidak Tersedia </span>";
            }else{
                echo "<span class = 'badge badge-primary'> Tersedia </span>";
            }
            ?></td>
            <td class="text-center">

                <a href="<?php echo base_url('admin/data_mobil/detail_mobil/').$m->id_mobil ?>"class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                <a href="<?php echo base_url('admin/data_mobil/delete_mobil/').$m->id_mobil ?>"class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                <a href="<?php echo base_url('admin/data_mobil/update_mobil/').$m->id_mobil ?>"class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

            
            <?php endforeach; ?>
            </td>
            </tr>
            </tbody>
            </table>
</section>
</div>