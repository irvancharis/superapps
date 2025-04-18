<?php
class Produk_kategori extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_PRODUK_KATEGORI');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');
    }

    public function index($page = 'produk_kategori')
    {
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'PRODUK_KATEGORI','LIST');
        if (!$CEK_ROLE) { redirect('non_akses'); }

        $data['M_PRODUK_KATEGORI'] = $this->M_PRODUK_KATEGORI->get_produk_kategori();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_PRODUK_KATEGORI->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_kategori', $data);
    }

    public function get_single($KODE_PRODUK_KATEGORI)
    {
        $result = $this->M_PRODUK_KATEGORI->get_produk_kategori_single($KODE_PRODUK_KATEGORI);
        echo json_encode($result);
    }
    
    
    public function get_kategori_produk()
    {
        $result = $this->M_PRODUK_KATEGORI->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'produk_kategori')
    {
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'PRODUK_KATEGORI','TAMBAH');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_KATEGORI->get_kategori_produk();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_kategori_tambah', $data);
    }

    public function edit($KODE_PRODUK_KATEGORI, $page = 'produk_kategori')
    {
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'PRODUK_KATEGORI','EDIT');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_KATEGORI->get_produk_kategori_single($KODE_PRODUK_KATEGORI);
        $data['get_kategori_produk'] = $this->M_PRODUK_KATEGORI->get_kategori_produk();
        $data['get_produk_kategori'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_kategori_edit', $data);
    }

    public function detail($KODE_PRODUK_KATEGORI, $page = 'produk_kategori')
    {
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'PRODUK_KATEGORI','DETAIL');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_KATEGORI->get_produk_kategori_single($KODE_PRODUK_KATEGORI);
        $data['get_produk_kategori'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_kategori_detail', $data);
    }


    public function insert()
    {

        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'PRODUK_KATEGORI','TAMBAH');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $NAMA_PRODUK_KATEGORI = $this->input->post('NAMA_PRODUK_KATEGORI');
        $KETERANGAN_KATEGORI = $this->input->post('KETERANGAN_KATEGORI');

        if (empty($NAMA_PRODUK_KATEGORI)) {
            $errors[] = 'NAMA KATEGORI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_KATEGORI)) {
            $errors[] = 'KETERANGAN KATEGORI tidak boleh kosong.';
        }


        $inputan = $this->input->post(null, TRUE);
        $inputan['KODE_PRODUK_KATEGORI'] = $this->uuid->v4();
		$result = $this->M_PRODUK_KATEGORI->insert($inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {

        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'PRODUK_KATEGORI','EDIT');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $KODE_PRODUK_KATEGORI = $this->input->post('KODE_PRODUK_KATEGORI');
        $NAMA_PRODUK_KATEGORI = $this->input->post('NAMA_PRODUK_KATEGORI');
        $KETERANGAN_KATEGORI = $this->input->post('KETERANGAN_KATEGORI');

        // Validasi 
        if (empty($KODE_PRODUK_KATEGORI)) {
            $errors[] = 'KODE KATEGORI tidak boleh kosong.';
        }
        if (empty($NAMA_PRODUK_KATEGORI)) {
            $errors[] = 'NAMA KATEGORI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_KATEGORI)) {
            $errors[] = 'KETERANGAN KATEGORI tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
		$result = $this->M_PRODUK_KATEGORI->update($KODE_PRODUK_KATEGORI, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_PRODUK_KATEGORI)
    {

        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'PRODUK_KATEGORI','HAPUS');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        // Proses hapus data
        $result = $this->M_PRODUK_KATEGORI->hapus($KODE_PRODUK_KATEGORI);
        redirect('produk_kategori');
    }
} 