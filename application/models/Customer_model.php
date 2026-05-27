<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    protected $table = 'customers';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function updateByUserId($user_id, $data)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->update($this->table, $data);
    }

    public function getByUserId($user_id)
    {
        return $this->db
            ->get_where($this->table, [
                'user_id' => $user_id
            ])
            ->row();
    }
    public function get_all_customers()
{
    $this->db->select('customers.*, users.nama_lengkap, users.email');
    $this->db->from('customers');
    $this->db->join('users', 'users.id = customers.user_id');

    return $this->db->get()->result();
}

}