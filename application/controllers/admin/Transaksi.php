<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Rental_model');

        // cek login admin (SAMAKAN dengan Customer.php kamu)
        if(
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') != 'admin'
        ){
            redirect('auth/login');
        }
    }

    // =========================
    // LIST TRANSAKSI
    // =========================
    public function index()
    {
        $this->db->select('
            transaksi.*,
            users.nama_lengkap,
            mobil.merk,
            mobil.no_plat
        ');

        $this->db->from('transaksi');
        $this->db->join('users', 'users.id = transaksi.id_customer');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->order_by('transaksi.id_rental', 'DESC');

        $data['transaksi'] = $this->db->get()->result();

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/transaksi', $data);
        $this->load->view('templates_admin/footer');
    }

    // =========================
    // DETAIL TRANSAKSI
    // =========================
    public function detail($id)
    {
        $this->db->select('
            transaksi.*,
            users.nama_lengkap,
            users.email,
            users.no_hp,
            mobil.merk,
            mobil.no_plat,
            mobil.harga,
            mobil.warna,
            mobil.tahun
        ');

        $this->db->from('transaksi');
        $this->db->join('users', 'users.id = transaksi.id_customer');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->where('transaksi.id_rental', $id);

        $data['detail'] = $this->db->get()->row();

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/detail_transaksi', $data);
        $this->load->view('templates_admin/footer');
    }

    // =========================
    // TAMBAH TRANSAKSI
    // =========================
    public function tambah()
{
    $data['customer'] = $this->db->get('users')->result();
    $data['mobil']    = $this->db->get('mobil')->result();

    $this->load->view('templates_admin/header');
    $this->load->view('templates_admin/sidebar');
    $this->load->view('admin/form_tambah_transaksi', $data);
    $this->load->view('templates_admin/footer');
}


    public function tambah_aksi()
    {
        $data = [
            'id_customer'          => $this->input->post('id_customer'),
            'id_mobil'             => $this->input->post('id_mobil'),
            'tanggal_rental'       => $this->input->post('tanggal_rental'),
            'tanggal_kembali'      => $this->input->post('tanggal_kembali'),
            'tanggal_pengembalian' => '0000-00-00',
            'status_rental'        => 'Berjalan',
            'status_pengembalian'  => 'Belum Kembali'
        ];

        $this->Rental_model->insert_data($data, 'transaksi');

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success">Transaksi berhasil ditambahkan</div>'
        );

        redirect('admin/transaksi');
    }

    // =========================
    // PENGEMBALIAN MOBIL
    // =========================
    public function pengembalian($id)
    {
        $data = [
            'tanggal_pengembalian' => date('Y-m-d'),
            'status_pengembalian'  => 'Sudah Kembali',
            'status_rental'        => 'Selesai'
        ];

        $this->db->where('id_rental', $id);
        $this->db->update('transaksi', $data);

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success">Mobil berhasil dikembalikan</div>'
        );

        redirect('admin/transaksi');
    }

    // =========================
    // HAPUS TRANSAKSI
    // =========================
    public function hapus($id)
    {
        $this->db->where('id_rental', $id);
        $this->db->delete('transaksi');

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success">Data transaksi berhasil dihapus</div>'
        );

        redirect('admin/transaksi');
    }
}