<?php
class Produk_item extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_PRODUK_ITEM');
        $this->load->helper('url_helper');
    }

    public function index($page = 'produk_item')
    {
        $this->load->library('session');

        $data['M_PRODUK_ITEM'] = $this->M_PRODUK_ITEM->get_produk_item();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_PRODUK_ITEM->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item', $data);
    }

    public function get_single($KODE_ITEM)
    {
        $result = $this->M_PRODUK_ITEM->get_produk_item_single($KODE_ITEM);
        echo json_encode($result);
    }


    public function get_kategori_produk()
    {
        $result = $this->M_PRODUK_ITEM->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'produk_item')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item_tambah', $data);
    }

    public function edit($KODE_ITEM, $page = 'produk_item')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_ITEM->get_produk_item_single($KODE_ITEM);
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();
        $data['get_produk_item'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item_edit', $data);
    }

    public function detail($KODE_ITEM, $page = 'produk_item')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_ITEM->get_produk_item_single($KODE_ITEM);
        $data['get_produk_item'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item_detail', $data);
    }


    public function insert()
    {
        // Ambil data dari POST
        $inputan = $this->input->post(null, TRUE);
        $KODE_ITEM = $this->input->post('KODE_ITEM');

        $config['upload_path'] = APPPATH . '../assets/uploads/item/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $KODE_ITEM;

        $this->load->library('upload', $config);
        $result = '';

        if (!$this->upload->do_upload('FOTO_ITEM')) {
            echo json_encode(['success' => false, 'error' => 'Gagal upload foto.']);
        } else {
            // Ambil data file yang diupload
            $data = $this->upload->data();
            $extension = $data['file_ext'];
            $inputan['FOTO_ITEM'] = $KODE_ITEM . $extension;

            $result = $this->M_PRODUK_ITEM->insert($inputan);
        }

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update($KODE)
    {
        $KODE_ITEM = $KODE;
        $NAMA_ITEM = $this->input->post('NAMA_ITEM');
        $KODE_KATEGORI = $this->input->post('KODE_KATEGORI');
        $KETERANGAN_ITEM = $this->input->post('KETERANGAN_ITEM');

        // Validasi 
        $errors = [];
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

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'error' => implode(', ', $errors)]);
            return;
        }

        // Ambil data produk item lama
        $produk_item = $this->M_PRODUK_ITEM->get_produk_item_single($KODE_ITEM);
        $foto_lama = $produk_item->FOTO_ITEM;

        // Konfigurasi Upload
        $config['upload_path'] = APPPATH . '../assets/uploads/item/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $KODE_ITEM;

        $inputan = $this->input->post(null, TRUE);

        if (!empty($_FILES['FOTO_ITEM']['name'])) { // Jika ada file yang diupload
            // Hapus foto lama jika ada
            if (!empty($foto_lama) && file_exists(APPPATH . '../assets/uploads/item/' . $foto_lama)) {
                unlink(APPPATH . '../assets/uploads/item/' . $foto_lama);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('FOTO_ITEM')) {
                // Ambil data file baru
                $data = $this->upload->data();
                $extension = $data['file_ext'];
                $inputan['FOTO_ITEM'] = $KODE_ITEM . $extension;
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal upload foto.']);
                return;
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal upload foto.']);
            return;
        }

        // Update data di database
        $result = $this->M_PRODUK_ITEM->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_PRODUK_ITEM->hapus($KODE_ITEM);
        redirect('produk_item');
    }

    // public function coba($KODE)
    // {
    //     $produk_item = $this->M_PRODUK_ITEM->get_produk_item_single($KODE);
    //     echo json_encode($produk_item);
    // }
}
