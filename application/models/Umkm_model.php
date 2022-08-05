<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Umkm_model extends CI_Model
{
    private $table = 'umkm';
    private $primary = 'id_umkm';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getLayanan()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function selectAll()
    {
        $this->db->select('*');
        $this->db->from('umkm');
        $this->db->Order_by('nama_umkm', "ASC");
        return $this->db->get()->result_array();
    }
    public function delete($id)
    {
        $this->db->where($this->primary, $id);
        return $this->db->delete($this->table);
    }
    public function update($data)
    {
        $this->db->where($this->primary, $data[$this->primary]);
        return $this->db->update($this->table, $data);
    }
    public function getUserById($id)
    {
        $this->db->select('*');
        $this->db->from('umkm');
        $this->db->where($this->primary, $id);
        return $this->db->get()->row_array();
    }
    public function sumumkm()
    {
        $this->db->from('umkm');
        return $this->db->get()->num_rows();
    }
}
