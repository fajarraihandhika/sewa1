<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rental_model');
        $this->load->library(['session', 'upload']);

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') != 'customer') {
            redirect('auth/login');
        }
    }

    /* ==================== HALAMAN PROFIL ==================== */
    public function index()
    {
        $id_user  = $this->session->userdata('id_user');
        $customer = $this->rental_model->get_profil($id_user);
        $total_sewa = $this->rental_model->hitung_total_sewa($id_user);

        $data = [
            'customer'   => $customer,
            'total_sewa' => $total_sewa,
            'is_pelanggan_lama' => $total_sewa > 5,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/profil/index', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== SIMPAN PROFIL ==================== */
    public function simpan()
    {
        header('Content-Type: application/json');
        $id_user = $this->session->userdata('id_user');

        // Update tabel users
        $data_user = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'no_hp'        => $this->input->post('no_hp'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];
        $this->rental_model->update_user($id_user, $data_user);

        // Update session nama
        $this->session->set_userdata('nama_lengkap', $this->input->post('nama_lengkap'));

        // Data customers
        $data_customer = [
            'tgl_lahir'     => $this->input->post('tgl_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat'        => $this->input->post('alamat'),
            'kota'          => $this->input->post('kota'),
            'provinsi'      => $this->input->post('provinsi'),
            'id_type'       => $this->input->post('id_type'),
            'id_number'     => $this->input->post('id_number'),
            'nomor_sim'     => $this->input->post('nomor_sim'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Upload foto profil
        if (!empty($_FILES['foto_profil']['name'])) {
            $upload = $this->_upload_foto('foto_profil', 'profil_');
            if ($upload['status'] == 'error') {
                echo json_encode($upload); return;
            }
            $data_customer['foto_profil'] = $upload['nama_file'];
        }

        // Upload foto KTP
        if (!empty($_FILES['foto_id']['name'])) {
            $upload = $this->_upload_foto('foto_id', 'ktp_');
            if ($upload['status'] == 'error') {
                echo json_encode($upload); return;
            }
            $data_customer['foto_id'] = $upload['nama_file'];
        }

        // Upload foto SIM
        if (!empty($_FILES['foto_sim']['name'])) {
            $upload = $this->_upload_foto('foto_sim', 'sim_');
            if ($upload['status'] == 'error') {
                echo json_encode($upload); return;
            }
            $data_customer['foto_sim'] = $upload['nama_file'];
        }

        // Jika data berubah, reset verifikasi
        $reset_fields = ['id_number', 'nomor_sim', 'foto_id', 'foto_sim'];
        $perlu_reverifikasi = false;
        foreach ($reset_fields as $f) {
            if (isset($data_customer[$f])) {
                $perlu_reverifikasi = true;
                break;
            }
        }
        if ($perlu_reverifikasi) {
            $data_customer['is_verified'] = 0;
        }

        $this->rental_model->simpan_profil($id_user, $data_customer);

        echo json_encode([
            'status'  => 'success',
            'message' => 'Profil berhasil disimpan' . ($perlu_reverifikasi ? '. Menunggu verifikasi ulang admin.' : '.')
        ]);
    }

    /* ==================== HELPER UPLOAD ==================== */
    private function _upload_foto($field, $prefix = '')
    {
        $config = [
            'upload_path'   => './assets/upload/',
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
            'status'     => 'success',
            'nama_file'  => $this->upload->data('file_name'),
        ];
    }
}