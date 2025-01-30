<?php
class M_MAPING_RUANGAN extends CI_Model
{

    // Nama tabel
    protected $table = 'MAPING_RUANGAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_maping_ruangan()
    {
        $query = $this->db->get('VIEW_RUANGAN');
        return $query->result_object();
    }

    public function get_maping_ruangan_single($KODE_RUANGAN)
    {
        $this->db->select('*');
		$this->db->from('VIEW_RUANGAN');
		$this->db->where('KODE_RUANGAN', $KODE_RUANGAN);
		$query = $this->db->get();
        return $query;
    }

    public function get_area()
    {
        $query = $this->db->get('MAPING_AREA');
        return $query->result_object();
    }

    
    public function get_latest_data()
    {
        $this->db->order_by('IDTICKET', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($KODE_RUANGAN, $data)
    {
        $this->db->where('KODE_RUANGAN', $KODE_RUANGAN);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE_RUANGAN)
    {
        $this->db->where('KODE_RUANGAN', $KODE_RUANGAN);
        return $this->db->delete($this->table);
    }
}
