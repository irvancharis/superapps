<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Maping_area extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MAPING_AREA_model');
        $this->load->helper('url_helper');
    }

    public function index($page = 'maping_area')
    {
        $this->load->library('session');

        $data['sfa_maping_area'] = $this->MAPING_AREA_model->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_area', $data);
    }

    public function insert()
    {

        // Ambil data dari POST
        $get_last_area = $this->MAPING_AREA_model->get_latest_data();
        $id_area = $get_last_area[0]->KODE_AREA + 1;
        $nama_area = $this->input->post('nama_area');
        $keterangan = $this->input->post('keterangan');

        // Validasi data
        if (empty($nama_area)) {
            echo json_encode(['success' => false, 'error' => 'Nama Area tidak boleh kosong.']);
            return;
        }

        // Proses simpan data
        $data = [
            'KODE_AREA' => $id_area,
            'NAMA_AREA' => $nama_area,
            'KETERANGAN_AREA' => $keterangan,
        ];

        $result = $this->MAPING_AREA_model->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        // Ambil data dari POST
        $id_area = $this->input->post('id_area_edit');
        $nama_area = $this->input->post('nama_area_edit');
        $keterangan = $this->input->post('keterangan_edit');

        // Validasi data
        if (empty($nama_area)) {
            echo json_encode(['success' => false, 'error' => 'Nama Area tidak boleh kosong.']);
            return;
        }

        // Proses update data
        $data = [
            'NAMA_AREA' => $nama_area,
            'KETERANGAN_AREA' => $keterangan,
        ];

        $result = $this->MAPING_AREA_model->update($id_area, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_area = $this->input->post('id_area_hapus');

        // Proses hapus data
        $result = $this->MAPING_AREA_model->hapus($id_area);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
