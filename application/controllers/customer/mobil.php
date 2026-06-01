<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rental_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') != 'customer') {
            redirect('auth/login');
        }
    }

    /* ==================== DAFTAR MOBIL ==================== */
    public function index()
    {
        $id_user    = $this->session->userdata('id_user');
        $customer   = $this->rental_model->get_profil($id_user);
        $total_sewa = $this->rental_model->hitung_total_sewa($id_user);

        // Cek profil & verifikasi
        $profil_lengkap = !empty($customer) && !empty($customer->id_number) && !empty($customer->nomor_sim);
        $is_verified    = !empty($customer) && $customer->is_verified == 'verified';

        if (!$profil_lengkap || !$is_verified) {
            redirect('customer/profil');
        }

        $data = [
            'mobil'              => $this->rental_model->filtermobil(),
            'type'               => $this->rental_model->get_data('type')->result(),
            'customer'           => $customer,
            'total_sewa'         => $total_sewa,
            'is_pelanggan_lama'  => $total_sewa > 5,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/mobil/index', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== DETAIL MOBIL (AJAX) ==================== */
    public function detail($id)
    {
        $mobil = $this->rental_model->get_detail_mobil($id);
        header('Content-Type: application/json');
        echo json_encode($mobil);
        exit;
    }

    /* ==================== FORM PESAN (AJAX) ==================== */
    public function form_pesan($id)
    {
        $id_user    = $this->session->userdata('id_user');
        $total_sewa = $this->rental_model->hitung_total_sewa($id_user);
        $mobil      = $this->rental_model->get_detail_mobil($id);
        $supir      = ($total_sewa > 5) ? $this->rental_model->get_supir_tersedia() : [];

        $data = [
            'mobil' => $mobil,
            'supir' => $supir,
            'is_pelanggan_lama' => $total_sewa > 5,
        ];

        // Return JSON untuk dirender di modal
        header('Content-Type: application/json');
        echo json_encode([
            'mobil' => $mobil,
            'supir' => $supir,
            'is_pelanggan_lama' => $total_sewa > 5,
        ]);
        exit;
    }

    /* ==================== SUBMIT PEMESANAN ==================== */
    public function pesan()
    {
        header('Content-Type: application/json');
        $id_user = $this->session->userdata('id_user');

        $id_mobil       = $this->input->post('id_mobil');
        $tanggal_rental = $this->input->post('tanggal_rental');
        $tanggal_kembali = $this->input->post('tanggal_kembali');
        $id_supir       = $this->input->post('id_supir') ?: null;
        $catatan        = $this->input->post('catatan');

        // Validasi field
        if (empty($id_mobil) || empty($tanggal_rental) || empty($tanggal_kembali)) {
            echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi.']);
            return;
        }

        // Validasi tanggal
        if ($tanggal_kembali <= $tanggal_rental) {
            echo json_encode(['status' => 'error', 'message' => 'Tanggal kembali harus setelah tanggal sewa.']);
            return;
        }

        // Cek ketersediaan mobil
        if (!$this->rental_model->cek_mobil_tersedia($id_mobil, $tanggal_rental, $tanggal_kembali)) {
            echo json_encode(['status' => 'error', 'message' => 'Mobil tidak tersedia di tanggal tersebut.']);
            return;
        }

        // Hitung total harga
        $mobil  = $this->rental_model->get_detail_mobil($id_mobil);
        $selisih = (strtotime($tanggal_kembali) - strtotime($tanggal_rental)) / 86400;
        $total_harga = $selisih * $mobil->harga;

        // Harga supir (jika ada) — misal Rp 150.000/hari
        if ($id_supir) {
            $total_harga += $selisih * 150000;
        }

        $data = [
            'id_customer'     => $id_user,
            'id_mobil'        => $id_mobil,
            'id_supir'        => $id_supir,
            'tanggal_rental'  => $tanggal_rental,
            'tanggal_kembali' => $tanggal_kembali,
            'total_harga'     => $total_harga,
            'catatan'         => $catatan,
            'status_rental'   => 0, // pending
            'status_pengembalian' => 0,
        ];

        if ($this->rental_model->buat_transaksi($data)) {
            echo json_encode([
                'status'   => 'success',
                'message'  => 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.',
                'redirect' => base_url('customer/transaksi'),
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan pesanan. Coba lagi.']);
        }
    }
}