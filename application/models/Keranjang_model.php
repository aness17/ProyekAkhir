<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    private $table = 'keranjang';
    private $primary = 'id_keranjang';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function selectAll()
    {
        $this->db->where('keranjang.id_pelanggan', $this->session->userdata('id'));
        $this->db->join('produk', 'produk.id_produk = keranjang.id_produk');
        return $this->db->get($this->table)->result_array();
    }
    public function selectjumlah()
    {
        $this->db->where('keranjang.id_pelanggan', $this->session->userdata('id'));
        $this->db->join('produk', 'produk.id_produk = keranjang.id_produk');
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
    public function getUserById($id)
    {
        $this->db->where($this->primary, $id);
        return $this->db->get($this->table)->row_array();
    }
}
