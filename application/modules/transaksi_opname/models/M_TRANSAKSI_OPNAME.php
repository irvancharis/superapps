<?php

class M_TRANSAKSI_OPNAME extends CI_Model
 {

    // Nama tabel
    protected $table = 'TRANSAKSI_PENGADAAN';
    protected $VIEW_KARYAWAN = 'VIEW_KARYAWAN';

    public function __construct()
 {
        parent::__construct();
        $this->load->database();
    }

    public function get_data()
 {
        $query = $this->db->get( 'VIEW_TRANSAKSI_OPNAME' );
        return $query->result_object();
    }

    public function get_karyawan()
 {
        $query = $this->db->get( 'VIEW_KARYAWAN' );
        return $query->result_object();
    }

    public function get_single( $KODE )
 {
        $this->db->select( '*' );
        $this->db->from( 'VIEW_KARYAWAN' );
        $this->db->where( 'NIK', $KODE );
        $query = $this->db->get();
        return $query;
    }

    public function get_area()
 {
        $query = $this->db->get( 'MAPING_AREA' );
        return $query->result_object();
    }

    public function get_departemen()
 {
        $query = $this->db->get( 'DEPARTEMEN' );
        return $query->result_object();
    }

    public function get_jabatan()
 {
        $query = $this->db->get( 'JABATAN' );
        return $query->result_object();
    }

    public function get_latest_data()
 {
        $this->db->order_by( 'IDTICKET', 'DESC' );
        $this->db->limit( 1 );
        $query = $this->db->get( $this->table );
        return $query->result_object();
    }

    public function insert( $data )
 {
        return $this->db->insert( $this->table, $data );
    }

    public function update( $KODE_ITEM, $data )
 {
        $this->db->where( 'NIK', $KODE_ITEM );
        return $this->db->update( $this->table, $data );
    }

    public function hapus( $KODE_ITEM )
 {
        $this->db->where( 'NIK', $KODE_ITEM );
        return $this->db->delete( $this->table );
    }
}