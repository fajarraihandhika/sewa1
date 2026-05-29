<?php
class Home extends CI_Controller {
    public function index() {
        $data['mobil'] = $this->rental_model->filtermobil();
        $data['type']  = $this->rental_model->get_data('type')->result();
        $this->load->view('templates_customer/header');
        $this->load->view('home/index', $data);
        $this->load->view('templates_customer/footer');
    }
}