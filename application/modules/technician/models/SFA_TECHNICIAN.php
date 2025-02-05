<?php
class SFA_TECHNICIAN extends CI_Model
{

    // Nama tabel
    protected $table = 'SFA_TECHNICIAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $this->db->select('SFA_TECHNICIAN.*, SFA_DEPARTEMENT.NAMA_DEPARTEMENT');
        $this->db->from('SFA_TECHNICIAN');
        $this->db->join('SFA_DEPARTEMENT', 'SFA_TECHNICIAN.DEPARTEMENT = SFA_DEPARTEMENT.ID_DEPARTEMENT', 'left');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_departement()
    {
        $query = $this->db->get('SFA_DEPARTEMENT');
        return $query->result_object();
    }

    public function get_karyawan()
    {
        $query = $this->db->get('SFA_KARYAWAN');
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

    public function update($id_departement, $data)
    {
        $this->db->where('IDTECH', $id_departement);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_departement)
    {
        $this->db->where('IDTECH', $id_departement);
        return $this->db->delete($this->table);
    }
}
