<?php
class SFA_TECHNICIAN extends CI_Model
{

    // Nama tabel
    protected $table = 'TECHNICIAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $this->db->select('TECHNICIAN.*, DEPARTEMEN.*, KARYAWAN.ID_KARYAWAN, KARYAWAN.NAMA_KARYAWAN');
        $this->db->from('TECHNICIAN');
        $this->db->join('DEPARTEMEN', 'TECHNICIAN.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('KARYAWAN', 'TECHNICIAN.IDKARYAWAN = KARYAWAN.ID_KARYAWAN', 'left');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_departement()
    {
        $query = $this->db->get('DEPARTEMEN');
        return $query->result_object();
    }

    public function get_karyawan()
    {
        $query = $this->db->get('KARYAWAN');
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('IDTECH', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_tech, $data)
    {
        $this->db->where('IDTECH', $id_tech);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_tech)
    {
        $this->db->where('IDTECH', $id_tech);
        return $this->db->delete($this->table);
    }
}
