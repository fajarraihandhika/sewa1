<?php

class data_supir extends CI_Controller {

    public function index()
    {
        $data['supir'] = $this->rental_model->get_data('supir')->result();

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_supir', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_supir()
    {
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/form_tambah_supir');
        $this->load->view('templates_admin/footer');
    }

    public function tambah_supir_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {

            $this->tambah_supir();

        } else {

            $nama         = $this->input->post('nama');
            $no_telepon   = $this->input->post('no_telepon');
            $alamat       = $this->input->post('alamat');
            $status       = $this->input->post('status');

            $foto = '';

            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']   = './assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {

                    $foto = $this->upload->data('file_name');

                } else {

                    echo $this->upload->display_errors();
                    return;
                }
            }

            $data = array(
                'nama'         => $nama,
                'no_telepon'   => $no_telepon,
                'alamat'       => $alamat,
                'foto'         => $foto,
                'status'       => $status
            );

            $this->rental_model->insert_data($data, 'supir');

            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Supir Berhasil Ditambahkan!
                    <button type="button" class="close" data-bs-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>'
            );

            redirect('admin/data_supir');
        }
    }

    public function update_supir($id)
    {
        $where = array('id_supir' => $id);

        $data['supir'] = $this->db->query("SELECT * FROM supir WHERE id_supir = '$id'")->result();

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/form_update_supir', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update_supir_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {

            $this->update_supir(
                $this->input->post('id_supir')
            );

        } else {

            $id           = $this->input->post('id_supir');
            $nama         = $this->input->post('nama');
            $no_telepon   = $this->input->post('no_telepon');
            $alamat       = $this->input->post('alamat');
            $status       = $this->input->post('status');

            $data = array(
                'nama'         => $nama,
                'no_telepon'   => $no_telepon,
                'alamat'       => $alamat,
                'status'       => $status
            );

            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']   = './assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {

                    $foto = $this->upload->data('file_name');
                    $data['foto'] = $foto;

                } else {

                    echo $this->upload->display_errors();
                    return;
                }
            }

            $where = array(
                'id_supir' => $id
            );

            $this->rental_model->update_data('supir', $data, $where);

            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Supir Berhasil Diupdate!
                    <button type="button" class="close" data-bs-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>'
            );

            redirect('admin/data_supir');
        }
    }

    public function delete_supir($id)
    {
        $where = array(
            'id_supir' => $id
        );

        $this->rental_model->delete_data($where, 'supir');

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Supir Berhasil Dihapus!
                <button type="button" class="close" data-bs-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>'
        );

        redirect('admin/data_supir');
    }
    public function detail_supir($id)
    {
        $data['detail'] = $this->rental_model->ambil_id_supir($id);
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/detail_supir',$data);
        $this->load->view('templates_admin/footer');
    }

    public function _rules()
    {
        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required'
        );

        $this->form_validation->set_rules(
            'no_telepon',
            'No Telepon',
            'required'
        );

        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required'
        );

        $this->form_validation->set_rules(
            'status',
            'Status',
            'required'
        );
    }
}