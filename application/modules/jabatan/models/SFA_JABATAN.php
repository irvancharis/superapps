<?php
class SFA_JABATAN extends CI_Model
{

    // Nama tabel
    protected $table = 'JABATAN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $query = $this->db->get('JABATAN');
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('KODE_JABATAN', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_jabatan, $data)
    {
        $this->db->where('KODE_JABATAN', $id_jabatan);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_jabatan)
    {
        $this->db->where('KODE_JABATAN', $id_jabatan);
        return $this->db->delete($this->table);
    }
}
