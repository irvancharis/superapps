<?php

class Transaksi_pengadaan extends CI_Controller
 {
    public $data = array();

    public function __construct()
 {
        parent::__construct();
        $this->load->model('M_TRANSAKSI_PENGADAAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
    }

    public function index($page = 'transaksi_pengadaan')
    {
        $this->load->library('session');
        // echo $this->uuid->v4();

        $data[ 'M_TRANSAKSI_PENGADAAN' ] = $this->M_TRANSAKSI_PENGADAAN->get_data();
        $this->session->set_userdata( 'page', $page );
        $data[ 'page' ] = $this->session->userdata( 'page' );
        //$data[ 'get_kategori' ] = $this->M_TRANSAKSI_PENGADAAN->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan', $data);
    }

    public function get_single( $KODE )
 {
        $result = $this->M_TRANSAKSI_PENGADAAN->get_single( $KODE );
        echo json_encode( $result );
    }

    public function get_kategori_produk()
 {
        $result = $this->M_TRANSAKSI_PENGADAAN->get_kategori_produk();
        echo json_encode( $result );
    }

    public function transaksi_pengadaan_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');

        $this->load->view('transaksi_pengadaan_produk', $data);
    }

    public function transaksi_pengadaan_tambah_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_pengadaan');
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();

        $this->load->view('transaksi_pengadaan_tambah_produk', $data);
    }

    public function get_produk()
    {
        $search = $this->input->post('search')['value'];
        $search = strtoupper($search);

        log_message('error', 'Search query: ' . $search); // Tambahkan log ini

        if (empty($search)) {
            echo json_encode([
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ]);
            return;
        }

        $data = $this->M_PRODUK_ITEM->getFilteredProduk($search);

        log_message('error', 'Data returned: ' . json_encode($data)); // Tambahkan log ini

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }


    public function tambah($page = 'transaksi_pengadaan')
    {
        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['M_TRANSAKSI_PENGADAAN'] = $this->M_TRANSAKSI_PENGADAAN->get_data();
        $data['get_karyawan'] = $this->M_TRANSAKSI_PENGADAAN->get_karyawan();
        $data['get_area'] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data['get_ruangan'] = $this->M_TRANSAKSI_PENGADAAN->get_ruangan();
        $data['get_lokasi'] = $this->M_TRANSAKSI_PENGADAAN->get_lokasi();
        $data['get_departemen'] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data['get_jabatan'] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_pengadaan_tambah', $data);
    }

    public function edit( $KODE, $page = 'transaksi_pengadaan' )
 {
        $this->load->library( 'session' );
        $this->session->set_userdata( 'page', $page );
        $data[ 'page' ] = $this->session->userdata( 'page' );
        $query = $this->M_TRANSAKSI_PENGADAAN->get_single( $KODE );
        $data[ 'get_single' ] = $query->row();
        $data[ 'get_area' ] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data[ 'get_departemen' ] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data[ 'get_jabatan' ] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view( 'layout/navbar' ) .
        $this->load->view( 'layout/sidebar', $data ) .
        $this->load->view( 'karyawan_edit', $data );
    }

    public function detail( $KODE, $page = 'transaksi_pengadaan' )
 {
        $this->load->library( 'session' );
        $this->session->set_userdata( 'page', $page );
        $data[ 'page' ] = $this->session->userdata( 'page' );
        $query = $this->M_TRANSAKSI_PENGADAAN->get_single( $KODE );
        $data[ 'get_single' ] = $query->row();
        $data[ 'get_area' ] = $this->M_TRANSAKSI_PENGADAAN->get_area();
        $data[ 'get_departemen' ] = $this->M_TRANSAKSI_PENGADAAN->get_departemen();
        $data[ 'get_jabatan' ] = $this->M_TRANSAKSI_PENGADAAN->get_jabatan();
        $this->load->view( 'layout/navbar' ) .
        $this->load->view( 'layout/sidebar', $data ) .
        $this->load->view( 'karyawan_detail', $data );
    }

    public function insert()
    {
        $items = $this->input->post('items');
        $formData = $this->input->post('form');

        if (!empty($formData) && !empty($items)) {
            // Simpan data transaksi utama
            $data_transaksi = [
                'UUID_TRANSAKSI_PENGADAAN' => $this->uuid->v4(),
                'DEPARTEMEN_PENGAJUAN' => $formData['DEPARTEMEN_PENGAJUAN'],
                'TANGGAL_PENGAJUAN' => date('Y-m-d H:i:s'),
                'STATUS_PENGADAAN' => 0,
                'NO_REGISTER' => $formData['NO_REGISTER'],
            ];
            $this->db->insert('TRANSAKSI_PENGADAAN', $data_transaksi);

            // Simpan detail produk
            foreach ($items as $item) {
                $data_produk = [
                    'UUID_TRANSAKSI_PENGADAAN' => $this->uuid->v4(),
                    'KODE_PRODUK_ITEM' => $item['id'],
                    'JUMLAH_PENGADAAN' => $item['jumlah'],
                    'KEPERLUAN' => $item['keperluan'],
                    'AREA_PENEMPATAN' => $formData['AREA_PENEMPATAN'],
                    'RUANGAN_PENEMPATAN' => $formData['RUANGAN_PENEMPATAN'],
                    'LOKASI_PENEMPATAN' => $formData['LOKASI_PENEMPATAN']
                ];
                $this->db->insert('TRANSAKSI_PENGADAAN_DETAIL', $data_produk);
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function update()
 {
        $KODE_ITEM = $this->input->post( 'NIK' );

        // Validasi
        if ( empty( $KODE_ITEM ) ) {
            $errors[] = 'NIK tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
        $result = $this->M_TRANSAKSI_PENGADAAN->update($KODE_ITEM, $inputan);

        if ( $result ) {
            echo json_encode( [ 'success' => true ] );
        } else {
            echo json_encode( [ 'success' => false, 'error' => 'Gagal memperbarui data.' ] );
        }
    }

    public function hapus( $KODE_ITEM )
 {
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PENGADAAN->hapus( $KODE_ITEM );
        redirect( 'karyawan' );
    }
}