<?php
class Transaksi_pengadaan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TRANSAKSI_PENGADAAN');
        $this->load->helper('url_helper');
    }

    public function index($page = 'transaksi_pengadaan')
    {
        $this->load->library('session');

        $data['M_TRANSAKSI_PENGADAAN'] = $this->M_TRANSAKSI_PENGADAAN->get_transaksi();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_TRANSAKSI_PENGADAAN->get_departement();
        $data['get_technician'] = $this->M_TRANSAKSI_PENGADAAN->get_technician();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan', $data);
    }

    public function get_departement()
    {
        $result = $this->M_TRANSAKSI_PENGADAAN->get_departement();
        echo json_encode($result);
    }

    public function get_area()
    {
        $result = $this->M_TRANSAKSI_PENGADAAN->get_area();
        echo json_encode($result);
    }

    public function tambah_view($page = 'ticket')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_TRANSAKSI_PENGADAAN->get_departement();
        $data['get_technician'] = $this->M_TRANSAKSI_PENGADAAN->get_technician();
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('ticket_tambah', $data);
    }

    public function insert()
    {
        // Ambil data dari POST
        $get_last_ticket = $this->M_TRANSAKSI_PENGADAAN->get_latest_data();
        $id_ticket = isset($get_last_ticket[0]->IDTICKET) ? $get_last_ticket[0]->IDTICKET + 1 : 1; // Default ke 1 jika data kosong
        $requestby = $this->input->post('request_by');
        $id_departement = $this->input->post('id_departemen');
        $email_ticket = $this->input->post('email_ticket');
        $site_ticket = $this->input->post('id_area');
        $type_ticket = $this->input->post('type_ticket');
        $description_ticket = $this->input->post('description_ticket');



        // Jika validasi lolos, lanjutkan proses penyimpanan
        $data = [
            'IDTICKET' => $id_ticket,
            'REQUESTBY' => $requestby,
            'DEPARTEMENT' => $id_departement,
            'EMAIL_TICKET' => $email_ticket,
            'SITE_TICKET' => $site_ticket,
            'TYPE_TICKET' => $type_ticket,
            'DESCRIPTION_TICKET' => $description_ticket,
        ];

        $result = $this->M_TRANSAKSI_PENGADAAN->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        // Ambil data dari POST
        $id_ticket = $this->input->post('id_ticket_edit');
        $requestby = $this->input->post('requestby');
        $id_departement = $this->input->post('id_departement');
        $email_ticket = $this->input->post('email_ticket');
        $site_ticket = $this->input->post('site_ticket');
        $type_ticket = $this->input->post('type_ticket');
        $description_ticket = $this->input->post('description_ticket');
        $date_ticket = $this->input->post('date_ticket');
        $date_ticket_done = $this->input->post('date_ticket_done');
        $id_technician = $this->input->post('id_technician');
        $status_ticket = $this->input->post('status_ticket');
        $approval_ticket = $this->input->post('approval_ticket');
        $prosentase = $this->input->post('prosentase');

        // Array untuk menampung error
        $errors = [];

        // Validasi `requestby`
        if (empty($requestby)) {
            $errors[] = 'Request By tidak boleh kosong.';
        } elseif (strlen($requestby) > 100) {
            $errors[] = 'Request By tidak boleh lebih dari 100 karakter.';
        }

        // Validasi `id_departement`
        if (empty($id_departement)) {
            $errors[] = 'ID Departemen tidak boleh kosong.';
        } elseif (!is_numeric($id_departement)) {
            $errors[] = 'ID Departemen harus berupa angka.';
        }

        // Validasi `email_ticket`
        if (empty($email_ticket)) {
            $errors[] = 'Email Ticket tidak boleh kosong.';
        } elseif (!filter_var($email_ticket, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email Ticket harus dalam format email yang valid.';
        }

        // Validasi `site_ticket`
        if (empty($site_ticket)) {
            $errors[] = 'Site Ticket tidak boleh kosong.';
        } elseif (strlen($site_ticket) > 200) {
            $errors[] = 'Site Ticket tidak boleh lebih dari 200 karakter.';
        }

        // Validasi `type_ticket`
        if (empty($type_ticket)) {
            $errors[] = 'Type Ticket tidak boleh kosong.';
        }

        // Validasi `description_ticket`
        if (empty($description_ticket)) {
            $errors[] = 'Deskripsi Ticket tidak boleh kosong.';
        } elseif (strlen($description_ticket) > 500) {
            $errors[] = 'Deskripsi Ticket tidak boleh lebih dari 500 karakter.';
        }

        // Validasi `date_ticket`
        if (empty($date_ticket)) {
            $errors[] = 'Tanggal Ticket tidak boleh kosong.';
        } elseif (!strtotime($date_ticket)) {
            $errors[] = 'Tanggal Ticket harus dalam format tanggal yang valid.';
        }

        // Validasi `date_ticket_done`
        if (!empty($date_ticket_done) && !strtotime($date_ticket_done)) {
            $errors[] = 'Tanggal Ticket Selesai harus dalam format tanggal yang valid.';
        } elseif (!empty($date_ticket_done) && strtotime($date_ticket_done) < strtotime($date_ticket)) {
            $errors[] = 'Tanggal Ticket Selesai tidak boleh lebih awal dari Tanggal Ticket.';
        }

        // Validasi `id_technician`
        if (empty($id_technician)) {
            $errors[] = 'ID Teknisi tidak boleh kosong.';
        } elseif (!is_numeric($id_technician)) {
            $errors[] = 'ID Teknisi harus berupa angka.';
        }

        // Validasi `status_ticket`
        if (empty($status_ticket)) {
            $errors[] = 'Status Ticket tidak boleh kosong.';
        } elseif (!in_array($status_ticket, ['open', 'in progress', 'closed'])) { // Sesuaikan nilai yang diizinkan
            $errors[] = 'Status Ticket harus berupa "open", "in progress", atau "closed".';
        }

        // Validasi `approval_ticket`
        if (empty($approval_ticket)) {
            $errors[] = 'Approval Ticket tidak boleh kosong.';
        } elseif (!in_array($approval_ticket, ['approved', 'rejected', 'pending'])) { // Sesuaikan nilai yang diizinkan
            $errors[] = 'Approval Ticket harus berupa "approved", "rejected", atau "pending".';
        }

        // Validasi `prosentase`
        if (empty($prosentase)) {
            $errors[] = 'Prosentase tidak boleh kosong.';
        } elseif (!is_numeric($prosentase)) {
            $errors[] = 'Prosentase harus berupa angka.';
        } elseif ($prosentase < 0 || $prosentase > 100) {
            $errors[] = 'Prosentase harus antara 0 hingga 100.';
        }

        // Jika ada error, kembalikan respons JSON dengan daftar error
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        // Jika validasi lolos, lanjutkan proses penyimpanan
        $data = [
            'REQUESTBY' => $requestby,
            'DEPARTEMENT' => $id_departement,
            'EMAIL_TICKET' => $email_ticket,
            'SITE_TICKET' => $site_ticket,
            'TYPE_TICKET' => $type_ticket,
            'DESCRIPTION_TICKET' => $description_ticket,
            'DATE_TICKET' => $date_ticket,
            'DATE_TICKET_DONE' => $date_ticket_done,
            'TECHNICIAN' => $id_technician,
            'STATUS_TICKET' => $status_ticket,
            'APPROVAL_TICKET' => $approval_ticket,
            'PROSENTASE' => $prosentase,
        ];

        $result = $this->M_TRANSAKSI_PENGADAAN->update($id_ticket, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_ticket = $this->input->post('id_ticket_hapus');

        // Proses hapus data
        $result = $this->M_TRANSAKSI_PENGADAAN->hapus($id_ticket);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
