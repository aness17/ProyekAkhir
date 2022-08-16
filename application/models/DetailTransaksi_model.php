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

    public function getFrekuensi($nama)
    {
        $this->db->where("produk.nama_produk", $nama);
        $this->db->select("count(*) as jumlah");
        $this->db->join("produk", "produk.id_produk = detail_transaksi.id_produk");
        return $this->db->get($this->table)->row_array();
    }

    public function bestSeller($date)
    {
        $this->db->select("sum(ket_jumlah) as ket_jumlah, produk.*");
        $this->db->join("produk", "produk.id_produk = detail_transaksi.id_produk");
        $this->db->join("transaksi", "transaksi.id_transaksi = detail_transaksi.id_transaksi");
        $this->db->where('transaksi.tgl_pesanan like', '%' . $date . '%');
        $this->db->group_by("id_produk");
        $this->db->order_by("ket_jumlah", "desc");
        $this->db->limit(3);
        return $this->db->get($this->table)->result_array();
    }

    public function riwayat()
    {
        $this->db->where('transaksi.id_pelanggan', $this->session->userdata('id'));
        $this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        $this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk');
        $this->db->group_by("detail_transaksi.id_transaksi");
        $this->db->select("detail_transaksi.*, transaksi.*, produk.*,GROUP_CONCAT(produk.nama_produk) as nama_produk, sum(detail_transaksi.ket_jumlah) as ket_jumlah");
        $this->db->order_by('transaksi.tgl_pesanan', 'DESC');
        return $this->db->get($this->table)->result_array();
    }
    public function riwayat_user($date)
    {
        $this->db->where('transaksi.id_pelanggan', $this->session->userdata('id'));
        $this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        $this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk');
        $this->db->where('DATE(tgl_pesanan) like ', $date);
        $this->db->group_by("detail_transaksi.id_transaksi");
        $this->db->select("detail_transaksi.*, transaksi.*, produk.*,GROUP_CONCAT(produk.nama_produk) as nama_produk, sum(detail_transaksi.ket_jumlah) as ket_jumlah");
        $this->db->order_by('transaksi.tgl_pesanan', 'DESC');
        return $this->db->get($this->table)->result_array();
    }
    public function sekect()
    {
        // $this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('detail_transaksi C', 'A.id_transaksi=C.id_transaksi');
        $this->db->join('produk D', 'D.id_produk = C.id_produk');
        $this->db->group_by("A.id_transaksi");
        $this->db->select("A.*, B.*, C.*, D.*,GROUP_CONCAT(D.nama_produk) as nama_produk, sum(C.ket_jumlah) as ket_jumlah");
        $this->db->order_by('C.id_detail', 'ASC');
        return $this->db->get($this->table . " as A")->result_array();
    }
}
