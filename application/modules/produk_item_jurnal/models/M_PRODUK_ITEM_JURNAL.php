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
        $this->db->select('
        pj.KODE_TRANSAKSI, 
        pj.KODE_ITEM, 
        pi.NAMA_ITEM,
        pk.NAMA_PRODUK_KATEGORI,
        pi.KETERANGAN_ITEM,
        pi.SATUAN,
        pi.FOTO_ITEM,
        pj.TANGGAL_TRANSAKSI, 
        pj.JENIS_TRANSAKSI, 
        ma.NAMA_AREA as AREA, 
        md.NAMA_DEPARTEMEN as DEPARTEMEN, 
        mr.NAMA_RUANGAN as RUANGAN, 
        ml.NAMA_LOKASI as LOKASI, 
        pj.JUMLAH, 
        pj.IN_OUT
    ');
        $this->db->from('VIEW_PRODUK_JURNAL pj');
        $this->db->join('MAPING_AREA ma', 'pj.AREA = ma.KODE_AREA', 'left');
        $this->db->join('MAPING_RUANGAN mr', 'pj.RUANGAN = mr.KODE_RUANGAN', 'left');
        $this->db->join('MAPING_LOKASI ml', 'pj.LOKASI = ml.KODE_LOKASI', 'left');
        $this->db->join('DEPARTEMEN md', 'pj.DEPARTEMEN = md.KODE_DEPARTEMEN', 'left');
        $this->db->join('PRODUK_ITEM pi', 'pj.KODE_ITEM = pi.KODE_ITEM', 'left');
        $this->db->join('PRODUK_KATEGORI pk', 'pi.KODE_KATEGORI = pk.KODE_PRODUK_KATEGORI', 'left');

        if (!empty($params['AREA'])) {
            $this->db->where('ma.KODE_AREA', $params['AREA']);
        }
        if (!empty($params['DEPARTEMEN'])) {
            $this->db->where('md.KODE_DEPARTEMEN', $params['DEPARTEMEN']);
        }
        if (!empty($params['RUANGAN'])) {
            $this->db->where('mr.KODE_RUANGAN', $params['RUANGAN']);
        }
        if (!empty($params['LOKASI'])) {
            $this->db->where('ml.KODE_LOKASI', $params['LOKASI']);
        }
        if (!empty($params['KODE_ITEM'])) {
            $this->db->where('pj.KODE_ITEM', $params['KODE_ITEM']);
        }

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

    // Mendapatkan transaksi berdasarkan kode
    public function get_jurnal_produk_by_kode($kode_transaksi)
    {
        $this->db->select('t.*, a.NAMA_AREA, d.NAMA_DEPARTEMEN, r.NAMA_RUANGAN, l.NAMA_LOKASI');
        $this->db->from('PRODUK_ITEM_JURNAL t');
        $this->db->join('MAPING_AREA a', 'a.KODE_AREA = t.AREA', 'left');
        $this->db->join('DEPARTEMEN d', 'd.KODE_DEPARTEMEN = t.DEPARTEMEN', 'left');
        $this->db->join('MAPING_RUANGAN r', 'r.KODE_RUANGAN = t.RUANGAN', 'left');
        $this->db->join('MAPING_LOKASI l', 'l.KODE_LOKASI = t.LOKASI', 'left');
        $this->db->where('t.KODE_TRANSAKSI', $kode_transaksi);
        return $this->db->get()->row();
    }

    // Mendapatkan semua transaksi untuk item di lokasi tertentu
    public function get_all_jurnal_for_item($kode_item, $kode_area, $kode_departemen, $kode_ruangan, $kode_lokasi)
    {
        $this->db->select('t.*, ps.JUMLAH_STOK ');
        $this->db->from('VIEW_PRODUK_JURNAL t');
        $this->db->join('PRODUK_STOK ps', 'ps.KODE_ITEM = t.KODE_ITEM AND ps.KODE_AREA = t.AREA AND ps.KODE_DEPARTEMEN = t.DEPARTEMEN AND ps.KODE_RUANGAN = t.RUANGAN AND ps.KODE_LOKASI = t.LOKASI', 'left');
        $this->db->where('t.KODE_ITEM', $kode_item);
        $this->db->where('t.AREA', $kode_area);
        $this->db->where('t.DEPARTEMEN', $kode_departemen);
        $this->db->where('t.RUANGAN', $kode_ruangan);
        $this->db->where('t.LOKASI', $kode_lokasi);
        $this->db->order_by('t.TANGGAL_TRANSAKSI', 'ASC');
        return $this->db->get()->result();
    }

    // MAS JUNIYAR
    public function get_all_jurnal_grouped_by_area()
    {
        // Query untuk mendapatkan semua data jurnal dikelompokkan by area
        $this->db->select('t.*, pi.NAMA_ITEM, pi.SATUAN, pi.KETERANGAN_ITEM, pi.FOTO_ITEM, 
                      a.NAMA_AREA, d.NAMA_DEPARTEMEN, r.NAMA_RUANGAN, l.NAMA_LOKASI, pk.NAMA_PRODUK_KATEGORI AS KATEGORI');
        $this->db->from('PRODUK_ITEM_JURNAL t');
        $this->db->join('PRODUK_ITEM pi', 'pi.KODE_ITEM = t.KODE_ITEM', 'left');
        $this->db->join('PRODUK_KATEGORI pk', 'pk.KODE_PRODUK_KATEGORI = pi.KODE_KATEGORI', 'left');
        $this->db->join('MAPING_AREA a', 'a.KODE_AREA = t.AREA', 'left');
        $this->db->join('DEPARTEMEN d', 'd.KODE_DEPARTEMEN = t.DEPARTEMEN', 'left');
        $this->db->join('MAPING_RUANGAN r', 'r.KODE_RUANGAN = t.RUANGAN', 'left');
        $this->db->join('MAPING_LOKASI l', 'l.KODE_LOKASI = t.LOKASI', 'left');
        $this->db->order_by('t.AREA, t.TANGGAL_TRANSAKSI', 'ASC');
        return $this->db->get()->result();
    }
    // MAS JUNIYAR
}
