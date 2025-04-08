<?php
class M_KARYAWAN extends CI_Model
{

    // Nama tabel
    protected $table = 'KARYAWAN';
    protected $VIEW_KARYAWAN = 'VIEW_KARYAWAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_karyawan()
    {
        $query = $this->db->get('VIEW_KARYAWAN');
        return $query->result_object();
    }

    public function get_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_KARYAWAN');
        $this->db->where('NIK', $KODE);
        $query = $this->db->get();
        return $query;
    }

    public function get_karyawan_by_area($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_KARYAWAN');
        $this->db->where('ID_MAPING_AREA', $KODE);
        $query = $this->db->get();
        return $query;
    }

    public function get_karyawan_by_departemen($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_KARYAWAN');
        $this->db->where('ID_DEPARTEMENT', $KODE);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_karyawan_by_area_n_departemen($area, $departemen)
    {
        $this->db->select('*');
        $this->db->from('VIEW_KARYAWAN');
        $this->db->where('ID_MAPING_AREA', $area);
        $this->db->where('ID_DEPARTEMENT', $departemen);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_karyawan_by_jabatan($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_KARYAWAN');
        $this->db->where('ID_JABATAN', $KODE);
        $query = $this->db->get();
        return $query;
    }

    public function get_karyawan_by_id($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_KARYAWAN');
        $this->db->where('ID_KARYAWAN', $KODE);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_kabag_by_departemen($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_KARYAWAN');
        $this->db->where('ID_DEPARTEMENT', $KODE);
        $this->db->where('NAMA_JABATAN', 'KABAG');
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_area()
    {
        $query = $this->db->get('MAPING_AREA');
        return $query->result_object();
    }

    public function get_departemen()
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
        $this->db->order_by('IDTICKET', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
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

    public function hapus($KODE)
    {
        $this->db->where('NIK', $KODE);
        return $this->db->delete($this->table);
    }
}
