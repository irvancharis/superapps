<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_ABSENSI');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
        $this->load->library('Uuid');

        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function index($page = 'absensi')
    {
        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'ABSENSI', 'LIST ABSENSI');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $data['M_ABSENSI'] = $this->M_ABSENSI->get_news();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $no = 1;

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('absensi', [$data, 'no' => $no]);
    }
}
