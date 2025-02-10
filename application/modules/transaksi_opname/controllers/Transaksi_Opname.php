<?php

class Transaksi_opname extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TRANSAKSI_OPNAME');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');
    }

    public function index($page = 'transaksi_opname')
    {
        $this->load->library('session');
        //echo $this->uuid->v4();

        $data['M_TRANSAKSI_OPNAME'] = $this->M_TRANSAKSI_OPNAME->get_data();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data[ 'get_kategori' ] = $this->M_TRANSAKSI_OPNAME->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_opname', $data);
    }

    public function get_single($KODE)
    {
        $result = $this->M_TRANSAKSI_OPNAME->get_single($KODE);
        echo json_encode($result);
    }

    public function get_kategori_produk()
    {
        $result = $this->M_TRANSAKSI_OPNAME->get_kategori_produk();
        echo json_encode($result);
    }

    public function get_produk_input_opname()
    {
        $KODE_AREA = $this->input->get('KODE_AREA');
        $KODE_RUANGAN = $this->input->get('KODE_RUANGAN');
        $KODE_LOKASI = $this->input->get('KODE_LOKASI');
        $KODE_DEPARTEMEN = $this->input->get('KODE_DEPARTEMEN');
        $result = $this->M_TRANSAKSI_OPNAME->get_produk_input_opname($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function tambah($page = 'transaksi_opname')
    {
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
            $this->load->view('transaksi_opname_tambah', $data);
    }

    public function aproval_kabag($KODE, $page = 'transaksi_opname')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_OPNAME->get_single($KODE);
        $data['get_single'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_opname_aproval_kabag', $data);
    }


    public function list_produk($KODE)
    {
        $query = $this->M_TRANSAKSI_OPNAME->get_detail_single($KODE);
        echo json_encode($query);
    }

    public function detail($KODE, $page = 'transaksi_opname')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query_transaksi = $this->M_TRANSAKSI_OPNAME->get_single($KODE);
        $query_detail_transaksi = $this->M_TRANSAKSI_OPNAME->get_detail_single($KODE);
        $data['transaksi'] = $query_transaksi->row();
        $data['detail_transaksi'] = $query_detail_transaksi;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_opname_detail', $data);
    }

    public function insert()
    {
        $items = $this->input->post('items');
        $formData = $this->input->post('form');
        $uuid_transaksi = $this->uuid->v4();

        if (!empty($formData) && !empty($items)) {
            // Simpan data transaksi utama
            $data_transaksi = [
                'UUID_TRANSAKSI_OPNAME' => $uuid_transaksi,
                'KODE_DEPARTEMEN' => $formData['KODE_DEPARTEMEN'],
                'TANGGAL_OPNAME' => date('Y-m-d'),
                'CATATAN_OPNAME' => $formData['CATATAN_OPNAME'],
                'AREA_OPNAME' => $formData['AREA_OPNAME'],
                'STATUS_OPNAME' => 'MENUNGGU APROVAL KABAG',
                'RUANGAN_OPNAME' => $formData['RUANGAN_OPNAME'],
                'LOKASI_OPNAME' => $formData['LOKASI_OPNAME'],
            ];
            $this->db->insert('TRANSAKSI_OPNAME', $data_transaksi);

            // Simpan detail produk
            foreach ($items as $item) {
                $data_produk = [
                    'UUID_TRANSAKSI_OPNAME' => $uuid_transaksi,
                    'UUID_PRODUK_STOK' => $item['UUID_STOK'],
                    'STOK_SYSTEM' => $item['JUMLAH_STOK'],
                    'STOK_AKTUAL' => $item['STOK_AKTUAL'],
                ];
                $this->db->insert('TRANSAKSI_OPNAME_DETAIL', $data_produk);
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
        $result = $this->M_TRANSAKSI_OPNAME->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_TRANSAKSI_OPNAME->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}
