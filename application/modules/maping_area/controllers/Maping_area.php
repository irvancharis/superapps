<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Maping_area extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_MAPING_AREA');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');
    }

    public function index($page = 'maping_area')
    {
        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_AREA','LIST');
        // if (!$CEK_ROLE) { redirect('non_akses'); }

        $data['sfa_maping_area'] = $this->M_MAPING_AREA->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('maping_area', $data);
    }

    public function insert()
    {
        // $this->load->library( 'session' );
        // $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_AREA','TAMBAH');
        // if (!$CEK_ROLE) { redirect('non_akses'); }

        $nama_area = $this->input->post('nama_area');
        $keterangan = $this->input->post('keterangan');

        // Validasi data
        if (empty($nama_area)) {
            echo json_encode(['success' => false, 'error' => 'Nama Area tidak boleh kosong.']);
            return;
        }

        // Proses simpan data
        $data = [
            'KODE_AREA' => $this->uuid->v4(),
            'NAMA_AREA' => $nama_area,
            'KETERANGAN_AREA' => $keterangan,
        ];

        $result = $this->M_MAPING_AREA->insert($data);

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
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_AREA','EDIT');
        if (!$CEK_ROLE) { redirect('non_akses'); }


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

        $result = $this->M_MAPING_AREA->update($id_area, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {

        $this->load->library( 'session' );
        $SESSION_ROLE = $this->session->userdata( 'ROLE' );
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE,'MAPING_AREA','HAPUS');
        if (!$CEK_ROLE) { 
            echo json_encode(['success' => false, 'error' => 'anda tidak memiliki akses']); 
        }else{
             // Ambil data dari POST
            $id_area = $this->input->post('id_area_hapus');

            // Proses hapus data
            $result = $this->M_MAPING_AREA->hapus($id_area);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
            }
        }


       
    }
}
