<?php

class mobil extends CI_Controller {

    public function index()
    {
        $data['mobil'] = $this->rental_model->get_data('mobil')->result();

        $data['type'] = $this->rental_model->get_data('type')->result();

        $this->load->view('templates_customer/header');
        $this->load->view('customer/mobil', $data);
        $this->load->view('templates_customer/footer');
    }
}