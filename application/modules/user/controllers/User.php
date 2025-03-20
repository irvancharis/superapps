<?php
class User extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_USER');
        $this->load->model('role/M_ROLE');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
    }

    public function index($page = 'user')
    {
        $this->load->library('session');

        $data['M_USER'] = $this->M_USER->get_user();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('user', $data);
    }

    public function get_single($KODE_ITEM)
    {
        $result = $this->M_USER->get_user_single($KODE_ITEM);
        echo json_encode($result);
    }


    public function tambah($page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_role'] = $this->M_ROLE->get_role();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('user_tambah', $data);
    }

    public function edit($KODE_ITEM, $page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_role'] = $this->M_ROLE->get_role();
        $data['get_user'] = $this->M_USER->get_user_single($KODE_ITEM);
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('user_edit', $data);
    }

    public function detail($KODE_ITEM, $page = 'user')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_role'] = $this->M_ROLE->get_role();
        $data['get_user'] = $this->M_USER->get_user_single($KODE_ITEM);
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('user_detail', $data);
    }


    public function insert()
    {
        // Ambil data dari POST
        $DATA = $this->input->post();
        $DATA['UUID_USER'] = $this->uuid->v4();
        $password = $DATA['PASSWORD'];
        $DATA['PASSWORD'] = password_hash($password, PASSWORD_DEFAULT);
        
        $result = $this->M_USER->insert($DATA);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update($KODE_ITEM)
    {
        $inputan = $this->input->post(null, TRUE);
        if (empty($inputan['PASSWORD'])) {
            unset($inputan['PASSWORD']);
        }else{
            $password = $inputan['PASSWORD'];
            $inputan['PASSWORD'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $result = $this->M_USER->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_USER->hapus($KODE_ITEM);
        redirect('user');
    }
}
