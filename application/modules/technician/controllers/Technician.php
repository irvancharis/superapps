<?php
class Technician extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_TECHNICIAN');
        $this->load->helper('url_helper');
    }

    public function index($page = 'technician')
    {
        $this->load->library('session');

        $data['M_TECHNICIAN'] = $this->M_TECHNICIAN->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_TECHNICIAN->get_departement();
        $data['get_karyawan'] = $this->M_TECHNICIAN->get_karyawan();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('technician', $data);
    }

    public function get_karyawan_by_id($kode)
    {
        $data = $this->M_TECHNICIAN->get_karyawan_by_id($kode);
        echo json_encode($data);
    }

    public function insert()
    {

        // Ambil data dari POST
        $get_last_technician = $this->M_TECHNICIAN->get_latest_data();
        $id_technician = isset($get_last_technician[0]->IDTECH) ? $get_last_technician[0]->IDTECH + 1 : 1; // Default ke 1 jika data kosong
        $nama_technician = $this->input->post('nama_technician');
        $id_departement = $this->input->post('id_departement');
        $status = $this->input->post('status');
        $id_karyawan = $this->input->post('id_karyawan');
        $description = $this->input->post('description_technician');

        // Validasi data
        $errors = [];

        if (empty($nama_technician)) {
            $errors[] = 'Nama Teknisi tidak boleh kosong.';
        } elseif (strlen($nama_technician) > 100) {
            $errors[] = 'Nama Teknisi tidak boleh lebih dari 100 karakter.';
        }

        if (empty($id_departement)) {
            $errors[] = 'ID Departemen tidak boleh kosong.';
        } elseif (!is_numeric($id_departement)) {
            $errors[] = 'ID Departemen harus berupa angka.';
        }

        if (empty($status)) {
            $errors[] = 'Status tidak boleh kosong.';
        } elseif (!in_array($status, [0, 1])) { // Contoh validasi nilai yang diizinkan
            $errors[] = 'Status harus berupa "active" atau "inactive".';
        }

        if (empty($id_karyawan)) {
            $errors[] = 'ID Karyawan tidak boleh kosong.';
        }

        if (strlen($description) > 255) {
            $errors[] = 'Deskripsi Teknisi tidak boleh lebih dari 255 karakter.';
        }

        // Jika ada error, kembalikan respons JSON dengan daftar error
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        $status_karyawan = $status == 'AKTIF' ? '1' : '0';

        // Jika validasi lolos, lanjutkan proses penyimpanan
        $data = [
            'IDTECH' => $id_technician,
            'NAME_TECHNICIAN' => $nama_technician,
            'DEPARTEMENT' => $id_departement,
            'STATUS' => $status_karyawan,
            'IDKARYAWAN' => $id_karyawan,
            'DESCRIPTION_TECHNICIAN' => $description,
        ];


        $result = $this->M_TECHNICIAN->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        // Ambil data dari POST
        $id_technician = $this->input->post('id_technician_edit');
        $nama_technician = $this->input->post('nama_technician_edit');
        $id_departement = $this->input->post('id_departement_edit');
        $status = $this->input->post('status_edit');
        $id_karyawan = $this->input->post('id_karyawan_edit');
        $description = $this->input->post('description_technician_edit');

        // Validasi data
        $errors = [];

        if (empty($nama_technician)) {
            $errors[] = 'Nama Teknisi tidak boleh kosong.';
        } elseif (strlen($nama_technician) > 100) {
            $errors[] = 'Nama Teknisi tidak boleh lebih dari 100 karakter.';
        }

        if (empty($id_departement)) {
            $errors[] = 'ID Departemen tidak boleh kosong.';
        } elseif (!is_numeric($id_departement)) {
            $errors[] = 'ID Departemen harus berupa angka.';
        }

        if (!in_array($status, [0, 1])) { // Contoh validasi nilai yang diizinkan
            $errors[] = 'Status harus berupa "active" atau "inactive".';
        }

        if (empty($id_karyawan)) {
            $errors[] = 'ID Karyawan tidak boleh kosong.';
        } elseif (!is_numeric($id_karyawan)) {
            $errors[] = 'ID Karyawan harus berupa angka.';
        }

        if (strlen($description) > 255) {
            $errors[] = 'Deskripsi Teknisi tidak boleh lebih dari 255 karakter.';
        }

        // Jika ada error, kembalikan respons JSON dengan daftar error
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        // Proses update data
        $data = [
            'NAME_TECHNICIAN' => $nama_technician,
            'DEPARTEMENT' => $id_departement,
            'STATUS' => $status,
            'IDKARYAWAN' => $id_karyawan,
            'DESCRIPTION_TECHNICIAN' => $description,
        ];

        $result = $this->M_TECHNICIAN->update($id_technician, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_technician = $this->input->post('id_technician_hapus');

        // Proses hapus data
        $result = $this->M_TECHNICIAN->hapus($id_technician);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
