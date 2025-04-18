<?php
class M_TICKET extends CI_Model
{

    // Nama tabel
    protected $table = 'TICKET';

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
        $this->db->where('TICKET.STATUS_TICKET !=', '100');
        $this->db->where('TICKET.APPROVAL_TICKET !=', '2');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_ticket_queue()
    {
        $this->db->select('TICKET.*, DEPARTEMEN.*, TECHNICIAN.*, MAPING_AREA.*');
        $this->db->from('TICKET');
        $this->db->join('DEPARTEMEN', 'TICKET.DEPARTEMENT = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->join('TECHNICIAN', 'TICKET.TECHNICIAN = TECHNICIAN.IDTECH', 'left');
        $this->db->join('MAPING_AREA', 'TICKET.SITE_TICKET = MAPING_AREA.KODE_AREA', 'left');
        $this->db->where('TICKET.STATUS_TICKET !=', '100');
        $this->db->where('TICKET.APPROVAL_TICKET !=', '2');
        $this->db->order_by('TICKET.DATE_TICKET', 'ASC');

        $query = $this->db->get();
        $results = $query->result_object();

        // Urutkan secara manual di PHP
        usort($results, function ($a, $b) {
            if ($a->STATUS_TICKET == 0 && $b->STATUS_TICKET != 0) {
                return -1;
            } elseif ($a->STATUS_TICKET != 0 && $b->STATUS_TICKET == 0) {
                return 1;
            } else {
                return strtotime($a->DATE_TICKET) - strtotime($b->DATE_TICKET);
            }
        });

        return $results;
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

    public function get_latest_data()
    {
        $this->db->order_by('DATE_TICKET', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function get_joblist_by_departement_and_area($id_departemen, $id_area)
    {
        $this->db->select('NAMA_JOBLIST');
        $this->db->from('DEPARTEMENT_JOBLIST');
        $this->db->where('DEPARTEMENT', $id_departemen);
        $this->db->like('KODE_AREA', $id_area); // Asumsi KODE_AREA disimpan sebagai string (misalnya, "1,2,3")
        $query = $this->db->get();

        return $query->result();
    }

    public function get_ticket_detail_view($id_ticket)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TICKET_DETAIL');
        $this->db->where('IDTICKET', $id_ticket);
        $this->db->order_by('TGL_PENGERJAAN', 'DESC');
        $query = $this->db->get();
        return $query->result_object();
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

    public function update_konfirmasi_selesai($id_ticket, $data)
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
