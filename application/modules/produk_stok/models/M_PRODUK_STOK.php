<?php
class M_PRODUK_STOK extends CI_Model
{

    // Nama tabel
    protected $table = 'PRODUK_STOK';
    protected $VIEW_PRODUK_STOK = 'VIEW_PRODUK_STOK';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_produk_stok()
    {
        $query = $this->db->get('VIEW_PRODUK_STOK');
        return $query->result_object();
    }

    public function get_jumlah_stok($kode)
    {
        $this->db->where('UUID_STOK', $kode);
        $query = $this->db->get('VIEW_PRODUK_STOK');
        return $query->row();
    }

    public function cek_aset($kode)
    {
        $this->db->where('UUID_STOK', $kode);
        $query = $this->db->get('VIEW_ASET');
        return $query->result_object();
    }

    public function cek_detail_produk($kode)
    {
        $this->db->where('UUID_STOK', $kode);
        $query = $this->db->get('VIEW_ASET');
        return $query->row();
    }

    public function cek_histori_aset($kode)
    {
        $this->db->where('UUID_ASET', $kode);
        $query = $this->db->get('VIEW_ASET_DETAIL');
        return $query->result_object();
    }

    public function getProdukMaping($area, $ruangan, $lokasi, $departemen)
    {
        if (!empty($area)) {
            $this->db->where('KODE_AREA', $area);
        }
        if (!empty($ruangan)) {
            $this->db->where('KODE_RUANGAN', $ruangan);
        }
        if (!empty($lokasi)) {
            $this->db->where('KODE_LOKASI', $lokasi);
        }
        if (!empty($departemen)) {
            $this->db->where('KODE_DEPARTEMEN', $departemen);
        }
        $result = $this->db->get('VIEW_PRODUK_STOK');
        return $result->result_object();
    }

    public function getFilteredProduk($search)
    {
        $query = "SELECT * FROM VIEW_PRODUK_STOK WHERE NAMA_PRODUK LIKE '%$search%' OR KODE_ITEM LIKE '%$search%' OR NAMA_PRODUK_KATEGORI LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_produk_stok_single($KODE_ITEM)
    {
        $this->db->select('*');
        $this->db->from('VIEW_PRODUK_STOK');
        $this->db->where('KODE_ITEM', $KODE_ITEM);
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
        $this->db->order_by('KODE_ITEM', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert_aset($data)
    {
        return $this->db->insert('ASET', $data);
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