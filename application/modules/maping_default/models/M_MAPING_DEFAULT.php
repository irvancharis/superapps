<?php
class M_MAPING_DEFAULT extends CI_Model
{

    // Nama tabel
    protected $table = 'MAPING_DEFAULT';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function get_area()
    {
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function get_maping_default_single($AREA)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('AREA', $AREA);
        $query = $this->db->get();
        return $query;
    }

    public function get_latest_data()
    {
        $this->db->order_by('AREA', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($AREA, $data)
    {
        $this->db->where('AREA', $AREA);
        return $this->db->update($this->table, $data);
    }

    public function hapus($AREA)
    {
        $this->db->where('AREA', $AREA);
        return $this->db->delete($this->table);
    }
}
