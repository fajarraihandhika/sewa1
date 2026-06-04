<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') != 'admin'
        ){
            redirect('auth/login');
        }
    }

    public function index()
    {
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');

        $this->db->select('
            transaksi.*,
            users.nama_lengkap,
            mobil.merk,
            mobil.no_plat,
            mobil.harga_perhari
        ');
        $this->db->from('transaksi');
        $this->db->join('users', 'users.id = transaksi.id_customer');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');

        if(!empty($tanggal_awal) && !empty($tanggal_akhir)){
            $this->db->where('transaksi.tanggal_rental >=', $tanggal_awal);
            $this->db->where('transaksi.tanggal_rental <=', $tanggal_akhir);
        }

        $this->db->order_by('transaksi.id_rental', 'DESC');

        $data['laporan'] = $this->db->get()->result();
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates_admin/footer');
    }

    public function pendapatan()
{
    // 1. Ambil parameter utama filter dari form GET
    $filter = $this->input->get('periode') ? $this->input->get('periode') : 'bulan_ini';
    $tgl_mulai = $this->input->get('tanggal_mulai');
    $tgl_selesai = $this->input->get('tanggal_selesai');

    // =========================================================================
    // BAGIAN 1: PROSES KONDISI FILTER (KUSTOM VS INSTAN)
    // =========================================================================
    
    // Kita buat penampung kondisi where untuk diaplikasikan ke query SUM dan query Tabel
    $kondisi_where = [];

    if ($filter == 'kustom' && !empty($tgl_mulai) && !empty($tgl_selesai)) {
        // Jika filter kustom tanggal aktif
        $kondisi_where['DATE(transaksi.tanggal_rental) >='] = $tgl_mulai;
        $kondisi_where['DATE(transaksi.tanggal_rental) <='] = $tgl_selesai;
        $label_periode = date('d M Y', strtotime($tgl_mulai)) . " s/d " . date('d M Y', strtotime($tgl_selesai));
    } else {
        // Jika menggunakan filter instan (hari ini, minggu ini, dll)
        switch ($filter) {
            case 'hari_ini':
                $kondisi_where['DATE(transaksi.tanggal_rental)'] = date('Y-m-d');
                $label_periode = "Hari Ini (" . date('d M Y') . ")";
                break;
            case 'minggu_ini':
                $kondisi_where['transaksi.tanggal_rental >='] = date('Y-m-d', strtotime('-7 days'));
                $label_periode = "7 Hari Terakhir";
                break;
            case 'bulan_ini':
                $kondisi_where['MONTH(transaksi.tanggal_rental)'] = date('m');
                $kondisi_where['YEAR(transaksi.tanggal_rental)'] = date('Y');
                $label_periode = "Bulan Ini (" . date('F Y') . ")";
                break;
            case 'tahun_ini':
                $kondisi_where['YEAR(transaksi.tanggal_rental)'] = date('Y');
                $label_periode = "Tahun Ini (" . date('Y') . ")";
                break;
            case 'semua':
                $label_periode = "Keseluruhan (All-Time)";
                break;
            default:
                // Jaga-jaga jika input ngawur, kembalikan ke bulan ini
                $kondisi_where['MONTH(transaksi.tanggal_rental)'] = date('m');
                $kondisi_where['YEAR(transaksi.tanggal_rental)'] = date('Y');
                $label_periode = "Bulan Ini (" . date('F Y') . ")";
                $filter = 'bulan_ini';
                break;
        }
    }

    // =========================================================================
    // BAGIAN 2: QUERY TOTAL OMZET (UNTUK AKUMULASI DI BAWAH TABEL)
    // =========================================================================
    $this->db->select_sum('transaksi.total_harga');
    $this->db->from('transaksi');
    $this->db->where('transaksi.status_bayar', 2); // Hanya yang lunas

    // Terapkan kondisi dinamis hasil filter di atas
    if (!empty($kondisi_where)) {
        $this->db->where($kondisi_where);
    }
    
    $query_sum = $this->db->get()->row();
    $data['total_pendapatan'] = $query_sum->total_harga ?? 0;

    // =========================================================================
    // BAGIAN 3: QUERY RINCIAN TRANSAKSI (UNTUK SEBARAN ISI TABEL)
    // =========================================================================
    $this->db->select('
        transaksi.*, 
        users.nama_lengkap, 
        mobil.merk, 
        mobil.no_plat, 
        mobil.harga_perhari,
        DATEDIFF(transaksi.tanggal_kembali, transaksi.tanggal_rental) as durasi
    ');
    $this->db->from('transaksi');
    $this->db->join('users', 'users.id = transaksi.id_customer');
    $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
    $this->db->where('transaksi.status_bayar', 2); // Hanya yang lunas

    // Terapkan kondisi dinamis yang sama persis agar sinkron total & tabelnya
    if (!empty($kondisi_where)) {
        $this->db->where($kondisi_where);
    }

    $this->db->order_by('transaksi.tanggal_rental', 'DESC');
    $data['rincian_pendapatan'] = $this->db->get()->result();

    // =========================================================================
    // BAGIAN 4: MELEMPAR DATA KE VIEW
    // =========================================================================
    $data['current_filter'] = $filter;
    $data['label_periode'] = $label_periode;

    $this->load->view('templates_admin/header');
    $this->load->view('templates_admin/sidebar');
    $this->load->view('admin/pendapatan', $data); // Diarahkan ke views/admin/pendapatan.php sesuai kodinganmu
    $this->load->view('templates_admin/footer');
}
}