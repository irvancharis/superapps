<?php
class Karyawan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_KARYAWAN');
        $this->load->helper('url_helper');
    }

    public function index($page = 'karyawan')
    {
        $this->load->library('session');

        $data['M_KARYAWAN'] = $this->M_KARYAWAN->get_karyawan();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_KARYAWAN->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan', $data);
    }

    public function get_single($KODE)
    {
        $result = $this->M_KARYAWAN->get_single($KODE);
        echo json_encode($result);
    }
    
    
    public function get_kategori_produk()
    {
        $result = $this->M_KARYAWAN->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'karyawan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_KARYAWAN->get_area();
        $data['get_departemen'] = $this->M_KARYAWAN->get_departemen();
        $data['get_jabatan'] = $this->M_KARYAWAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_tambah', $data);
    }

    public function edit($KODE, $page = 'karyawan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_KARYAWAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $data['get_area'] = $this->M_KARYAWAN->get_area();
        $data['get_departemen'] = $this->M_KARYAWAN->get_departemen();
        $data['get_jabatan'] = $this->M_KARYAWAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_edit', $data);
    }

/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Detail karyawan
     *
     * @param string $KODE_ITEM kode item yang akan di detail
     * @param string $page page yang akan di load
     */
/******  65b76a20-bfbd-43d1-a245-14d85356b36b  *******/
    public function detail($KODE, $page = 'karyawan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_KARYAWAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $data['get_area'] = $this->M_KARYAWAN->get_area();
        $data['get_departemen'] = $this->M_KARYAWAN->get_departemen();
        $data['get_jabatan'] = $this->M_KARYAWAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_detail', $data);
    }


    public function insert()
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
		$result = $this->M_KARYAWAN->insert($inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
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
		$result = $this->M_KARYAWAN->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_KARYAWAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
} 