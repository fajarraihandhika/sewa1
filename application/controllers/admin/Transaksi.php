<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rental_model');

        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    /* ==================== LIST TRANSAKSI ==================== */
    public function index()
    {
        $status = $this->input->get('status');

        $this->db->select('transaksi.*, users.nama_lengkap, users.no_hp, mobil.merk, mobil.kode_type, mobil.no_plat, mobil.gambar');
        $this->db->from('transaksi');
        $this->db->join('users', 'users.id = transaksi.id_customer');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');

        if (!empty($status)) {
            $this->db->where('transaksi.status_rental', $status);
        }

        $this->db->order_by('transaksi.id_rental', 'DESC');
        $transaksi = $this->db->get()->result();

        // Hitung per status untuk badge
        $counts = [
            'semua'   => $this->db->count_all('transaksi'),
            'pending' => $this->db->where('status_rental', 'pending')->count_all_results('transaksi'),
            'aktif'   => $this->db->where('status_rental', 'aktif')->count_all_results('transaksi'),
            'selesai' => $this->db->where('status_rental', 'selesai')->count_all_results('transaksi'),
            'ditolak' => $this->db->where('status_rental', 'ditolak')->count_all_results('transaksi'),
        ];

        $data = [
            'transaksi'     => $transaksi,
            'status_filter' => $status,
            'counts'        => $counts,
            'title'         => 'Kelola Transaksi',
        ];

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/transaksi/index', $data);
        $this->load->view('templates_admin/footer');
    }

    /* ==================== DETAIL TRANSAKSI ==================== */
    public function detail($id_rental)
    {
        $this->db->select('transaksi.*, 
            users.nama_lengkap, users.email, users.no_hp,
            mobil.merk, mobil.kode_type, mobil.no_plat, mobil.gambar, mobil.harga_perhari,
            supir.nama AS nama_supir, supir.no_telepon AS telp_supir, supir.foto AS foto_supir');
        $this->db->from('transaksi');
        $this->db->join('users', 'users.id = transaksi.id_customer');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->join('supir', 'supir.id_supir = transaksi.id_supir', 'left');
        $this->db->where('transaksi.id_rental', $id_rental);
        $transaksi = $this->db->get()->row();

        if (!$transaksi) redirect('admin/transaksi');

        $data = [
            'transaksi' => $transaksi,
            'title'     => 'Detail Transaksi #' . str_pad($id_rental, 5, '0', STR_PAD_LEFT),
        ];

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/transaksi/detail', $data);
        $this->load->view('templates_admin/footer');
    }

    /* ==================== KONFIRMASI PEMBAYARAN ==================== */
    public function konfirmasi_bayar($id_rental)
    {
        $this->db->where('id_rental', $id_rental);
        $this->db->update('transaksi', ['status_bayar' => 2]);

        $this->session->set_flashdata('success', 'Pembayaran berhasil dikonfirmasi.');
        redirect('admin/transaksi/detail/' . $id_rental);
    }

    /* ==================== APPROVE (AKTIFKAN) ==================== */
    public function approve($id_rental)
    {
        // Cek apakah pembayaran sudah dikonfirmasi
        $trx = $this->db->get_where('transaksi', ['id_rental' => $id_rental])->row();

        if (!$trx) {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan.');
            redirect('admin/transaksi');
        }

        if ($trx->status_bayar < 2) {
            $this->session->set_flashdata('error', 'Pembayaran belum dikonfirmasi. Konfirmasi pembayaran terlebih dahulu.');
            redirect('admin/transaksi/detail/' . $id_rental);
        }

        $this->db->where('id_rental', $id_rental);
        $this->db->update('transaksi', [
            'status_rental' => 'aktif',
        ]);

        // Update status mobil jadi tidak tersedia
        $this->db->where('id_mobil', $trx->id_mobil);
        $this->db->update('mobil', ['status' => 0]);

        $this->session->set_flashdata('success', 'Transaksi berhasil diaktifkan.');
        redirect('admin/transaksi/detail/' . $id_rental);
    }

    /* ==================== TOLAK ==================== */
    public function tolak($id_rental)
    {
        $this->db->where('id_rental', $id_rental);
        $this->db->update('transaksi', ['status_rental' => 'ditolak']);

        $this->session->set_flashdata('success', 'Transaksi berhasil ditolak.');
        redirect('admin/transaksi');
    }

    /* ==================== SELESAI (PENGEMBALIAN) ==================== */
    public function selesai($id_rental)
    {
        $trx = $this->db->get_where('transaksi', ['id_rental' => $id_rental])->row();

        if (!$trx) {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan.');
            redirect('admin/transaksi');
        }

        $this->db->where('id_rental', $id_rental);
        $this->db->update('transaksi', [
            'status_rental'       => 'selesai',
            'status_pengembalian' => 'sudah',
            'tanggal_pengembalian' => date('Y-m-d'),
        ]);

        // Kembalikan status mobil jadi tersedia
        $this->db->where('id_mobil', $trx->id_mobil);
        $this->db->update('mobil', ['status' => 1]);

        $this->session->set_flashdata('success', 'Transaksi selesai. Mobil dikembalikan.');
        redirect('admin/transaksi/detail/' . $id_rental);
    }
}