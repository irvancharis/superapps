<?php
class M_USER extends CI_Model
{

    // Nama tabel
    protected $table = 'USER';
    protected $view_user = 'VIEW_USER';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user()
    {
        $query = $this->db->get('VIEW_USER');
        return $query->result_object();
    }

    public function getFilteredUSER($search)
    {
        $query = "SELECT * FROM VIEW_USER WHERE NAMA_USER LIKE '%$search%' OR UUID_USER LIKE '%$search%' ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_user_single($KODE_USER)
    {
        $this->db->select('*');
        $this->db->from('VIEW_USER');
        $this->db->where('UUID_USER', $KODE_USER);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_latest_data()
    {
        $this->db->order_by('KODE_USER', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($KODE_USER, $data)
    {
        $this->db->where('UUID_USER', $KODE_USER);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE_USER)
    {
        $this->db->where('UUID_USER', $KODE_USER);
        return $this->db->delete($this->table);
    }
}
