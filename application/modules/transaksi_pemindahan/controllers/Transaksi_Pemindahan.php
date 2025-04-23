<?php

class Transaksi_pemindahan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('role/M_ROLE');
        $this->load->model('M_TRANSAKSI_PEMINDAHAN');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
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
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'LIST PEMINDAHAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        //echo $this->uuid->v4();

        $data['M_TRANSAKSI_PEMINDAHAN'] = $this->M_TRANSAKSI_PEMINDAHAN->get_data();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pemindahan', $data);
    }

    public function get_single($KODE)
    {
        $result = $this->M_TRANSAKSI_PEMINDAHAN->get_single($KODE);
        echo json_encode($result);
    }

    public function get_kategori_produk()
    {
        $result = $this->M_TRANSAKSI_PEMINDAHAN->get_kategori_produk();
        echo json_encode($result);
    }

    public function get_produk_by_aset()
    {
        $kode = $this->input->post('kode_aset');
        $result = $this->M_TRANSAKSI_PEMINDAHAN->get_produk_by_aset($kode);
        echo json_encode($result);
    }

    public function get_produk_maping()
    {
        $this->load->library('session');

        $area = $this->uri->segment(3);
        $ruangan = $this->uri->segment(4);
        $lokasi = $this->uri->segment(5);
        $departemen = $this->uri->segment(6);
        $data['produk'] = $this->M_TRANSAKSI_PEMINDAHAN->list_produk_maping($area, $ruangan, $lokasi, $departemen);
        $this->load->view('list_produk', $data);
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

        $data = $this->M_PRODUK_ITEM->getFilteredProdukStok($search);

        log_message('error', 'Data returned: ' . json_encode($data)); // Tambahkan log ini

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }

    public function get_produk_input_pemindahan()
    {
        $KODE_AREA = $this->input->get('KODE_AREA');
        $KODE_RUANGAN = $this->input->get('KODE_RUANGAN');
        $KODE_LOKASI = $this->input->get('KODE_LOKASI');
        $KODE_DEPARTEMEN = $this->input->get('KODE_DEPARTEMEN');
        $result = $this->M_TRANSAKSI_PEMINDAHAN->get_produk_input_pemindahan($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function transaksi_pemindahan_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pemindahan');
        $data['page'] = $this->session->userdata('page');

        $this->load->view('transaksi_pemindahan_produk', $data);
    }

    public function transaksi_pemindahan_tambah_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pemindahan');
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();

        $this->load->view('transaksi_pemindahan_tambah_produk', $data);
    }

    public function tambah($page = 'transaksi_pemindahan')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'PENGAJUAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();
        $kode_area = $this->session->userdata('ID_AREA');
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan_by_area($kode_area);
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pemindahan_tambah', $data);
    }

    public function tambah_by_aset($page = 'transaksi_pemindahan')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'PENGAJUAN');
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
            $this->load->view('transaksi_pemindahan_by_aset', $data);
    }

    public function aproval_kabag($KODE, $page = 'transaksi_pemindahan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PEMINDAHAN->get_single($KODE);
        $data['get_single'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pemindahan_aproval_kabag', $data);
    }

    public function aproval_gm($KODE, $page = 'transaksi_pemindahan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PEMINDAHAN->get_single($KODE);
        $data['get_single'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pemindahan_aproval_gm', $data);
    }

    public function aproval_head($KODE, $page = 'transaksi_pemindahan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PEMINDAHAN->get_single($KODE);
        $data['get_single'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pemindahan_aproval_head', $data);
    }

    public function proses_pemindahan($KODE, $page = 'transaksi_pemindahan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PEMINDAHAN->get_single($KODE);
        $data['get_single'] = $query;

        $KODE_DEPARTEMEN = $query->DEPARTEMEN_AKHIR;
        $karyawan = $this->M_KARYAWAN->get_karyawan_by_departemen($KODE_DEPARTEMEN);
        $data['karyawan'] = $karyawan;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pemindahan_proses', $data);
    }


    public function list_produk($KODE)
    {
        $query = $this->M_TRANSAKSI_PEMINDAHAN->get_detail_single($KODE);
        echo json_encode($query);
    }

    public function list_maping($KODE)
    {
        $query = $this->M_TRANSAKSI_PEMINDAHAN->get_single($KODE);
        echo json_encode($query);
    }

    public function detail($KODE, $page = 'transaksi_pemindahan')
    {
        // $SESSION_ROLE = $this->session->userdata('ROLE');
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PEMINDAHAN', 'DETAIL PEMINDAHAN');
        // if (!$CEK_ROLE) {
        //     redirect('non_akses');
        // }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query_transaksi = $this->M_TRANSAKSI_PEMINDAHAN->get_single($KODE);
        $query_detail_transaksi = $this->M_TRANSAKSI_PEMINDAHAN->get_detail_single($KODE);
        $data['transaksi'] = $query_transaksi;
        $data['detail_transaksi'] = $query_detail_transaksi;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('detail', $data);
    }

    public function insert()
    {
        $inputan = $this->input->post(null, TRUE);
        $KODE_ITEM = $this->input->post('KODE_ITEM');
        $uuid_transaksi = $this->uuid->v4();

        $data_transaksi = [
            'USER_PENGAJUAN' => $this->session->userdata('ID_KARYAWAN'),
            'UUID_TRANSAKSI_PEMINDAHAN' => $uuid_transaksi,
            'DEPARTEMEN_AWAL' => $this->session->userdata('ID_DEPARTEMEN'),
            'TANGGAL_PENGAJUAN' => date('Y-m-d'),
            'KETERANGAN_PEMINDAHAN' => $inputan['KETERANGAN_PEMINDAHAN'],
            'AREA_AWAL' => $this->session->userdata('ID_AREA'),
            'RUANGAN_AWAL' => $inputan['RUANGAN_AWAL'],
            'LOKASI_AWAL' => $inputan['LOKASI_AWAL'],
            'AREA_AKHIR' => $inputan['AREA_AKHIR'],
            'RUANGAN_AKHIR' => $inputan['RUANGAN_AKHIR'],
            'LOKASI_AKHIR' => $inputan['LOKASI_AKHIR'],
            'DEPARTEMEN_AKHIR' => $inputan['DEPARTEMEN_AKHIR'],
            'STATUS_PEMINDAHAN' => 'MENUNGGU APROVAL KABAG',
        ];

        $this->db->insert('TRANSAKSI_PEMINDAHAN', $data_transaksi);

        // Cek apakah ada file yang diunggah
        if (!empty($_FILES['FOTO_AWAL']['name'][0])) {
            $files = $_FILES;
            $count = count($_FILES['FOTO_AWAL']['name']);
            for ($i = 0; $i < $count; $i++) {
                $FOTO_NAME = $this->uuid->v4();

                $_FILES['file']['name'] = $files['FOTO_AWAL']['name'][$i];
                $_FILES['file']['type'] = $files['FOTO_AWAL']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['FOTO_AWAL']['tmp_name'][$i];
                $_FILES['file']['error'] = $files['FOTO_AWAL']['error'][$i];
                $_FILES['file']['size'] = $files['FOTO_AWAL']['size'][$i];

                $config['upload_path'] = FCPATH . 'assets/uploads/transaksi_pemindahan/';
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
                        'UUID_TRANSAKSI_PEMINDAHAN' => $uuid_transaksi,
                        'UUID_PRODUK_STOK' => $inputan['UUID_STOK'][$i],
                        'UUID_ASET' => isset($inputan['UUID_ASET'][$i]) ? $inputan['UUID_ASET'][$i] : null,
                        'JUMLAH_PEMINDAHAN' => $inputan['JUMLAH_PEMINDAHAN'][$i],
                        'FOTO_AWAL' => $data['file_name'],
                        'KEPERLUAN' => $inputan['KETERANGAN_ITEM'][$i],
                    ];
                    $this->db->insert('TRANSAKSI_PEMINDAHAN_DETAIL', $data_produk);
                }
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }




    public function disapprove_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PEMINDAHAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_pemindahan
        $data_update = [
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PEMINDAHAN' => 'DITOLAK KABAG',
            'KETERANGAN_CANCEL_KABAG' => $form,
        ];

        $update = $this->M_TRANSAKSI_PEMINDAHAN->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PEMINDAHAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'KETERANGAN_PEMINDAHAN' => $form['KETERANGAN_PEMINDAHAN'],
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'STATUS_PEMINDAHAN' => 'MENUNGGU APROVAL GM',
        ];

        $update = $this->M_TRANSAKSI_PEMINDAHAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        echo json_encode(['success' => true]);
    }

    public function disapprove_gm()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PEMINDAHAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_pemindahan
        $data_update = [
            'TANGGAL_APROVAL_GM' => date('Y-m-d'),
            'KODE_APROVAL_GM' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PEMINDAHAN' => 'DITOLAK GM',
            'KETERANGAN_CANCEL_GM' => $form,
        ];

        $update = $this->M_TRANSAKSI_PEMINDAHAN->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_gm()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PEMINDAHAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_GM' => $this->session->userdata('ID_KARYAWAN'),
            'TANGGAL_APROVAL_GM' => date('Y-m-d'),
            'STATUS_PEMINDAHAN' => 'MENUNGGU APROVAL HEAD',
        ];

        $update = $this->M_TRANSAKSI_PEMINDAHAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }


        echo json_encode(['success' => true]);
    }

    public function disapprove_head()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PEMINDAHAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_pemindahan
        $data_update = [
            'TANGGAL_APROVAL_HEAD' => date('Y-m-d'),
            'KODE_APROVAL_HEAD' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PEMINDAHAN' => 'DITOLAK HEAD',
            'KETERANGAN_CANCEL_HEAD' => $form,
        ];

        $update = $this->M_TRANSAKSI_PEMINDAHAN->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_head()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PEMINDAHAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_HEAD' => $this->session->userdata('ID_KARYAWAN'),
            'TANGGAL_APROVAL_HEAD' => date('Y-m-d'),
            'STATUS_PEMINDAHAN' => 'PROSES PEMINDAHAN',
        ];

        $update = $this->M_TRANSAKSI_PEMINDAHAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        echo json_encode(['success' => true]);
    }

    public function update_proses_pemindahan()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PEMINDAHAN'); // Ambil ID transaksi
        $USER_PENERIMA = $this->input->post('USER_PENERIMA');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'USER_PENYERAHAN' => $this->session->userdata('ID_KARYAWAN'),
            'USER_PENERIMA' => $USER_PENERIMA,
            'TANGGAL_REALISASI' => date('Y-m-d'),
            'STATUS_PEMINDAHAN' => 'SELESAI',
        ];

        $update = $this->M_TRANSAKSI_PEMINDAHAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        $items = $this->input->post('items');
        $list_maping = $this->input->post('form');

        foreach ($items as $item) {
            //pengurangan stok
            $UUID_STOK = $item['UUID_STOK'];
            $data_produk = $item['JUMLAH_PEMINDAHAN'];
            $this->M_TRANSAKSI_PEMINDAHAN->pengurangan_real_stok($UUID_STOK, $data_produk);

            //cek stok
            $KODE_ITEM = $item['KODE_ITEM'];
            $DEPARTEMEN = $list_maping['DEPARTEMEN_AKHIR'];
            $AREA = $list_maping['AREA_AKHIR'];
            $LOKASI = $list_maping['LOKASI_AKHIR'];
            $RUANGAN = $list_maping['RUANGAN_AKHIR'];
            $JUMLAH_PEMINDAHAN = $item['JUMLAH_PEMINDAHAN'];

            $UUID_ASET = $item['UUID_ASET'];



            $cek_stok = $this->M_TRANSAKSI_PEMINDAHAN->cek_stok($KODE_ITEM, $AREA, $RUANGAN, $LOKASI, $DEPARTEMEN);
            if ($cek_stok) {
                $this->M_TRANSAKSI_PEMINDAHAN->penambahan_real_stok($cek_stok->UUID_STOK, $JUMLAH_PEMINDAHAN);
                if ($UUID_ASET != null) {
                    $data = [
                        'UUID_STOK' => $cek_stok->UUID_STOK
                    ];
                    $this->M_TRANSAKSI_PEMINDAHAN->update_aset($UUID_ASET, $data);
                }
            } else {
                $uuid_stok_baru = $this->uuid->v4();
                $data = [
                    'UUID_STOK' => $uuid_stok_baru,
                    'KODE_ITEM' => $KODE_ITEM,
                    'KODE_DEPARTEMEN' => $DEPARTEMEN,
                    'KODE_AREA' => $AREA,
                    'KODE_LOKASI' => $LOKASI,
                    'KODE_RUANGAN' => $RUANGAN,
                    'JUMLAH_STOK' => $JUMLAH_PEMINDAHAN
                ];
                $this->M_TRANSAKSI_PEMINDAHAN->insert_stok($data);

                if ($UUID_ASET != null) {
                    $data = [
                        'UUID_STOK' => $uuid_stok_baru
                    ];
                    $this->M_TRANSAKSI_PEMINDAHAN->update_aset($UUID_ASET, $data);
                }
            }
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
        $result = $this->M_TRANSAKSI_PEMINDAHAN->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PEMINDAHAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}
