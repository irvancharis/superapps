<?php
class M_ROLE extends CI_Model
{

    // Nama tabel
    protected $table_role = 'ROLE_';
    protected $table_detail_role = 'ROLE_DETAIL_';
    protected $VIEW_ROLE = 'VIEW_ROLE';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_role()
    {
        $query = $this->db->get('ROLE_');
        return $query->result_object();
    }

    public function get_detail_role()
    {
        $query = $this->db->get('VIEW_ROLE');
        return $query->result_object();
    }

    public function get_detail_role_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_ROLE');
        $this->db->where('KODE_ROLE', $KODE);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_detail_fitur_single($KODE_ROLE, $KODE_DETAIL_FITUR)
    {
        $this->db->select('*');
        $this->db->from('VIEW_ROLE');
        $this->db->where('KODE_ROLE', $KODE_ROLE);
        $this->db->where('KODE_DETAIL_FITUR', $KODE_DETAIL_FITUR);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getFilteredProduk($search)
    {
        $query = "SELECT * FROM VIEW_ROLE WHERE KODE_ROLE LIKE '%$search%' OR NAMA_ROLE LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_role_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('ROLE_');
        $this->db->where('KODE_ROLE', $KODE);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_latest_data()
    {
        $this->db->order_by('KODE_ROLE', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert_role($data)
    {
        return $this->db->insert($this->table_role, $data);
    }

    public function insert_detail_role($data)
    {
        return $this->db->insert($this->table_detail_role, $data);

    }

    public function update($KODE, $data)
    {
        $this->db->where('KODE_ROLE', $KODE);
        return $this->db->update($this->table_role, $data);
    }

    public function hapus($KODE)
    {
        $this->db->where('KODE_ROLE', $KODE);
        return $this->db->delete($this->table_role);
    }
}
