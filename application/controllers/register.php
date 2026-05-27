<?php 

class register extends CI_Controller{
    public function index()
    {
        $this->load->view('templates_admin/header');
        $this->load->view('register');
        $this->load->view('templates_admin/footer');
    }
}

?>