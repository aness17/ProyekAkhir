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
        $this->db->where('id_cs', $id);
        return $this->db->delete("transaksi");
        // $this->db->select('*');
        // $this->db->from('user');
        // $this->db->where('user.id_cs', $id);
        // $where_clause = $this->db->get_compiled_select();

        // #Create main query
        // $this->db->where('transaksi.id_cs', $id);
        // $this->db->where("`id_cs` NOT IN ($where_clause)", NULL, FALSE);
        // $this->db->delete('transaksi');

        // $this->db->where('transaksi.id_cs=user.id_cs');
        // $this->db->where('transaksi.id_cs', $id);
        // $this->db->delete(array('transaksi', 'user'));

        // DELETE transaksi,user FROM transaksi INNER JOIN user ON user.id_cs=transaksi.id_cs WHERE transaksi.id_cs='39'
        // DELETE a.*, b.* FROM transaksi a JOIN user b ON a.id_cs = b.id_cs WHERE a.id_cs = '32'
        // $this->db->delete('transaksi,user');
        // $this->db->join('user', 'user.id_cs=transaksi.id_cs');
        // $this->db->where('transaksi.id_cs', $id);
        // $this->db->query("DELETE transaksi,user FROM transaksi INNER JOIN user ON user.id_cs=transaksi.id_cs WHERE transaksi.id_cs='$id'", array($id));


        // return $this->db->get($this->table)->result_array(); 



        // $this->db->join('user', 'user.id_cs=transaksi.id_cs');
        // $this->db->where('transaksi.id_cs', $id);
        // return $this->db->delete('transaksi');
    }
    public function selectedit($id)
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.id_transaksi', $id);
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A")->result_array();
    }
    public function selecttransaksi()
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A")->result_array();
    }
    public function selecttransaksiagen($where)
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.status', 'selesai');
        $this->db->where('B.catatan', $where);
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A")->result_array();
    }

    public function selectAll()
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.status !=', 'selesai');
        $this->db->order_by('A.id_transaksi DESC');
        return $this->db->get($this->table . " as A")->result_array();
    }
    public function selectoutlet()
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.status !=', 'selesai');
        $this->db->like('B.catatan', 'input by outlet ' . $this->session->userdata('id'));
        $this->db->order_by('A.id_transaksi', 'DESC');

        return $this->db->get($this->table . " as A")->result_array();
    }
    public function selectAgen()
    {
        // SELECT * FROM `transaksi` A, user B, jenisld C,layananld D where A.id_cs = B.id_cs and A.id_jenis=C.id_jenis and A.id_layanan=D.id_layanan
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('A.status !=', 'selesai');
        $this->db->LIKE('B.catatan', 'input by agen');
        $this->db->order_by('A.id_transaksi', 'DESC');
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
    public function selectstatusoutlet($where)
    {
        $this->db->from('transaksi');
        $this->db->join('user user', 'transaksi.id_cs=user.id_cs');
        $this->db->where('transaksi.status', $where);
        $this->db->where('user.catatan', 'input by outlet ' . $this->session->userdata('id'));
        return $this->db->get()->num_rows();
    }
    public function selectransaksiagen($where)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('user', 'transaksi.id_cs=user.id_cs');
        $this->db->where('status', $where);
        $this->db->where('user.catatan', 'input by agen ' . $this->session->userdata('id'));
        return $this->db->get()->num_rows();
    }

    public function selecttrans()
    {
        $this->db->from('transaksi');

        return $this->db->get()->num_rows();
    }
    public function selecttransaksioutlet()
    {
        $this->db->from('transaksi');
        $this->db->join('user user', 'transaksi.id_cs=user.id_cs');
        $this->db->where('user.catatan', 'input by outlet ' . $this->session->userdata('id'));
        return $this->db->get()->num_rows();
    }
    public function selectwhere($where)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
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
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('B.id_cs  =', $id);
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A ")->result_array();
    }

    public function selectpesanan($id)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('B.id_cs  =', $id);
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A ")->result_array();
    }
    public function view_by_date($date)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('DATE(tgl_order)', $date); // Tambahkan where tanggal nya
        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    }
    public function view_by_month($month)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->like('tgl_order', $month); // Tambahkan where bulan
        // $this->db->where('YEAR(tgl_order)', $year); // Tambahkan where tahun

        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
    }
    public function view_by_year($year)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('YEAR(tgl_order)', $year); // Tambahkan where tahun

        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
    }
    public function view_by_date_outlet($date)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('DATE(tgl_order)', $date); // Tambahkan where tanggal nya
        $this->db->where('B.catatan', 'input by outlet ' . $this->session->userdata('id'));
        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    }
    public function view_by_month_outlet($month)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->like('tgl_order', $month); // Tambahkan where bulan
        $this->db->where('B.catatan', 'input by outlet ' . $this->session->userdata('id'));

        // $this->db->where('YEAR(tgl_order)', $year); // Tambahkan where tahun

        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
    }
    public function view_by_year_outlet($year)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('YEAR(tgl_order)', $year); // Tambahkan where tahun
        $this->db->where('B.catatan', 'input by outlet ' . $this->session->userdata('id'));

        return $this->db->get($this->table . " as A ")->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
    }
    public function view_all()
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->order_by('A.id_transaksi', 'DESC');
        return $this->db->get($this->table . " as A ")->result(); // Tampilkan semua data transaksi
    }
    public function view_all_outlet($catatan)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('B.catatan', $catatan);
        $this->db->order_by('A.id_transaksi DESC');
        return $this->db->get($this->table . " as A ")->result_array(); // Tampilkan semua data transaksi
    }

    public function view_outlet()
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where('B.catatan', 'input by outlet ' . $this->session->userdata('id'));
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

    public function getUserById($id)
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->where($this->primary, $id);
        return $this->db->get($this->table . " as A")->row_array();
    }
    public function sumharga()
    {
        $this->db->select_sum('harga');
        $this->db->where('A.status', 'selesai');
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
    public function sumhargatotalagen()
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->select_sum('harga')->where('B.catatan', 'input by agen ' . $this->session->userdata('id'));
        $this->db->where('status', 'selesai');

        return $this->db->get($this->table . " as A")->result();
    }
    public function sumpendapatanagen()
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->select_sum('harga')->where('B.catatan', 'input by agen ' . $this->session->userdata('id'));
        $this->db->where('status', 'selesai');

        return $this->db->get($this->table . " as A")->result();
    }
    public function sumhargabelumbayaragen()
    {
        $this->db->join('user B', 'A.id_cs=B.id_cs');
        $this->db->join('jenisld C', 'A.id_jenis=C.id_jenis');
        $this->db->join('layananld D', 'A.id_layanan=D.id_layanan');
        $this->db->select_sum('harga')->where('B.catatan', 'input by agen ' . $this->session->userdata('id'));
        $this->db->where('status!=', 'selesai');

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
    public function pesananAgen($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function selectnama($data)
    {
        $this->db->from('user');
        $this->db->where('nama_cs', $data);
        return $this->db->get()->result_array();
        // $this->db->where('A.id_cs', $id);
        // return $this->db->get($this->'user')->result_array();
    }
    public function selectjenis($data)
    {
        $this->db->from('jenisld');
        $this->db->where('nama_jenis', $data);
        return $this->db->get()->result_array();
        // $this->db->where('A.id_cs', $id);
        // return $this->db->get($this->'user')->result_array();
    }
    public function selectlayanan($data)
    {
        $this->db->from('layananld');
        $this->db->where('nama_layanan', $data);
        return $this->db->get()->result_array();
        // $this->db->where('A.id_cs', $id);
        // return $this->db->get($this->'user')->result_array();
    }
}
