<?php
class Maping_lokasi extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_MAPING_LOKASI');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');
    }

    public function index($page = 'maping_lokasi')
    {
        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_LOKASI','LIST');
        // if (!$CEK_ROLE) { redirect('non_akses'); }

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

        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_LOKASI','TAMBAH');
        // if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_area'] = $this->M_MAPING_LOKASI->get_area();
        $data['get_ruangan'] = $this->M_MAPING_LOKASI->get_ruangan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_lokasi_tambah', $data);
    }

    public function edit($KODE_LOKASI, $page = 'maping_lokasi')
    {

        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_LOKASI','EDIT');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_MAPING_LOKASI->get_maping_lokasi_single($KODE_LOKASI);
        $data['get_area'] = $this->M_MAPING_LOKASI->get_area();
        $data['get_ruangan'] = $this->M_MAPING_LOKASI->get_ruangan();
        $data['get_maping_lokasi'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_lokasi_edit', $data);
    }

    public function detail($KODE_LOKASI, $page = 'maping_lokasi')
    {
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_LOKASI','DETAIL');
        if (!$CEK_ROLE) { redirect('non_akses'); }


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

        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_LOKASI','TAMBAH');
        // if (!$CEK_ROLE) { redirect('non_akses'); }


        $NAMA_LOKASI = $this->input->post('NAMA_LOKASI');
        $KETERANGAN_KATEGORI = $this->input->post('KETERANGAN_KATEGORI');

        // Validasi 
        if (empty($NAMA_LOKASI)) {
            $errors[] = 'NAMA LOKASI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_KATEGORI)) {
            $errors[] = 'KETERANGAN KATEGORI tidak boleh kosong.';
        }


        $inputan = $this->input->post(null, TRUE);
        $inputan['KODE_LOKASI'] = $this->uuid->v4();
		$result = $this->M_MAPING_LOKASI->insert($inputan);

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
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_LOKASI','EDIT');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $KODE_LOKASI = $this->input->post('KODE_LOKASI');
        $NAMA_LOKASI = $this->input->post('NAMA_LOKASI');
        $KETERANGAN_LOKASI = $this->input->post('KETERANGAN_LOKASI');

        // Validasi 
        if (empty($KODE_LOKASI)) {
            $errors[] = 'KODE LOKASI tidak boleh kosong.';
        }
        if (empty($NAMA_LOKASI)) {
            $errors[] = 'NAMA LOKASI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_LOKASI)) {
            $errors[] = 'KETERANGAN LOKASI tidak boleh kosong.';
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
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_LOKASI','HAPUS');
        if (!$CEK_ROLE) { 
            redirect('non_akses');
        }else{
            // Proses hapus data
            $result = $this->M_MAPING_LOKASI->hapus($KODE_LOKASI);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
            }
        }
        
    }
} 