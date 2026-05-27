<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Customer_model');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER VIEW
    |--------------------------------------------------------------------------
    */
    public function register()
    {
        $this->load->view('auth/register');
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK EMAIL AJAX
    |--------------------------------------------------------------------------
    */
    public function check_email()
    {
        $email = $this->input->post('email');

        $user = $this->User_model->getByEmail($email);

        if($user){
            echo json_encode([
                'status' => 'error',
                'message' => 'Email sudah digunakan'
            ]);
        } else {
            echo json_encode([
                'status' => 'ok'
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER SUBMIT
    |--------------------------------------------------------------------------
    */
    public function submit()
    {
        $nama     = htmlspecialchars($this->input->post('nama_lengkap'));
        $email    = htmlspecialchars($this->input->post('email'));
        $no_hp    = htmlspecialchars($this->input->post('no_hp'));
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm');

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        if(empty($nama) || empty($email) || empty($no_hp) || empty($password))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Semua field wajib diisi'
            ]);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Format email tidak valid'
            ]);
            return;
        }

        if(strlen($password) < 8)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Password minimal 8 karakter'
            ]);
            return;
        }

        if($password != $confirm)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Konfirmasi password tidak cocok'
            ]);
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | EMAIL SUDAH ADA?
        |--------------------------------------------------------------------------
        */

        $cek = $this->User_model->getByEmail($email);

        if($cek)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email sudah terdaftar'
            ]);
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | INSERT USERS
        |--------------------------------------------------------------------------
        */

        $userData = [
            'nama_lengkap' => $nama,
            'email'        => $email,
            'no_hp'        => $no_hp,
            'password'     => password_hash($password, PASSWORD_DEFAULT),
            'role'         => 'customer'
        ];

        $this->User_model->insert($userData);

        $user_id = $this->db->insert_id();

        /*
        |--------------------------------------------------------------------------
        | INSERT CUSTOMERS KOSONG
        |--------------------------------------------------------------------------
        */

        $customerData = [
            'user_id' => $user_id
        ];

        $this->Customer_model->insert($customerData);

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        echo json_encode([
            'status' => 'success',
            'message' => 'Registrasi berhasil'
        ]);
    }

}