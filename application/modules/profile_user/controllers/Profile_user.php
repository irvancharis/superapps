<?php
class Profile_user extends CI_Controller
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

        $data['M_USER'] = $this->M_USER->get_user_single($this->session->userdata('UUID_USER'));
        $data['M_KARYAWAN'] = $this->M_KARYAWAN->get_karyawan_by_id($this->session->userdata('ID_KARYAWAN'));
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('profile_user', $data);
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
        $result = $this->M_USER->hapus($KODE_ITEM);
        redirect('user');
    }

    public function ganti_password($kode_user)
    {
        $password_baru = $this->input->post('new_password');
        $konfirmasi_password = $this->input->post('confirm_password');

        if ($password_baru == $konfirmasi_password) {
            $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
            $result = $this->M_USER->update($kode_user, ['PASSWORD' => $password_baru]);
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Password baru dan konfirmasi password tidak cocok.']);
        }
    }
}
