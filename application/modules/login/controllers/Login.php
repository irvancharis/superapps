<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Login extends CI_Controller
 {
    public $data = array();

    public function __construct()
 {
        parent::__construct();
        $this->load->helper( 'url_helper' );
        $this->load->model('M_LOGIN');
    }

    public function index( )
 {

        $this->load->view( 'login' );
    }


    public function ceklogin()
 {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $user = $this->M_LOGIN->getuser($username);

                if ($user) {
                    if ($password == $user->PASSWORD) {
                        $this->load->library('session');
                        $this->session->set_userdata('isLoggedIn',true);
                        $this->session->set_userdata('UUID_USER',$user->UUID_USER);
                        $this->session->set_userdata('ID_AREA',$user->ID_AREA);
                        $this->session->set_userdata('NAMA_AREA',$user->NAMA_AREA);
                        $this->session->set_userdata('ID_JABATAN',$user->ID_JABATAN);
                        $this->session->set_userdata('NAMA_JABATAN',$user->NAMA_JABATAN);
                        $this->session->set_userdata('ID_KARYAWAN',$user->ID_KARYAWAN);
                        $this->session->set_userdata('ID_DEPARTEMEN',$user->ID_DEPARTEMENT);
                        $this->session->set_userdata('NAMA_DEPARTEMEN',$user->NAMA_DEPARTEMEN);
                        $this->session->set_userdata('ROLE',$user->KODE_ROLE);

                        return redirect()->to('/transaksi_opname');
                    } else {
                        echo json_encode(['success' => false, 'error' => 'password salah.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'email tidak terdaftar.']);
                }
    }

    public function logout()
 {
        $this->session->unset_userdata(array('isLoggedIn', 'UUID_USER'));
        return redirect()->to( '/login' );
    }


    public function non_akses()
 {
        $this->load->view( 'akses' );
    }

}