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
        $query = $this->db->get('MAPING_LOKASI');
        return $query->result_object();
    }

    public function get_maping_lokasi_single($KODE_LOKASI)
    {
        $this->db->select('*');
		$this->db->from('MAPING_LOKASI');
		$this->db->where('KODE_LOKASI', $KODE_LOKASI);
		$query = $this->db->get();
        return $query;
    }

    public function get_kategori_produk()
    {
        $query = $this->db->get('MAPING_LOKASI');
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
