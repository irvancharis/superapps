<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Departement_joblist extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_DEPARTEMENT_JOBLIST');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->helper('url_helper');
    }

    public function index($page = 'departement_joblist')
    {
        $this->load->library('session');

        $data['M_DEPARTEMENT_JOBLIST'] = $this->M_DEPARTEMENT_JOBLIST->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_DEPARTEMENT_JOBLIST->get_departement();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('departement_joblist', $data);
    }

    public function insert()
    {
        // Ambil data dari POST
        $get_last_joblist = $this->M_DEPARTEMENT_JOBLIST->get_latest_data();
        $id_joblist = isset($get_last_joblist[0]->ID_JOBLIST) ? $get_last_joblist[0]->ID_JOBLIST + 1 : 1;
        $id_departement = $this->input->post('id_departement');
        $joblist = $this->input->post('nama_joblist');
        $kode_area = $this->input->post('kode_area'); // Ambil data kode_area

        // Validasi data
        if (empty($joblist)) {
            echo json_encode(['success' => false, 'error' => 'Nama departemen tidak boleh kosong.']);
            return;
        }

        // Gabungkan kode_area menjadi string dengan format "1,2,3,4"
        $kode_area_str = !empty($kode_area) ? implode(',', $kode_area) : null;

        // Proses simpan data
        $data = [
            'ID_JOBLIST' => $id_joblist,
            'DEPARTEMENT' => $id_departement,
            'NAMA_JOBLIST' => $joblist,
            'KODE_AREA' => $kode_area_str, // Simpan kode_area dalam format string
        ];

        $result = $this->M_DEPARTEMENT_JOBLIST->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        // Ambil data dari POST
        $id_joblist = $this->input->post('id_joblist_edit');
        $id_departement = $this->input->post('id_departement_edit');
        $joblist = $this->input->post('nama_joblist_edit');
        $kode_area = $this->input->post('kode_area_edit'); // Ambil data kode_area

        // Validasi data
        if (empty($joblist)) {
            echo json_encode(['success' => false, 'error' => 'Nama departemen tidak boleh kosong.']);
            return;
        }

        // Gabungkan kode_area menjadi string dengan format "1,2,3,4"
        $kode_area_str = !empty($kode_area) ? implode(',', $kode_area) : null;

        // Proses update data
        $data = [
            'DEPARTEMENT' => $id_departement,
            'NAMA_JOBLIST' => $joblist,
            'KODE_AREA' => $kode_area_str, // Simpan kode_area dalam format string
        ];

        $result = $this->M_DEPARTEMENT_JOBLIST->update($id_joblist, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_joblist = $this->input->post('id_joblist_hapus');

        // Proses hapus data
        $result = $this->M_DEPARTEMENT_JOBLIST->hapus($id_joblist);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
