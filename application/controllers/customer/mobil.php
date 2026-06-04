<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mobil extends CI_Controller {

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
        $id_user  = $this->session->userdata('id_user');
        $customer = $this->rental_model->get_profil($id_user);
        $total_sewa = $this->rental_model->hitung_total_sewa($id_user);

        

        $data = [
            'mobil'             => $this->rental_model->filtermobil(),
            'type'              => $this->rental_model->get_data('type')->result(),
            'customer'          => $customer,
            'total_sewa'        => $total_sewa,
            'is_pelanggan_lama' => $total_sewa > 5,
        ];

        $this->load->view('templates_customer/header_dashboard', $data);
        $this->load->view('customer/mobil/index', $data);
        $this->load->view('templates_customer/footer_dashboard');
    }

    /* ==================== DETAIL MOBIL AJAX ==================== */
    public function detail($id)
    {
        $mobil = $this->rental_model->get_detail_mobil($id);
        header('Content-Type: application/json');
        echo json_encode($mobil);
        exit;
    }

    /* ==================== FORM PESAN AJAX ==================== */
    public function form_pesan($id)
    {
        $id_user    = $this->session->userdata('id_user');
        $total_sewa = $this->rental_model->hitung_total_sewa($id_user);
        $mobil      = $this->rental_model->get_detail_mobil($id);

        // Pelanggan lama: kirim daftar supir untuk dipilih
        // Pelanggan baru: supir akan di-assign random, tidak dikirim ke frontend
        $supir = ($total_sewa > 5)
            ? $this->rental_model->get_supir_tersedia()
            : [];

        header('Content-Type: application/json');
        echo json_encode([
            'mobil'             => $mobil,
            'supir'             => $supir,
            'is_pelanggan_lama' => $total_sewa > 5,
        ]);
        exit;
    }

    /* ==================== SUBMIT PEMESANAN ==================== */
    public function pesan()
    {
        header('Content-Type: application/json');
        $id_user = $this->session->userdata('id_user');

        // ── Ambil input ──────────────────────────────────────────
        $id_mobil      = $this->input->post('id_mobil');
        $jenis_durasi  = $this->input->post('jenis_durasi');   // jam|hari|minggu|bulan
        $jumlah_durasi = (int) $this->input->post('jumlah_durasi');
        $id_supir      = $this->input->post('id_supir') ?: null;
        $is_luar_kota  = $this->input->post('is_luar_kota') ? 1 : 0;
        $catatan       = $this->input->post('catatan');
        $metode_bayar  = $this->input->post('metode_bayar') === 'tunai' ? 'tunai' : 'transfer';

        // ── Validasi dasar ───────────────────────────────────────
        $valid_durasi = ['jam', 'hari', 'minggu', 'bulan'];
        if (empty($id_mobil) || !in_array($jenis_durasi, $valid_durasi) || $jumlah_durasi < 1) {
            echo json_encode(['status' => 'error', 'message' => 'Data pemesanan tidak lengkap.']);
            return;
        }

        // Validasi minimal 3 jam
        if ($jenis_durasi === 'jam' && $jumlah_durasi < 3) {
            echo json_encode(['status' => 'error', 'message' => 'Sewa per jam minimal 3 jam.']);
            return;
        }

        // ── Hitung datetime mulai & selesai ──────────────────────
        $tanggal_mulai_str = $this->input->post('tanggal_mulai'); // format: Y-m-d H:i
        if (empty($tanggal_mulai_str)) {
            echo json_encode(['status' => 'error', 'message' => 'Tanggal mulai wajib diisi.']);
            return;
        }

        $ts_mulai = strtotime($tanggal_mulai_str);
        if (!$ts_mulai) {
            echo json_encode(['status' => 'error', 'message' => 'Format tanggal tidak valid.']);
            return;
        }

        switch ($jenis_durasi) {
            case 'jam':
                $ts_selesai = strtotime("+{$jumlah_durasi} hours", $ts_mulai);
                break;
            case 'hari':
                $ts_selesai = strtotime("+{$jumlah_durasi} days", $ts_mulai);
                break;
            case 'minggu':
                $ts_selesai = strtotime("+{$jumlah_durasi} weeks", $ts_mulai);
                break;
            case 'bulan':
                $ts_selesai = strtotime("+{$jumlah_durasi} months", $ts_mulai);
                break;
        }

        $tanggal_rental  = date('Y-m-d H:i:s', $ts_mulai);
        $tanggal_kembali = date('Y-m-d H:i:s', $ts_selesai);

        // ── Ambil data mobil ─────────────────────────────────────
        $mobil = $this->rental_model->get_detail_mobil($id_mobil);
        if (!$mobil) {
            echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan.']);
            return;
        }

        // ── Cek ketersediaan & logika upgrade ────────────────────
        $total_sewa       = $this->rental_model->hitung_total_sewa($id_user);
        $is_pelanggan_lama = $total_sewa > 5;
        $id_mobil_asal    = null;
        $is_upgrade       = 0;

        $tersedia = $this->rental_model->cek_mobil_tersedia($id_mobil, $tanggal_rental, $tanggal_kembali);

        if (!$tersedia) {
            if ($is_pelanggan_lama) {
                // Coba cari upgrade kendaraan kelas lebih tinggi
                $mobil_upgrade = $this->rental_model->cari_upgrade_mobil($mobil, $tanggal_rental, $tanggal_kembali);

                if ($mobil_upgrade) {
                    // Simpan info mobil asal, gunakan mobil upgrade
                    $id_mobil_asal = $id_mobil;
                    $id_mobil      = $mobil_upgrade->id_mobil;
                    $mobil         = $mobil_upgrade;
                    $is_upgrade    = 1;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Mobil tidak tersedia dan tidak ada kendaraan pengganti saat ini.']);
                    return;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Mobil tidak tersedia di tanggal tersebut.']);
                return;
            }
        }

        // ── Tentukan supir ───────────────────────────────────────
        $supir = null;
        if ($is_pelanggan_lama && !empty($id_supir)) {
            // Pelanggan lama: pakai supir pilihan customer
            $supir = $this->rental_model->get_detail_supir($id_supir);
        } else {
            // Pelanggan baru (atau lama yang tidak pilih): assign supir random
            $supir = $this->rental_model->get_supir_random();
        }

        if (!$supir) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada supir yang tersedia saat ini. Silakan coba lagi nanti.']);
            return;
        }

        // ── Hitung harga ─────────────────────────────────────────
        // Catatan: untuk upgrade, harga tetap menggunakan harga mobil ASAL
        $mobil_untuk_harga = $is_upgrade
            ? $this->rental_model->get_detail_mobil($id_mobil_asal)
            : $mobil;

        $kalkulasi = $this->rental_model->hitung_harga(
            $mobil_untuk_harga,
            $jenis_durasi,
            $jumlah_durasi,
            $supir,
            $is_luar_kota
        );

        // ── Simpan transaksi ─────────────────────────────────────
        $data = [
            'id_customer'         => $id_user,
            'id_mobil'            => $id_mobil,
            'id_mobil_asal'       => $id_mobil_asal,
            'is_upgrade'          => $is_upgrade,
            'id_supir'            => $supir->id_supir,
            'jenis_durasi'        => $jenis_durasi,
            'jumlah_durasi'       => $jumlah_durasi,
            'tanggal_rental'      => $tanggal_rental,
            'tanggal_kembali'     => $tanggal_kembali,
            'is_luar_kota'        => $is_luar_kota,
            'biaya_mobil'         => $kalkulasi['biaya_mobil'],
            'biaya_supir'         => $kalkulasi['biaya_supir'],
            'biaya_antjemput'     => 0, // Modul 2 (belum diimplementasi)
            'biaya_tambahan'      => 0, // Diisi saat pengembalian jika ada kelebihan waktu
            'total_harga'         => $kalkulasi['total'],
            'catatan'             => $catatan,
            'metode_bayar'        => $metode_bayar,
            'status_bayar'        => 0,
            'status_rental'       => 'pending',
            'status_pengembalian' => 'belum',
        ];

        if ($this->rental_model->buat_transaksi($data)) {
            $id_rental = $this->db->insert_id();

            $message = 'Pesanan berhasil!';
            if ($is_upgrade) {
                $message .= " Mobil pilihan Anda tidak tersedia, kami upgrade ke {$mobil->merk} dengan harga tetap sama.";
            }

            // Redirect berbeda berdasarkan metode bayar
            $redirect = ($metode_bayar === 'tunai')
                ? base_url('customer/transaksi/konfirmasi_tunai/' . $id_rental)
                : base_url('customer/transaksi/bayar/' . $id_rental);

            echo json_encode([
                'status'   => 'success',
                'message'  => $message,
                'redirect' => $redirect,
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan pesanan. Coba lagi.']);
        }
    }
}