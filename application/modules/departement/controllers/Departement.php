<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Departement extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SFA_DEPARTEMENT');
        $this->load->helper('url_helper');
    }

    public function index($page = 'departement')
    {
        $this->load->library('session');

        $data['sfa_departement'] = $this->SFA_DEPARTEMENT->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('departement', $data);
    }

    public function insert()
    {

        // Ambil data dari POST
        $get_last_departement = $this->SFA_DEPARTEMENT->get_latest_data();
        $id_departement = $get_last_departement[0]->KODE_DEPARTEMEN + 1;
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

        $result = $this->SFA_DEPARTEMENT->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
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

        $result = $this->SFA_DEPARTEMENT->update($id_departement, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_departement = $this->input->post('id_departement_hapus');

        // Proses hapus data
        $result = $this->SFA_DEPARTEMENT->hapus($id_departement);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
