<?php

class M_TRANSAKSI_PENGHAPUSAN extends CI_Model
{

    // Nama tabel
    protected $table = 'TRANSAKSI_PENGHAPUSAN';
    protected $table_detail = 'TRANSAKSI_PENGHAPUSAN_DETAIL';
    protected $VIEW_TRANSAKSI_PENGHAPUSAN = 'VIEW_TRANSAKSI_PENGHAPUSAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data()
    {
        $query = $this->db->get('VIEW_TRANSAKSI_PENGHAPUSAN');
        return $query->result_object();
    }

    public function get_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TRANSAKSI_PENGHAPUSAN');
        $this->db->where('UUID_TRANSAKSI_PENGHAPUSAN', $KODE);
        $query = $this->db->get();
        return $query;
    }

    public function get_detail_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TRANSAKSI_PENGHAPUSAN_DETAIL');
        $this->db->where('UUID_TRANSAKSI_PENGHAPUSAN', $KODE);
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

    public function get_produk_input_penghapusan($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN)
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
        $this->db->where('UUID_TRANSAKSI_PENGHAPUSAN', $KODE);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE)
    {
        $this->db->where('NIK', $KODE);
        return $this->db->delete($this->table);
    }

    public function delete_detail($KODE)
    {
        $this->db->where('UUID_TRANSAKSI_PENGHAPUSAN', $KODE);
        return $this->db->delete($this->table_detail);
    }

    public function update_real_stok($KODE, $data)
    {
        $this->db->where('UUID_STOK', $KODE);
        return $this->db->update('PRODUK_STOK', $data);
    }
}
