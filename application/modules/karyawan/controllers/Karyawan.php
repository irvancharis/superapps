<?php
class Karyawan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_KARYAWAN');
        $this->load->helper('url_helper');
    }

    public function index($page = 'karyawan')
    {
        $this->load->library('session');

        $data['M_KARYAWAN'] = $this->M_KARYAWAN->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_departement'] = $this->M_KARYAWAN->get_departement();
        $data['get_jabatan'] = $this->M_KARYAWAN->get_jabatan();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan', $data);
    }

    public function insert()
    {

        // Ambil data dari POST
        $get_last_karyawan = $this->M_KARYAWAN->get_latest_data();
        $id_karyawan = isset($get_last_karyawan[0]->ID_KARYAWAN) ? $get_last_karyawan[0]->ID_KARYAWAN + 1 : 1; // Default ke 1 jika data kosong
        $nama_karyawan = $this->input->post('nama_karyawan');
        $id_departement = $this->input->post('id_departement');
        $status = $this->input->post('status');
        $id_jabatan = $this->input->post('id_jabatan');

        // Validasi data
        $errors = [];

        // Validasi nama karyawan
        if (empty($nama_karyawan)) {
            $errors[] = 'Nama Karyawan tidak boleh kosong.';
        } elseif (strlen($nama_karyawan) > 100) {
            $errors[] = 'Nama Karyawan tidak boleh lebih dari 100 karakter.';
        }

        // Validasi ID Departemen
        if (empty($id_departement)) {
            $errors[] = 'ID Departemen tidak boleh kosong.';
        } elseif (!is_numeric($id_departement)) {
            $errors[] = 'ID Departemen harus berupa angka.';
        }

        // Validasi status
        if (empty($status)) {
            $errors[] = 'Status tidak boleh kosong.';
        } elseif (!in_array($status, [0, 1])) { // Contoh validasi nilai yang diizinkan
            $errors[] = 'Status harus berupa "Aktif" atau "Pasif".';
        }

        // Validasi ID Jabatan
        if (empty($id_jabatan)) {
            $errors[] = 'ID Jabatan tidak boleh kosong.';
        } elseif (!is_numeric($id_jabatan)) {
            $errors[] = 'ID Jabatan harus berupa angka.';
        }

        // Jika ada error, kembalikan respons JSON dengan daftar error
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        // Jika validasi lolos, lanjutkan proses penyimpanan
        $data = [
            'ID_KARYAWAN' => $id_karyawan,
            'NAMA_KARYAWAN' => $nama_karyawan,
            'ID_DEPARTEMENT' => $id_departement,
            'STATUS_KARYAWAN' => $status,
            'NIK' => $id_karyawan,
            'ID_JABATAN' => $id_jabatan,
        ];


        $result = $this->M_KARYAWAN->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        // Ambil data dari POST
        $id_karyawan = $this->input->post('id_karyawan_edit'); // Default ke 1 jika data kosong
        $nama_karyawan = $this->input->post('nama_karyawan_edit');
        $id_departement = $this->input->post('id_departement_edit');
        $status = $this->input->post('status_edit');
        $id_jabatan = $this->input->post('id_jabatan_edit');

        // Validasi data
        $errors = [];

        // Validasi nama karyawan
        if (empty($nama_karyawan)) {
            $errors[] = 'Nama Karyawan tidak boleh kosong.';
        } elseif (strlen($nama_karyawan) > 100) {
            $errors[] = 'Nama Karyawan tidak boleh lebih dari 100 karakter.';
        }

        // Validasi ID Departemen
        if (empty($id_departement)) {
            $errors[] = 'ID Departemen tidak boleh kosong.';
        } elseif (!is_numeric($id_departement)) {
            $errors[] = 'ID Departemen harus berupa angka.';
        }

        // Validasi status
        if (!in_array($status, [0, 1])) { // Contoh validasi nilai yang diizinkan
            $errors[] = 'Status harus berupa "Aktif" atau "Pasif".';
        }

        // Validasi ID Jabatan
        if (empty($id_jabatan)) {
            $errors[] = 'ID Jabatan tidak boleh kosong.';
        } elseif (!is_numeric($id_jabatan)) {
            $errors[] = 'ID Jabatan harus berupa angka.';
        }

        // Jika ada error, kembalikan respons JSON dengan daftar error
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        // Jika validasi lolos, lanjutkan proses penyimpanan
        $data = [
            'NAMA_KARYAWAN' => $nama_karyawan,
            'ID_DEPARTEMENT' => $id_departement,
            'STATUS_KARYAWAN' => $status,
            'ID_JABATAN' => $id_jabatan,
        ];

        $result = $this->M_KARYAWAN->update($id_karyawan, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_karyawan = $this->input->post('id_karyawan_hapus');

        // Proses hapus data
        $result = $this->M_KARYAWAN->hapus($id_karyawan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}
