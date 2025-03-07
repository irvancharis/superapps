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
        $this->load->model('transaksi_pengadaan/M_TRANSAKSI_PENGADAAN');
        $this->load->model('transaksi_opname/M_TRANSAKSI_OPNAME');
        $this->load->model('transaksi_pemindahan/M_TRANSAKSI_PEMINDAHAN');
        $this->load->model('transaksi_penghapusan/M_TRANSAKSI_PENGHAPUSAN');

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
        $data['transaksi_pengadaan_total'] = $this->M_TRANSAKSI_PENGADAAN->total_transaksi_pengadaan();
        $data['transaksi_pengadaan_proses'] = $this->M_TRANSAKSI_PENGADAAN->total_proses_transaksi_pengadaan();
        $data['transaksi_opname_total'] = $this->M_TRANSAKSI_OPNAME->total_transaksi_opname();
        $data['transaksi_opname_proses'] = $this->M_TRANSAKSI_OPNAME->total_proses_transaksi_opname();
        $data['transaksi_pemindahan_total'] = $this->M_TRANSAKSI_PEMINDAHAN->total_transaksi_pemindahan();
        $data['transaksi_pemindahan_proses'] = $this->M_TRANSAKSI_PEMINDAHAN->total_proses_transaksi_pemindahan();
        $data['transaksi_penghapusan_total'] = $this->M_TRANSAKSI_PENGHAPUSAN->total_transaksi_penghapusan();
        $data['transaksi_penghapusan_proses'] = $this->M_TRANSAKSI_PENGHAPUSAN->total_proses_transaksi_penghapusan();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('dashboard', $data);
    }    
}