<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Customer_model');
        $this->load->library('form_validation');

        // cek login
        if(!$this->session->userdata('user_id'))
        {
            redirect('auth/login');
        }
    }

    // halaman lengkapi profil
    public function complete_profile()
    {
        $user_id = $this->session->userdata('user_id');

        $data['customer'] = $this->Customer_model
            ->get_by_user($user_id);

        $this->load->view('customer/complete_profile', $data);
    }

    // submit profile
    public function submit_profile()
    {
        // validation
        $this->form_validation->set_rules(
            'tgl_lahir',
            'Tanggal Lahir',
            'required'
        );

        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required'
        );

        if($this->form_validation->run() == FALSE)
        {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => validation_errors()
                ]));
        }

        $user_id = $this->session->userdata('user_id');

        $data = [

            'tgl_lahir'      => $this->input->post('tgl_lahir'),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
            'alamat'         => $this->input->post('alamat'),
            'kota'           => $this->input->post('kota'),
            'provinsi'       => $this->input->post('provinsi'),
            'id_type'        => $this->input->post('id_type'),
            'id_number'      => $this->input->post('id_number'),
            'nomor_sim'      => $this->input->post('nomor_sim'),

            // status default
            'is_verified'    => 'pending'

        ];

        $this->Customer_model
            ->save_profile($user_id, $data);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status'  => 'success',
                'message' => 'Profil berhasil dilengkapi'
            ]));
    }

}