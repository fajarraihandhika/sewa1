<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Customer_model');

        if(
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') != 'admin'
        ){
            redirect('auth/login');
        }
    }

    // list customer
    public function index()
    {
        $data['customers'] = $this->Customer_model
            ->get_all_customers();

            $this->load->view('templates_admin/header');
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/data_customer', $data);
            $this->load->view('templates_admin/footer');
        
    }

    // verify customer
    public function verify($id)
    {
        $this->db->where('id', $id);

        $this->db->update('customers', [
            'is_verified' => 'verified'
        ]);

        $this->session->set_flashdata(
            'success',
            'Customer berhasil diverifikasi'
        );

        redirect('admin/customer');
    }

    // reject customer
    public function reject($id)
    {
        $this->db->where('id', $id);

        $this->db->update('customers', [
            'is_verified' => 'rejected'
        ]);

        $this->session->set_flashdata(
            'success',
            'Customer berhasil ditolak'
        );

        redirect('admin/customer');
    }

    public function tambah()
    {
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/form_tambah_customer');
        $this->load->view('templates_admin/footer');
    }

    // =========================
    // SIMPAN CUSTOMER
    // =========================
    public function simpan()
    {

        // VALIDASI
        $this->form_validation->set_rules(
            'nama_lengkap',
            'Nama Lengkap',
            'required'
        );

        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email'
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]'
        );

        if($this->form_validation->run() == FALSE)
        {

            $this->session->set_flashdata(
                'error',
                validation_errors()
            );

            redirect('admin/customer/tambah');
        }

        // CEK EMAIL
        $cek = $this->db
            ->where('email', $this->input->post('email'))
            ->get('users')
            ->row();

        if($cek)
        {
            $this->session->set_flashdata(
                'error',
                'Email sudah digunakan'
            );

            redirect('admin/customer/tambah');
        }

        // INSERT USERS
        $user = [

            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email'        => $this->input->post('email'),
            'no_hp'        => $this->input->post('no_hp'),
            'password'     => password_hash(
                $this->input->post('password'),
                PASSWORD_DEFAULT
            ),
            'role'         => 'customer',
            'status'       => 'active',
            'created_at'   => date('Y-m-d H:i:s')

        ];

        $this->db->insert('users', $user);

        $user_id = $this->db->insert_id();

        // INSERT CUSTOMERS
        $customer = [

            'user_id'        => $user_id,
            'tgl_lahir'      => $this->input->post('tgl_lahir'),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
            'alamat'         => $this->input->post('alamat'),
            'kota'           => $this->input->post('kota'),
            'provinsi'       => $this->input->post('provinsi'),
            'id_type'        => $this->input->post('id_type'),
            'id_number'      => $this->input->post('id_number'),
            'nomor_sim'      => $this->input->post('nomor_sim'),
            'is_verified'    => 'pending',
            'created_at'     => date('Y-m-d H:i:s')

        ];

        $this->db->insert('customers', $customer);

        // FLASH MESSAGE
        $this->session->set_flashdata(
            'success',
            'Customer berhasil ditambahkan'
        );

        redirect('admin/customer');
    }

}