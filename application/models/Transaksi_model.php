<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    private $table = 'transaksi';
    private $primary = 'id_transaksi';

    public function createPesanan($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function deleteUser($id)
    {
        $this->db->where('id_pelanggan', $id);
        return $this->db->delete("transaksi");
    }
    public function getWhere($where)
    {
        $this->db->where($where);
        return $this->db->get($this->table)->row_array();
    }
    public function getLastId()
    {
        $this->db->select_max('id_transaksi');
        return $this->db->get($this->table)->row_array();
    }
    public function selectedit($id)
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('detail_transaksi C', 'A.id_transaksi=C.id_transaksi');
        $this->db->join('produk D', 'D.id_produk = C.id_produk');
        $this->db->where('A.id_transaksi', $id);
        $this->db->order_by('A.id_transaksi', 'ASC');
        return $this->db->get($this->table . " as A")->result_array();
    }
    public function selectAll()
    {
        // $this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('detail_transaksi C', 'A.id_transaksi=C.id_transaksi');
        $this->db->join('produk D', 'D.id_produk = C.id_produk');
        $this->db->order_by('C.id_detail', 'ASC');
        return $this->db->get($this->table . " as A")->result_array();
    }

    public function update($data, $id)
    {
        $this->db->where('id_transaksi', $id);
        return $this->db->update($this->table, $data);
    }
    public function select($where)
    {
        $this->db->from('transaksi');
        $this->db->where('status', $where);
        return $this->db->get()->num_rows();
    }

    public function selecttrans()
    {
        $this->db->from('transaksi');

        return $this->db->get()->num_rows();
    }

    public function selectwhere($where)
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('produk C', 'A.id_produk=C.id_produk');
        $this->db->where('A.status =', $where);
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A")->result_array();
    }
    public function selectagenstatus()
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.status !=', 'selesai');
        $this->db->where('A.status !=', 'Menunggu Penjemputan');
        $this->db->where('B.catatan =', 'input by agen ' . $this->session->userdata('id'));
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A")->result_array();
    }

    public function selectoutletstatus()
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.status !=', 'selesai');
        $this->db->where('A.status !=', 'Menunggu Penjemputan');
        $this->db->where('B.catatan =', 'input by outlet ' . $this->session->userdata('id'));
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A")->result_array();
    }

    public function selecthasil($id)
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('produk C', 'A.id_produk=C.id_produk');
        $this->db->where('B.id_pelanggan  =', $id);
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A ")->result_array();
    }

    public function selectpesanan($id)
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('produk C', 'A.id_produk=C.id_produk');
        $this->db->where('B.id_pelanggan  =', $id);
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A ")->result_array();
    }
    public function view_by_date($date)
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('produk C', 'A.id_produk=C.id_produk');
        $this->db->where('DATE(tgl_order)', $date); // Tambahkan where tanggal nya
        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    }
    public function view_by_month($month)
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('produk C', 'A.id_produk=C.id_produk');
        $this->db->like('tgl_order', $month); // Tambahkan where bulan
        // $this->db->where('YEAR(tgl_order)', $year); // Tambahkan where tahun

        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
    }
    public function view_by_year($year)
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('produk C', 'A.id_produk=C.id_produk');
        $this->db->where('YEAR(tgl_order)', $year); // Tambahkan where tahun

        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
    }

    public function view_all()
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('produk C', 'A.id_produk=C.id_produk');
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A ")->result(); // Tampilkan semua data transaksi
    }

    public function option_tahun()
    {
        // $this->db->join('user B', 'A.id_cs=B.id_cs');
        // $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        // $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->select('YEAR(tgl_order) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tgl_order)'); // Urutkan berdasarkan tahun secara Descending (DESC)
        $this->db->group_by('YEAR(tgl_order)'); // Group berdasarkan tahun pada field tgl

        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
    public function updatePesanan($data, $id)
    {
        $this->db->where('id_transaksi', $id);
        return $this->db->update($this->table, $data);
    }

    public function getTransaksiById($id)
    {
        $this->db->join('pelanggan B', 'A.id_pelanggan=B.id_pelanggan');
        $this->db->join('detail_transaksi C', 'A.id_transaksi=C.id_transaksi');
        $this->db->join('produk D', 'D.id_produk = C.id_produk');
        $this->db->where($this->primary, $id);
        return $this->db->get($this->table . " as A")->row_array();
    }
    public function sumharga()
    {
        $this->db->select_sum('total_harga');
        return $this->db->get($this->table . " as A")->result();
    }
    public function sumhargaproses()
    {
        $this->db->select_sum('harga');
        $this->db->where('A.status !=', 'selesai');
        return $this->db->get($this->table . " as A")->result();
    }
    public function sumhargatotal()
    {
        $this->db->select_sum('harga');
        return $this->db->get($this->table . " as A")->result();
    }

    public function struk($id)
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.id_cs', $id);
        $this->db->Order_by('A.id_transaksi', "DESC");
        $this->db->limit(1);
        return $this->db->get($this->table . " as A")->result_array();
    }
}
