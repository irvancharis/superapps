<?php
class M_FITUR extends CI_Model
{

    // Nama tabel
    protected $table_fitur = 'FITUR_';
    protected $table_detail_fitur = 'FITUR_DETAIL_';
    protected $VIEW_FITUR = 'VIEW_FITUR';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_fitur()
    {
        $query = $this->db->get('FITUR_');
        return $query->result_object();
    }

    public function get_detail_fitur($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_FITUR');
        $this->db->where('KODE_FITUR', $KODE);
        $query = $this->db->get();
        return$query->result_object();
    }

    public function getFilteredProduk($search)
    {
        $query = "SELECT * FROM VIEW_FITUR WHERE KODE_FITUR LIKE '%$search%' OR NAMA_FITUR LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_fitur_single($KODE)
    {
        $this->db->where('KODE_FITUR', $KODE);
        $query = $this->db->get('FITUR_');
        return $query->row();
    }

    public function get_latest_data()
    {
        $this->db->order_by('KODE_FITUR', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert_fitur($data)
    {
        return $this->db->insert($this->table_fitur, $data);
    }

    public function insert_detail_fitur($data)
    {
        return $this->db->insert($this->table_detail_fitur, $data);
    }

    public function update($KODE, $data)
    {
        $this->db->where('KODE_FITUR', $KODE);
        return $this->db->update($this->table_fitur, $data);
    }

    public function hapus($KODE)
    {
        $this->db->where('KODE_FITUR', $KODE);
        return $this->db->delete($this->table_fitur);
    }

    public function hapus_detail_fitur($KODE)
    {
        $this->db->where('KODE_DETAIL_FITUR', $KODE);
        return $this->db->delete($this->table_detail_fitur);
    }
}
