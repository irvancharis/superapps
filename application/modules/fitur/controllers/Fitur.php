<?php
class Fitur extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_FITUR');
        $this->load->helper('url_helper');
        $this->load->library( 'Uuid' );
        $this->load->library('TanggalIndo');
    }

    public function index($page = 'user')
    {
        $this->load->library('session');

        $data['M_FITUR'] = $this->M_FITUR->get_fitur();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_FITUR->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('fitur', $data);
    }

    public function get_single($KODE_FITUR)
    {
        $result = $this->M_FITUR->get_fitur_single($KODE_FITUR);
        echo json_encode($result);
    }

    public function tambah_fitur($page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('fitur_tambah', $data);
    }

    public function tambah_detail_fitur($KODE_FITUR,$page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['kode_fitur'] = $KODE_FITUR;
        $data['get_fitur'] = $this->M_FITUR->get_fitur();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('fitur_detail_tambah', $data);
    }

    public function edit($KODE_FITUR, $page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_FITUR->get_fitur_single($KODE_FITUR);
        $data['get_kategori_produk'] = $this->M_FITUR->get_kategori_produk();
        $data['get_fitur'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('fitur_edit', $data);
    }

    public function detail($KODE_FITUR, $page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_fitur'] = $this->M_FITUR->get_fitur_single($KODE_FITUR);
        $data['get_detail_fitur'] = $this->M_FITUR->get_detail_fitur($KODE_FITUR);
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('fitur_detail', $data);
    }


    public function insert_fitur()
    {
        // Ambil data dari POST
        

        $data = $this->input->post();
        $data['KODE_FITUR'] = $this->uuid->v4();

        $result = $this->M_FITUR->insert_fitur($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function insert_detail_fitur()
    {
        // Ambil data dari POST
        

        $data = $this->input->post();
        $data['KODE_DETAIL_FITUR'] = $this->uuid->v4();

        $result = $this->M_FITUR->insert_detail_fitur($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        $KODE_FITUR = $this->input->post('KODE_FITUR');
        $NAMA_ITEM = $this->input->post('NAMA_ITEM');
        $KODE_KATEGORI = $this->input->post('KODE_KATEGORI');
        $KETERANGAN_ITEM = $this->input->post('KETERANGAN_ITEM');

        // Validasi 
        if (empty($KODE_FITUR)) {
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
        $result = $this->M_FITUR->update($KODE_FITUR, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_FITUR)
    {
        // Proses hapus data
        $result = $this->M_FITUR->hapus($KODE_FITUR);
        redirect('fitur');
    }


    public function hapus_detail_fitur($KODE_FITUR)
    {
        // Proses hapus data
        $result = $this->M_FITUR->hapus_detail_fitur($KODE_FITUR);
        redirect('fitur');
    }
}
