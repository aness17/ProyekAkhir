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
        $this->db->Order_by('A.nama_produk', "ASC");
        return $this->db->get($this->table . " as A")->result_array();
    }

    public function getWhere($where)
    {
        $this->db->where($where);
        return $this->db->geT($this->table)->row_array();
    }

    public function selectproduk($kategori)
    {
        $this->db->join('kategori B', 'A.fk_kategori=B.id_kategori');
        $this->db->join('umkm C', 'A.fk_umkm=C.id_umkm');
        $this->db->where('B.nama_kategori', $kategori);
        $this->db->Order_by('A.nama_produk', "ASC");
        return $this->db->get($this->table . " as A")->result_array();
    }
    public function sumProduk()
    {
        return $this->db->get($this->table)->num_rows();
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
    public function getProdukById($id)
    {
        $this->db->where($this->primary, $id);
        return $this->db->get($this->table)->row_array();
    }
    public function getLastId()
    {
        $this->db->select_max('id_produk');
        return $this->db->get($this->table)->row_array();
    }
    public function selectharga($harga, $harga2)
    {
        $this->db->join('kategori B', 'A.fk_kategori=B.id_kategori');
        $this->db->join('umkm C', 'A.fk_umkm=C.id_umkm');
        $this->db->where('A.harga_produk >=', $harga);
        $this->db->where('A.harga_produk <=', $harga2);
        $this->db->Order_by('A.harga_produk', "ASC");
        return $this->db->get($this->table . " as A")->result_array();
    }
}
