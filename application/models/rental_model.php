<?php
class rental_model extends CI_Model{
    public function get_data($table)
    {
       return $this->db->get($table);
    }

    public function insert_data($data,$table)
    {
        $this->db->insert($table,$data);
    }

    public function update_data($table,$data,$where)
    {
        $this->db->update($table,$data,$where);
    }

    public function delete_data($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function ambil_id_mobil($id)
    {
        $hasil = $this->db->where('id_mobil',$id)->get('mobil');
        if($hasil->num_rows() > 0){
            return $hasil->result();
        }else{
            FALSE;
        }
    }

    public function ambil_id_supir($id)
    {
        $hasil = $this->db->where('id_supir',$id)->get('supir');
        if($hasil->num_rows() > 0){
            return $hasil->result();
        }else{
            FALSE;
        }
    }


    public function filtermobil($type = null, $status = null, $harga = null)
{
    $this->db->select('mobil.*, type.nama_type');
    $this->db->from('mobil');
    $this->db->join('type', 'type.kode_type = mobil.kode_type');

    // FILTER TYPE
    if (!empty($type)) {
        $this->db->where('mobil.kode_type', $type);
    }

    // FILTER STATUS
    if (!empty($status)) {
        $this->db->where('mobil.status', $status);
    }

    // FILTER HARGA
    if ($harga == 'rendah') {
        $this->db->order_by('mobil.harga', 'ASC');
    } elseif ($harga == 'tinggi') {
        $this->db->order_by('mobil.harga', 'DESC');
    }

    return $this->db->get()->result();
}
    
}
?>