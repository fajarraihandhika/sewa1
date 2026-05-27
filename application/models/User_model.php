<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'users';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getByEmail($email)
    {
        return $this->db
            ->get_where($this->table, ['email' => $email])
            ->row();
    }

}