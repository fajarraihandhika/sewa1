<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rental_model');

        // Proteksi halaman - wajib login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Hanya role customer yang boleh akses
        if ($this->session->userdata('role') != 'customer') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // Ambil data customer berdasarkan id_user
        $customer = $this->db->get_where('customers', ['user_id' => $id_user])->row();

        // Hitung statistik transaksi
        $this->db->where('id_customer', $id_user);
        $total_sewa = $this->db->count_all_results('transaksi');

        $this->db->where('id_customer', $id_user);
        $this->db->where('status_rental', 1);
        $sewa_aktif = $this->db->count_all_results('transaksi');

        $this->db->where('id_customer', $id_user);
        $this->db->where('status_rental', 2);
        $sewa_selesai = $this->db->count_all_results('transaksi');

        $this->db->where('id_customer', $id_user);
        $this->db->where('status_rental', 0);
        $sewa_pending = $this->db->count_all_results('transaksi');

        // Cek apakah pelanggan lama (total sewa > 5)
        $is_pelanggan_lama = $total_sewa > 5;

        // Riwayat 5 transaksi terbaru
        $this->db->select('transaksi.*, mobil.merk, mobil.gambar, mobil.kode_type');
        $this->db->from('transaksi');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->where('transaksi.id_customer', $id_user);
        $this->db->order_by('transaksi.id_rental', 'DESC');
        $this->db->limit(5);
        $riwayat = $this->db->get()->result();

        $data = [
            'customer'           => $customer,
            'total_sewa'         => $total_sewa,
            'sewa_aktif'         => $sewa_aktif,
            'sewa_selesai'       => $sewa_selesai,
            'sewa_pending'       => $sewa_pending,
            'is_pelanggan_lama'  => $is_pelanggan_lama,
            'riwayat'            => $riwayat,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/dashboard/index', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }
}