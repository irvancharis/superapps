<?php

class Transaksi_pengadaan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TRANSAKSI_PENGADAAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->model('produk_stok/M_PRODUK_STOK');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
        $this->load->library('session');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');
        $this->load->database();
    }

    public function index($page = 'transaksi')
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'LIST');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }
        // echo $this->uuid->v4();

        $data['M_TRANSAKSI_PENGADAAN'] = $this->M_TRANSAKSI_PENGADAAN->get_data_view();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan', $data);
    }


    public function get_single($KODE)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $result = $this->M_TRANSAKSI_PENGADAAN->get_single($KODE);
        echo json_encode($result);
    }

    public function get_kategori_produk()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $result = $this->M_TRANSAKSI_PENGADAAN->get_kategori_produk();
        echo json_encode($result);
    }

    public function print($kode)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $data['transaksi'] = $this->M_TRANSAKSI_PENGADAAN->get_single($kode);
        $data['detail'] = $this->M_TRANSAKSI_PENGADAAN->get_detail($kode);
        $this->load->view('print', $data);
    }

    public function transaksi_pengadaan_produk()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');

        $this->load->view('transaksi_pengadaan_produk', $data);
    }

    public function transaksi_pengadaan_tambah_produk()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();

        $this->load->view('transaksi_pengadaan_tambah_produk', $data);
    }

    public function get_produk()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $search = $this->input->post('search')['value'];
        $search = strtoupper($search);

        log_message('error', 'Search query: ' . $search); // Tambahkan log ini

        if (empty($search)) {
            echo json_encode([
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ]);
            return;
        }

        $data = $this->M_PRODUK_ITEM->getFilteredProduk($search);

        log_message('error', 'Data returned: ' . json_encode($data)); // Tambahkan log ini

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }

    public function get_lokasi_by_ruangan()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $KODE_RUANGAN = $this->input->post('RUANGAN_PENEMPATAN');

        $result = $this->M_TRANSAKSI_PENGADAAN->get_lokasi_by_ruangan($KODE_RUANGAN);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function get_ruangan_by_area()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $KODE_AREA = $this->session->userdata('ID_AREA');

        $result = $this->M_TRANSAKSI_PENGADAAN->get_ruangan_by_area($KODE_AREA);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    // APPROVAL
    public function approval_kabag_by_token($token)
    {

        $data_token = $this->M_TRANSAKSI_PENGADAAN->get_detail_token($token);
        if ($data_token) {
            $data['approval_kabag'] = $this->M_TRANSAKSI_PENGADAAN->get_single($data_token->UUID_TRANSAKSI);
            $data['id_transaksi_pengadaan'] = $data_token->UUID_TRANSAKSI;
            $this->load->view('transaksi_pengadaan_approval_kabag_by_token', $data);
        } else {
            echo "Data Tidak Ditemukan";
        }
    }

    // APPROVAL
    public function approval_kabag($id_transaksi_pengadaan)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['approval_kabag'] = $this->M_TRANSAKSI_PENGADAAN->get_single($id_transaksi_pengadaan);
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['id_transaksi_pengadaan'] = $id_transaksi_pengadaan;
        log_message('error', 'Data returned: ' . json_encode($data['approval_kabag']));
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_approval_kabag', $data);
    }

    public function approval_gm_by_token($token)
    {
        $data_token = $this->M_TRANSAKSI_PENGADAAN->get_detail_token($token);
        if ($data_token) {
            $data['approval_gm'] = $this->M_TRANSAKSI_PENGADAAN->get_single($data_token->UUID_TRANSAKSI);
            $data['item'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi_detail($data_token->UUID_TRANSAKSI);
            $data['id_transaksi_pengadaan'] = $data_token->UUID_TRANSAKSI;
            $this->load->view('transaksi_pengadaan_approval_gm_by_token', $data);
        } else {
            echo "Data Tidak Ditemukan";
        }
    }

    public function approval_gm($id_transaksi_pengadaan)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'APROVAL GM');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['approval_gm'] = $this->M_TRANSAKSI_PENGADAAN->get_single($id_transaksi_pengadaan);
        $data['item'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi_detail($id_transaksi_pengadaan);
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['id_transaksi_pengadaan'] = $id_transaksi_pengadaan;
        log_message('error', 'Data returned: ' . json_encode($data['approval_gm']));
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_approval_gm', $data);
    }

    public function approval_head($id_transaksi_pengadaan)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'APROVAL HEAD');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['approval_head'] = $this->M_TRANSAKSI_PENGADAAN->get_single($id_transaksi_pengadaan);
        $data['item'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi_detail($id_transaksi_pengadaan);
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['id_transaksi_pengadaan'] = $id_transaksi_pengadaan;
        log_message('error', 'Data returned: ' . json_encode($data['approval_head']));
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_approval_head', $data);
    }

    public function approval_head_by_token($token)
    {
        $data_token = $this->M_TRANSAKSI_PENGADAAN->get_detail_token($token);
        if ($data_token) {
            $data['approval_head'] = $this->M_TRANSAKSI_PENGADAAN->get_single($data_token->UUID_TRANSAKSI);
            $data['item'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi_detail($data_token->UUID_TRANSAKSI);
            $data['id_transaksi_pengadaan'] = $data_token->UUID_TRANSAKSI;
            $this->load->view('transaksi_pengadaan_approval_head_by_token', $data);
        } else {
            echo "Data Tidak Ditemukan";
        }
    }


    // PROSES PENGADAAN
    public function proses_pengadaan($id_transaksi_pengadaan)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'PROSES PENGADAAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['proses_pengadaan'] = $this->M_TRANSAKSI_PENGADAAN->get_single($id_transaksi_pengadaan);
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['id_transaksi_pengadaan'] = $id_transaksi_pengadaan;
        log_message('error', 'Data returned: ' . json_encode($data['proses_pengadaan']));
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_proses_pengadaan', $data);
    }

    // MENUNGGU KIRIMAN BARANG
    public function m_kiriman_barang($id_transaksi_pengadaan)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['m_kiriman_barang'] = $this->M_TRANSAKSI_PENGADAAN->get_single($id_transaksi_pengadaan);
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['id_transaksi_pengadaan'] = $id_transaksi_pengadaan;
        $data['karyawan'] = $this->M_KARYAWAN->get_karyawan();
        log_message('error', 'Data returned: ' . json_encode($data['m_kiriman_barang']));
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_m_kiriman_barang', $data);
    }

    // PENYERAHAN BARANG
    public function penyerahan_barang($id_transaksi_pengadaan)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['penyerahan_barang'] = $this->M_TRANSAKSI_PENGADAAN->get_single($id_transaksi_pengadaan);
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['id_transaksi_pengadaan'] = $id_transaksi_pengadaan;
        $data['karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['karyawan_departemen'] = $this->M_KARYAWAN->get_karyawan_by_departemen($data['penyerahan_barang']->KODE_DEPARTEMEN_PENGAJUAN);
        log_message('error', 'Data returned: ' . json_encode($data['karyawan']));
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_penyerahan_barang', $data);
    }

    // PENYERAHAN BARANG USER
    public function penyerahan_barang_user($id_transaksi_pengadaan)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['penyerahan_barang_user'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi($id_transaksi_pengadaan);
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['id_transaksi_pengadaan'] = $id_transaksi_pengadaan;
        $data['karyawan'] = $this->M_KARYAWAN->get_karyawan_by_departemen($data['penyerahan_barang_user']->KODE_DEPARTEMEN_PENGAJUAN);
        log_message('error', 'Data returned: ' . json_encode($data['karyawan']));
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_penyerahan_barang_user', $data);
    }

    public function get_data_transaksi_detail($id_transaksi_pengadaan)
    {

        $produk = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi_detail($id_transaksi_pengadaan);

        if (empty($produk)) {
            echo json_encode([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ]);
            return;
        }

        echo json_encode([
            'success' => true,
            'data' => $produk
        ]);
    }


    public function tambah($page = 'transaksi_pengadaan')
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'PENGAJUAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['M_TRANSAKSI_PENGADAAN'] = $this->M_TRANSAKSI_PENGADAAN->get_data();
        $data['get_karyawan'] = $this->M_TRANSAKSI_PENGADAAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();
        $kode_area = $this->session->userdata('ID_AREA');
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan_by_area($kode_area);
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $data['get_jabatan'] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_tambah', $data);
    }

    public function detail($KODE, $page = 'transaksi_pengadaan')
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $transaksi = $this->M_TRANSAKSI_PENGADAAN->get_single($KODE);
        $data['transaksi'] = $transaksi;

        $detail_transaksi = $this->M_TRANSAKSI_PENGADAAN->get_detail($KODE);
        $data['detail_transaksi'] = $detail_transaksi;

        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['get_jabatan'] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('detail', $data);
    }

    public function kirim_wa($data)
    {
        $setting = $this->db->get('SETTING')->row();
        $token_wa = $setting->TOKEN_WA;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $data['target'],
                'message' => $data['message'],
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token_wa
            ),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            echo $error_msg;
        }
    }


    public function insert()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $items = $this->input->post('items');
        $formData = $this->input->post('form');
        $uuid_transaksi = $this->uuid->v4();
        $uuid_token = $this->uuid->v4();

        if (!empty($formData) && !empty($items)) {
            // Simpan data transaksi utama
            $data_transaksi = [
                'UUID_TRANSAKSI_PENGADAAN' => $uuid_transaksi,
                'KODE_DEPARTEMEN_PENGAJUAN' => $formData['DEPARTEMEN_PENGAJUAN'],
                'TANGGAL_PENGAJUAN' => date('Y-m-d H:i:s'),
                'STATUS_PENGADAAN' => 'MENUNGGU APROVAL KABAG',
                'KODE_USER_PENGAJUAN' => $this->session->userdata('ID_KARYAWAN'),
                'KODE_AREA_DEFAULT' => $formData['AREA_PENEMPATAN'],
                'KODE_RUANGAN_DEFAULT' => $formData['RUANGAN_PENEMPATAN'],
                'KODE_LOKASI_DEFAULT' => $formData['LOKASI_PENEMPATAN'],
            ];

            $this->db->insert('TRANSAKSI_PENGADAAN', $data_transaksi);
            
            $jumlah_item = count($items);
            // Simpan detail produk
            foreach ($items as $item) {
                $data_produk = [
                    'UUID_TRANSAKSI_PENGADAAN' => $uuid_transaksi,
                    'KODE_PRODUK_ITEM' => $item['id'],
                    'JUMLAH_PENGADAAN' => $item['jumlah'],
                    'KEPERLUAN' => $item['keperluan'],
                ];
                $this->db->insert('TRANSAKSI_PENGADAAN_DETAIL', $data_produk);
            }

            $data_token = [
                'UUID_TOKEN' => $uuid_token,
                'TOKEN' => rand(100000, 999999),
                'CREATE' => date('Y-m-d H:i:s'),
                'MASA_BERLAKU' => date('Y-m-d H:i:s', strtotime('+1 days')),
                'USER_AKSES' => 'd3d646fb-b1e2-430d-ad50-6b4e7aa882c1',
                'KETERANGAN_TRANSAKSI' => 'TRANSAKSI PENGADAAN - APROVAL KABAG',
                'LINK' => base_url('appinkabag/' . $uuid_token),
                'UUID_TRANSAKSI' => $uuid_transaksi,
            ];
            $this->db->insert('TOKEN', $data_token);


            $get_kontak_kabag = $this->M_TRANSAKSI_PENGADAAN->get_karyawan_by_departemen($formData['DEPARTEMEN_PENGAJUAN'], 'KABAG');
            //kirim notif WA
            $data = [
                "target" => $get_kontak_kabag->TELEPON,
                "message" => '📢 Pemberitahuan Transaksi Pengadaan!
Telah terjadi transaksi pengadaan dengan detail berikut:

📌 Nomor Transaksi: ' . $data_token['UUID_TRANSAKSI'] . '
🛍️ Total Item: ' . $jumlah_item . '

Silakan lakukan pengecekan dan approval melalui link berikut:
🔗 ' . $data_token['LINK'] . '

Mohon segera ditindaklanjuti untuk kelancaran proses pengadaan. Terima kasih!

Salam,
Sejahtera Abadi Group'
            ];

            //send message
            $this->kirim_wa($data);

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }



    public function update()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $KODE_ITEM = $this->input->post('NIK');

        // Validasi
        if (empty($KODE_ITEM)) {
            $errors[] = 'NIK tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
        $result = $this->M_TRANSAKSI_PENGADAAN->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function update_approval_kabag()
    {
        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $form = $this->input->post('form');
        $items = $this->input->post('items');
        $token = $this->input->post('token');
        $uuid_token = $this->uuid->v4();

        $jumlah_item = count($items);

        if (!$id_transaksi || empty($form) || empty($items)) {
            echo json_encode(['success' => false, 'error' => 'Harap isi Keterangan Pengajuan Pengadaan
            !']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'KETERANGAN_PENGAJUAN' => $form['KETERANGAN_PENGAJUAN'],
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'STATUS_PENGADAAN' => 'MENUNGGU APROVAL GM',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        $this->db->where('UUID_TOKEN', $token);
        $this->db->delete('TOKEN');
        
        $data_token = [
            'UUID_TOKEN' => $uuid_token,
            'TOKEN' => rand(100000, 999999),
            'CREATE' => date('Y-m-d H:i:s'),
            'MASA_BERLAKU' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'USER_AKSES' => 'd3d646fb-b1e2-430d-ad50-6b4e7aa882c1',
            'KETERANGAN_TRANSAKSI' => 'TRANSAKSI PENGADAAN - APROVAL GM',
            'LINK' => base_url('appingm/' . $uuid_token),
            'UUID_TRANSAKSI' => $id_transaksi,
        ];
        $this->db->insert('TOKEN', $data_token);

        $get_setting = $this->db->get('SETTING')->row();        
        $this->db->where('ID_KARYAWAN', $get_setting->GM);
        $get_kabag = $this->db->get('VIEW_KARYAWAN')->row();

        $data = [
            "target" => $get_kabag->TELEPON,
            "message" => '📢 Pemberitahuan Transaksi Pengadaan!
Telah terjadi transaksi pengadaan dengan detail berikut:

📌 Nomor Transaksi: ' . $data_token['UUID_TRANSAKSI'] . '
🛍️ Total Item: ' . $jumlah_item . '

Silakan lakukan pengecekan dan approval melalui link berikut:
🔗 ' . $data_token['LINK'] . '

Mohon segera ditindaklanjuti untuk kelancaran proses pengadaan. Terima kasih!

Salam,
Sejahtera Abadi Group'
        ];

        //send message
        $this->kirim_wa($data);


        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        echo json_encode(['success' => true]);
    }

    public function update_approval_gm()
    {        

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $items = $this->input->post('items');
        $token = $this->input->post('token');
        $uuid_token = $this->uuid->v4();

        $jumlah_item = count($items);

        if (!$id_transaksi || empty($items)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_GM' => $this->session->userdata('ID_KARYAWAN'),
            'TANGGAL_APROVAL_GM' => date('Y-m-d'),
            'STATUS_PENGADAAN' => 'MENUNGGU APROVAL HEAD',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        $this->db->where('UUID_TOKEN', $token);
        $this->db->delete('TOKEN');
        
        $data_token = [
            'UUID_TOKEN' => $uuid_token,
            'TOKEN' => rand(100000, 999999),
            'CREATE' => date('Y-m-d H:i:s'),
            'MASA_BERLAKU' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'USER_AKSES' => '8b045f06-cef0-4611-a086-cde108614c8d',
            'KETERANGAN_TRANSAKSI' => 'TRANSAKSI PENGADAAN - APROVAL HEAD',
            'LINK' => base_url('appinhead/' . $uuid_token),
            'UUID_TRANSAKSI' => $id_transaksi,
        ];
        $this->db->insert('TOKEN', $data_token);

        $get_setting = $this->db->get('SETTING')->row();
        $this->db->where('ID_KARYAWAN', $get_setting->HEAD);
        $get_head = $this->db->get('VIEW_KARYAWAN')->row();

        $data = [
            "target" => $get_head->TELEPON,
            "message" => '📢 Pemberitahuan Transaksi Pengadaan!
Telah terjadi transaksi pengadaan dengan detail berikut:

📌 Nomor Transaksi: ' . $data_token['UUID_TRANSAKSI'] . '
🛍️ Total Item: ' . $jumlah_item . '

Silakan lakukan pengecekan dan approval melalui link berikut:
🔗 ' . $data_token['LINK'] . '

Mohon segera ditindaklanjuti untuk kelancaran proses pengadaan. Terima kasih!

Salam,
Sejahtera Abadi Group'
        ];

        //send message
        $this->kirim_wa($data);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        echo json_encode(['success' => true]);
    }

    public function update_approval_head()
    {

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $items = $this->input->post('items');
        $token = $this->input->post('token');

        if (!$id_transaksi || empty($items)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_HEAD' => $this->session->userdata('ID_KARYAWAN'),
            'TANGGAL_APROVAL_HEAD' => date('Y-m-d'),
            'STATUS_PENGADAAN' => 'PROSES PENGADAAN',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        $this->db->where('UUID_TOKEN', $token);
        $this->db->delete('TOKEN');

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        echo json_encode(['success' => true]);
    }

    public function disapprove_kabag()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL_KABAG');
        $items = $this->input->post('items');

        if (!$id_transaksi || empty($form) || empty($items)) {
            echo json_encode(['success' => false, 'error' => 'Harap isi Keterangan Cancel!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KETERANGAN_CANCEL_KABAG' => $form,
            'STATUS_PENGADAAN' => 'DITOLAK KABAG',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        $token = $this->input->post('token');
        $this->db->where('UUID_TOKEN', $token);
        $this->db->delete('TOKEN');

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function disapprove_gm()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL_GM');
        $items = $this->input->post('items');

        if (!$id_transaksi || empty($form) || empty($items)) {
            echo json_encode(['success' => false, 'error' => 'Harap isi Keterangan Cancel!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KETERANGAN_CANCEL_GM' => $form,
            'STATUS_PENGADAAN' => 'DITOLAK GM',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        $token = $this->input->post('token');
        $this->db->where('UUID_TOKEN', $token);
        $this->db->delete('TOKEN');

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function disapprove_head()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL_HEAD');
        $items = $this->input->post('items');

        if (!$id_transaksi || empty($form) || empty($items)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KETERANGAN_CANCEL_HEAD' => $form,
            'STATUS_PENGADAAN' => 'DITOLAK HEAD',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        $token = $this->input->post('token');
        $this->db->where('UUID_TOKEN', $token);
        $this->db->delete('TOKEN');

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function update_proses_pengadaan()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $items = $this->input->post('items');
        $form = $this->input->post('form');

        if (!$id_transaksi || empty($items) || empty($form)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_USER_PENGADAAN' => $this->session->userdata('ID_KARYAWAN'),
            'NO_REGISTER' => $form['NO_REGISTER'],
            'TANGGAL_PENGADAAN' => date('Y-m-d'),
            'STATUS_PENGADAAN' => 'MENUNGGU KIRIMAN BARANG',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        echo json_encode(['success' => true]);
    }

    public function update_m_kiriman_barang()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $items = $this->input->post('items');
        $form = $this->input->post('form');

        if (!$id_transaksi || empty($items) || empty($form)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'NO_RESI' => $form['NO_RESI'],
            'KODE_USER_PENERIMA_KIRIMAN' => $this->session->userdata('ID_KARYAWAN'),
            'TANGGAL_PENERIMAAN_KIRIMAN' => date('Y-m-d'),
            'STATUS_PENGADAAN' => 'MENUNGGU PENYERAHAN',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);   
            
            
            $get_maping_default = $this->M_TRANSAKSI_PENGADAAN->get_maping_default($form['AREA']);  
            
            
            
            
            // Update stok barang jika barang tidak ada di tabel Produk_Stok maka Insert jika ada maka Update
            $cek_produk_stok = $this->M_PRODUK_STOK->get_produk_stok_single($item['id'], $get_maping_default->AREA,$get_maping_default->DEPARTEMEN, $get_maping_default->RUANGAN, $get_maping_default->LOKASI )->row();
            
            if ($cek_produk_stok) {
                $data_update = [
                    'JUMLAH_STOK' => $cek_produk_stok->JUMLAH_STOK + $item['jumlah']
                ];
                $this->M_PRODUK_STOK->update($item['id'], $data_update);
            } else {
                $data_insert = [
                    'UUID_STOK' => $this->uuid->v4(),
                    'KODE_ITEM' => $item['id'],
                    'JUMLAH_STOK' => $item['jumlah'],
                    'KODE_AREA' => $get_maping_default->AREA,
                    'KODE_RUANGAN' => $get_maping_default->RUANGAN,
                    'KODE_LOKASI' => $get_maping_default->LOKASI,
                    'KODE_DEPARTEMEN' => $get_maping_default->DEPARTEMEN,
                ];
                $this->M_PRODUK_STOK->insert($data_insert);
            }

        }

        echo json_encode(['success' => true]);
    }

    public function update_penyerahan_barang()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $items = $this->input->post('items');
        $form = $this->input->post('form');

        if (!$id_transaksi || empty($items) || empty($form)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_USER_PENYERAHAN_BARANG' => $form['KODE_USER_PENYERAHAN_BARANG'],
            'KODE_USER_PENERIMA_BARANG' => $form['KODE_USER_PENERIMA_BARANG'],
            'TANGGAL_PENYERAHAN_BARANG' => date('Y-m-d'),
            'STATUS_PENGADAAN' => 'SELESAI',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);

            // Update stok barang jika barang tidak ada di tabel Produk_Stok maka Insert jika ada maka Update
            $cek_produk_stok = $this->M_PRODUK_STOK->get_produk_stok_single($item['id'], $form['AREA_PENEMPATAN'], $form['DEPARTEMEN_PENGAJUAN'], $form['RUANGAN_PENEMPATAN'], $form['LOKASI_PENEMPATAN'])->row();
            if ($cek_produk_stok) {
                $data_update = [
                    'JUMLAH_STOK' => $cek_produk_stok->JUMLAH_STOK + $item['jumlah']
                ];
                $this->M_PRODUK_STOK->update($cek_produk_stok->UUID_STOK, $data_update);
            } else {
                $data_insert = [
                    'UUID_STOK' => $this->uuid->v4(),
                    'KODE_ITEM' => $item['id'],
                    'JUMLAH_STOK' => $item['jumlah'],
                    'KODE_AREA' => $form['AREA_PENEMPATAN'],
                    'KODE_RUANGAN' => $form['RUANGAN_PENEMPATAN'],
                    'KODE_LOKASI' => $form['LOKASI_PENEMPATAN'],
                    'KODE_DEPARTEMEN' => $form['DEPARTEMEN_PENGAJUAN'],
                ];
                $this->M_PRODUK_STOK->insert($data_insert);
            }

            $get_maping_default = $this->M_TRANSAKSI_PENGADAAN->get_maping_default($form['AREA_PENEMPATAN']);          
            
            // Update stok barang jika barang tidak ada di tabel Produk_Stok maka Insert jika ada maka Update
            $cek_produk_stok_temp = $this->M_PRODUK_STOK->get_produk_stok_single($item['id'], $get_maping_default->AREA,$get_maping_default->DEPARTEMEN, $get_maping_default->RUANGAN, $get_maping_default->LOKASI)->row();

            if ($cek_produk_stok_temp) {
                
                    $jumlah_stok = $cek_produk_stok_temp->JUMLAH_STOK - $item['jumlah'];
                    
                    if ($jumlah_stok > 0) {
                        $data_update_temp = [
                            'JUMLAH_STOK' => $jumlah_stok
                        ];
                        $this->M_PRODUK_STOK->update($cek_produk_stok_temp->UUID_STOK, $data_update_temp);    
                    }else{
                        $this->M_PRODUK_STOK->delete($cek_produk_stok_temp->UUID_STOK);
                    }                    
            }
        }

        echo json_encode(['success' => true]);
    }

    public function update_penyerahan_barang_user()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $items = $this->input->post('items');
        $form = $this->input->post('form');

        if (!$id_transaksi || empty($items) || empty($form)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_USER_PENYERAHAN_BARANG' => $form['KODE_USER_PENERIMA_BARANG'],
            'TANGGAL_PENYERAHAN_BARANG' => date('Y-m-d'),
            'STATUS_PENGADAAN' => 'SELESAI',
        ];

        $update = $this->M_TRANSAKSI_PENGADAAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGADAAN->delete_detail($id_transaksi); // Hapus data lama
        foreach ($items as $item) {
            $data_detail = [
                'UUID_TRANSAKSI_PENGADAAN' => $id_transaksi,
                'KODE_PRODUK_ITEM' => $item['id'],
                'JUMLAH_PENGADAAN' => $item['jumlah'],
                'KEPERLUAN' => $item['keperluan']
            ];
            $this->M_TRANSAKSI_PENGADAAN->insert_detail($data_detail);
        }

        echo json_encode(['success' => true]);
    }

    public function hapus($KODE_ITEM)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PENGADAAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}