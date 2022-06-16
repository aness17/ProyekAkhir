<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailTransaksi_model extends CI_Model
{
    private $table = 'detail_transaksi';
    private $primary = 'id_detail';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function selectAll()
    {
        return $this->db->get($this->table)->result_array();
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

    public function riwayat()
    {
        $this->db->where('transaksi.id_pelanggan', $this->session->userdata('id'));
        $this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        $this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk');
        $this->db->order_by('tgl_pesanan', 'DESC');
        return $this->db->get($this->table)->result_array();
    }
}
