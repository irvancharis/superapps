<?php
class Ticket_client_view extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TICKET');
        $this->load->model('WHATSAPP');
        $this->load->model('TELEGRAM');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('technician/M_TECHNICIAN');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->helper('url_helper');
    }

    public function index($page = 'ticket')
    {
        $this->load->library('session');

        $data['M_TICKET'] = $this->M_TICKET->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_TICKET->get_departement();
        $data['get_area'] = $this->M_TICKET->get_area();

        $this->load->view('ticket_client_view', $data);
    }

    public function ticket_card($kode)
    {
        // get ticket by id
        $ticket['ticket'] = $this->M_TICKET->get_ticket($kode);
        // get nama technician by id
        $ticket['technician'] = $this->M_TECHNICIAN->get_teknisi_by_id($ticket['ticket']->TECHNICIAN);
        $this->load->view('ticket_card', $ticket);
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
        $result = null;

        // if (empty($type_ticket) || !is_array($type_ticket)) {
        //     echo json_encode(['success' => false, 'error' => 'Pilih setidaknya satu jenis keluhan.']);
        //     return;
        // }

        // // Gabungkan array type_ticket menjadi string untuk penyimpanan di tabel Ticket
        // $type_ticket_str = implode(',', $type_ticket);

        // Konfigurasi upload Gambar
        $config['upload_path'] = APPPATH . '../assets/uploads/ticket/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $id_ticket . $requestby;

        // Cek Apakah ada gambar yang diupload
        if (!empty($_FILES['image']['name'])) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
                return;
            }
            // Ambil data file yang diupload
            $data_gambar = $this->upload->data();
            $extension = $data_gambar['file_ext'];
            $foto = $id_ticket . '_' . $requestby . $extension;

            // Jika validasi lolos, lanjutkan proses penyimpanan
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
                'STATUS_TICKET' => 0,
                'APPROVAL_TICKET' => 0,
                'PROSENTASE' => null,
                'FOTO' => $foto
            ];

            $result = $this->M_TICKET->insert($data);
        } else {
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
                'STATUS_TICKET' => 0,
                'APPROVAL_TICKET' => 0,
                'PROSENTASE' => null,
                'FOTO' => null
            ];

            $result = $this->M_TICKET->insert($data);
        }

        // $this->db->trans_start();

        // ke tabel Ticket_Detail
        // if ($result) {
        //     foreach ($type_ticket as $value) {
        //         $data_detail = [
        //             'IDTICKET' => $id_ticket,
        //             'TECHNICIAN' => $value,
        //             'KETERANGAN' => null,
        //             'FOTO' => null
        //         ];
        //         $this->M_TICKET->insert_detail($data_detail);
        //     }
        // }

        // Selesaikan transaksi
        // $this->db->trans_complete();

        // Membuat format pesan sesuai permintaan
        $get_nama_departement = $this->M_DEPARTEMENT->get_departemen_single($id_departement);
        $nama_departemen = $get_nama_departement->NAMA_DEPARTEMEN;
        $url = "http://192.168.3.105/superapps/ticket";
        $get_kabag = $this->M_KARYAWAN->get_karyawan_by_departemen($id_departement);
        $KABAG = $get_kabag->TELEPON;

        // Kirim pesan WA ke Tim IT
        // $message =
        //     "📢 REQUEST TICKETING \n\n" .

        //     "📌 Informasi Pengguna: \n\n" .
        //     "\t👤 Nama: `$requestby` \n" .
        //     "\t🏢 Departemen: `$nama_departemen` \n\n" .

        //     "📌 Detail Keluhan: \n\n" .
        //     "\t📂 Tipe Keluhan: `$type_ticket` \n" .
        //     "\t📝 Deskripsi: \n" .
        //     "```$description_ticket``` \n\n\n" .

        //     "🚨 Harap segera proses ticket dengan membuka URL di bawah ini:\n" .
        //     "🔗 ($url)";
        // $this->WHATSAPP->send_wa('081216126123', $message);

        // Kirim pesan WA ke KABAG bersangkutan
        // $message =
        //     "📢 REQUEST TICKETING \n\n" .

        //     "📌 Informasi Perequest: \n\n" .
        //     "\t👤 Nama: `$requestby` \n" .
        //     "\t🏢 Departemen: `$nama_departemen` \n\n" .

        //     "📌 Detail Keluhan: \n\n" .
        //     "\t📂 Tipe Keluhan: `$type_ticket` \n" .
        //     "\t📝 Deskripsi: \n" .
        //     "```$description_ticket``` \n\n\n";
        // $this->WHATSAPP->send_wa($KABAG, $message);

        // Kirim Pesan ke Telegram Tim IT
        $ms_telegram =
            "📢 REQUEST TICKETING \n\n" .

            "📌 Informasi Pengguna: \n\n" .
            "\t👤 Nama: `$requestby` \n" .
            "\t🏢 Departemen: `$nama_departemen` \n\n" .

            "📌 Detail Keluhan: \n\n" .
            "\t📂 Tipe Keluhan: `$type_ticket` \n" .
            "\t📝 Deskripsi: \n" .
            "```$description_ticket``` \n\n\n" .

            "🚨 Harap segera proses ticket dengan membuka URL di bawah ini:\n" .
            "🔗 ($url)";
        $this->TELEGRAM->send_message('8007581238', $ms_telegram);

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
        $date_ticket_done = $this->input->post('date_ticket_done', true);

        // Validasi input
        if (empty($id_ticket) || empty($status_ticket)) {
            echo json_encode(['success' => false, 'error' => 'ID Ticket dan Status Ticket tidak boleh kosong.']);
            return;
        }

        // Pastikan date_ticket_done valid dan memiliki format yang benar
        if ($date_ticket_done) {
            $date_ticket_done = date('Y-m-d H:i:s', strtotime($date_ticket_done));
        } else {
            $date_ticket_done = null; // Atau set default jika diperlukan
        }

        // Data yang akan diupdate
        if ($prosentase == 100) {
            $data = [
                'STATUS_TICKET' => $status_ticket,
                'DATE_TICKET_DONE' => $date_ticket_done,
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
