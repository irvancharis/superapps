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
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
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

    public function ticket_history($kode)
    {
        // get ticket by id
        $ticket['ticket_detail'] = $this->M_TICKET->get_ticket_detail_view($kode);
        $ticket['id_ticket'] = $kode;
        $ticket['status_ticket'] = $this->M_TICKET->get_ticket($kode)->STATUS_TICKET;
        // get nama technician by id
        // $ticket['technician'] = $this->M_TECHNICIAN->get_teknisi_by_id($ticket['ticket_detail']->TECHNICIAN);
        $this->load->view('ticket_history', $ticket);
    }

    public function ticket_confirm($kode)
    {
        // get ticket by id
        $ticket['ticket_detail'] = $this->M_TICKET->get_ticket_detail_view($kode);
        $ticket['id_ticket'] = $kode;
        $ticket['status_ticket'] = $this->M_TICKET->get_ticket($kode)->STATUS_TICKET;
        // get nama technician by id
        // $ticket['technician'] = $this->M_TECHNICIAN->get_teknisi_by_id($ticket['ticket_detail']->TECHNICIAN);
        $this->load->view('ticket_confirm', $ticket);
    }

    // Fungsi untuk mengembalikan data JSON Ticket History
    public function get_ticket_progress($kode)
    {
        $ticket_detail = $this->M_TICKET->get_ticket_detail_view($kode); // Ambil data dari model
        echo json_encode($ticket_detail); // Kembalikan data dalam format JSON
    }

    public function ticket_queue($page = 'ticket')
    {
        $this->load->library('session');

        $data['M_TICKET'] = $this->M_TICKET->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_TICKET->get_departement();
        $data['get_area'] = $this->M_TICKET->get_area();

        $this->load->view('ticket_queue', $data);
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
        $id_departemen = $this->input->post('id_departemen');
        $id_area = $this->input->post('id_area');

        // Validasi input
        if (empty($id_departemen) || empty($id_area)) {
            echo json_encode(['success' => false, 'error' => 'Departemen dan Area harus dipilih.']);
            return;
        }

        // Ambil data joblist berdasarkan id_departemen dan id_area
        $data = $this->M_TICKET->get_joblist_by_departement_and_area($id_departemen, $id_area);

        if ($data) {
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Tidak ada data JOBLIST untuk DEPARTEMEN dan AREA yang dipilih.']);
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
        $requestby = $this->input->post('request_by');
        $id_departement = $this->input->post('id_departemen');
        $telp = $this->input->post('telp');
        $site_ticket = $this->input->post('id_area');
        $lokasi_ticket = $this->M_MAPING_AREA->get_maping_area_single($site_ticket)->row()->NAMA_AREA;
        $id_departement_request = $this->input->post('id_departemen_request');
        $nama_departemen_request = $this->M_DEPARTEMENT->get_departemen_single($id_departement_request)->NAMA_DEPARTEMEN;
        $type_ticket = $this->input->post('type_ticket');
        $description_ticket = $this->input->post('description_ticket');
        $result = null;

        // Fungsi untuk generate kode kategori secara otomatis
        function generate_category_code($type_ticket)
        {
            // Hilangkan spasi dan karakter khusus, lalu ambil 3 huruf pertama
            $cleaned_string = preg_replace('/[^a-zA-Z]/', '', $type_ticket); // Hanya ambil huruf
            $category_code = strtoupper(substr($cleaned_string, 0, 3)); // Ambil 3 huruf pertama dan ubah ke uppercase
            return $category_code;
        }

        // Generate kode kategori
        $category_code = generate_category_code($type_ticket);

        // Tanggal saat ini
        $current_date = date('Ymd'); // Format: TahunBulanTanggal (YYYYMMDD)

        // Ambil jumlah tiket pada hari ini
        $this->db->like('IDTICKET', $current_date, 'after'); // Cari IDTICKET yang dimulai dengan tanggal hari ini
        $ticket_count = $this->db->count_all_results('TICKET'); // Hitung jumlah tiket

        // Nomor urut
        $sequence_number = $ticket_count + 1; // Increment nomor urut

        // Format nomor urut menjadi 3 digit (misalnya, 001, 002, dst.)
        $formatted_sequence_number = str_pad($sequence_number, 3, '0', STR_PAD_LEFT);

        // Gabungkan komponen untuk membuat IDTICKET
        $id_ticket = $current_date . '-' . $category_code . '-' . $formatted_sequence_number;

        // Contoh hasil:
        // 20250312-FIN-001
        // 20250312-COM-002
        // 20250312-PRI-003
        // 20250313-FIN-001

        // Konfigurasi upload Gambar
        $config['upload_path'] = APPPATH . '../assets/uploads/ticket/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['max_size'] = 4096; // 4MB
        $config['file_name'] = $id_ticket . '_' . $requestby;

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
                'TELP' => $telp,
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
        } elseif (!empty($_FILES['dokumen']['name'])) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('dokumen')) {
                echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
                return;
            }
            // Ambil data file yang diupload
            $data_dokumen = $this->upload->data();
            $extension = $data_dokumen['file_ext'];
            $foto = $id_ticket . '_' . $requestby . $extension;

            // Jika validasi lolos, lanjutkan proses penyimpanan
            $data = [
                'IDTICKET' => $id_ticket,
                'REQUESTBY' => $requestby,
                'DEPARTEMENT' => $id_departement,
                'TELP' => $telp,
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
                'TELP' => $telp,
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


        // Membuat format pesan sesuai permintaan
        $get_nama_departement = $this->M_DEPARTEMENT->get_departemen_single($id_departement);
        $nama_departemen = $get_nama_departement->NAMA_DEPARTEMEN;
        $get_IP = $this->get_lan_ip();
        $url = "http://" . $get_IP . "/superapps/login";

        if ($nama_departemen != "UMUM") {
            $get_kabag = $this->M_KARYAWAN->get_kabag_by_departemen($id_departement);
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
            $message =
                "=====*REQUEST TICKETING*===== \n\n" .

                "=====*INFORMASI PEREQUEST*===== \n" .
                "   👤 NAMA: `" . strtoupper($requestby) . "` \n" .
                "   🏢 DEPARTEMEN: `" . strtoupper($nama_departemen) . "` \n" .
                "   📍 LOKASI: `" . strtoupper($lokasi_ticket) . "` \n\n" .

                "=====*DETAIL KELUHAN*===== \n" .
                "   📂 TIPE KELUHAN: `" . strtoupper($type_ticket) . "` \n" .
                "   📝 DESKRIPSI KELUHAN: `" . strtoupper($description_ticket) . "` \n\n" .

                "=====*DEPARTEMEN DIREQUEST*===== \n" .
                "   🏢 DEPARTEMEN: `" . strtoupper($nama_departemen_request) . "`";

            $this->WHATSAPP->send_wa($KABAG, $message);
        }

        // Kirim Pesan ke Telegram Tim IT
        $ms_telegram =
            "=====*REQUEST TICKETING*===== \n\n" .

            "=====*INFORMASI PEREQUEST*===== \n" .
            "   👤 NAMA: `" . strtoupper($requestby) . "` \n" .
            "   🏢 DEPARTEMEN: `" . strtoupper($nama_departemen) . "` \n" .
            "   📍 LOKASI: `" . strtoupper($lokasi_ticket) . "` \n\n" .

            "=====*DETAIL KELUHAN*===== \n" .
            "   📂 TIPE KELUHAN: `" . strtoupper($type_ticket) . "` \n" .
            "   📝 DESKRIPSI KELUHAN: `" . strtoupper($description_ticket) . "` \n\n" .

            "🚨 *HARAP SEGERA PROSES TICKET DENGAN MEMBUKA URL DI BAWAH INI:* \n" .
            "[ $url ]";

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
        // E-MAIL
        // $email_ticket = $this->input->post('email_ticket');
        // TELP
        $telp = $this->input->post('telp');
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
            // E-MAIL
            // 'EMAIL_TICKET' => $email_ticket,
            // TELP
            'TELP' => $telp,
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

    public function updateKonfirmasiSelesai($id_ticket)
    {
        $get_ticket = $this->M_TICKET->get_ticket($id_ticket);

        // Lakukan proses update status ticket di sini
        $data = [
            'STATUS_TICKET' => 100,
            'DATE_TICKET_DONE' => date('Y-m-d H:i:s'),
            'PROSENTASE' => 100
        ];
        $result = $this->M_TICKET->update_konfirmasi_selesai($id_ticket, $data); // Misalnya, status 100 = SELESAI

        $IDTICKET_DETAIL = $this->uuid->v4();
        $data_detail = [
            'IDTICKET_DETAIL' => $IDTICKET_DETAIL,
            'IDTICKET' => $id_ticket,
            'TGL_PENGERJAAN' => date('Y-m-d H:i:s'),
            'TECHNICIAN' => $get_ticket->TECHNICIAN,
            'OBJEK_DITANGANI' => 'Selesai',
            'KETERANGAN' => 'Sudah Dikonfirmasi Selesai Oleh Client',
            'FOTO' => null,
            'STATUS_PROGRESS' => 100
        ];
        $this->M_TICKET->insert_detail($data_detail);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Ticket berhasil dikonfirmasi selesai.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengonfirmasi ticket.']);
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
}
