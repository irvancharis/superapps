<?php
class M_KARYAWAN extends CI_Model
{

    // Nama tabel
    protected $table = 'KARYAWAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $this->db->select('KARYAWAN.*, DEPARTEMEN.*, JABATAN.*');
        $this->db->from('KARYAWAN');
        $this->db->join('DEPARTEMEN', 'KARYAWAN.ID_DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('JABATAN', 'KARYAWAN.ID_JABATAN = JABATAN.KODE_JABATAN', 'left');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_departement()
    {
        $query = $this->db->get('DEPARTEMEN');
        return $query->result_object();
    }

    public function get_jabatan()
    {
        $query = $this->db->get('JABATAN');
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('ID_KARYAWAN', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_karyawan, $data)
    {
        $this->db->where('ID_KARYAWAN', $id_karyawan);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_karyawan)
    {
        $this->db->where('ID_KARYAWAN', $id_karyawan);
        return $this->db->delete($this->table);
    }
}
