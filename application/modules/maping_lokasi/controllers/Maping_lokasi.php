<?php
class Maping_lokasi extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_MAPING_LOKASI');
        $this->load->helper('url_helper');
    }

    public function index($page = 'maping_lokasi')
    {
        $this->load->library('session');

        $data['M_MAPING_LOKASI'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_MAPING_LOKASI->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_lokasi', $data);
    }

    public function get_single($KODE_LOKASI)
    {
        $result = $this->M_MAPING_LOKASI->get_maping_lokasi_single($KODE_LOKASI);
        echo json_encode($result);
    }
    
    
    public function get_kategori_produk()
    {
        $result = $this->M_MAPING_LOKASI->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'maping_lokasi')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_MAPING_LOKASI->get_kategori_produk();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_lokasi_tambah', $data);
    }

    public function edit($KODE_LOKASI, $page = 'maping_lokasi')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_MAPING_LOKASI->get_maping_lokasi_single($KODE_LOKASI);
        $data['get_kategori_produk'] = $this->M_MAPING_LOKASI->get_kategori_produk();
        $data['get_maping_lokasi'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_lokasi_edit', $data);
    }

    public function detail($KODE_LOKASI, $page = 'maping_lokasi')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_MAPING_LOKASI->get_maping_lokasi_single($KODE_LOKASI);
        $data['get_maping_lokasi'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_lokasi_detail', $data);
    }


    public function insert()
    {
        $KODE_LOKASI = $this->input->post('KODE_LOKASI');
        $NAMA_LOKASI = $this->input->post('NAMA_LOKASI');
        $KODE_LOKASI = $this->input->post('KODE_LOKASI');
        $KETERANGAN_KATEGORI = $this->input->post('KETERANGAN_KATEGORI');

        // Validasi 
        if (empty($KODE_LOKASI)) {
            $errors[] = 'KODE LOKASI tidak boleh kosong.';
        }
        if (empty($NAMA_LOKASI)) {
            $errors[] = 'NAMA LOKASI tidak boleh kosong.';
        }
        if (empty($KODE_LOKASI)) {
            $errors[] = 'KODE LOKASI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_KATEGORI)) {
            $errors[] = 'KETERANGAN KATEGORI tidak boleh kosong.';
        }


        $inputan = $this->input->post(null, TRUE);
		$result = $this->M_MAPING_LOKASI->insert($inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        $KODE_LOKASI = $this->input->post('KODE_LOKASI');
        $NAMA_LOKASI = $this->input->post('NAMA_LOKASI');
        $KODE_LOKASI = $this->input->post('KODE_LOKASI');
        $KETERANGAN_KATEGORI = $this->input->post('KETERANGAN_KATEGORI');

        // Validasi 
        if (empty($KODE_LOKASI)) {
            $errors[] = 'KODE LOKASI tidak boleh kosong.';
        }
        if (empty($NAMA_LOKASI)) {
            $errors[] = 'NAMA LOKASI tidak boleh kosong.';
        }
        if (empty($KODE_LOKASI)) {
            $errors[] = 'KODE LOKASI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_KATEGORI)) {
            $errors[] = 'KETERANGAN KATEGORI tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
		$result = $this->M_MAPING_LOKASI->update($KODE_LOKASI, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_LOKASI)
    {
        // Proses hapus data
        $result = $this->M_MAPING_LOKASI->hapus($KODE_LOKASI);
        redirect('maping_lokasi');
    }
} 