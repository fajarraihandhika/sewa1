<?php

class dashboard extends CI_Controller{
    public function index()
    {
        
        $data['mobil'] = $this->rental_model->get_data('mobil')->result();
        $data['type'] = $this->rental_model->get_data('type')->result();
        $this->load->view('templates_customer/header');
        $this->load->view('customer/dashboard',$data);
        $this->load->view('templates_customer/footer');
        
    }

    public function filter()
{
    $type = $this->input->get('type');
    $status = $this->input->get('status');
    $harga = $this->input->get('harga');

    $data['mobil'] = $this->rental_model->filtermobil($type, $status, $harga);

    $this->load->view('templates_customer/header');
    $this->load->view('customer/dashboard', $data);
    $this->load->view('templates_customer/footer');
}
}

?>