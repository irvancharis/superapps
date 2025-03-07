<?php

class Transaksi_penghapusan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('role/M_ROLE');
        $this->load->model('M_TRANSAKSI_PENGHAPUSAN');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->model('produk_stok/M_PRODUK_STOK');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');

        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function index($page = 'transaksi')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'LIST PENGHAPUSAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        //echo $this->uuid->v4();

        $data['M_TRANSAKSI_PENGHAPUSAN'] = $this->M_TRANSAKSI_PENGHAPUSAN->get_data();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan', $data);
    }

    public function get_single($KODE)
    {
        $result = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        echo json_encode($result);
    }

    public function get_kategori_produk()
    {
        $result = $this->M_TRANSAKSI_PENGHAPUSAN->get_kategori_produk();
        echo json_encode($result);
    }

    public function get_produk_maping()
    {
        $this->load->library('session');

        $area = $this->uri->segment(3);
        $ruangan = $this->uri->segment(4);
        $lokasi = $this->uri->segment(5);
        $departemen = $this->uri->segment(6);
        $data['produk'] = $this->M_TRANSAKSI_PENGHAPUSAN->list_produk_maping($area, $ruangan, $lokasi, $departemen);
        $this->load->view('list_produk', $data);

    }

    public function get_produk()
    {
        $search = strtoupper($this->input->post('search')['value']);
        $area = $this->input->post('area');
        $departemen = $this->input->post('departemen');
        $ruangan = $this->input->post('ruangan');
        $lokasi = $this->input->post('lokasi');

        log_message('error', 'Search query: ' . $search);
        log_message('error', 'Filter area: ' . $area . ', departemen: ' . $departemen . ', ruangan: ' . $ruangan . ', lokasi: ' . $lokasi);

        // Cek jika filter tersedia meski tanpa pencarian
        if (empty($search) && (!$area || !$departemen || !$ruangan || !$lokasi)) {
            echo json_encode([
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ]);
            return;
        }

        // Mengambil data produk dengan filter pencarian dan filter tambahan
        $data = $this->M_PRODUK_STOK->getFilteredProdukStok($search, $area, $departemen, $ruangan, $lokasi);

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }

    public function get_produk_input_penghapusan()
    {
        $KODE_AREA = $this->input->get('KODE_AREA');
        $KODE_RUANGAN = $this->input->get('KODE_RUANGAN');
        $KODE_LOKASI = $this->input->get('KODE_LOKASI');
        $KODE_DEPARTEMEN = $this->input->get('KODE_DEPARTEMEN');
        $result = $this->M_TRANSAKSI_PENGHAPUSAN->get_produk_input_penghapusan($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function transaksi_penghapusan_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_penghapusan');
        $data['page'] = $this->session->userdata('page');

        $this->load->view('transaksi_penghapusan_produk', $data);
    }

    public function transaksi_penghapusan_tambah_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_penghapusan');
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();

        $this->load->view('transaksi_penghapusan_tambah_produk', $data);
    }

    public function tambah($page = 'transaksi_penghapusan')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'PENGAJUAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_tambah', $data);
    }

    public function aproval_kabag($KODE, $page = 'transaksi_penghapusan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_aproval_kabag', $data);
    }

    public function aproval_gm($KODE, $page = 'transaksi_penghapusan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_aproval_gm', $data);
    }

    public function aproval_head($KODE, $page = 'transaksi_penghapusan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_aproval_head', $data);
    }

    public function jadwal_penghapusan($KODE, $page = 'transaksi_penghapusan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $data['metode_penghapusan'] = $this->M_TRANSAKSI_PENGHAPUSAN->get_metode();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_jadwal', $data);
    }

    public function proses_penghapusan($KODE, $page = 'transaksi_penghapusan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $data['metode_penghapusan'] = $this->M_TRANSAKSI_PENGHAPUSAN->get_metode();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_proses', $data);
    }

    public function update_jadwal_pengahapusan()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'STATUS_PENGHAPUSAN' => 'PROSES PENGHAPUSAN',
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail

        foreach ($items as $item) {
            $UUID_TRANSAKSI = $item['UUID_TRANSAKSI_PENGHAPUSAN'];
            $UUID_STOK = $item['UUID_STOK'];
            $data['KODE_METODE_PENGHAPUSAN'] = $item['KODE_METODE_PENGHAPUSAN'];
            $this->M_TRANSAKSI_PENGHAPUSAN->update_detail_transaksi($UUID_TRANSAKSI, $UUID_STOK, $data);
        }

        echo json_encode(['success' => true]);
    }

    public function update_proses_pengahapusan()
    {

        $inputan = $this->input->post(null, TRUE);
        $uuid = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN');

        // Ambil data items dan ubah dari JSON string ke array PHP
        $items_json = $this->input->post('items');
        $items = json_decode($items_json, true); // Decode JSON ke array

        // Update tabel transaksi_pengadaan
        $data_update = [
            'TANGGAL_REALISASI' => date('Y-m-d'),
            'USER_PELAKSANA' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PENGHAPUSAN' => 'SELESAI',
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($uuid, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Cek apakah ada file yang diunggah
        if (!empty($_FILES['FOTO_KONDISI_AKHIR']['name'][0])) {
            $files = $_FILES;

            foreach ($items as $i => $item) {
                $FOTO_NAME = $this->uuid->v4();

                $_FILES['file']['name'] = $files['FOTO_KONDISI_AKHIR']['name'][$i];
                $_FILES['file']['type'] = $files['FOTO_KONDISI_AKHIR']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['FOTO_KONDISI_AKHIR']['tmp_name'][$i];
                $_FILES['file']['error'] = $files['FOTO_KONDISI_AKHIR']['error'][$i];
                $_FILES['file']['size'] = $files['FOTO_KONDISI_AKHIR']['size'][$i];

                $config['upload_path'] = FCPATH . 'assets/uploads/transaksi_penghapusan/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = $FOTO_NAME;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
                    exit;
                } else {
                    $data = $this->upload->data();

                    $UUID_STOK = $item['UUID_STOK'];
                    $data_produk = $item['JUMLAH_PENGHAPUSAN'];
                    $this->M_TRANSAKSI_PENGHAPUSAN->update_real_stok($UUID_STOK, $data_produk);
                }
            }
            echo json_encode(['success' => true]);
        }
    }


    public function list_produk($KODE)
    {
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_detail_single($KODE);
        echo json_encode($query);
    }

    public function detail($KODE, $page = 'transaksi_penghapusan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PENGHAPUSAN', 'DETAIL PENGHAPUSAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query_transaksi = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        $query_detail_transaksi = $this->M_TRANSAKSI_PENGHAPUSAN->get_detail_single($KODE);
        $data['transaksi'] = $query_transaksi->row();
        $data['detail_transaksi'] = $query_detail_transaksi;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_detail', $data);
    }

    public function insert()
    {
        $inputan = $this->input->post(null, TRUE);
        $KODE_ITEM = $this->input->post('KODE_ITEM');

        $uuid_transaksi = $this->uuid->v4();

        $data_transaksi = [
            'USER_PENGAJUAN' => $this->session->userdata('ID_KARYAWAN'),
            'UUID_TRANSAKSI_PENGHAPUSAN' => $uuid_transaksi,
            'KODE_DEPARTEMEN' => $this->session->userdata('ID_DEPARTEMEN'),
            'TANGGAL_PENGAJUAN' => date('Y-m-d'),
            'KETERANGAN_PENGHAPUSAN' => $inputan['KETERANGAN'],
            'AREA_PENGHAPUSAN' => $inputan['AREA'],
            'STATUS_PENGHAPUSAN' => 'MENUNGGU APROVAL KABAG',
            'RUANGAN_PENGHAPUSAN' => $inputan['RUANGAN'],
            'LOKASI_PENGHAPUSAN' => $inputan['LOKASI'],
        ];

        $this->db->insert('TRANSAKSI_PENGHAPUSAN', $data_transaksi);

        // Cek apakah ada file yang diunggah
        if (!empty($_FILES['FOTO_KONDISI_AWAL']['name'][0])) {
            $files = $_FILES;
            $count = count($_FILES['FOTO_KONDISI_AWAL']['name']);

            for ($i = 0; $i < $count; $i++) {
                $FOTO_NAME = $this->uuid->v4();

                $_FILES['file']['name'] = $files['FOTO_KONDISI_AWAL']['name'][$i];
                $_FILES['file']['type'] = $files['FOTO_KONDISI_AWAL']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['FOTO_KONDISI_AWAL']['tmp_name'][$i];
                $_FILES['file']['error'] = $files['FOTO_KONDISI_AWAL']['error'][$i];
                $_FILES['file']['size'] = $files['FOTO_KONDISI_AWAL']['size'][$i];

                $config['upload_path'] = FCPATH . 'assets/uploads/transaksi_penghapusan/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = $FOTO_NAME;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
                    exit;
                } else {
                    $data = $this->upload->data();
                    $data_produk = [
                        'UUID_TRANSAKSI_PENGHAPUSAN' => $uuid_transaksi,
                        'UUID_PRODUK_STOK' => $inputan['UUID_STOK'][$i],
                        'JUMLAH_PENGHAPUSAN' => $inputan['JUMLAH_PENGHAPUSAN'][$i],
                        'FOTO_KONDISI_AWAL' => $data['file_name'],
                        'KETERANGAN_ITEM' => $inputan['KETERANGAN_ITEM'][$i],
                    ];
                    $this->db->insert('TRANSAKSI_PENGHAPUSAN_DETAIL', $data_produk);
                }
            }
        }

        echo json_encode(['success' => true]);
    }




    public function disapprove_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_penghapusan
        $data_update = [
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PENGHAPUSAN' => 'DITOLAK KABAG',
            'KETERANGAN_CANCEL_KABAG' => $form,
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'KETERANGAN_PENGHAPUSAN' => $form['KETERANGAN_PENGHAPUSAN'],
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'STATUS_PENGHAPUSAN' => 'MENUNGGU APROVAL GM',
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        echo json_encode(['success' => true]);
    }

    public function disapprove_gm()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_penghapusan
        $data_update = [
            'TANGGAL_APROVAL_GM' => date('Y-m-d'),
            'KODE_APROVAL_GM' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PENGHAPUSAN' => 'DITOLAK GM',
            'KETERANGAN_CANCEL_GM' => $form,
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_gm()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_GM' => $this->session->userdata('ID_KARYAWAN'),
            'TANGGAL_APROVAL_GM' => date('Y-m-d'),
            'STATUS_PENGHAPUSAN' => 'MENUNGGU APROVAL HEAD',
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }


        echo json_encode(['success' => true]);
    }

    public function disapprove_head()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_penghapusan
        $data_update = [
            'TANGGAL_APROVAL_HEAD' => date('Y-m-d'),
            'KODE_APROVAL_HEAD' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PENGHAPUSAN' => 'DITOLAK HEAD',
            'KETERANGAN_CANCEL_HEAD' => $form,
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_head()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_HEAD' => $this->session->userdata('ID_KARYAWAN'),
            'TANGGAL_APROVAL_HEAD' => date('Y-m-d'),
            'STATUS_PENGHAPUSAN' => 'MENUNGGU JADWAL PENGHAPUSAN',
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }



        echo json_encode(['success' => true]);
    }


    public function update()
    {
        $KODE_ITEM = $this->input->post('NIK');

        // Validasi
        if (empty($KODE_ITEM)) {
            $errors[] = 'NIK tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
        $result = $this->M_TRANSAKSI_PENGHAPUSAN->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PENGHAPUSAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}
