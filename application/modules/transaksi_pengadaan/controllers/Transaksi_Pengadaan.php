<?php
class Transaksi_pengadaan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TRANSAKSI_PENGADAAN');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
    }

    public function index($page = 'transaksi_pengadaan')
    {
        $this->load->library('session');
        //echo $this->uuid->v4();

        $data['M_TRANSAKSI_PENGADAAN'] = $this->M_TRANSAKSI_PENGADAAN->get_data();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_TRANSAKSI_PENGADAAN->get_kategori();

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


    public function tambah($page = 'karyawan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_TRANSAKSI_PENGADAAN->get_karyawan();
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['get_jabatan'] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_tambah', $data);
    }

    public function edit($KODE, $page = 'karyawan')
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
        $KODE_ITEM = $this->input->post('NIK');

        // Validasi 
        if (empty($KODE_ITEM)) {
            $errors[] = 'NIK tidak boleh kosong.';
        }       


        $inputan = $this->input->post(null, TRUE);
		$result = $this->M_TRANSAKSI_PENGADAAN->insert($inputan);

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
		$result = $this->M_TRANSAKSI_PENGADAAN->update($KODE_ITEM, $inputan);

        if ($result) {
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