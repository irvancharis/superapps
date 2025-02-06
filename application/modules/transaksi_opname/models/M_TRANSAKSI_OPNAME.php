<?php

class M_TRANSAKSI_OPNAME extends CI_Model
 {

    // Nama tabel
    protected $table = 'TRANSAKSI_PENGADAAN';
    protected $VIEW_TRANSAKSI_OPNAME = 'VIEW_TRANSAKSI_OPNAME';

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

    public function get_single( $KODE )
 {
        $this->db->select( '*' );
        $this->db->from( 'VIEW_TRANSAKSI_OPNAME' );
        $this->db->where( 'UUID_TRANSAKSI_OPNAME', $KODE );
        $query = $this->db->get();
        return $query;
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

    public function update( $KODE, $data )
 {
        $this->db->where( 'NIK', $KODE );
        return $this->db->update( $this->table, $data );
    }

    public function hapus( $KODE )
 {
        $this->db->where( 'NIK', $KODE );
        return $this->db->delete( $this->table );
    }
}