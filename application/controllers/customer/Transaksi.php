<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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

    /* ==================== RIWAYAT ==================== */
    public function index()
    {
        $id_user    = $this->session->userdata('id_user');
        $status     = $this->input->get('status');
        $total_sewa = $this->Rental_model->hitung_total_sewa($id_user);
        $customer   = $this->Rental_model->get_profil($id_user);

        $data = [
            'transaksi'         => $this->Rental_model->get_transaksi_customer($id_user, $status),
            'customer'          => $customer,
            'total_sewa'        => $total_sewa,
            'is_pelanggan_lama' => $total_sewa > 5,
            'status_filter'     => $status,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/transaksi/index', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== DETAIL ==================== */
    public function detail($id_rental)
    {
        $id_user   = $this->session->userdata('id_user');
        $customer  = $this->Rental_model->get_profil($id_user);
        $transaksi = $this->Rental_model->get_detail_transaksi($id_rental, $id_user);

        if (!$transaksi) redirect('customer/transaksi');

        $total_sewa = $this->Rental_model->hitung_total_sewa($id_user);

        $data = [
            'transaksi'         => $transaksi,
            'customer'          => $customer,
            'total_sewa'        => $total_sewa,
            'is_pelanggan_lama' => $total_sewa > 5,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/transaksi/detail', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== HALAMAN BAYAR (TRANSFER) ==================== */
    public function bayar($id_rental)
    {
        $id_user   = $this->session->userdata('id_user');
        $transaksi = $this->Rental_model->get_detail_transaksi($id_rental, $id_user);
        $customer  = $this->Rental_model->get_profil($id_user);

        if (!$transaksi) redirect('customer/transaksi');

        // Kalau bukan transfer, arahkan ke halaman yang sesuai
        if ($transaksi->metode_bayar === 'tunai') {
            redirect('customer/transaksi/konfirmasi_tunai/' . $id_rental);
        }

        // Sudah upload bukti, tidak perlu ke sini lagi
        if ($transaksi->status_bayar >= 1) {
            redirect('customer/transaksi/detail/' . $id_rental);
        }

        $total_sewa = $this->Rental_model->hitung_total_sewa($id_user);

        $data = [
            'transaksi'         => $transaksi,
            'customer'          => $customer,
            'total_sewa'        => $total_sewa,
            'is_pelanggan_lama' => $total_sewa > 5,
            'rekening' => [
                'bank'      => 'BCA',
                'nomor'     => '1234567890',
                'atas_nama' => 'DriveEase Indonesia',
            ],
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/transaksi/bayar', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== HALAMAN KONFIRMASI TUNAI ==================== */
    public function konfirmasi_tunai($id_rental)
    {
        $id_user   = $this->session->userdata('id_user');
        $transaksi = $this->Rental_model->get_detail_transaksi($id_rental, $id_user);
        $customer  = $this->Rental_model->get_profil($id_user);

        if (!$transaksi) redirect('customer/transaksi');

        // Kalau bukan tunai, arahkan ke halaman transfer
        if ($transaksi->metode_bayar === 'transfer') {
            redirect('customer/transaksi/bayar/' . $id_rental);
        }

        $total_sewa = $this->Rental_model->hitung_total_sewa($id_user);

        $data = [
            'transaksi'         => $transaksi,
            'customer'          => $customer,
            'total_sewa'        => $total_sewa,
            'is_pelanggan_lama' => $total_sewa > 5,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/transaksi/konfirmasi_tunai', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== UPLOAD BUKTI BAYAR ==================== */
    public function upload_bukti($id_rental)
    {
       

        $id_user   = $this->session->userdata('id_user');
        $transaksi = $this->Rental_model->get_detail_transaksi($id_rental, $id_user);

        if (!$transaksi) {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak ditemukan.']);
            return;
        }

        if (empty($_FILES['bukti_pembayaran']['name'])) {
            echo json_encode(['status' => 'error', 'message' => 'File bukti pembayaran wajib diupload.']);
            return;
        }

        $config = [
            'upload_path'   => './assets/upload/',
            'allowed_types' => 'jpg|jpeg|png|pdf',
            'max_size'      => 2048,
            'file_name'     => 'bukti_' . $id_rental . '_' . time(),
            'overwrite'     => TRUE,
        ];

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('bukti_pembayaran')) {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
            return;
        }

        $nama_file = $this->upload->data('file_name');

        $this->Rental_model->update_data(
            'transaksi',
            [
                'bukti_pembayaran' => $nama_file,
                'status_bayar'     => 1,
            ],
            ['id_rental' => $id_rental]
        );

        echo json_encode([
            'status'   => 'success',
            'message'  => 'Bukti pembayaran berhasil diupload! Menunggu konfirmasi admin.',
            'redirect' => base_url('customer/transaksi/detail/' . $id_rental),
        ]);
    }

    /* ==================== BATAL ==================== */
    public function batal($id_rental)
    {
        header('Content-Type: application/json');
        $id_user   = $this->session->userdata('id_user');
        $transaksi = $this->Rental_model->get_detail_transaksi($id_rental, $id_user);

        if (!$transaksi) {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak ditemukan.']);
            return;
        }

        if ($transaksi->status_rental != 'pending') {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak bisa dibatalkan.']);
            return;
        }

        $this->Rental_model->update_data(
            'transaksi',
            ['status_rental' => 'ditolak'],
            ['id_rental' => $id_rental]
        );

        echo json_encode([
            'status'   => 'success',
            'message'  => 'Pesanan berhasil dibatalkan.',
            'redirect' => base_url('customer/transaksi'),
        ]);
    }

    /* ==================== KWITANSI ==================== */
    public function kwitansi($id_rental)
    {
        $id_user   = $this->session->userdata('id_user');
        $transaksi = $this->Rental_model->get_detail_transaksi($id_rental, $id_user);
        $customer  = $this->Rental_model->get_profil($id_user);

        if (!$transaksi) redirect('customer/transaksi');

        // Kwitansi hanya bisa dicetak kalau pembayaran sudah terkonfirmasi
        if ($transaksi->status_bayar < 2) {
            redirect('customer/transaksi/detail/' . $id_rental);
        }

        $data = [
            'transaksi' => $transaksi,
            'customer'  => $customer,
        ];

        // Load tanpa header/footer dashboard — halaman print-friendly
        $this->load->view('customer/transaksi/kwitansi', $data);
    }
}