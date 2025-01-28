<?php
class M_PRODUK_KATEGORI extends CI_Model
{

    // Nama tabel
    protected $table = 'PRODUK_KATEGORI';
    protected $view_produk_kategori = 'VIEW_PRODUK_KATEGORI';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_produk_kategori()
    {
        $query = $this->db->get('PRODUK_KATEGORI');
        return $query->result_object();
    }

    public function get_produk_kategori_single($KODE_PRODUK_KATEGORI)
    {
        $this->db->select('*');
		$this->db->from('PRODUK_KATEGORI');
		$this->db->where('KODE_PRODUK_KATEGORI', $KODE_PRODUK_KATEGORI);
		$query = $this->db->get();
        return $query;
    }

    public function get_kategori_produk()
    {
        $query = $this->db->get('PRODUK_KATEGORI');
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

    public function update($KODE_PRODUK_KATEGORI, $data)
    {
        $this->db->where('KODE_PRODUK_KATEGORI', $KODE_PRODUK_KATEGORI);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE_PRODUK_KATEGORI)
    {
        $this->db->where('KODE_PRODUK_KATEGORI', $KODE_PRODUK_KATEGORI);
        return $this->db->delete($this->table);
    }
}
