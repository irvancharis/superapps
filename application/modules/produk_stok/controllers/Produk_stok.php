<?php
class Produk_stok extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_PRODUK_STOK');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->helper('url_helper');
        $this->load->library('TanggalIndo');
        $this->load->library('ciqrcode');
        $this->load->library('Uuid');
    }

    public function index($page = 'produk_stok')
    {
        $this->load->library('session');

        $data['M_PRODUK_STOK'] = $this->M_PRODUK_STOK->get_produk_stok();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();        
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_PRODUK_STOK->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_stok', $data);
    }

    public function scan()
    {
        $this->load->view('scan');
    }

    public function produk_aset_histori($kode_stok,$kode_aset,$page = 'produk_stok')
    {
        $this->load->library('session');

        $data['aset'] = $this->M_PRODUK_STOK->cek_detail_produk($kode_stok);
        $data['histori_aset'] = $this->M_PRODUK_STOK->cek_histori_aset($kode_aset);
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

            $this->load->view('produk_aset_histori', $data);
    }


    public function detail_stok($kode,$page = 'produk_stok')
    {
        $this->load->library('session');

        $data['detail_aset'] = $this->M_PRODUK_STOK->cek_detail_produk($kode);
        $data['aset'] = $this->M_PRODUK_STOK->cek_aset($kode);
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_stok_detail', $data);
    }

    public function get_single($KODE_ITEM)
    {
        $result = $this->M_PRODUK_STOK->get_produk_stok_single($KODE_ITEM);
        echo json_encode($result);
    }


    public function cek_aset($KODE)
    {
        $result = $this->M_PRODUK_STOK->cek_aset($KODE);
        echo json_encode($result);
    }


    public function get_produk_stok()
    {
    $area = $this->input->post('KODE_AREA');
    $ruangan = $this->input->post('KODE_RUANGAN');
    $lokasi = $this->input->post('KODE_LOKASI');
    $departemen = $this->input->post('KODE_DEPARTEMEN');

    $result = $this->M_PRODUK_STOK->getProdukMaping($area, $ruangan, $lokasi, $departemen);

    // Konversi semua hasil menjadi array
    $result = json_decode(json_encode($result), true);

    foreach ($result as &$row) {
        $row['cek_aset'] = $this->M_PRODUK_STOK->cek_aset($row['UUID_STOK']);
        $row['jumlah_aset'] = count($row['cek_aset']);
        $row['jumlah_stok'] = $row['JUMLAH_STOK'];
    }
    echo json_encode($result);
    exit;

    }

    public function generate_aset($kode)
    {
        $stok = $this->M_PRODUK_STOK->get_jumlah_stok($kode);
        $jumlah_aset = $this->M_PRODUK_STOK->cek_aset($kode);
        $jumlah_aset = count($jumlah_aset);

        $jumlah_aset = $stok->JUMLAH_STOK - $jumlah_aset;

        for($i = 0; $i < $jumlah_aset; $i++) {
            $data['UUID_STOK'] = $stok->UUID_STOK;
            $data['UUID_ASET'] = $this->uuid->v4();
            $this->M_PRODUK_STOK->insert_aset($data);
        }

        echo json_encode(['success' => true]);
    }


    public function get_kategori_produk()
    {
        $result = $this->M_PRODUK_STOK->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'produk_stok')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_STOK->get_kategori_produk();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_stok_tambah', $data);
    }

    public function edit($KODE_ITEM, $page = 'produk_stok')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_STOK->get_produk_stok_single($KODE_ITEM);
        $data['get_kategori_produk'] = $this->M_PRODUK_STOK->get_kategori_produk();
        $data['get_produk_stok'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_stok_edit', $data);
    }

    public function detail($KODE_ITEM, $page = 'produk_stok')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_STOK->get_produk_stok_single($KODE_ITEM);
        $data['get_produk_stok'] = $query->row();        
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_stok_detail', $data);
        
    }

    public function qr($kode = null) {
        header("Content-Type: image/png");  // Set header agar output langsung sebagai gambar

        $config['cacheable']    = false;    // Tidak perlu cache
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = [0, 0, 0];    // Warna hitam untuk QR
        $config['white']        = [255, 255, 255]; // Warna putih untuk background
        $this->ciqrcode->initialize($config);

        $params['data'] = $kode ? $kode : 'DefaultCode';
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = null;  // Jangan simpan file, langsung output

        $this->ciqrcode->generate($params);  // QR Code akan langsung tampil di browser
    }

    public function print_qr_aset($kode) {
        $data['aset'] = $this->M_PRODUK_STOK->cek_aset($kode);
        $this->load->view('print_qr_aset', $data);

    }

    public function print_qr_single($kode) {
        $data['aset'] = $this->M_PRODUK_STOK->cek_aset_single($kode);
        $this->load->view('print_qr_single', $data);

    }



    public function qr_link() {
        header("Content-Type: image/png");  // Set header agar output langsung sebagai gambar

        $config['cacheable']    = false;    // Tidak perlu cache
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = [0, 0, 0];    // Warna hitam untuk QR
        $config['white']        = [255, 255, 255]; // Warna putih untuk background
        $this->ciqrcode->initialize($config);

        // URL yang ingin disimpan dalam QR Code
        $stok = $this->uri->segment(3);
        $aset = $this->uri->segment(4);
        

        $link_url = 'http://192.168.3.108/superapps/produk_stok/produk_aset_histori/'.$stok.'/'.$aset;

        $params['data'] = $link_url;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = null;  // Jangan simpan file, langsung output

        $this->ciqrcode->generate($params);  // QR Code akan langsung tampil di browser
    }


    public function insert()
    {
        // Ambil data dari POST
        $get_last_produk = $this->M_PRODUK_STOK->get_latest_data();
        $KODE_ITEM = isset($get_last_produk[0]->KODE_ITEM) ? $get_last_produk[0]->KODE_ITEM + 1 : 1;
        $NAMA_ITEM = $this->input->post('NAMA_ITEM');
        $KODE_KATEGORI = $this->input->post('KODE_KATEGORI');
        $KETERANGAN_ITEM = $this->input->post('KETERANGAN_ITEM');


        // Proses simpan data
        $data = [
            'KODE_ITEM' => $KODE_ITEM,
            'NAMA_ITEM' => $NAMA_ITEM,
            'KODE_KATEGORI' => $KODE_KATEGORI,
            'KETERANGAN_ITEM' => $KETERANGAN_ITEM,
            'FOTO_ITEM' => null
        ];

        $result = $this->M_PRODUK_STOK->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        $KODE_ITEM = $this->input->post('KODE_ITEM');
        $NAMA_ITEM = $this->input->post('NAMA_ITEM');
        $KODE_KATEGORI = $this->input->post('KODE_KATEGORI');
        $KETERANGAN_ITEM = $this->input->post('KETERANGAN_ITEM');

        // Validasi 
        if (empty($KODE_ITEM)) {
            $errors[] = 'KODE ITEM tidak boleh kosong.';
        }
        if (empty($NAMA_ITEM)) {
            $errors[] = 'NAMA ITEM tidak boleh kosong.';
        }
        if (empty($KODE_KATEGORI)) {
            $errors[] = 'KODE KATEGORI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_ITEM)) {
            $errors[] = 'KETERANGAN ITEM tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
        $result = $this->M_PRODUK_STOK->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_PRODUK_STOK->hapus($KODE_ITEM);
        redirect('produk_stok');
    }
}