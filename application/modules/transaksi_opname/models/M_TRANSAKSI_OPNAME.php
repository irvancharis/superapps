<?php

class M_TRANSAKSI_OPNAME extends CI_Model
{

    // Nama tabel
    protected $table = 'TRANSAKSI_OPNAME';
    protected $table_detail = 'TRANSAKSI_OPNAME_DETAIL';
    protected $VIEW_TRANSAKSI_OPNAME = 'VIEW_TRANSAKSI_OPNAME';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function total_transaksi_opname()
    {
        $query = $this->db->count_all('VIEW_TRANSAKSI_OPNAME');
        return $query;
    }

    public function total_proses_transaksi_opname()
    {
        $this->db->where('STATUS_OPNAME !=', 'SELESAI');
        $this->db->where('STATUS_OPNAME !=', 'DITOLAK KABAG');
        $this->db->where('STATUS_OPNAME !=', 'DITOLAK GM');
        $this->db->where('STATUS_OPNAME !=', 'DITOLAK HEAD');
        $query = $this->db->count_all_results('VIEW_TRANSAKSI_OPNAME');
        return $query;
    }

    public function get_data()
    {
        $this->db->where('STATUS_OPNAME !=', 'SELESAI');
        $this->db->where('STATUS_OPNAME !=', 'DITOLAK KABAG');
        $this->db->where('STATUS_OPNAME !=', 'DITOLAK GM');
        $this->db->where('STATUS_OPNAME !=', 'DITOLAK HEAD');
        $this->db->order_by('TANGGAL_OPNAME', 'DESC');
        $query = $this->db->get('VIEW_TRANSAKSI_OPNAME');
        return $query->result_object();
    }

    public function get_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TRANSAKSI_OPNAME');
        $this->db->where('UUID_TRANSAKSI_OPNAME', $KODE);
        $query = $this->db->get();
        return $query;
    }

    public function get_detail_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TRANSAKSI_OPNAME_DETAIL');
        $this->db->where('UUID_TRANSAKSI_OPNAME', $KODE);
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

    public function get_produk_input_opname($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN)
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


    public function update_transaksi($KODE, $data)
    {
        $this->db->where('UUID_TRANSAKSI_OPNAME', $KODE);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE)
    {
        $this->db->where('NIK', $KODE);
        return $this->db->delete($this->table);
    }

    public function delete_detail($KODE)
    {
        $this->db->where('UUID_TRANSAKSI_OPNAME', $KODE);
        return $this->db->delete($this->table_detail);
    }

    public function update_real_stok($KODE, $data)
    {
        $this->db->where('UUID_STOK', $KODE);
        return $this->db->update('PRODUK_STOK', $data);
    }
}
