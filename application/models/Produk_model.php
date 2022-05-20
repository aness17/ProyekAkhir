<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $table = 'produk';
    private $primary = 'id_produk';

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

        $this->db->join('kategori B', 'A.fk_kategori=B.id_kategori');
        $this->db->join('umkm C', 'A.fk_umkm=C.id_umkm');
        return $this->db->get($this->table . " as A")->result_array();
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
        $this->db->from('produk');
        $this->db->where($this->primary, $id);
        return $this->db->get()->row_array();
    }
}
