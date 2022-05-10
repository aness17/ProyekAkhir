<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    private $table = 'kategori';
    private $primary = 'id_kategori';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getKategori()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function selectAll()
    {
        $this->db->select('*');
        $this->db->from('kategori');
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
        $this->db->from('kategori');
        $this->db->where($this->primary, $id);
        return $this->db->get()->row_array();
    }
}
