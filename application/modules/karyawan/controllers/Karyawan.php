<?php
class Karyawan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_KARYAWAN');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');
        $this->load->helper('url_helper');
    }

    public function index($page = 'karyawan')
    {
        $this->load->library('session');

        $data['M_KARYAWAN'] = $this->M_KARYAWAN->get_karyawan();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_KARYAWAN->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan', $data);
    }

    public function get_single($KODE)
    {
        $result = $this->M_KARYAWAN->get_single($KODE);
        echo json_encode($result);
    }
    
    
    public function get_kategori_produk()
    {
        $result = $this->M_KARYAWAN->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'karyawan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_KARYAWAN->get_area();
        $data['get_departemen'] = $this->M_KARYAWAN->get_departemen();
        $data['get_jabatan'] = $this->M_KARYAWAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_tambah', $data);
    }

    public function edit($KODE, $page = 'karyawan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_KARYAWAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $data['get_area'] = $this->M_KARYAWAN->get_area();
        $data['get_departemen'] = $this->M_KARYAWAN->get_departemen();
        $data['get_jabatan'] = $this->M_KARYAWAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_edit', $data);
    }

    /**
     * Detail karyawan
     *
     * @param string $KODE_ITEM kode item yang akan di detail
     * @param string $page page yang akan di load
     */
    public function detail($KODE, $page = 'karyawan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_KARYAWAN->get_single($KODE);
        $data['get_single'] = $query->row();
        $data['get_area'] = $this->M_KARYAWAN->get_area();
        $data['get_departemen'] = $this->M_KARYAWAN->get_departemen();
        $data['get_jabatan'] = $this->M_KARYAWAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('karyawan_detail', $data);
    }


    public function insert()
    {
        $KODE = $this->uuid->v4();
        
        $config['upload_path'] = APPPATH . '../assets/uploads/';  
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $KODE;

        $this->load->library('upload', $config);
        $result = '';

        if (!$this->upload->do_upload('FOTO')) {
            echo json_encode(['success' => false, 'error' => 'Gagal upload foto.']);
        } else {
            // Ambil data file yang diupload
            $data = $this->upload->data();
            $extension = $data['file_ext'];

            $inputan = $this->input->post(null, TRUE);
            $inputan['FOTO'] = $KODE.$extension;
            $inputan['ID_KARYAWAN'] = $KODE;
		    $result = $this->M_KARYAWAN->insert($inputan);

            if ($result) {
            echo json_encode(['success' => true]);
            } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
            }
        }

        
    }

    public function update()
    {
        $KODE_ITEM = $this->input->post('NIK');

        // Validasi 
        if (empty($KODE_ITEM)) {
            $errors[] = 'NIK tidak boleh kosong.';
        }       

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
        $result = $this->M_KARYAWAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
} 