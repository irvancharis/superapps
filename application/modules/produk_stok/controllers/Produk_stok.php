<?php
class Produk_stok extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_PRODUK_STOK');
        $this->load->helper('url_helper');
    }

    public function index($page = 'produk_stok')
    {
        $this->load->library('session');

        $data['M_PRODUK_STOK'] = $this->M_PRODUK_STOK->get_produk_stok();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_PRODUK_STOK->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_stok', $data);
    }

    public function get_single($KODE_ITEM)
    {
        $result = $this->M_PRODUK_STOK->get_produk_stok_single($KODE_ITEM);
        echo json_encode($result);
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
