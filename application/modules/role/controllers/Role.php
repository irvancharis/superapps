<?php
class Role extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_ROLE');
        $this->load->model('fitur/M_FITUR');        
        $this->load->helper('url_helper');
        $this->load->library( 'Uuid' );
        $this->load->library('TanggalIndo');
    }

    public function index($page = 'user')
    {
        $this->load->library('session');

        $data['M_ROLE'] = $this->M_ROLE->get_role();        
        $data['M_FITUR'] = $this->M_FITUR->get_fitur();
        
        
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_ROLE->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('role', $data);
    }

    public function get_single($KODE_ROLE)
    {
        $result = $this->M_ROLE->get_role_single($KODE_ROLE);
        echo json_encode($result);
    }


    public function get_kategori_produk()
    {
        $result = $this->M_ROLE->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah_role($page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('role_tambah', $data);
    }

    public function tambah_detail_role($page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_role'] = $this->M_ROLE->get_role();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('role_detail_tambah', $data);
    }

    public function edit($KODE, $page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['M_FITUR'] = $this->M_FITUR->get_fitur();
        $data['get_role'] = $this->M_ROLE->get_role_single($KODE);
        $data['kode_role'] = $KODE;
        $data['get_detail_role'] = $this->M_ROLE->get_detail_role_single($KODE);
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('role_edit', $data);
    }

    public function detail($KODE_ROLE, $page = 'role')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_ROLE->get_role_single($KODE_ROLE);
        $data['get_role'] = $query->row();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('role_detail', $data);
    }


    public function insert_role()
    {
        // Ambil data dari POST
        

        $data = $this->input->post();
        $result = $this->M_ROLE->insert_role($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function insert_detail_role()
    {
        // Ambil data dari POST
        $datas = $this->input->post('data');
        
        foreach ($datas as $item) {
                $data = [
                    'KODE_ROLE' => $item['KODE_ROLE'],
                    'KODE_FITUR' => $item['KODE_FITUR'],
                    'KODE_DETAIL_FITUR' => $item['KODE_DETAIL_FITUR'],
                ];
                $result = $this->M_ROLE->insert_detail_role($data);
            }        

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        $KODE_ROLE = $this->input->post('KODE_ROLE');
        $NAMA_ITEM = $this->input->post('NAMA_ITEM');
        $KODE_KATEGORI = $this->input->post('KODE_KATEGORI');
        $KETERANGAN_ITEM = $this->input->post('KETERANGAN_ITEM');

        // Validasi 
        if (empty($KODE_ROLE)) {
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
        $result = $this->M_ROLE->update($KODE_ROLE, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ROLE)
    {
        // Proses hapus data
        $result = $this->M_ROLE->hapus($KODE_ROLE);
        redirect('role');
    }
}