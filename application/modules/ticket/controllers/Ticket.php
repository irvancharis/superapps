<?php
class Ticket extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TICKET');
        $this->load->model('role/M_ROLE');
        $this->load->model('technician/M_TECHNICIAN');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('jabatan/M_JABATAN');
        $this->load->model('WHATSAPP');
        $this->load->model('TELEGRAM');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('Uuid');
    }

    public function index($page = 'ticket')
    {
        $this->load->library('session');

        if ($this->session->userdata('NAMA_ROLE') == 'IT' || $this->session->userdata('NAMA_ROLE') == 'IT KABAG') {
            $data['M_TICKET_DALAM_ANTRIAN'] = $this->M_TICKET->get_ticket_by_approval(0);
            $data['JML_DALAM_ANTRIAN'] = $this->M_TICKET->count_ticket_by_approval(0);
            $data['M_TICKET_DISETUJUI'] = $this->M_TICKET->get_ticket_by_approval(1);
            $data['JML_DISETUJUI'] = $this->M_TICKET->count_ticket_by_approval(1);
            $data['M_TICKET_DITOLAK'] = $this->M_TICKET->get_ticket_by_approval(2);
            $data['JML_DITOLAK'] = $this->M_TICKET->count_ticket_by_approval(2);
            $data['M_TICKET_ALL'] = $this->M_TICKET->get_news();
            $data['JML_ALL'] = $this->M_TICKET->count_ticket_all();
            $data['M_TICKET_SEDANG_DIKERJAKAN'] = $this->M_TICKET->get_ticket_by_status(25);
            $data['JML_SEDANG_DIKERJAKAN'] = $this->M_TICKET->count_ticket_by_status(25);
            $data['M_TICKET_MENUNGGU_VALIDASI'] = $this->M_TICKET->get_ticket_by_status(50);
            $data['JML_MENUNGGU_VALIDASI'] = $this->M_TICKET->count_ticket_by_status(50);
            $data['M_TICKET_SELESAI'] = $this->M_TICKET->get_ticket_by_status(100);
            $data['JML_SELESAI'] = $this->M_TICKET->count_ticket_by_status(100);


            $this->session->set_userdata('page', $page);
            $data['page'] = $this->session->userdata('page');
            $data['get_departement'] = $this->M_TICKET->get_departement();
            $data['get_technician'] = $this->M_TICKET->get_technician();

            $this->load->view('layout/navbar') .
                $this->load->view('layout/sidebar', $data) .
                $this->load->view('ticket', $data);
        } elseif ($this->session->userdata('NAMA_ROLE') == 'IT TEKNISI') {
            $data['M_TICKET_DALAM_ANTRIAN'] = $this->M_TICKET->get_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 0);
            $data['JML_DALAM_ANTRIAN'] = $this->M_TICKET->count_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 0);
            $data['M_TICKET_SEDANG_DIKERJAKAN'] = $this->M_TICKET->get_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 25);
            $data['JML_SEDANG_DIKERJAKAN'] = $this->M_TICKET->count_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 25);
            $data['M_TICKET_MENUNGGU_VALIDASI'] = $this->M_TICKET->get_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 50);
            $data['JML_MENUNGGU_VALIDASI'] = $this->M_TICKET->count_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 50);
            $data['M_TICKET_SELESAI'] = $this->M_TICKET->get_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 100);
            $data['JML_SELESAI'] = $this->M_TICKET->count_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 100);
            $data['M_TICKET_ALL_TECHNICIAN'] = $this->M_TICKET->get_ticket_approval_disetujui();
            $data['JML_ALL'] = $this->M_TICKET->count_ticket_by_approval_disetujui();
            $this->session->set_userdata('page', $page);
            $data['page'] = $this->session->userdata('page');
            $data['get_departement'] = $this->M_TICKET->get_departement();
            $data['get_technician'] = $this->M_TICKET->get_technician();

            $this->load->view('layout/navbar') .
                $this->load->view('layout/sidebar', $data) .
                $this->load->view('ticket', $data);
        }
    }

    public function ticket_card($kode)
    {
        // get ticket by id
        $ticket['ticket'] = $this->M_TICKET->get_ticket($kode);
        // get nama technician by id
        $ticket['technician'] = $this->M_TECHNICIAN->get_karyawan_by_id($ticket->TECHNICIAN);
        $this->load->view('ticket_card', $ticket);
    }

    public function ticket_admin($kode, $page = 'ticket')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TICKET', 'PROSES TICKET');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['ticket'] = $this->M_TICKET->get_ticket($kode);
        $data['ticket_detail'] = $this->M_TICKET->get_ticket_detail_view($kode);
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen_single($data['ticket']->DEPARTEMENT);
        $data['get_departemen_request'] = $this->M_DEPARTEMENT->get_departemen_single($data['ticket']->DEPARTEMENT_DIREQUEST);
        $data['get_jabatan'] = $this->M_JABATAN->get_news();
        $data['get_technician'] = $this->M_TECHNICIAN->get_teknisi_by_id($data['ticket']->TECHNICIAN);
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('ticket_admin', $data);
    }

    public function ticket_technician($kode, $page = 'ticket')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TICKET', 'PROSES TICKET');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['M_TICKET_DETAIL_HISTORY'] = $this->M_TICKET->get_ticket_detail_view($kode);
        $data['ticket'] = $this->M_TICKET->get_ticket($kode);
        $data['ticket_detail'] = $this->M_TICKET->get_selected_tickets($kode);
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen_single($data['ticket']->DEPARTEMENT);
        $data['get_departemen_request'] = $this->M_DEPARTEMENT->get_departemen_single($data['ticket']->DEPARTEMENT_DIREQUEST);
        $data['get_jabatan'] = $this->M_JABATAN->get_news();
        $data['get_technician'] = $this->M_TECHNICIAN->get_teknisi_by_id($data['ticket']->TECHNICIAN);
        // $this->load->view('layout/navbar') .
        // $this->load->view('layout/sidebar', $data) .
        $this->load->view('ticket_technician', $data);
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
        $id_departemen = $this->input->get('id_departemen');

        // Validasi input
        if (empty($id_ticket) || empty($id_departemen)) {
            echo json_encode(['success' => false, 'error' => 'ID Ticket dan Departemen harus dipilih.']);
            return;
        }

        // Ambil data ticket untuk mendapatkan type_ticket yang sudah dipilih
        $ticket = $this->M_TICKET->get_ticket($id_ticket);
        $selected_tickets = isset($ticket->TYPE_TICKET)
            ? (strpos($ticket->TYPE_TICKET, ',') !== false
                ? explode(',', $ticket->TYPE_TICKET)
                : [$ticket->TYPE_TICKET])
            : [];

        // Ambil data joblist berdasarkan id_departemen
        $data = $this->M_TICKET->get_departement_joblist($id_departemen);

        if ($data) {
            echo json_encode([
                'success' => true,
                'data' => $data,
                'selected_tickets' => $selected_tickets // Kirim daftar type_ticket yang sudah dipilih
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Tidak ada data joblist untuk departemen yang dipilih.']);
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

        $this->WHATSAPP->send_wa('081259456586', 'Tes Pesan WA !!!');

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
        // Cek apakah user memiliki hak akses
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TICKET', 'PROSES TICKET');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

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
        $id_technician = $this->input->post('id_technician');
        $status_ticket = $this->input->post('status_ticket');
        $approval_ticket = $this->input->post('approval_ticket');
        $alasan_ditolak = $this->input->post('alasan_ditolak');
        $prosentase = $this->input->post('prosentase');
        $date_ticket_done = $this->input->post('date_ticket_done');

        // Pastikan date_ticket_done valid dan memiliki format yang benar
        if ($date_ticket_done) {
            $date_ticket_done = date('Y-m-d H:i:s', strtotime($date_ticket_done));
        } else {
            $date_ticket_done = null; // Atau set default jika diperlukan
        }

        // Kondisi jika value variabel $approval_ticket bernilai 2 / ditolak
        if ($approval_ticket != 2) {
            // Jika validasi lolos, lanjutkan proses penyimpanan
            $data = [
                'DATE_TICKET_DONE' => $date_ticket_done,
                'TECHNICIAN' => $id_technician,
                'STATUS_TICKET' => $status_ticket,
                'APPROVAL_TICKET' => $approval_ticket,
                'PROSENTASE' => $prosentase
            ];

            $result = $this->M_TICKET->update($id_ticket, $data);

            // Simpan data detail ticket
            $IDTICKET_DETAIL = $this->uuid->v4();
            $data_detail = [
                'IDTICKET_DETAIL' => $IDTICKET_DETAIL,
                'IDTICKET' => $id_ticket,
                'TGL_PENGERJAAN' => date('Y-m-d H:i:s'),
                'TECHNICIAN' => $id_technician,
                'OBJEK_DITANGANI' => "Approval Ticket",
                'KETERANGAN' => "Ticket Diproses Oleh Teknisi",
                'FOTO' => null,
                'STATUS_PROGRESS' => $status_ticket
            ];
            $this->M_TICKET->insert_detail($data_detail);

            // Ambil data teknisi dan departemen dari database
            $get_ticket = $this->M_TICKET->get_ticket($id_ticket);
            $get_departemen = $this->M_DEPARTEMENT->get_departemen_single($get_ticket->DEPARTEMENT);
            $get_teknisi = $this->M_TECHNICIAN->get_teknisi_by_id($id_technician);
            $get_karyawan = $this->M_KARYAWAN->get_karyawan_by_id($get_teknisi->IDKARYAWAN);
            $lokasi_ticket = $this->M_MAPING_AREA->get_maping_area_single($get_ticket->SITE_TICKET)->row()->NAMA_AREA;
            $TELP_TEKNISI = $get_karyawan->TELEPON;
            $NAMA_TEKNISI = $get_karyawan->NAMA_KARYAWAN;
            $get_IP = $this->get_lan_ip();
            // Ticket Card
            // $url = "http://" . $get_IP . "/superapps/ticket_client_view/ticket_card/$id_ticket";

            // Ticket History
            // $url_client = "http://" . urlencode($get_IP) . "/superapps/ticket_client_view/ticket_history/" . urlencode($id_ticket);
            // $url_teknisi = "http://" . urlencode($get_IP) . "/superapps/ticket/ticket_technician/"  . urlencode($id_ticket);

            // Ticket History Versi ZROK
            $url_client = "https://qsch2nssom6w.share.zrok.io/superapps/ticket_client_view/ticket_history/" . urlencode($id_ticket);
            // $url_teknisi = "https://qsch2nssom6w.share.zrok.io/superapps/login";
            $url_teknisi_local = "http://192.168.3.103/login";
            $url_teknisi_public = "https://ticketing.sagroup.id/login";
            $url_teknisi_alter = "http://182.253.41.206/login";

            // Membuat format pesan sesuai permintaan
            // // Kirim Pesan ke WA (Teknisi)
            $message =
                "===== *REQUEST TICKETING* =====\n\n" .

                "===== *INFORMASI PEREQUEST* =====\n" .
                "👤 NAMA: " . strtoupper($get_ticket->REQUESTBY) . "\n" .
                "🏢 DEPARTEMEN: " . strtoupper($get_departemen->NAMA_DEPARTEMEN) . "\n" .
                "📍 LOKASI: " . strtoupper($lokasi_ticket) . "\n\n" .

                "===== *DETAIL KELUHAN* =====\n" .
                "📂 TIPE KELUHAN: " . strtoupper($get_ticket->TYPE_TICKET) . "\n" .
                "📝 DESKRIPSI KELUHAN: " . strtoupper($get_ticket->DESCRIPTION_TICKET) . "\n\n" .

                "🚨 *HARAP SEGERA PROSES TICKET DENGAN MEMBUKA URL DI BAWAH INI:* \n" .
                "$url_teknisi_public (Jaringan Internet Non-Kantor / Paket Data) \n" .
                "$url_teknisi_local (Jaringan Internet Kantor / Local Network) \n" .
                "$url_teknisi_alter (Alamat URL Alternatif)";
            $this->WHATSAPP->send_wa($TELP_TEKNISI, $message);

            // // Kirim Pesan ke Telegram (Teknisi)
            // $ms_telegram_teknisi =
            //     "📢 REQUEST TICKETING \n\n" .

            //     "📌 Informasi Pengguna: \n\n" .
            //     "\t👤 Nama: `$get_ticket->REQUESTBY` \n" .
            //     "\t🏢 Departemen: `$get_departemen->NAMA_DEPARTEMEN` \n\n" .

            //     "📌 Detail Keluhan: \n\n" .
            //     "\t📂 Tipe Keluhan: `$get_ticket->TYPE_TICKET` \n" .
            //     "\t📝 Deskripsi: \n" .
            //     "```$get_ticket->DESCRIPTION_TICKET``` \n\n\n" .

            //     "🚨 Harap segera proses ticket dengan membuka URL di bawah ini:\n" .
            //     "🔗 ($url_teknisi)";
            // $this->TELEGRAM->send_message('8007581238', $ms_telegram_teknisi);

            // // Kirim Pesan ke Telegram (Client)
            // $ms_telegram_client =
            //     "📢 TICKETING PROGRESS \n\n" .

            //     "📌 Ticket Sudah DIPROSES \n\n" .

            //     "🚨 Lihat Progress Ticket anda dengan membuka URL di bawah ini:\n" .
            //     "🔗 [ $url_client ]";
            // $this->TELEGRAM->send_message('8007581238', $ms_telegram_client);

            // // Kirim Pesan ke WA (Client)
            $telp_client = $this->M_TICKET->get_selected_tickets($id_ticket)->TELP;
            $ms_wa_client =
                "===== *TICKET SUDAH DI APPROVE* ===== \n\n" .
                "📌 ID TICKET: " . strtoupper($get_ticket->IDTICKET) . " \n" .
                "👤 TEKNISI: " . strtoupper($NAMA_TEKNISI) . " \n\n" .
                " *TUNGGU KONFIRMASI LEBIH LANJUT.* ";
            $this->WHATSAPP->send_wa($telp_client, $ms_wa_client);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
            }
        } else {
            // Jika validasi lolos, lanjutkan proses penyimpanan
            $data = [
                'DATE_TICKET_DONE' => $date_ticket_done,
                'TECHNICIAN' => $id_technician,
                'STATUS_TICKET' => 200,
                'APPROVAL_TICKET' => $approval_ticket,
                'PROSENTASE' => 0,
                'ALASAN_DITOLAK' => $alasan_ditolak
            ];

            $result = $this->M_TICKET->update($id_ticket, $data);

            // // Kirim Pesan ke WA (Client)
            $telp_client = $this->M_TICKET->get_selected_tickets($id_ticket)->TELP;
            $url_client = "https://qsch2nssom6w.share.zrok.io/superapps/ticket_client_view/ticket_history/" . urlencode($id_ticket);
            $ms_wa_client =
                "===== *TICKET PROGRESS* ===== \n\n" .
                "===== *INFORMASI TICKET* ===== \n\n" .
                "📌 *MOHON MAAF TICKET ANDA KAMI TOLAK*  \n" .
                "👤 ALASAN: " . strtoupper($alasan_ditolak) . " \n\n" .

                "🚨 *JIKA ADA KENDALA MOHON KONFIRMASI LEBIH LANJUT* ";
            $this->WHATSAPP->send_wa($telp_client, $ms_wa_client);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
            }
        }
    }

    public function updateStatus()
    {
        // Ambil data dari POST dengan validasi awal
        $id_ticket = $this->input->post('id_ticket', true);
        $status_ticket = $this->input->post('status_ticket', true);
        $prosentase = $this->input->post('prosentase', true);
        $objek_ditangani = $this->input->post('objek_ditangani', true);
        $keterangan = $this->input->post('keterangan', true);

        // Validasi input
        if (empty($id_ticket) || $status_ticket == null) {
            echo json_encode(['success' => false, 'error' => 'ID Ticket dan Status Ticket tidak boleh kosong.']);
            return;
        }

        $IDTICKET_DETAIL = $this->uuid->v4();

        // Konfigurasi upload Gambar
        $config['upload_path'] = APPPATH . '../assets/uploads/ticket/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 5048; // 2MB
        $config['file_name'] = $IDTICKET_DETAIL;

        // Data yang akan diupdate
        if ($prosentase == 100) {
            $data = [
                'STATUS_TICKET' => $status_ticket,
                'DATE_TICKET_DONE' => date('Y-m-d H:i:s'),
                'PROSENTASE' => $prosentase,
            ];
        } else {
            $data = [
                'STATUS_TICKET' => $status_ticket,
                'PROSENTASE' => $prosentase,
            ];
        }

        // Pastikan model memiliki metode update yang benar
        $result = $this->M_TICKET->update($id_ticket, $data);

        // ke tabel Ticket_Detail
        if ($result) {
            // Cek apakah ada file yang diupload
            if (!empty($_FILES['FOTO']['name'])) {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('FOTO')) {
                    echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
                    return;
                }
                // Ambil data file yang diupload
                $data = $this->upload->data();
                $extension = $data['file_ext'];
                $foto = $IDTICKET_DETAIL . $extension;

                $data_detail = [
                    'IDTICKET_DETAIL' => $IDTICKET_DETAIL,
                    'IDTICKET' => $id_ticket,
                    'TGL_PENGERJAAN' => date('Y-m-d H:i:s'),
                    'TECHNICIAN' => $this->session->userdata('ID_KARYAWAN'),
                    'OBJEK_DITANGANI' => $objek_ditangani,
                    'KETERANGAN' => $keterangan,
                    'FOTO' => $foto,
                    'STATUS_PROGRESS' => $status_ticket
                ];
            } else {
                $data_detail = [
                    'IDTICKET_DETAIL' => $IDTICKET_DETAIL,
                    'IDTICKET' => $id_ticket,
                    'TGL_PENGERJAAN' => date('Y-m-d H:i:s'),
                    'TECHNICIAN' => $this->session->userdata('ID_KARYAWAN'),
                    'OBJEK_DITANGANI' => $objek_ditangani,
                    'KETERANGAN' => $keterangan,
                    'FOTO' => null,
                    'STATUS_PROGRESS' => $status_ticket
                ];
            }
            $this->M_TICKET->insert_detail($data_detail);

            // kirim notifikasi ke client via WA
            $get_ticket = $this->M_TICKET->get_ticket($id_ticket);
            $get_ticket_detail = $this->M_TICKET->get_ticket_detail_view_last_data($id_ticket);
            $get_teknisi = $this->M_TECHNICIAN->get_teknisi_by_id($get_ticket->TECHNICIAN);
            $get_karyawan = $this->M_KARYAWAN->get_karyawan_by_id($get_teknisi->IDKARYAWAN);
            $NAMA_TEKNISI = $get_karyawan->NAMA_KARYAWAN;
            // $url_client = "https://qsch2nssom6w.share.zrok.io/superapps/ticket_client_view/ticket_history/" . urlencode($id_ticket);
            $url_client = "https://ticketing.sagroup.id/ticket_client_view/ticket_history/" . urlencode($id_ticket);
            $url_client_local = "http://192.168.3.103/superapps/ticket_client_view/ticket_history/" . urlencode($id_ticket);
            $url_client_alter = "http://182.253.41.206/ticket_client_view/ticket_history/" . urlencode($id_ticket);
            $url_client_confirm = "https://qsch2nssom6w.share.zrok.io/superapps/ticket_client_view/ticket_confirm/" . urlencode($id_ticket);
            $telp_client = $this->M_TICKET->get_selected_tickets($id_ticket)->TELP;
            $ms_wa_client =
                "===== *TICKET PROGRESS* ===== \n\n" .
                "📌 *PROGRESS: " . strtoupper($get_ticket_detail->KETERANGAN) . "* \n" .
                "👤 TEKNISI: " . strtoupper($NAMA_TEKNISI) . " \n\n" .

                "🚨 *JIKA PROGRESS TICKET SUDAH SELESAI, KONFIRMASI DENGAN KLIK TAUTAN DI BAWAH.:* \n" .
                "$url_client (Jaringan Internet Non-Kantor / Paket Data) \n" .
                "$url_client_local (Jaringan Internet Kantor / Local Network) \n" .
                "$url_client_alter (Alamat URL Alternatif)";
            $this->WHATSAPP->send_wa($telp_client, $ms_wa_client);
        }

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
        $id_ticket = $this->input->post('id_ticket');

        // Proses hapus data
        $result = $this->M_TICKET->hapus($id_ticket);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }

    // Get lan ip
    private function get_lan_ip()
    {
        // Jalankan perintah ipconfig
        $output = shell_exec('ipconfig | findstr IPv4');

        // Cari alamat IPv4 menggunakan regex
        preg_match('/IPv4 Address[\.\s]+:\s+([\d\.]+)/', $output, $matches);

        // Jika ditemukan, kembalikan alamat IP
        if (isset($matches[1])) {
            return $matches[1];
        }

        return null; // Jika tidak ditemukan
    }

    public function cetak_progress_ticket($kode)
    {
        $this->load->library('session');
        // $SESSION_ROLE = $this->session->userdata('ROLE');
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TICKET', 'PROSES TICKET');
        // if (!$CEK_ROLE) {
        //     redirect('non_akses');
        // }

        $data['ticket'] = $this->M_TICKET->get_ticket($kode);
        $data['ticket_detail'] = $this->M_TICKET->get_ticket_detail_view($kode);
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen_single($data['ticket']->DEPARTEMENT);
        $data['get_departemen_request'] = $this->M_DEPARTEMENT->get_departemen_single($data['ticket']->DEPARTEMENT_DIREQUEST);
        $data['get_jabatan'] = $this->M_JABATAN->get_news();
        $data['get_technician'] = $this->M_TECHNICIAN->get_teknisi_by_id($data['ticket']->TECHNICIAN);

        $this->load->library('pdfgenerator');
        $data['title'] = "Laporan ticket";
        $file_pdf = $data['title'];
        $paper = 'F4';
        $orientation = "portrait";
        $html = $this->load->view('ticket_laporan_progress_fix', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function check_updates()
    {
        $this->load->database();
        // Ambil data penting untuk di-hash
        $data = $this->db->query("
        SELECT 
                COUNT(*) as total_tickets,
                SUM(CASE WHEN STATUS_TICKET = 0 THEN 1 ELSE 0 END) as status_0,
                SUM(CASE WHEN STATUS_TICKET = 25 THEN 1 ELSE 0 END) as status_25,
                SUM(CASE WHEN STATUS_TICKET = 50 THEN 1 ELSE 0 END) as status_50,
                SUM(CASE WHEN STATUS_TICKET = 100 THEN 1 ELSE 0 END) as status_100,
                MAX(DATE_TICKET) as latest_date
            FROM TICKET
        ")->row_array();

        // Buat hash unik dari data
        $current_hash = md5(json_encode($data));
        $session_hash = $this->session->userdata('ticket_data_hash');

        $response = ['has_update' => false];

        if (!$session_hash || $current_hash !== $session_hash) {
            $response['has_update'] = true;
            $this->session->set_userdata('ticket_data_hash', $current_hash);
        }

        // Tambahkan timestamp untuk debugging
        $response['last_check'] = date('Y-m-d H:i:s');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function check_updates_technician()
    {
        $this->load->database();
        // Ambil data penting untuk di-hash
        $data = $this->db->query("
        SELECT 
                COUNT(*) as total_tickets,
                SUM(CASE WHEN STATUS_PROGRESS = 0 THEN 1 ELSE 0 END) as status_0,
                SUM(CASE WHEN STATUS_PROGRESS = 25 THEN 1 ELSE 0 END) as status_25,
                SUM(CASE WHEN STATUS_PROGRESS = 50 THEN 1 ELSE 0 END) as status_50,
                SUM(CASE WHEN STATUS_PROGRESS = 100 THEN 1 ELSE 0 END) as status_100,
                MAX(TGL_PENGERJAAN) as latest_date
            FROM TICKETDETAIL
        ")->row_array();

        // Buat hash unik dari data
        $current_hash = md5(json_encode($data));
        $session_hash = $this->session->userdata('ticket_data_hash_technician');

        $response = ['has_update' => false];

        if (!$session_hash || $current_hash !== $session_hash) {
            $response['has_update'] = true;
            $this->session->set_userdata('ticket_data_hash_technician', $current_hash);
        }

        // Tambahkan timestamp untuk debugging
        $response['last_check'] = date('Y-m-d H:i:s');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
