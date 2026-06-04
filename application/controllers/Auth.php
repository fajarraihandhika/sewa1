<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    // ================= REGISTER PAGE =================
    public function register()
    {
        $this->load->view('auth/register');
    }

    // ================= CHECK EMAIL AJAX =================
    public function check_email()
    {
        $email = $this->input->post('email');

        $cek = $this->db
            ->where('email', $email)
            ->get('users')
            ->row();

        if($cek){
            echo json_encode([
                'status'  => 'error',
                'message' => 'Email sudah digunakan'
            ]);
        } else {
            echo json_encode([
                'status' => 'ok'
            ]);
        }
    }

    // ================= REGISTER PROCESS =================
    public function submit()
    {
        header('Content-Type: application/json');

        $nama     = $this->input->post('nama_lengkap');
        $no_hp    = $this->input->post('no_hp');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm');

        // VALIDASI
        if(empty($nama) || empty($no_hp) || empty($email) || empty($password)){
            echo json_encode([
                'status' => 'error',
                'message' => 'Semua field wajib diisi'
            ]);
            return;
        }

        if($password != $confirm){
            echo json_encode([
                'status' => 'error',
                'message' => 'Konfirmasi password tidak cocok'
            ]);
            return;
        }

        // CHECK EMAIL
        $cek = $this->db
            ->where('email', $email)
            ->get('users')
            ->row();

        if($cek){
            echo json_encode([
                'status' => 'error',
                'message' => 'Email sudah digunakan'
            ]);
            return;
        }

        // INSERT USERS
        $data = [
            'nama_lengkap' => $nama,
            'email'        => $email,
            'no_hp'        => $no_hp,
            'password'     => password_hash($password, PASSWORD_DEFAULT),
            'role'         => 'customer',
            'status'       => 'pending',
            'created_at'   => date('Y-m-d H:i:s')
        ];

        $insert = $this->db->insert('users', $data);

        if($insert){

            echo json_encode([
                'status' => 'success'
            ]);

        } else {

            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal simpan database'
            ]);

        }
    }
    // ================= LOGIN PAGE =================
public function login()
{
    $this->load->view('auth/login');
}


// ================= LOGIN PROCESS =================
public function login_process()
{
    header('Content-Type: application/json');

    $email    = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db
        ->where('email', $email)
        ->get('users')
        ->row();

    if(!$user){

        echo json_encode([
            'status' => 'error',
            'message' => 'Email tidak ditemukan'
        ]);
        return;
    }

    if(!password_verify($password, $user->password)){

        echo json_encode([
            'status' => 'error',
            'message' => 'Password salah'
        ]);
        return;
    }

    $session = [

        'id_user'      => $user->id,
        'nama_lengkap' => $user->nama_lengkap,
        'email'        => $user->email,
        'role'         => $user->role,
        'logged_in'    => true
    
    ];
    
    $this->session->set_userdata($session);
    
    // redirect berdasarkan role
    if($user->role == 'admin')
    {
        $redirect = base_url('admin/dashboard');
    }
    else
    {
        $redirect = base_url('customer/dashboard');
    }
    
    echo json_encode([
        'status'   => 'success',
        'redirect' => $redirect
    ]);
}
// ================= LOGOUT =================
public function logout()
{
    $this->session->unset_userdata([
        'id_user',
        'nama_lengkap',
        'email',
        'role',
        'logged_in'
    ]);

    $this->session->sess_destroy();

    redirect('auth/login');
}

}