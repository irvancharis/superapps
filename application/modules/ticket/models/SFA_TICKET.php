<?php
class SFA_TICKET extends CI_Model
{

    // Nama tabel
    protected $table = 'SFA_TICKET';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $this->db->select('SFA_TICKET.*, SFA_DEPARTEMENT.*, SFA_TECHNICIAN.*');
        $this->db->from('SFA_TICKET');
        $this->db->join('SFA_DEPARTEMENT', 'SFA_TICKET.DEPARTEMENT = SFA_DEPARTEMENT.ID_DEPARTEMENT', 'left');
        $this->db->join('SFA_TECHNICIAN', 'SFA_TICKET.TECHNICIAN = SFA_TECHNICIAN.IDTECH', 'left');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_departement()
    {
        $query = $this->db->get('SFA_DEPARTEMENT');
        return $query->result_object();
    }

    public function get_technician()
    {
        $query = $this->db->get('SFA_TECHNICIAN');
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

    public function update($id_ticket, $data)
    {
        $this->db->where('IDTICKET', $id_ticket);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id_ticket)
    {
        $this->db->where('IDTICKET', $id_ticket);
        return $this->db->delete($this->table);
    }
}
