<?php
class M_MAPING_AREA extends CI_Model
{

    // Nama tabel
    protected $table = 'MAPING_AREA';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $query = $this->db->get('MAPING_AREA');
        return $query->result_object();
    }

    public function get_area()
    {
        $query = $this->db->get('MAPING_AREA');
        return $query->result_object();
    }

    public function get_maping_area_single($KODE)
    {
        $this->db->select('*');
		$this->db->from('MAPING_AREA');
		$this->db->where('KODE_AREA', $KODE);
		$query = $this->db->get();
        return $query;
    }

    public function get_latest_data()
    {
        $this->db->order_by('KODE_AREA', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_area, $data)
    {
        $this->db->where('KODE_AREA', $id_area);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_area)
    {
        $this->db->where('KODE_AREA', $id_area);
        return $this->db->delete($this->table);
    }
}
