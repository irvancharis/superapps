<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departement extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_DEPARTEMENT');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');

        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function index($page = 'departement')
    {
        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'DEPARTEMEN', 'LIST');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $data['M_DEPARTEMENT'] = $this->M_DEPARTEMENT->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('departement', $data);
    }

    public function insert()
    {

        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'DEPARTEMEN', 'TAMBAH');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        // Ambil data dari POST
        // $id_departement = $this->uuid->v4();
        $id_departement = $this->M_DEPARTEMENT->get_latest_data() ? $this->M_DEPARTEMENT->get_latest_data()[0]->KODE_DEPARTEMEN + 1 : 1;
        $nama_departement = $this->input->post('nama_departement');
        $keterangan = $this->input->post('keterangan');

        // Validasi data
        if (empty($nama_departement)) {
            echo json_encode(['success' => false, 'error' => 'Nama departemen tidak boleh kosong.']);
            return;
        }

        // Proses simpan data
        $data = [
            'KODE_DEPARTEMEN' => $id_departement,
            'NAMA_DEPARTEMEN' => $nama_departement,
            'KETERANGAN' => $keterangan,
        ];

        $result = $this->M_DEPARTEMENT->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {

        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'DEPARTEMEN', 'EDIT');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        // Ambil data dari POST
        $id_departement = $this->input->post('id_departement_edit');
        $nama_departement = $this->input->post('nama_departement_edit');
        $keterangan = $this->input->post('keterangan_edit');

        // Validasi data
        if (empty($nama_departement)) {
            echo json_encode(['success' => false, 'error' => 'Nama departemen tidak boleh kosong.']);
            return;
        }

        // Proses update data
        $data = [
            'NAMA_DEPARTEMEN' => $nama_departement,
            'KETERANGAN' => $keterangan,
        ];

        $result = $this->M_DEPARTEMENT->update($id_departement, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {

        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'DEPARTEMEN', 'HAPUS');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        // Ambil data dari POST
        $id_departement = $this->input->post('id_departement_hapus');

        // Proses hapus data
        $result = $this->M_DEPARTEMENT->hapus($id_departement);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
