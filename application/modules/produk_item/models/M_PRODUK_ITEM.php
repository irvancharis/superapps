<?php
class M_PRODUK_ITEM extends CI_Model
{

    // Nama tabel
    protected $table = 'PRODUK_ITEM';
    protected $view_produk_item = 'VIEW_PRODUK_ITEM';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_produk_item()
    {
        $query = $this->db->get('VIEW_PRODUK_ITEM');
        return $query->result_object();
    }

    public function getFilteredProduk($search)
    {
        $query = "SELECT * FROM VIEW_PRODUK_ITEM WHERE NAMA_ITEM LIKE '%$search%' OR KODE_ITEM LIKE '%$search%' OR NAMA_PRODUK_KATEGORI LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function getFilteredProdukStok($search)
    {
        $query = "SELECT * FROM VIEW_PRODUK_STOK WHERE NAMA_PRODUK LIKE '%$search%' OR KODE_ITEM LIKE '%$search%' OR NAMA_PRODUK_KATEGORI LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_produk_item_single($KODE_ITEM)
    {
        $this->db->select('*');
        $this->db->from('VIEW_PRODUK_ITEM');
        $this->db->where('KODE_ITEM', $KODE_ITEM);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_kategori_produk()
    {
        $query = $this->db->get('PRODUK_KATEGORI');
        return $query->result_object();
    }


    public function get_latest_data()
    {
        $this->db->order_by('KODE_ITEM', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($KODE_ITEM, $data)
    {
        $this->db->where('KODE_ITEM', $KODE_ITEM);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE_ITEM)
    {
        $this->db->where('KODE_ITEM', $KODE_ITEM);
        return $this->db->delete($this->table);
    }
}
