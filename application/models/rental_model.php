<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_model extends CI_Model {

    /* ==================== GENERIC ==================== */
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function update_data($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete_data($where, $table)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }

    /* ==================== MOBIL ==================== */
    public function get_all_mobil()
    {
        return $this->db->get('mobil')->result();
    }

    public function get_detail_mobil($id)
    {
        $this->db->select('mobil.*, type.nama_type');
        $this->db->from('mobil');
        $this->db->join('type', 'type.kode_type = mobil.kode_type');
        $this->db->where('mobil.id_mobil', $id);
        return $this->db->get()->row();
    }

    public function ambil_id_mobil($id)
    {
        $hasil = $this->db->where('id_mobil', $id)->get('mobil');
        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        }
        return FALSE;
    }

    public function filtermobil($type = null, $status = null, $harga = null)
    {
        $this->db->select('mobil.*, type.nama_type');
        $this->db->from('mobil');
        $this->db->join('type', 'type.kode_type = mobil.kode_type');

        if (!empty($type)) {
            $this->db->where('mobil.kode_type', $type);
        }
        if (!empty($status)) {
            $this->db->where('mobil.status', $status);
        }
        if ($harga == 'rendah') {
            $this->db->order_by('mobil.harga', 'ASC');
        } elseif ($harga == 'tinggi') {
            $this->db->order_by('mobil.harga', 'DESC');
        }

        return $this->db->get()->result();
    }

    /* ==================== SUPIR ==================== */
    public function get_supir_tersedia()
    {
        return $this->db->where('status', 1)->get('supir')->result();
    }

    public function get_detail_supir($id)
    {
        return $this->db->get_where('supir', ['id_supir' => $id])->row();
    }

    public function ambil_id_supir($id)
    {
        $hasil = $this->db->where('id_supir', $id)->get('supir');
        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        }
        return FALSE;
    }

    /* ==================== CUSTOMERS (PROFIL) ==================== */
    public function get_profil($id_user)
    {
        $this->db->select('customers.*, users.nama_lengkap, users.email, users.no_hp');
        $this->db->from('customers');
        $this->db->join('users', 'users.id = customers.user_id', 'left');
        $this->db->where('customers.user_id', $id_user);
        return $this->db->get()->row();
    }

    public function profil_exists($id_user)
    {
        return $this->db->where('user_id', $id_user)->count_all_results('customers') > 0;
    }

    public function simpan_profil($id_user, $data)
    {
        if ($this->profil_exists($id_user)) {
            return $this->db->where('user_id', $id_user)->update('customers', $data);
        } else {
            $data['user_id'] = $id_user;
            $data['is_verified'] = 0;
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->db->insert('customers', $data);
        }
    }

    public function update_user($id_user, $data)
    {
        return $this->db->where('id', $id_user)->update('users', $data);
    }

    /* ==================== TRANSAKSI ==================== */
    public function get_transaksi_customer($id_user, $status = null)
    {
        $this->db->select('transaksi.*, mobil.merk, mobil.gambar, mobil.kode_type, mobil.no_plat, supir.nama AS nama_supir');
        $this->db->from('transaksi');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->join('supir', 'supir.id_supir = transaksi.id_supir', 'left');
        $this->db->where('transaksi.id_customer', $id_user);

        if ($status !== null && $status !== '') {
            $this->db->where('transaksi.status_rental', $status);
        }

        $this->db->order_by('transaksi.id_rental', 'DESC');
        return $this->db->get()->result();
    }

    public function get_detail_transaksi($id_rental, $id_user)
    {
        $this->db->select('transaksi.*, mobil.merk, mobil.gambar, mobil.kode_type, mobil.no_plat, mobil.harga,
                           supir.nama AS nama_supir, supir.no_telepon AS telp_supir,
                           supir.foto AS foto_supir, supir.rating AS rating_supir,
                           users.nama_lengkap, users.email, users.no_hp');
        $this->db->from('transaksi');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->join('supir', 'supir.id_supir = transaksi.id_supir', 'left');
        $this->db->join('users', 'users.id = transaksi.id_customer');
        $this->db->where('transaksi.id_rental', $id_rental);
        $this->db->where('transaksi.id_customer', $id_user);
        return $this->db->get()->row();
    }

    public function buat_transaksi($data)
    {
        return $this->db->insert('transaksi', $data);
    }

    public function hitung_total_sewa($id_user)
    {
        return $this->db->where('id_customer', $id_user)->count_all_results('transaksi');
    }

    public function cek_mobil_tersedia($id_mobil, $tgl_mulai, $tgl_selesai)
    {
        // Cek apakah mobil sedang aktif disewa di rentang tanggal tersebut
        $this->db->where('id_mobil', $id_mobil);
        $this->db->where('status_rental', 1);
        $this->db->where("tanggal_kembali >=", $tgl_mulai);
        $this->db->where("tanggal_rental <=", $tgl_selesai);
        return $this->db->count_all_results('transaksi') == 0;
    }
}