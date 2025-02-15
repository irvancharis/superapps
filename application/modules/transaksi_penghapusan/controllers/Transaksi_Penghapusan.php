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
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');

        if ( !$this->session->userdata( 'isLoggedIn' ) ) {
            redirect('login');
        }
    }

    public function index($page = 'transaksi_penghapusan')
    {

        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'TRANSAKSI PENGHAPUSAN','LIST PENGHAPUSAN');
        if (!$CEK_ROLE) { redirect('non_akses'); }

        
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

    public function tambah($page = 'transaksi_penghapusan')
    {
        
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'TRANSAKSI PENGHAPUSAN','PENGAJUAN');
        if (!$CEK_ROLE) { redirect('non_akses'); }

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
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'TRANSAKSI PENGHAPUSAN','APROVAL KABAG');
        if (!$CEK_ROLE) { redirect('non_akses'); }


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
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'TRANSAKSI PENGHAPUSAN','APROVAL KABAG');
        if (!$CEK_ROLE) { redirect('non_akses'); }


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
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'TRANSAKSI PENGHAPUSAN','APROVAL KABAG');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_penghapusan_aproval_head', $data);
    }


    public function list_produk($KODE)
    {
        $query = $this->M_TRANSAKSI_PENGHAPUSAN->get_detail_single($KODE);
        echo json_encode($query);
    }

    public function detail($KODE, $page = 'transaksi_penghapusan')
    {
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'TRANSAKSI PENGHAPUSAN','DETAIL PENGHAPUSAN');
        if (!$CEK_ROLE) { redirect('non_akses'); }

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

        $items = $this->input->post('items');
        $formData = $this->input->post('form');
        $uuid_transaksi = $this->uuid->v4();

        if (!empty($formData) && !empty($items)) {
            // Simpan data transaksi utama
            $data_transaksi = [
                'USER_PELAKSANA' => $this->session->userdata('ID_KARYAWAN'),
                'UUID_TRANSAKSI_PENGHAPUSAN' => $uuid_transaksi,
                'KODE_DEPARTEMEN' => $this->session->userdata('ID_DEPARTEMEN'),
                'TANGGAL_PENGHAPUSAN' => date('Y-m-d'),
                'CATATAN_PENGHAPUSAN' => $formData['CATATAN_PENGHAPUSAN'],
                'AREA_PENGHAPUSAN' => $formData['AREA_PENGHAPUSAN'],
                'STATUS_PENGHAPUSAN' => 'MENUNGGU APROVAL KABAG',
                'RUANGAN_PENGHAPUSAN' => $formData['RUANGAN_PENGHAPUSAN'],
                'LOKASI_PENGHAPUSAN' => $formData['LOKASI_PENGHAPUSAN'],
            ];
            $this->db->insert('TRANSAKSI_PENGHAPUSAN', $data_transaksi);

            // Simpan detail produk
            foreach ($items as $item) {
                $data_produk = [
                    'UUID_TRANSAKSI_PENGHAPUSAN' => $uuid_transaksi,
                    'UUID_PRODUK_STOK' => $item['UUID_STOK'],
                    'STOK_SYSTEM' => $item['JUMLAH_STOK'],
                    'STOK_AKTUAL' => $item['STOK_AKTUAL'],
                ];
                $this->db->insert('TRANSAKSI_PENGHAPUSAN_DETAIL', $data_produk);
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }


    public function disapprove_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PENGHAPUSAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');
        
        // Update tabel transaksi_penghapusan
        $data_update = [
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PENGHAPUSAN' => 'CANCEL',
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
            'CATATAN_PENGHAPUSAN' => $form['CATATAN_PENGHAPUSAN'],
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'STATUS_PENGHAPUSAN' => 'MENUNGGU APROVAL GM',
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        $this->M_TRANSAKSI_PENGHAPUSAN->delete_detail($id_transaksi); // Hapus data lama
        
        foreach ($items as $item) {
                $data_produk = [
                    'UUID_TRANSAKSI_PENGHAPUSAN' => $item['UUID_TRANSAKSI_PENGHAPUSAN'],
                    'UUID_PRODUK_STOK' => $item['UUID_STOK'],
                    'STOK_SYSTEM' => $item['JUMLAH_STOK'],
                    'STOK_AKTUAL' => $item['STOK_AKTUAL'],
                ];
                $this->db->insert('TRANSAKSI_PENGHAPUSAN_DETAIL', $data_produk);
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
            'STATUS_PENGHAPUSAN' => 'CANCEL',
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
            'STATUS_PENGHAPUSAN' => 'CANCEL',
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
            'STATUS_PENGHAPUSAN' => 'SELESAI',
        ];

        $update = $this->M_TRANSAKSI_PENGHAPUSAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        // Update transaksi_pengadaan_detail
        
        foreach ($items as $item) {
            $UUID_STOK = $item['UUID_STOK'];
            
                $data_produk = [
                    'JUMLAH_STOK' => $item['STOK_AKTUAL'],
                ];
                $this->M_TRANSAKSI_PENGHAPUSAN->update_real_stok($UUID_STOK, $data_produk);
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