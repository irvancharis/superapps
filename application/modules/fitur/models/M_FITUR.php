<?php
class M_FITUR extends CI_Model
{

    // Nama tabel
    protected $table = 'FITUR';
    protected $VIEW_FITUR = 'VIEW_FITUR';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_fitur()
    {
        $query = $this->db->get('VIEW_FITUR');
        return $query->result_object();
    }

    public function getFilteredProduk($search)
    {
        $query = "SELECT * FROM VIEW_FITUR WHERE NAMA_ITEM LIKE '%$search%' OR KODE_FITUR LIKE '%$search%' OR NAMA_PRODUK_KATEGORI LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_fitur_single($KODE_FITUR)
    {
        $this->db->select('*');
        $this->db->from('VIEW_FITUR');
        $this->db->where('KODE_FITUR', $KODE_FITUR);
        $query = $this->db->get();
        return $query;
    }

    public function get_latest_data()
    {
        $this->db->order_by('KODE_FITUR', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($KODE_FITUR, $data)
    {
        $this->db->where('KODE_FITUR', $KODE_FITUR);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE_FITUR)
    {
        $this->db->where('KODE_FITUR', $KODE_FITUR);
        return $this->db->delete($this->table);
    }
}
