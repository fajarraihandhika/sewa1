<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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

    /* ==================== RIWAYAT TRANSAKSI ==================== */
    public function index()
    {
        $id_user    = $this->session->userdata('id_user');
        $status     = $this->input->get('status');
        $total_sewa = $this->rental_model->hitung_total_sewa($id_user);
        $customer   = $this->rental_model->get_profil($id_user);

        $data = [
            'transaksi'          => $this->rental_model->get_transaksi_customer($id_user, $status),
            'customer'           => $customer,
            'total_sewa'         => $total_sewa,
            'is_pelanggan_lama'  => $total_sewa > 5,
            'status_filter'      => $status,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/transaksi/index', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== DETAIL TRANSAKSI ==================== */
    public function detail($id_rental)
    {
        $id_user    = $this->session->userdata('id_user');
        $total_sewa = $this->rental_model->hitung_total_sewa($id_user);
        $customer   = $this->rental_model->get_profil($id_user);
        $transaksi  = $this->rental_model->get_detail_transaksi($id_rental, $id_user);

        if (!$transaksi) {
            redirect('customer/transaksi');
        }

        $data = [
            'transaksi'          => $transaksi,
            'customer'           => $customer,
            'total_sewa'         => $total_sewa,
            'is_pelanggan_lama'  => $total_sewa > 5,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/transaksi/detail', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== BATALKAN TRANSAKSI ==================== */
    public function batal($id_rental)
    {
        header('Content-Type: application/json');
        $id_user   = $this->session->userdata('id_user');
        $transaksi = $this->rental_model->get_detail_transaksi($id_rental, $id_user);

        if (!$transaksi) {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak ditemukan.']);
            return;
        }

        // Hanya bisa batal kalau masih pending
        if ($transaksi->status_rental != 0) {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak bisa dibatalkan.']);
            return;
        }

        $this->rental_model->update_data(
            'transaksi',
            ['status_rental' => 3],
            ['id_rental' => $id_rental]
        );

        echo json_encode([
            'status'   => 'success',
            'message'  => 'Pesanan berhasil dibatalkan.',
            'redirect' => base_url('customer/transaksi'),
        ]);
    }
}