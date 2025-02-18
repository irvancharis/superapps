<?php

class Transaksi_pengadaan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TRANSAKSI_PENGADAAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
        $this->load->library('session');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');

        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function index($page = 'transaksi_pengadaan')
    {
        $this->load->library('session');
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
        $result = $this->M_TRANSAKSI_PENGADAAN->get_single($KODE);
        echo json_encode($result);
    }

    public function get_kategori_produk()
    {
        $result = $this->M_TRANSAKSI_PENGADAAN->get_kategori_produk();
        echo json_encode($result);
    }

    public function transaksi_pengadaan_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');

        $this->load->view('transaksi_pengadaan_produk', $data);
    }

    public function transaksi_pengadaan_tambah_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();

        $this->load->view('transaksi_pengadaan_tambah_produk', $data);
    }

    public function get_produk()
    {
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
        $KODE_AREA = $this->input->post('AREA_PENEMPATAN');

        $result = $this->M_TRANSAKSI_PENGADAAN->get_ruangan_by_area($KODE_AREA);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    // APPROVAL
    public function approval_kabag($id_transaksi_pengadaan)
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['approval_kabag'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi($id_transaksi_pengadaan);
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

    public function approval_gm($id_transaksi_pengadaan)
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'APROVAL GM');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['approval_gm'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi($id_transaksi_pengadaan);
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
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'APROVAL HEAD');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['approval_head'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi($id_transaksi_pengadaan);
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


    // PROSES PENGADAAN
    public function proses_pengadaan($id_transaksi_pengadaan)
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGADAAN', 'PROSES PENGADAAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['proses_pengadaan'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi($id_transaksi_pengadaan);
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
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['m_kiriman_barang'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi($id_transaksi_pengadaan);
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
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['penyerahan_barang'] = $this->M_TRANSAKSI_PENGADAAN->get_data_transaksi($id_transaksi_pengadaan);
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
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['get_jabatan'] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_tambah', $data);
    }

    public function detail($KODE, $page = 'transaksi_pengadaan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PENGADAAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['get_jabatan'] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_detail', $data);
    }

    public function insert()
    {
        $items = $this->input->post('items');
        $formData = $this->input->post('form');
        $uuid_transaksi = $this->uuid->v4();

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

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function update()
    {
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

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function disapprove_gm()
    {
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

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function disapprove_head()
    {
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

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function update_proses_pengadaan()
    {
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
        }

        echo json_encode(['success' => true]);
    }

    public function update_penyerahan_barang()
    {
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
        }

        echo json_encode(['success' => true]);
    }

    public function update_penyerahan_barang_user()
    {
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
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PENGADAAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}
