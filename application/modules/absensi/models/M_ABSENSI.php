<?php
class M_ABSENSI extends CI_Model
{

    // Nama tabel
    protected $table = 'ABSENSI';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $this->db->select('ABSENSI.*, USER.ID_KARYAWAN');
        $this->db->from('ABSENSI');
        $this->db->join('USER', 'ABSENSI.ID_USER = USER.UUID_USER', 'left');
        $this->db->order_by('ID_USER', 'ASC');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_absensi()
    {
        $query = $this->db->get('ABSENSI');
        return $query->result_object();
    }

    public function get_absensi_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('ABSENSI');
        $this->db->where('ID_ABSENSI', $KODE);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_latest_data()
    {
        $this->db->order_by('ID_ABSENSI', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_absensi, $data)
    {
        $this->db->where('ID_ABSENSI', $id_absensi);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_absensi)
    {
        $this->db->where('ID_ABSENSI', $id_absensi);
        return $this->db->delete($this->table);
    }
}
