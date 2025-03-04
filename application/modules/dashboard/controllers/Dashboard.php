<?php
class Dashboard extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->model('role/M_ROLE');
    }

    public function index($page = 'dashboard')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'DASHBOARD', 'DASHBOARD');
        if (!$CEK_ROLE) {
            redirect('login');
        }
        
        $this->load->library('session');

        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('dashboard', $data);
    }

    public function insert()
    {

        // Ambil data dari POST
        $get_last_jabatan = $this->M_JABATAN->get_latest_data();
        $id_jabatan = isset($get_last_jabatan[0]->KODE_JABATAN) ? $get_last_jabatan[0]->KODE_JABATAN + 1 : 1;
        $nama_jabatan = $this->input->post('nama_jabatan');
        $keterangan = $this->input->post('keterangan');

        // Validasi data
        if (empty($nama_jabatan)) {
            echo json_encode(['success' => false, 'error' => 'Nama departemen tidak boleh kosong.']);
            return;
        }

        // Proses simpan data
        $data = [
            'KODE_JABATAN' => $id_jabatan,
            'NAMA_JABATAN' => $nama_jabatan,
            'KETERANGAN' => $keterangan
        ];

        $result = $this->M_JABATAN->insert($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update()
    {
        // Ambil data dari POST
        $id_jabatan = $this->input->post('id_jabatan_edit');
        $nama_jabatan = $this->input->post('nama_jabatan_edit');
        $keterangan = $this->input->post('keterangan_edit');

        // Validasi data
        if (empty($nama_jabatan)) {
            echo json_encode(['success' => false, 'error' => 'Nama departemen tidak boleh kosong.']);
            return;
        }

        // Proses update data
        $data = [
            'NAMA_JABATAN' => $nama_jabatan,
            'KETERANGAN' => $keterangan
        ];

        $result = $this->M_JABATAN->update($id_jabatan, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus()
    {
        // Ambil data dari POST
        $id_jabatan = $this->input->post('id_jabatan_hapus');

        // Proses hapus data
        $result = $this->M_JABATAN->hapus($id_jabatan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus data.']);
        }
    }
}