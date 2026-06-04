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
        $this->db->select('mobil.*, type.nama_type, type.urutan_kelas');
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
            $this->db->order_by('mobil.harga_perhari', 'ASC');
        } elseif ($harga == 'tinggi') {
            $this->db->order_by('mobil.harga_perhari', 'DESC');
        }

        return $this->db->get()->result();
    }

    /* ==================== SUPIR ==================== */
    public function get_supir_tersedia()
    {
        return $this->db
            ->select('id_supir, nama, foto, rating, pengalaman, no_telepon, tarif_perhari, tarif_perjam')
            ->where('status', 1)
            ->get('supir')
            ->result();
    }

    public function get_supir_random()
    {
        return $this->db
            ->select('id_supir, nama, tarif_perhari, tarif_perjam')
            ->where('status', 1)
            ->order_by('RAND()')
            ->limit(1)
            ->get('supir')
            ->row();
    }

    public function get_detail_supir($id)
    {
        return $this->db
            ->select('id_supir, nama, foto, rating, pengalaman, no_telepon, tarif_perhari, tarif_perjam')
            ->get_where('supir', ['id_supir' => $id])
            ->row();
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
            $data['user_id']     = $id_user;
            $data['is_verified'] = 'pending';
            $data['created_at']  = date('Y-m-d H:i:s');
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
        $this->db->select('transaksi.*, mobil.merk, mobil.gambar, mobil.kode_type, mobil.no_plat,
                           supir.nama AS nama_supir,
                           mob_asal.merk AS merk_asal');
        $this->db->from('transaksi');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->join('supir', 'supir.id_supir = transaksi.id_supir', 'left');
        // join mobil asal (untuk kasus upgrade)
        $this->db->join('mobil mob_asal', 'mob_asal.id_mobil = transaksi.id_mobil_asal', 'left');
        $this->db->where('transaksi.id_customer', $id_user);

        if ($status !== null && $status !== '') {
            $this->db->where('transaksi.status_rental', $status);
        }

        $this->db->order_by('transaksi.id_rental', 'DESC');
        return $this->db->get()->result();
    }

    public function get_detail_transaksi($id_rental, $id_user)
    {
        $this->db->select('transaksi.*,
                           mobil.merk, mobil.gambar, mobil.kode_type, mobil.no_plat,
                           mobil.harga_perhari, mobil.harga_perjam,
                           mobil.harga_perminggu, mobil.harga_perbulan,
                           supir.nama AS nama_supir, supir.no_telepon AS telp_supir,
                           supir.foto AS foto_supir, supir.rating AS rating_supir,
                           supir.tarif_perhari AS tarif_supir_perhari,
                           supir.tarif_perjam AS tarif_supir_perjam,
                           mob_asal.merk AS merk_asal, mob_asal.kode_type AS type_asal,
                           users.nama_lengkap, users.email, users.no_hp');
        $this->db->from('transaksi');
        $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
        $this->db->join('supir', 'supir.id_supir = transaksi.id_supir', 'left');
        $this->db->join('mobil mob_asal', 'mob_asal.id_mobil = transaksi.id_mobil_asal', 'left');
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
        $this->db->where('id_mobil', $id_mobil);
        $this->db->where_in('status_rental', ['pending', 'aktif']);
        $this->db->where('tanggal_kembali >', $tgl_mulai);
        $this->db->where('tanggal_rental <', $tgl_selesai);
        return $this->db->count_all_results('transaksi') == 0;
    }

    /* ==================== HITUNG HARGA ==================== */
    /**
     * Hitung total harga berdasarkan jenis durasi.
     *
     * @param  object $mobil        Row dari get_detail_mobil()
     * @param  string $jenis_durasi jam|hari|minggu|bulan
     * @param  int    $jumlah       Jumlah unit durasi
     * @param  object|null $supir   Row dari get_detail_supir() atau null
     * @param  bool   $is_luar_kota
     * @return array  ['biaya_mobil', 'biaya_supir', 'subtotal', 'biaya_luar_kota', 'total']
     */
    public function hitung_harga($mobil, $jenis_durasi, $jumlah, $supir = null, $is_luar_kota = false)
    {
        // Pilih harga sesuai jenis durasi
        switch ($jenis_durasi) {
            case 'jam':
                $harga_satuan = (float) $mobil->harga_perjam;
                break;
            case 'minggu':
                $harga_satuan = (float) $mobil->harga_perminggu;
                break;
            case 'bulan':
                $harga_satuan = (float) $mobil->harga_perbulan;
                break;
            case 'hari':
            default:
                $harga_satuan = (float) $mobil->harga_perhari;
                break;
        }

        $biaya_mobil = $harga_satuan * $jumlah;

        // Biaya supir
        $biaya_supir = 0;
        if ($supir) {
            $tarif_supir  = ($jenis_durasi === 'jam')
                ? (float) $supir->tarif_perjam
                : (float) $supir->tarif_perhari;
            $biaya_supir  = $tarif_supir * $jumlah;
        }

        $subtotal        = $biaya_mobil + $biaya_supir;
        $biaya_luar_kota = $is_luar_kota ? round($subtotal * 0.20) : 0;
        $total           = $subtotal + $biaya_luar_kota;

        return [
            'biaya_mobil'     => $biaya_mobil,
            'biaya_supir'     => $biaya_supir,
            'subtotal'        => $subtotal,
            'biaya_luar_kota' => $biaya_luar_kota,
            'total'           => $total,
        ];
    }

    /* ==================== UPGRADE KENDARAAN ==================== */
    /**
     * Cari mobil kelas lebih tinggi yang tersedia di rentang waktu tertentu.
     * Hanya dipanggil untuk pelanggan lama ketika mobil pilihan tidak tersedia.
     *
     * @param  object $mobil_asal   Row mobil yang originally dipilih
     * @param  string $tgl_mulai
     * @param  string $tgl_selesai
     * @return object|null          Row mobil pengganti, atau null kalau tidak ada
     */
    public function cari_upgrade_mobil($mobil_asal, $tgl_mulai, $tgl_selesai)
    {
        // Ambil semua mobil yang tersedia di rentang waktu ini
        // dengan urutan_kelas lebih tinggi dari mobil asal
        $this->db->select('mobil.*, type.nama_type, type.urutan_kelas');
        $this->db->from('mobil');
        $this->db->join('type', 'type.kode_type = mobil.kode_type');
        $this->db->where('mobil.status', 1);
        $this->db->where('type.urutan_kelas >', $mobil_asal->urutan_kelas);
        // Exclude mobil yang sedang aktif/pending di rentang waktu tersebut
        $this->db->where("mobil.id_mobil NOT IN (
            SELECT id_mobil FROM transaksi
            WHERE status_rental IN ('pending','aktif')
            AND tanggal_kembali > '{$tgl_mulai}'
            AND tanggal_rental  < '{$tgl_selesai}'
        )");
        $this->db->order_by('type.urutan_kelas', 'ASC'); // ambil yang paling dekat kelasnya
        $this->db->limit(1);

        return $this->db->get()->row();
    }
}