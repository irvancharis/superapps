<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maping_default extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_MAPING_DEFAULT');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');
    }

    public function index($page = 'maping_default')
    {
        $data['sfa_maping_default'] = $this->M_MAPING_DEFAULT->get_news();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();

        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar', $data);
        $this->load->view('maping_default', $data);
    }

    public function insert()
    {
        $area = $this->input->post('area');
        $ruangan = $this->input->post('ruangan');
        $lokasi = $this->input->post('lokasi');
        $departemen = $this->input->post('departemen');

        // Validasi data
        if (empty($area)) {
            echo json_encode(['success' => false, 'error' => 'Area tidak boleh kosong.']);
            return;
        }

        // Proses simpan data
        $data = [
            'AREA' => $area,
            'RUANGAN' => $ruangan,
            'LOKASI' => $lokasi,
            'DEPARTEMEN' => $departemen
        ];

        $result = $this->M_MAPING_DEFAULT->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        $area = $this->input->post('area_edit');
        $ruangan = $this->input->post('ruangan_edit');
        $lokasi = $this->input->post('lokasi_edit');
        $departemen = $this->input->post('departemen_edit');

        // Validasi data
        if (empty($area)) {
            echo json_encode(['success' => false, 'error' => 'Area tidak boleh kosong.']);
            return;
        }

        // Proses update data
        $data = [
            'RUANGAN' => $ruangan,
            'LOKASI' => $lokasi,
            'DEPARTEMEN' => $departemen
        ];

        $result = $this->M_MAPING_DEFAULT->update($area, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        $area = $this->input->post('area_hapus');

        // Proses hapus data
        $result = $this->M_MAPING_DEFAULT->hapus($area);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
