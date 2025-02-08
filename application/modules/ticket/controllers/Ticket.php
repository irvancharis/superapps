<?php
class Ticket extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TICKET');
        $this->load->helper('url_helper');
    }

    public function index($page = 'ticket')
    {
        $this->load->library('session');

        $data['M_TICKET'] = $this->M_TICKET->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_TICKET->get_departement();
        $data['get_technician'] = $this->M_TICKET->get_technician();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('ticket', $data);
    }

    public function get_departement()
    {
        $result = $this->M_TICKET->get_departement();
        echo json_encode($result);
    }

    public function get_area()
    {
        $result = $this->M_TICKET->get_area();
        echo json_encode($result);
    }

    public function get_technician()
    {
        $result = $this->M_TICKET->get_technician();
        echo json_encode($result);
    }

    public function get_departement_joblist()
    {
        $id_departement = $this->input->post('id_departemen');
        $result = $this->M_TICKET->get_departement_joblist($id_departement);

        if (!empty($result)) {
            echo json_encode(['success' => true, 'data' => $result], JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['success' => false, 'error' => 'Data tidak ditemukan']);
        }
    }

    public function get_departement_joblist_edit()
    {
        $id_ticket = $this->input->get('id_ticket');
        $id_departement = $this->input->get('id_departemen');

        if (!$id_ticket) {
            echo json_encode(['success' => false, 'error' => 'ID Departemen tidak ditemukan']);
            return;
        }

        // Ambil daftar joblist dari database
        $joblist = $this->M_TICKET->get_departement_joblist($id_departement);

        // Ambil daftar yang sudah dipilih sebelumnya
        $selected_tickets = $this->M_TICKET->get_selected_tickets($id_ticket);

        echo json_encode([
            'success' => true,
            'data' => $joblist,
            'selected_tickets' => $selected_tickets // Kirim daftar yang sudah dipilih
        ]);
    }

    public function tambah_view($page = 'ticket')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_TICKET->get_departement();
        $data['get_technician'] = $this->M_TICKET->get_technician();
        $data['get_area'] = $this->M_TICKET->get_area();
        $data['get_karyawan'] = $this->M_TICKET->get_karyawan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('ticket_tambah', $data);
    }

    public function insert()
    {

        // Ambil data dari POST
        $get_last_ticket = $this->M_TICKET->get_latest_data();
        $id_ticket = isset($get_last_ticket[0]->IDTICKET) ? $get_last_ticket[0]->IDTICKET + 1 : 1; // Default ke 1 jika data kosong
        $requestby = $this->input->post('request_by');
        $id_departement = $this->input->post('id_departemen');
        $email_ticket = $this->input->post('email_ticket');
        $site_ticket = $this->input->post('id_area');
        $id_departement_request = $this->input->post('id_departemen_request');
        $type_ticket = $this->input->post('type_ticket');
        $description_ticket = $this->input->post('description_ticket');
        $id_technician = $this->input->post('id_technician');
        $status_ticket = $this->input->post('status_ticket');
        $approval_ticket = $this->input->post('approval_ticket');
        $prosentase = $this->input->post('prosentase');

        if (empty($type_ticket)) {
            $errors[] = 'Pilih setidaknya satu jenis keluhan.';
        } else {
            $type_ticket = implode(',', $type_ticket); // Gabungkan array menjadi string
        }

        // Jika validasi lolos, lanjutkan proses penyimpanan
        // ke tabel Ticket
        $data = [
            'IDTICKET' => $id_ticket,
            'REQUESTBY' => $requestby,
            'DEPARTEMENT' => $id_departement,
            'EMAIL_TICKET' => $email_ticket,
            'SITE_TICKET' => $site_ticket,
            'DEPARTEMENT_DIREQUEST' => $id_departement_request,
            'TYPE_TICKET' => $type_ticket,
            'DESCRIPTION_TICKET' => $description_ticket,
            'DATE_TICKET' => date('Y-m-d H:i:s'),
            'DATE_TICKET_DONE' => null,
            'TECHNICIAN' => $id_technician,
            'STATUS_TICKET' => $status_ticket,
            'APPROVAL_TICKET' => $approval_ticket,
            'PROSENTASE' => $prosentase
        ];

        $result = $this->M_TICKET->insert($data);

        // ke tabel Ticket_Detail
        foreach ($type_ticket as $key => $value) {
            $data_detail = [
                'IDTICKET' => $id_ticket,
                'TYPE_TICKET' => $value,
                'STATUS' => null
            ];
            $this->M_TICKET->insert_detail($data_detail);
        }

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function ticket_view($id)
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'ticket');
        $data['page'] = $this->session->userdata('page');
        $ticket = $this->M_TICKET->get_ticket($id);

        // Pastikan TYPE_TICKET menjadi array, meskipun hanya 1 value
        $data['type_ticket'] = isset($ticket->TYPE_TICKET)
            ? (strpos($ticket->TYPE_TICKET, ',') !== false
                ? explode(',', $ticket->TYPE_TICKET)
                : [$ticket->TYPE_TICKET])
            : [];

        $data['approval_ticket'] = $ticket->APPROVAL_TICKET;
        $data['status_ticket'] = $ticket->STATUS_TICKET;

        $data['get_ticket'] = $ticket;

        // Pastikan DATE_TICKET dalam format YYYY-MM-DD
        if (isset($data['get_ticket']->DATE_TICKET)) {
            $data['get_ticket']->DATE_TICKET = date('Y-m-d', strtotime($data['get_ticket']->DATE_TICKET));
        }

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('ticket_view', $data);
    }

    public function edit_view($id)
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'ticket');
        $data['page'] = $this->session->userdata('page');
        $data['get_technician'] = $this->M_TICKET->get_technician();
        $data['get_departement'] = $this->M_TICKET->get_departement();
        $ticket = $this->M_TICKET->get_ticket($id);

        // Pastikan TYPE_TICKET menjadi array, meskipun hanya 1 value
        $data['type_ticket'] = isset($ticket->TYPE_TICKET)
            ? (strpos($ticket->TYPE_TICKET, ',') !== false
                ? explode(',', $ticket->TYPE_TICKET)
                : [$ticket->TYPE_TICKET])
            : [];

        $data['approval_ticket'] = $ticket->APPROVAL_TICKET;
        $data['status_ticket'] = $ticket->STATUS_TICKET;

        $data['get_ticket'] = $ticket;
        $data['id_ticket'] = $id;

        // Pastikan DATE_TICKET dalam format YYYY-MM-DD
        if (isset($data['get_ticket']->DATE_TICKET)) {
            $data['get_ticket']->DATE_TICKET = date('Y-m-d', strtotime($data['get_ticket']->DATE_TICKET));
        }

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('ticket_edit', $data);
    }

    public function update()
    {
        // Ambil data dari POST
        $id_ticket =  $this->input->post('id_ticket');
        $requestby = $this->input->post('request_by');
        $id_departement = $this->input->post('id_departemen');
        $email_ticket = $this->input->post('email_ticket');
        $site_ticket = $this->input->post('id_area');
        $type_ticket = $this->input->post('type_ticket');
        $description_ticket = $this->input->post('description_ticket');
        $id_technician = $this->input->post('id_technician');
        $status_ticket = $this->input->post('status_ticket');
        $approval_ticket = $this->input->post('approval_ticket');
        $prosentase = $this->input->post('prosentase');
        $date_ticket_done = $this->input->post('date_ticket_done');

        // Pastikan date_ticket_done valid dan memiliki format yang benar
        if ($date_ticket_done) {
            $date_ticket_done = date('Y-m-d H:i:s', strtotime($date_ticket_done));
        } else {
            $date_ticket_done = null; // Atau set default jika diperlukan
        }

        // Cek apakah $type_ticket dari form merupakan array atau tidak
        if (is_array($type_ticket)) {
            // Jika dalam bentuk array (saat Create atau Edit dari form)
            if (empty($type_ticket)) {
                $errors[] = 'Pilih setidaknya satu jenis keluhan.';
            } else {
                $type_ticket = implode(',', $type_ticket); // Gabungkan array menjadi string
            }
        } else {
            // Jika dalam bentuk string (saat mengambil dari database untuk Edit)
            $type_ticket = !empty($type_ticket) ? explode(',', $type_ticket) : []; // Ubah ke array
        }

        // Jika validasi lolos, lanjutkan proses penyimpanan
        $data = [
            'REQUESTBY' => $requestby,
            'DEPARTEMENT' => $id_departement,
            'EMAIL_TICKET' => $email_ticket,
            'SITE_TICKET' => $site_ticket,
            'TYPE_TICKET' => $type_ticket,
            'DESCRIPTION_TICKET' => $description_ticket,
            'DATE_TICKET_DONE' => $date_ticket_done,
            'TECHNICIAN' => $id_technician,
            'STATUS_TICKET' => $status_ticket,
            'APPROVAL_TICKET' => $approval_ticket,
            'PROSENTASE' => $prosentase
        ];

        $result = $this->M_TICKET->update($id_ticket, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function updateStatus()
    {
        // Ambil data dari POST dengan validasi awal
        $id_ticket = $this->input->post('id_ticket', true);
        $status_ticket = $this->input->post('status_ticket', true);
        $prosentase = $this->input->post('prosentase', true);

        // Validasi input
        if (empty($id_ticket) || $status_ticket == null) {
            echo json_encode(['success' => false, 'error' => 'ID Ticket dan Status Ticket tidak boleh kosong.']);
            return;
        }

        // Data yang akan diupdate
        if ($prosentase == 100) {
            $data = [
                'STATUS_TICKET' => $status_ticket,
                'DATE_TICKET_DONE' => date('Y-m-d H:i:s'),
                'PROSENTASE' => $prosentase
            ];
        } else {
            $data = [
                'STATUS_TICKET' => $status_ticket,
                'PROSENTASE' => $prosentase
            ];
        }

        // Pastikan model memiliki metode update yang benar
        $result = $this->M_TICKET->update($id_ticket, $data);

        // Cek hasil update
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function updateApproval()
    {
        // Ambil data dari POST dengan validasi awal
        $id_ticket = $this->input->post('id_ticket', true);
        $approval_ticket = $this->input->post('approval_ticket', true);

        // Validasi input
        if ($id_ticket == null) {
            echo json_encode(['success' => false, 'error' => 'ID Ticket dan Status Ticket tidak boleh kosong.']);
            return;
        }

        $data = [
            'APPROVAL_TICKET' => $approval_ticket,
        ];

        // Pastikan model memiliki metode update yang benar
        $result = $this->M_TICKET->update($id_ticket, $data);

        // Cek hasil update
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_ticket = $this->input->post('id_ticket_hapus');

        // Proses hapus data
        $result = $this->M_TICKET->hapus($id_ticket);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
