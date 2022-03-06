<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'user';
    private $primary = 'id_cs';

    public function createUser($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getUserById($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($this->primary, $id);
        return $this->db->get()->row_array();
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where($this->table, ['email_cs' => $email])->row_array();
    }

    public function getUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        return $this->db->get()->result_array();
    }

    public function updateUser($data)
    {
        $this->db->where($this->primary, $data[$this->primary]);
        return $this->db->update($this->table, $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_cs', $id);
        return $this->db->update($this->table, $data);
    }
    public function deleteUser($id)
    {
        $this->db->where($this->primary, $id);
        return $this->db->delete($this->table);
        // DELETE transaksi,user FROM transaksi INNER JOIN user ON user.id_cs=transaksi.id_cs WHERE transaksi.id_cs='39'
        // DELETE a.*, b.* FROM transaksi a JOIN user b ON a.id_cs = b.id_cs WHERE a.id_cs = '32'
        // $this->db->from('transaksi');
        // $this->db->join('user', 'user.id_cs=transaksi.id_cs');
        // $this->db->where('transaksi.id_cs', $id);
        // $this->db->delete('transaksi');
        // return $this->db->get()->result_array();

        // $this->db->join('user', 'user.id_cs=transaksi.id_cs');
        // $this->db->where('transaksi.id_cs', $id);
        // return $this->db->delete('transaksi');
    }
    public function selectAll()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id_cs', 'ASC');
        return $this->db->get()->result_array();
    }
    public function sumcs()
    {
        $this->db->from('user');
        $this->db->where('fk_role', 1);
        return $this->db->get()->num_rows();
    }
    public function sumagen()
    {
        $this->db->from('user');
        $this->db->where('fk_role', 4);
        return $this->db->get()->num_rows();
    }
    public function sumoutlet()
    {
        $this->db->from('user');
        $this->db->where('fk_role', 2);
        return $this->db->get()->num_rows();
    }
    public function sumcsagen($where)
    {
        return $this->db->get_where('user', $where)->num_rows();
    }
    public function sumcsoutlet($where)
    {
        return $this->db->get_where('user', $where)->num_rows();
    }
    public function selectadm($where)
    {
        $this->db->from('user');
        $this->db->where('fk_role', $where);
        $this->db->order_by('id_cs', 'ASC');
        return $this->db->get()->result_array();
    }

    public function selectcs($where)
    {
        $this->db->from('user');
        $this->db->where($where);
        $this->db->order_by('id_cs', 'ASC');
        return $this->db->get()->result_array();
    }
    public function sumpemesanan()
    {
        $this->db->from('transaksi');
        return $this->db->get()->num_rows();
    }
    // $user = $this->db->query("SELECT * FROM user where fk_role = '1' and catatan = 'input by outlet ".$this->session->userdata('id')."'" );

}
