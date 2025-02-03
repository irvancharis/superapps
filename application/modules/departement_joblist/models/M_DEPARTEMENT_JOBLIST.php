<?php
class M_DEPARTEMENT_JOBLIST extends CI_Model
{

    // Nama tabel
    protected $table = 'DEPARTEMENT_JOBLIST';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $this->db->select('DEPARTEMENT_JOBLIST.*, DEPARTEMEN.*');
        $this->db->from('DEPARTEMENT_JOBLIST');
        $this->db->join('DEPARTEMEN', 'DEPARTEMENT_JOBLIST.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('ID_JOBLIST', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function get_departement()
    {
        $query = $this->db->get('DEPARTEMEN');
        return $query->result_object();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_joblist, $data)
    {
        $this->db->where('ID_JOBLIST', $id_joblist);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_joblist)
    {
        $this->db->where('ID_JOBLIST', $id_joblist);
        return $this->db->delete($this->table);
    }
}
