<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('M_LOGIN');
        $this->load->model('karyawan/M_KARYAWAN');
    }

    public function index()
    {

        $this->load->view('login');
    }


    public function ceklogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->M_LOGIN->getuser($username);
        $get_nik = $this->M_KARYAWAN->get_karyawan_by_id($user->ID_KARYAWAN);

        if ($user) {
            if (password_verify($password, $user->PASSWORD)) {
                $this->load->library('session');
                $this->session->set_userdata('isLoggedIn', true);
                $this->session->set_userdata('UUID_USER', $user->UUID_USER);
                $this->session->set_userdata('ID_AREA', $user->ID_MAPING_AREA);
                $this->session->set_userdata('NAMA_AREA', $user->NAMA_AREA);
                $this->session->set_userdata('ID_JABATAN', $user->ID_JABATAN);
                $this->session->set_userdata('NAMA_JABATAN', $user->NAMA_JABATAN);
                $this->session->set_userdata('ID_KARYAWAN', $user->ID_KARYAWAN);
                $this->session->set_userdata('NAMA_KARYAWAN', $user->NAMA_KARYAWAN);
                $this->session->set_userdata('ID_DEPARTEMEN', $user->ID_DEPARTEMENT);
                $this->session->set_userdata('NAMA_DEPARTEMEN', $user->NAMA_DEPARTEMEN);
                $this->session->set_userdata('ROLE', $user->KODE_ROLE);
                $this->session->set_userdata('NAMA_ROLE', $user->NAMA_ROLE);
                $this->session->set_userdata('NIK', $get_nik->NIK);

                return redirect('/dashboard');
            } else {
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('isLoggedIn', 'UUID_USER', 'ID_AREA', 'NAMA_AREA', 'ID_JABATAN', 'NAMA_JABATAN', 'ID_KARYAWAN', 'NAMA_KARYAWAN', 'ID_DEPARTEMEN', 'NAMA_DEPARTEMEN', 'ROLE', 'NAMA_ROLE'));
        return redirect('/login');
    }


    public function non_akses()
    {
        $this->load->view('akses');
    }
}
