<?php
class M_SETTING extends CI_Model
{

    // Nama tabel
    protected $table = 'SETTING';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    // Get all setting data
    public function get_setting()
    {
        $query = $this->db->get($this->table);
        return $query->row();
    }

    // Update setting data
    public function update_setting($data)
    {
        // Assuming there's only one row in SETTING table
        return $this->db->update($this->table, $data);
    }

    // Get GM value
    public function get_gm()
    {
        $this->db->select('GM');
        $query = $this->db->get($this->table);
        return $query->row()->GM;
    }

    // Get HEAD value
    public function get_head()
    {
        $this->db->select('HEAD');
        $query = $this->db->get($this->table);
        return $query->row()->HEAD;
    }

    // Get WhatsApp token value
    public function get_token_wa()
    {
        $this->db->select('TOKEN_WA');
        $query = $this->db->get($this->table);
        return $query->row()->TOKEN_WA;
    }
}
