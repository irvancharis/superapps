<?php
class M_LOGIN extends CI_Model
{

    // Nama tabel
    protected $table = 'VIEW_USER';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getuser($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_USER');
        $this->db->where('EMAIL', $KODE);
        $query = $this->db->get();
        return $query->row();
    }
    
}
