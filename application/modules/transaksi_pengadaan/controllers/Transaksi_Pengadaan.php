<?php

class Transaksi_pengadaan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TRANSAKSI_PENGADAAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
    }

    public function index($page = 'transaksi_pengadaan')
    {
        $this->load->library('session');
        // echo $this->uuid->v4();

        $data['M_TRANSAKSI_PENGADAAN'] = $this->M_TRANSAKSI_PENGADAAN->get_data();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data[ 'get_kategori' ] = $this->M_TRANSAKSI_PENGADAAN->get_kategori();

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

    public function approval_kabag($id_transaksi_pengadaan)
    {
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

    public function edit($KODE, $page = 'transaksi_pengadaan')
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
            $this->load->view('karyawan_edit', $data);
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
                'NO_REGISTER' => $formData['NO_REGISTER'],
                'KODE_USER_PENGAJUAN' => 1,
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
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
            return;
        }

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_KABAG' => 1,
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
            'KODE_APROVAL_GM' => 1,
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

    public function disapprove_kabag()
    {
        $id_transaksi = $this->input->post('id_transaksi'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL_KABAG');
        $items = $this->input->post('items');

        if (!$id_transaksi || empty($form) || empty($items)) {
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
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
            echo json_encode(['success' => false, 'error' => 'Data tidak lengkap!']);
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

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PENGADAAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}
