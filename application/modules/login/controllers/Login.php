<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Login extends CI_Controller
 {
    public $data = array();

    public function __construct()
 {
        parent::__construct();
        $this->load->helper( 'url_helper' );
    }

    public function index( )
 {

        $this->load->view( 'login' );
    }


    public function login()
 {
        helper( [ 'form' ] );

        if ( $this->request->getMethod() === 'post' ) {
            $rules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[username,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Username atau Password salah',
                ],
            ];

            if ( !$this->validate( $rules, $errors ) ) {
                $data[ 'validation' ] = $this->validator;
            } else {
                $model = new UserModel();

                $user = $model->where( 'username', $this->request->getVar( 'username' ) )->first();

                $this->setUserSession( $user );

                return redirect()->to( '/dashboard' );
            }
        }

        echo view( 'login' );
    }

    private function setUserSession( $user )
 {
        $data = [
            'id' => $user[ 'id' ],
            'username' => $user[ 'username' ],
            'isLoggedIn' => true,
        ];

        session()->set( $data );
        return true;
    }

    public function logout()
 {
        session()->destroy();
        return redirect()->to( '/login' );
    }

}