<?php
class M_MAPING_LOKASI extends CI_Model
{

    // Nama tabel
    protected $table = 'MAPING_LOKASI';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_maping_lokasi()
    {
        $query = $this->db->get('VIEW_LOKASI');
        return $query->result_object();
    }

    public function get_maping_lokasi_single($KODE_LOKASI)
    {
        $this->db->select('*');
		$this->db->from('VIEW_LOKASI');
		$this->db->where('KODE_LOKASI', $KODE_LOKASI);
		$query = $this->db->get();
        return $query;
    }

    public function get_area()
    {
        $query = $this->db->get('MAPING_AREA');
        return $query->result_object();
    }    

    public function get_ruangan()
    {
        $query = $this->db->get('MAPING_RUANGAN');
        return $query->result_object();
    }   
 

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($KODE_LOKASI, $data)
    {
        $this->db->where('KODE_LOKASI', $KODE_LOKASI);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE_LOKASI)
    {
        $this->db->where('KODE_LOKASI', $KODE_LOKASI);
        return $this->db->delete($this->table);
    }
}
