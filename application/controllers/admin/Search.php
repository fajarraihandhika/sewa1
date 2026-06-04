<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function index()
    {
        $keyword = $this->input->get('keyword');

        $data['keyword'] = $keyword;

        $data['mobil'] = [];
        $data['sopir'] = [];
        $data['pelanggan'] = [];
        $data['transaksi'] = [];

        if ($keyword) {
            $data['mobil'] = $this->db
                ->like('merk', $keyword)
                ->or_like('no_plat', $keyword)
                ->get('mobil')
                ->result();

            $data['sopir'] = $this->db
                ->like('nama', $keyword)
                ->or_like('no_telepon', $keyword)
                ->or_like('alamat', $keyword)
                ->get('supir')
                ->result();

            $data['pelanggan'] = $this->db
                ->where('role', 'customer')
                ->group_start()
                ->like('nama_lengkap', $keyword)
                ->or_like('email', $keyword)
                ->or_like('no_hp', $keyword)
                ->group_end()
                ->get('users')
                ->result();

            $data['transaksi'] = $this->db
                ->select('transaksi.*, users.nama_lengkap, mobil.merk, mobil.no_plat')
                ->from('transaksi')
                ->join('users', 'users.id = transaksi.id_customer', 'left')
                ->join('mobil', 'mobil.id_mobil = transaksi.id_mobil', 'left')
                ->group_start()
                    ->like('users.nama_lengkap', $keyword)
                    ->or_like('mobil.merk', $keyword)
                    ->or_like('mobil.no_plat', $keyword)
                    ->or_like('transaksi.id_rental', $keyword)
                ->group_end()
                ->get()
                ->result();
        }

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/search_result', $data);
        $this->load->view('templates_admin/footer');
    }
}