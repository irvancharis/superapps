<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_TICKET extends CI_Model
{

    // Nama tabel
    protected $table = 'TICKET';
    protected $view = 'VIEW_TICKET_DETAIL';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news()
    {
        $this->db->select('TICKET.*, DEPARTEMEN.*, TECHNICIAN.*, MAPING_AREA.*');
        $this->db->from('TICKET');
        $this->db->join('DEPARTEMEN', 'TICKET.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('TECHNICIAN', 'TICKET.TECHNICIAN = TECHNICIAN.IDTECH', 'left');
        $this->db->join('MAPING_AREA', 'TICKET.SITE_TICKET = MAPING_AREA.KODE_AREA', 'left');
        $this->db->order_by('DATE_TICKET', 'ASC');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_ticket_approval_disetujui()
    {
        $this->db->select('TICKET.*, DEPARTEMEN.*, TECHNICIAN.*, MAPING_AREA.*');
        $this->db->from('TICKET');
        $this->db->join('DEPARTEMEN', 'TICKET.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('TECHNICIAN', 'TICKET.TECHNICIAN = TECHNICIAN.IDTECH', 'left');
        $this->db->join('MAPING_AREA', 'TICKET.SITE_TICKET = MAPING_AREA.KODE_AREA', 'left');
        $this->db->order_by('DATE_TICKET', 'ASC');
        $this->db->where('TICKET.APPROVAL_TICKET', '1');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function count_ticket_by_approval(string $kode_approval = null)
    {
        if ($kode_approval != null) {
            $this->db->select('COUNT(IDTICKET) AS JUMLAH_TICKET');
            $this->db->from('TICKET');
            $this->db->where('APPROVAL_TICKET', $kode_approval);
            $query = $this->db->get();
            return $query->row_object();
        } else {
            $this->db->select('COUNT(IDTICKET) AS JUMLAH_TICKET');
            $this->db->from('TICKET');
            $this->db->where('APPROVAL_TICKET', '0');
            $query = $this->db->get();
            return $query->row_object();
        }
    }

    public function count_ticket_by_approval_disetujui()
    {
        $this->db->select('COUNT(IDTICKET) AS JUMLAH_TICKET');
        $this->db->from('TICKET');
        $this->db->where('APPROVAL_TICKET', '1');
        $query = $this->db->get();
        return $query->row_object();
    }

    public function count_ticket_by_technician(string $kode_technician = null, string $kode_status = null)
    {
        $this->db->select('COUNT(IDTICKET) AS JUMLAH_TICKET');
        $this->db->from('TICKET');
        $this->db->where('TECHNICIAN', $kode_technician);
        $this->db->where('STATUS_TICKET', $kode_status);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function count_ticket_by_status(string $kode_status)
    {
        $this->db->select('COUNT(IDTICKET) AS JUMLAH_TICKET');
        $this->db->from('TICKET');
        $this->db->where('STATUS_TICKET', $kode_status);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_ticket($id_ticket)
    {
        $this->db->select('TICKET.*, DEPARTEMEN.*, TECHNICIAN.*, MAPING_AREA.*');
        $this->db->from('TICKET');
        $this->db->join('DEPARTEMEN', 'TICKET.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('TECHNICIAN', 'TICKET.TECHNICIAN = TECHNICIAN.IDTECH', 'left');
        $this->db->join('MAPING_AREA', 'TICKET.SITE_TICKET = MAPING_AREA.KODE_AREA', 'left');
        $this->db->where('TICKET.IDTICKET', $id_ticket);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_ticket_by_approval($kode_approval)
    {
        $this->db->select('TICKET.*, DEPARTEMEN.*, TECHNICIAN.*, MAPING_AREA.*');
        $this->db->from('TICKET');
        $this->db->join('DEPARTEMEN', 'TICKET.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('TECHNICIAN', 'TICKET.TECHNICIAN = TECHNICIAN.IDTECH', 'left');
        $this->db->join('MAPING_AREA', 'TICKET.SITE_TICKET = MAPING_AREA.KODE_AREA', 'left');
        $this->db->order_by('DATE_TICKET', 'ASC');
        $this->db->where('TICKET.APPROVAL_TICKET', $kode_approval);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_ticket_by_status(string $kode_status)
    {
        $this->db->select('TICKET.*, DEPARTEMEN.*, TECHNICIAN.*, MAPING_AREA.*');
        $this->db->from('TICKET');
        $this->db->join('DEPARTEMEN', 'TICKET.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('TECHNICIAN', 'TICKET.TECHNICIAN = TECHNICIAN.IDTECH', 'left');
        $this->db->join('MAPING_AREA', 'TICKET.SITE_TICKET = MAPING_AREA.KODE_AREA', 'left');
        $this->db->order_by('DATE_TICKET', 'ASC');
        $this->db->where('TICKET.STATUS_TICKET', $kode_status);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_ticket_by_technician($kode_technician, string $kode_status)
    {
        $this->db->select('TICKET.*, DEPARTEMEN.*, TECHNICIAN.*, MAPING_AREA.*');
        $this->db->from('TICKET');
        $this->db->join('DEPARTEMEN', 'TICKET.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('TECHNICIAN', 'TICKET.TECHNICIAN = TECHNICIAN.IDTECH', 'left');
        $this->db->join('MAPING_AREA', 'TICKET.SITE_TICKET = MAPING_AREA.KODE_AREA', 'left');
        $this->db->order_by('DATE_TICKET', 'ASC');
        $this->db->where('TICKET.TECHNICIAN', $kode_technician);
        $this->db->where('TICKET.STATUS_TICKET', $kode_status);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_ticket_detail_view($id_ticket)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TICKET_DETAIL');
        $this->db->where('IDTICKET', $id_ticket);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_departement()
    {
        $query = $this->db->get('DEPARTEMEN');
        return $query->result_object();
    }

    public function get_technician()
    {
        $query = $this->db->get('TECHNICIAN');
        return $query->result_object();
    }

    public function get_area()
    {
        $query = $this->db->get('MAPING_AREA');
        return $query->result_object();
    }

    public function get_karyawan()
    {
        $query = $this->db->get('KARYAWAN');
        return $query->result_object();
    }

    public function get_departement_joblist($id_departement)
    {
        $this->db->select('*');
        $this->db->from('DEPARTEMENT_JOBLIST'); // Ganti dengan nama tabel yang sesuai
        $this->db->where('DEPARTEMENT', $id_departement);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_latest_data()
    {
        $this->db->order_by('IDTICKET', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    // Fungsi untuk mendapatkan daftar joblist yang dipilih
    public function get_selected_tickets($id_ticket)
    {
        $this->db->select('*');
        $this->db->from('TICKET');
        $this->db->where('IDTICKET', $id_ticket);
        $query = $this->db->get();

        return $query->row_object(); // Mengembalikan daftar nama joblist yang dipilih
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function insert_detail($data)
    {
        return $this->db->insert('TICKETDETAIL', $data);
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
