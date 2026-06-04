<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rental_model');
        $this->load->library(['session', 'upload']);

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') != 'customer') {
            redirect('auth/login');
        }
    }

    /* ==================== 1. HALAMAN UTAMA PROFIL (READ-ONLY) ==================== */
    public function index()
    {
        $id_user  = $this->session->userdata('id_user');
        
        // 1. Ambil data customer melalui model
        $customer = $this->Rental_model->get_profil($id_user);
        
        // 2. Ambil data user dari tabel users (ini yang dibutuhkan untuk no_hp)
        $user = $this->db->get_where('users', ['id' => $id_user])->row();
        
        // 3. Logika default jika customer belum ada
        if (!$customer) {
            $customer = (object)[
                'nama_lengkap'  => $this->session->userdata('nama_lengkap'),
                'no_hp'         => '', // Jika di masa depan no_hp pindah ke tabel customer
                'tgl_lahir'     => '',
                'jenis_kelamin' => '',
                'alamat'        => '',
                'kota'          => '',
                'provinsi'      => '',
                'id_type'       => '',
                'id_number'     => '',
                'nomor_sim'     => '',
                'foto_profil'   => '',
                'foto_id'       => '',
                'foto_sim'      => '',
                'is_verified'   => 'unverified'
            ];
        }
        
        $total_sewa = $this->Rental_model->hitung_total_sewa($id_user);
    
        // 4. Gabungkan semua data menjadi satu array tanpa menimpa (menggunakan assignment key)
        $data['user']              = $user;
        $data['customer']          = $customer;
        $data['total_sewa']        = $total_sewa;
        $data['is_pelanggan_lama'] = $total_sewa > 5;
    
        // 5. Kirim ke view
        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/profil/index', $data); 
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== 2. HALAMAN FORM INPUT (MODE EDIT) ==================== */
    public function edit()
    {
        $id_user  = $this->session->userdata('id_user');
        $customer = $this->Rental_model->get_profil($id_user);

        if (!$customer) {
            $customer = (object)[
                'nama_lengkap'  => $this->session->userdata('nama_lengkap'),
                'no_hp'         => '',
                'tgl_lahir'     => '',
                'jenis_kelamin' => '',
                'alamat'        => '',
                'kota'          => '',
                'provinsi'      => '',
                'id_type'       => '',
                'id_number'     => '',
                'nomor_sim'     => '',
                'foto_profil'   => '',
                'foto_id'       => '',
                'foto_sim'      => '',
                'is_verified'   => 'unverified'
            ];
        }
        $total_sewa = $this->Rental_model->hitung_total_sewa($id_user);

        $data = [
            'customer'          => $customer,
            'total_sewa'        => $total_sewa,
            'is_pelanggan_lama' => $total_sewa > 5,
        ];

        // Memanggil View Form Edit (File modifikasi kode Anda)
        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/profil/edit', $data); 
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== 3. PROSES SIMPAN DATA (AJAX) ==================== */
   public function simpan() 
{
    // Cek apakah request berasal dari AJAX
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    header('Content-Type: application/json');
    $id_user = $this->session->userdata('id_user');
    
    // 1. Coba ambil profil lama (bisa null jika user baru pertama kali isi)
    $profil_lama = $this->Rental_model->get_profil($id_user);
    $is_update = ($profil_lama !== null);
    
    // 2. Data dari form untuk tabel 'users'
    $data_user = [
        'nama_lengkap' => $this->input->post('nama_lengkap'),
        'no_hp'        => $this->input->post('no_hp')
    ];

    // 3. Data dari form untuk tabel 'customers'
    $data_customer = [
        'tgl_lahir'     => $this->input->post('tgl_lahir'),
        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        'alamat'        => $this->input->post('alamat'),
        'kota'          => $this->input->post('kota'),
        'provinsi'      => $this->input->post('provinsi'),
        'id_type'       => $this->input->post('id_type'),
        'id_number'     => $this->input->post('id_number'),
        'nomor_sim'     => $this->input->post('nomor_sim'),
    ];

    $ada_dokumen_baru = false;
    $upload_path_utama  = './assets/upload/';
    $upload_path_profil = './assets/upload/profil/';

    // Buat folder jika belum ada
    if (!is_dir($upload_path_utama)) mkdir($upload_path_utama, 0755, true);
    if (!is_dir($upload_path_profil)) mkdir($upload_path_profil, 0755, true);

    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['max_size']      = 2048;

    // 4. Upload Foto Profil
    if (!empty($_FILES['foto_profil']['name'])) {
        $config['upload_path'] = $upload_path_profil;
        $config['file_name']   = 'avatar_' . $id_user . '_' . time();
        $this->upload->initialize($config);
        if ($this->upload->do_upload('foto_profil')) {
            $data_customer['foto_profil'] = $this->upload->data('file_name');
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
            return;
        }
    }

    // 5. Upload KTP
    if (!empty($_FILES['foto_id']['name'])) {
        $config['upload_path'] = $upload_path_utama;
        $config['file_name']   = 'ktp_' . $id_user . '_' . time();
        $this->upload->initialize($config);
        if ($this->upload->do_upload('foto_id')) {
            $data_customer['foto_id'] = $this->upload->data('file_name');
            $ada_dokumen_baru = true;
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
            return;
        }
    }

    // 6. Upload SIM
    if (!empty($_FILES['foto_sim']['name'])) {
        $config['upload_path'] = $upload_path_utama;
        $config['file_name']   = 'sim_' . $id_user . '_' . time();
        $this->upload->initialize($config);
        if ($this->upload->do_upload('foto_sim')) {
            $data_customer['foto_sim'] = $this->upload->data('file_name');
            $ada_dokumen_baru = true;
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
            return;
        }
    }

    // 7. Logika Status Verifikasi
    $status_lama = $is_update ? $profil_lama->is_verified : 'unverified';
    $ktp_lama    = $is_update ? $profil_lama->id_number : '';
    $sim_lama    = $is_update ? $profil_lama->nomor_sim : '';

    if ($ada_dokumen_baru || ($ktp_lama !== $data_customer['id_number']) || ($sim_lama !== $data_customer['nomor_sim']) || $status_lama !== 'verified') {
        $data_customer['is_verified'] = 'pending';
        $pesan_sukses = 'Profil & dokumen berhasil diperbarui! Mohon tunggu verifikasi admin.';
    } else {
        $data_customer['is_verified'] = $status_lama;
        $pesan_sukses = 'Data pribadi berhasil diperbarui!';
    }

    // 8. Eksekusi Database
    $this->Rental_model->update_user($id_user, $data_user);
    
    if ($is_update) {
        // Update data customer yang sudah ada
        $this->db->where('user_id', $id_user);
        $this->db->update('customers', $data_customer);
    } else {
        // Simpan data customer baru
        $data_customer['user_id'] = $id_user;
        $this->db->insert('customers', $data_customer);
    }

    $this->session->set_userdata('nama_lengkap', $data_user['nama_lengkap']);

    echo json_encode([
        'status'  => 'success', 
        'message' => $pesan_sukses
    ]);
}
    /* ==================== HELPER UPLOAD (PRIVATE) ==================== */
    private function _upload_foto($field, $prefix = '')
    {
        if (strpos($prefix, 'ktp') !== false) {
            $subfolder = 'ktp';
        } elseif (strpos($prefix, 'sim') !== false) {
            $subfolder = 'sim';
        } else {
            $subfolder = 'profil';
        }

        $upload_path = './assets/upload/' . $subfolder;

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp',
            'max_size'      => 2048,
            'file_name'     => $prefix . $this->session->userdata('id_user') . '_' . time(),
            'overwrite'     => TRUE,
        ];

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field)) {
            return ['status' => 'error', 'message' => $this->upload->display_errors('', '')];
        }

        return [
            'status'    => 'success',
            'nama_file' => $subfolder . '/' . $this->upload->data('file_name'),
        ];
    }
}