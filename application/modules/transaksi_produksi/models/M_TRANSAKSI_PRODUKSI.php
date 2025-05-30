<?php

class M_TRANSAKSI_PRODUKSI extends CI_Model
{

    // Nama tabel
    protected $table = 'TRANSAKSI_PRODUKSI';
    protected $table_detail = 'TRANSAKSI_PRODUKSI_DETAIL';
    protected $VIEW_TRANSAKSI_PRODUKSI = 'VIEW_TRANSAKSI_PRODUKSI';
    protected $VIEW_TRANSAKSI_PRODUKSI_DTL = 'VIEW_TRANSAKSI_PRODUKSI_DTL';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function total_transaksi_produksi()
    {
        $query = $this->db->count_all('VIEW_TRANSAKSI_PRODUKSI');
        return $query;
    }


    public function get_maping_default($area)
    {
        $this->db->where('AREA', $area);
        $query = $this->db->get('MAPING_DEFAULT');
        return $query->row();
    }

    public function get_ruangan_by_area($KODE_AREA)
    {
        $this->db->select("*");
        $this->db->from('VIEW_RUANGAN');
        $this->db->where('KODE_AREA', $KODE_AREA);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function total_proses_transaksi_produksi()
    {
        $this->db->where('STATUS_PRODUKSI !=', 'SELESAI');
        $this->db->where('STATUS_PRODUKSI !=', 'DITOLAK KABAG');
        $this->db->where('STATUS_PRODUKSI !=', 'DITOLAK GM');
        $this->db->where('STATUS_PRODUKSI !=', 'DITOLAK HEAD');
        $query = $this->db->count_all_results('VIEW_TRANSAKSI_PRODUKSI');
        return $query;
    }

    public function get_data()
    {
        // $this->db->where('STATUS_PRODUKSI !=' ,'SELESAI');
        // $this->db->where('STATUS_PRODUKSI !=' ,'DITOLAK KABAG');
        // $this->db->where('STATUS_PRODUKSI !=' ,'DITOLAK GM');
        // $this->db->where('STATUS_PRODUKSI !=' ,'DITOLAK HEAD');
        if ($this->session->userdata("NAMA_ROLE") !== 'GM' && $this->session->userdata("NAMA_ROLE") !== 'HEAD' && $this->session->userdata("NAMA_ROLE") !== 'gudang') {
            $this->db->where('DEPARTEMEN =', $this->session->userdata("ID_DEPARTEMEN"));
        }
        $this->db->order_by('TANGGAL_PENGAJUAN', 'DESC');
        $query = $this->db->get('VIEW_TRANSAKSI_PRODUKSI');
        return $query->result_object();
    }

    public function get_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TRANSAKSI_PRODUKSI');
        $this->db->where('UUID_TRANSAKSI_PRODUKSI', $KODE);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_produk_by_aset($KODE)
    {
        $this->db->where('UUID_ASET', $KODE);
        $query = $this->db->get('VIEW_ASET');
        return $query->row();
    }

    public function get_detail_single($KODE)
    {
        $this->db->select('*');
        $this->db->from($this->VIEW_TRANSAKSI_PRODUKSI_DTL);
        $this->db->where('UUID_TRANSAKSI_PRODUKSI', $KODE);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('IDTICKET', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function get_produk_input_produksi($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN)
    {
        $this->db->select('*');
        $this->db->from('VIEW_PRODUK_STOK');
        $this->db->where('KODE_AREA', $KODE_AREA);
        $this->db->where('KODE_RUANGAN', $KODE_RUANGAN);
        $this->db->where('KODE_LOKASI', $KODE_LOKASI);
        $this->db->where('KODE_DEPARTEMEN', $KODE_DEPARTEMEN);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($KODE, $data)
    {
        $this->db->where('NIK', $KODE);
        return $this->db->update($this->table, $data);
    }

    public function update_aset($KODE, $data)
    {
        $this->db->where('UUID_ASET', $KODE);
        return $this->db->update('ASET', $data);
    }


    public function update_transaksi($KODE, $data)
    {
        $this->db->where('UUID_TRANSAKSI_PRODUKSI', $KODE);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE)
    {
        $this->db->where('NIK', $KODE);
        return $this->db->delete($this->table);
    }

    public function delete_detail($KODE)
    {
        $this->db->where('UUID_TRANSAKSI_PRODUKSI', $KODE);
        return $this->db->delete($this->table_detail);
    }

    public function pengurangan_real_stok($KODE, $data)
    {
        $this->db->where('UUID_STOK', $KODE);
        $this->db->set('JUMLAH_STOK', 'JUMLAH_STOK - ' . (int)$data, FALSE);
        return $this->db->update('PRODUK_STOK');
    }

    public function list_produk_maping($area, $ruangan, $lokasi, $departemen)
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

    public function penambahan_real_stok($KODE, $data)
    {
        $this->db->where('UUID_STOK', $KODE);
        $this->db->set('JUMLAH_STOK', 'JUMLAH_STOK + ' . (int)$data, FALSE);
        return $this->db->update('PRODUK_STOK');
    }


    public function cek_stok($KODE_ITEM, $KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN)
    {
        $this->db->select('*');
        $this->db->from('VIEW_PRODUK_STOK');
        $this->db->where('KODE_ITEM', $KODE_ITEM);
        $this->db->where('KODE_AREA', $KODE_AREA);
        $this->db->where('KODE_RUANGAN', $KODE_RUANGAN);
        $this->db->where('KODE_LOKASI', $KODE_LOKASI);
        $this->db->where('KODE_DEPARTEMEN', $KODE_DEPARTEMEN);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_stok($data)
    {
        return $this->db->insert('PRODUK_STOK', $data);
    }

    public function insert_produk_item_jurnal($data)
    {
        return $this->db->insert('PRODUK_ITEM_JURNAL', $data);
    }

    public function get_karyawan_by_departemen($kode, $key)
    {
        $this->db->where('ID_DEPARTEMENT', $kode);
        $this->db->where('NAMA_JABATAN', $key);
        $query = $this->db->get('VIEW_KARYAWAN');
        return $query->row();
    }
}
