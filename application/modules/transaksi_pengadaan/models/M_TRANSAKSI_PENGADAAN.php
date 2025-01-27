<?php
class M_TRANSAKSI_PENGADAAN extends CI_Model
{

    // Nama tabel
    protected $table = 'TRANSAKSI_PENGADAAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $query = $this->db->get('TRANSAKSI_PENGADAAN');
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('TANGGAL_PENGAJUAN', 'ASCD');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($UUID_TRANSAKSI_PENGADAAN, $data)
    {
        $this->db->where('UUID_TRANSAKSI_PENGADAAN', $UUID_TRANSAKSI_PENGADAAN);
        return $this->db->update($this->table, $data);
    }

    public function hapus($UUID_TRANSAKSI_PENGADAAN)
    {
        $this->db->where('UUID_TRANSAKSI_PENGADAAN', $UUID_TRANSAKSI_PENGADAAN);
        return $this->db->delete($this->table);
    }
}
