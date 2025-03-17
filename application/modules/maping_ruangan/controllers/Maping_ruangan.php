<?php
class MAPING_ruangan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_MAPING_RUANGAN');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');
    }

    public function index($page = 'maping_ruangan')
    {
        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_RUANGAN','LIST');
        // if (!$CEK_ROLE) { redirect('non_akses'); }

        $data['M_MAPING_RUANGAN'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_MAPING_RUANGAN->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_ruangan', $data);
    }

    public function get_single($KODE_RUANGAN)
    {
        $result = $this->M_MAPING_RUANGAN->get_maping_ruangan_single($KODE_RUANGAN);
        echo json_encode($result);
    }
    
    
    public function get_kategori_produk()
    {
        $result = $this->M_MAPING_RUANGAN->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'maping_ruangan')
    {
        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_RUANGAN','TAMBAH');
        // if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_area'] = $this->M_MAPING_RUANGAN->get_area();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_ruangan_tambah', $data);
    }

    public function edit($KODE_RUANGAN, $page = 'maping_ruangan')
    {
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_RUANGAN','EDIT');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_MAPING_RUANGAN->get_maping_ruangan_single($KODE_RUANGAN);
        $data['get_maping_area'] = $this->M_MAPING_RUANGAN->get_area();
        $data['get_maping_ruangan'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_ruangan_edit', $data);
    }

    public function detail($KODE_RUANGAN, $page = 'maping_ruangan')
    {
        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_RUANGAN','DETAIL');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_MAPING_RUANGAN->get_maping_ruangan_single($KODE_RUANGAN);
        $data['get_maping_ruangan'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_ruangan_detail', $data);
    }


    public function insert()
    {

        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_RUANGAN','TAMBAH');
        // if (!$CEK_ROLE) { redirect('non_akses'); }


        $NAMA_RUANGAN = $this->input->post('NAMA_RUANGAN');
        $KETERANGAN_KATEGORI = $this->input->post('KETERANGAN_KATEGORI');

        // Validasi 
        if (empty($NAMA_RUANGAN)) {
            $errors[] = 'NAMA RUANGAN tidak boleh kosong.';
        }
        if (empty($KETERANGAN_KATEGORI)) {
            $errors[] = 'KETERANGAN KATEGORI tidak boleh kosong.';
        }


        $inputan = $this->input->post(null, TRUE);
        $inputan['KODE_RUANGAN'] = $this->uuid->v4();
		$result = $this->M_MAPING_RUANGAN->insert($inputan);

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
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_RUANGAN','UBAH');
        if (!$CEK_ROLE) { redirect('non_akses'); }


        $KODE_RUANGAN = $this->input->post('KODE_RUANGAN');
        $NAMA_RUANGAN = $this->input->post('NAMA_RUANGAN');
        $KODE_RUANGAN = $this->input->post('KODE_RUANGAN');
        $KETERANGAN_KATEGORI = $this->input->post('KETERANGAN_KATEGORI');

        // Validasi 
        if (empty($KODE_RUANGAN)) {
            $errors[] = 'KODE RUANGAN tidak boleh kosong.';
        }
        if (empty($NAMA_RUANGAN)) {
            $errors[] = 'NAMA RUANGAN tidak boleh kosong.';
        }
        if (empty($KODE_RUANGAN)) {
            $errors[] = 'KODE RUANGAN tidak boleh kosong.';
        }
        if (empty($KETERANGAN_KATEGORI)) {
            $errors[] = 'KETERANGAN KATEGORI tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
		$result = $this->M_MAPING_RUANGAN->update($KODE_RUANGAN, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_RUANGAN)
    {

        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_RUANGAN','HAPUS');
        if (!$CEK_ROLE) { 
            redirect('non_akses');
        }else{
             // Ambil data dari POST
            $id_area = $this->input->post('id_ruangan_hapus');

            // Proses hapus data
            $result = $this->M_MAPING_RUANGAN->hapus($KODE_RUANGAN);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
            }
        }



        
    }
} 