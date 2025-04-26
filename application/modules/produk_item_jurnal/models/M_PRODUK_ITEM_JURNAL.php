<?php
class M_PRODUK_ITEM_JURNAL extends CI_Model
{

    // Nama tabel
    protected $table = 'PRODUK_ITEM_JURNAL';
    protected $view_produk_item = 'VIEW_PRODUK_JURNAL';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_produk_stok()
    {
        $query = $this->db->get('VIEW_PRODUK_JURNAL');
        return $query->result_object();
    }

    public function getFilteredProduk($search)
    {
        $query = "SELECT * FROM VIEW_PRODUK_JURNAL WHERE UPPER(NAMA_ITEM) LIKE '%$search%' OR KODE_ITEM LIKE '%$search%' OR UPPER(NAMA_PRODUK_KATEGORI) LIKE '%$search%'";
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
        $this->db->from('VIEW_PRODUK_JURNAL');
        $this->db->where('KODE_ITEM', $KODE_ITEM);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_produk_item_jurnal_detail($params)
    {
        // $this->db->select('*');
        // $this->db->from('VIEW_PRODUK_JURNAL');
        // $this->db->where('KODE_ITEM', $KODE_ITEM);
        // $this->db->where('DEPARTEMEN', $DEPARTEMEN);
        // $this->db->where('AREA', $AREA);
        // $this->db->where('RUANGAN', $RUANGAN);
        // $this->db->where('LOKASI', $LOKASI);
        // $query = $this->db->get();
        // return $query->result_object();

        $this->db->select('KODE_ITEM, TANGGAL_TRANSAKSI, JENIS_TRANSAKSI, JUMLAH, IN_OUT');
        $this->db->from('VIEW_PRODUK_JURNAL');

        if (!empty($params['AREA'])) {
            $this->db->where('AREA', $params['AREA']);
        }
        if (!empty($params['DEPARTEMEN'])) {
            $this->db->where('DEPARTEMEN', $params['DEPARTEMEN']);
        }
        if (!empty($params['RUANGAN'])) {
            $this->db->where('RUANGAN', $params['RUANGAN']);
        }
        if (!empty($params['LOKASI'])) {
            $this->db->where('LOKASI', $params['LOKASI']);
        }
        if (!empty($params['KODE_ITEM'])) {
            $this->db->where('KODE_ITEM', $params['KODE_ITEM']);
        }
        // ... filter lainnya

        $query = $this->db->get();
        return $query->result_array();
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
