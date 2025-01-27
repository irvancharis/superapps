<?php
class M_DEPARTEMENT extends CI_Model
{

    // Nama tabel
    protected $table = 'DEPARTEMEN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $query = $this->db->get('DEPARTEMEN');
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('KODE_DEPARTEMEN', 'DESC');
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
        $this->db->where('KODE_DEPARTEMEN', $id_departement);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_departement)
    {
        $this->db->where('KODE_DEPARTEMEN', $id_departement);
        return $this->db->delete($this->table);
    }
}
