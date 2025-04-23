<?php

class Transaksi_permintaan extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('role/M_ROLE');
        $this->load->model('M_TRANSAKSI_PERMINTAAN');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->model('produk_stok/M_PRODUK_STOK');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');

        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function index($page = 'transaksi')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PERMINTAAN', 'LIST');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        //echo $this->uuid->v4();

        $data['M_TRANSAKSI_PERMINTAAN'] = $this->M_TRANSAKSI_PERMINTAAN->get_data();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_permintaan', $data);
    }

    public function get_single($KODE)
    {
        $result = $this->M_TRANSAKSI_PERMINTAAN->get_single($KODE);
        echo json_encode($result);
    }

    public function get_kategori_produk()
    {
        $result = $this->M_TRANSAKSI_PERMINTAAN->get_kategori_produk();
        echo json_encode($result);
    }

    public function get_maping_default()
    {
        $area = $this->session->userdata('ID_AREA');
        $result = $this->M_TRANSAKSI_PERMINTAAN->get_maping_default($area);
        echo json_encode($result);
    }

    public function get_produk_by_aset()
    {
        $kode = $this->input->post('kode_aset');
        $result = $this->M_TRANSAKSI_PERMINTAAN->get_produk_by_aset($kode);
        echo json_encode($result);

    }

    public function get_produk_maping()
    {
        $this->load->library('session');

        $area = $this->uri->segment(3);
        $ruangan = $this->uri->segment(4);
        $lokasi = $this->uri->segment(5);
        $departemen = $this->uri->segment(6);
        $data['produk'] = $this->M_TRANSAKSI_PERMINTAAN->list_produk_maping($area, $ruangan, $lokasi, $departemen);
        $this->load->view('list_produk', $data);

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

        $data = $this->M_PRODUK_ITEM->getFilteredProdukStok($search);

        log_message('error', 'Data returned: ' . json_encode($data)); // Tambahkan log ini

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }

    public function get_produk_input_permintaan()
    {
        $KODE_AREA = $this->input->get('KODE_AREA');
        $KODE_RUANGAN = $this->input->get('KODE_RUANGAN');
        $KODE_LOKASI = $this->input->get('KODE_LOKASI');
        $KODE_DEPARTEMEN = $this->input->get('KODE_DEPARTEMEN');
        $result = $this->M_TRANSAKSI_PERMINTAAN->get_produk_input_permintaan($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function transaksi_permintaan_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_permintaan');
        $data['page'] = $this->session->userdata('page');

        $this->load->view('transaksi_permintaan_produk', $data);
    }

    public function transaksi_permintaan_tambah_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_permintaan');
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();

        $this->load->view('transaksi_permintaan_tambah_produk', $data);
    }

    public function get_ruangan_by_area()
    {
        $KODE_AREA = $this->input->post('AREA_PENEMPATAN');

        $result = $this->M_TRANSAKSI_PERMINTAAN->get_ruangan_by_area($KODE_AREA);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function tambah($page = 'transaksi_permintaan')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PERMINTAAN', 'PENGAJUAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_permintaan_tambah', $data);
    }

    public function tambah_by_aset($page = 'transaksi_permintaan')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PERMINTAAN', 'PENGAJUAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_permintaan_by_aset', $data);
    }

    public function aproval_kabag($KODE, $page = 'transaksi_permintaan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PERMINTAAN', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PERMINTAAN->get_single($KODE);
        $data['get_single'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_permintaan_aproval_kabag', $data);
    }

    

    public function proses_penyerahan($KODE, $page = 'transaksi_permintaan')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PERMINTAAN', 'PENYERAHAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PERMINTAAN->get_single($KODE);
        $data['get_single'] = $query;
        
        $KODE_DEPARTEMEN = $query->DEPARTEMEN_AKHIR;     
        $karyawan = $this->M_KARYAWAN->get_karyawan_by_departemen($KODE_DEPARTEMEN);        
        $data['karyawan'] = $karyawan;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_permintaan_proses', $data);
    }


    public function list_produk($KODE)
    {
        $query = $this->M_TRANSAKSI_PERMINTAAN->get_detail_single($KODE);
        echo json_encode($query);
    }

    public function list_maping($KODE)
    {
        $query = $this->M_TRANSAKSI_PERMINTAAN->get_single($KODE);
        echo json_encode($query);
    }

    public function detail($KODE, $page = 'transaksi_permintaan')
    {
        // $SESSION_ROLE = $this->session->userdata('ROLE');
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PERMINTAAN', 'DETAIL PERMINTAAN');
        // if (!$CEK_ROLE) {
        //     redirect('non_akses');
        // }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query_transaksi = $this->M_TRANSAKSI_PERMINTAAN->get_single($KODE);
        $query_detail_transaksi = $this->M_TRANSAKSI_PERMINTAAN->get_detail_single($KODE);
        $data['transaksi'] = $query_transaksi;
        $data['detail_transaksi'] = $query_detail_transaksi;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('detail', $data);
    }

    public function insert()
    {
        $inputan = $this->input->post(null, TRUE);
        $KODE_ITEM = $this->input->post('KODE_ITEM');
        $uuid_transaksi = $this->uuid->v4();

        $get_maping_default = $this->M_TRANSAKSI_PERMINTAAN->get_maping_default($this->session->userdata('ID_AREA'));

        $data_transaksi = [
            'USER_PENGAJUAN' => $this->session->userdata('ID_KARYAWAN'),
            'UUID_TRANSAKSI_PERMINTAAN' => $uuid_transaksi,
            'DEPARTEMEN_AWAL' => $get_maping_default->DEPARTEMEN,
            'TANGGAL_PENGAJUAN' => date('Y-m-d'),
            'KETERANGAN_PERMINTAAN' => $inputan['KETERANGAN_PERMINTAAN'],
            'AREA_AWAL' => $get_maping_default->AREA,      
            'RUANGAN_AWAL' => $get_maping_default->RUANGAN,
            'LOKASI_AWAL' => $get_maping_default->LOKASI,
            'AREA_AKHIR' => $inputan['AREA_AKHIR'],            
            'RUANGAN_AKHIR' => $inputan['RUANGAN_AKHIR'],
            'LOKASI_AKHIR' => $inputan['LOKASI_AKHIR'],
            'DEPARTEMEN_AKHIR' => $inputan['DEPARTEMEN_AKHIR'],            
            'STATUS_PERMINTAAN' => 'MENUNGGU APROVAL KABAG',
        ];

        $this->db->insert('TRANSAKSI_PERMINTAAN', $data_transaksi);

            $count = count($KODE_ITEM);            
            for ($i = 0; $i < $count; $i++) {
                    $data_produk = [
                        'UUID_TRANSAKSI_PERMINTAAN' => $uuid_transaksi,
                        'UUID_PRODUK_STOK' => $inputan['UUID_STOK'][$i],
                        'UUID_ASET' => isset($inputan['UUID_ASET'][$i]) ? $inputan['UUID_ASET'][$i] : null,
                        'JUMLAH_PERMINTAAN' => $inputan['JUMLAH_PERMINTAAN'][$i],
                        'KEPERLUAN' => $inputan['KETERANGAN_ITEM'][$i],
                    ];
                    $insert = $this->db->insert('TRANSAKSI_PERMINTAAN_DETAIL', $data_produk);

                }

            if ($insert) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
            }
        
    }


    public function disapprove_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PERMINTAAN'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_permintaan
        $data_update = [
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PERMINTAAN' => 'DITOLAK KABAG',
            'KETERANGAN_CANCEL_KABAG' => $form,
        ];

        $update = $this->M_TRANSAKSI_PERMINTAAN->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PERMINTAAN'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'KETERANGAN_PERMINTAAN' => $form['KETERANGAN_PERMINTAAN'],
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'STATUS_PERMINTAAN' => 'MENUNGGU PENYERAHAN',
        ];

        $update = $this->M_TRANSAKSI_PERMINTAAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        echo json_encode(['success' => true]);
    }


    public function update_proses_penyerahan()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PERMINTAAN'); // Ambil ID transaksi
        $USER_PENERIMA = $this->input->post('USER_PENERIMA');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'USER_PENYERAHAN' => $this->session->userdata('ID_KARYAWAN'),
            'USER_PENERIMA' => $USER_PENERIMA,
            'TANGGAL_REALISASI' => date('Y-m-d'),
            'STATUS_PERMINTAAN' => 'SELESAI',
        ];

        $update = $this->M_TRANSAKSI_PERMINTAAN->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        $items = $this->input->post('items');
        $list_maping = $this->input->post('form');  
                
        foreach ($items as $item) {
            //pengurangan stok
            $UUID_STOK = $item['UUID_STOK'];
            $data_produk = $item['JUMLAH_PERMINTAAN'];
            $this->M_TRANSAKSI_PERMINTAAN->pengurangan_real_stok($UUID_STOK, $data_produk);


            // Update stok barang jika barang tidak ada di tabel Produk_Stok maka Insert jika ada maka Update
            $cek_produk_stok = $this->M_PRODUK_STOK->get_produk_stok_single($item['KODE_ITEM'], $list_maping['AREA_AKHIR'],$list_maping['DEPARTEMEN_AKHIR'],$list_maping['RUANGAN_AKHIR'],$list_maping['LOKASI_AKHIR'] )->row();
            // echo json_encode($cek_produk_stok);
            // exit();
            
            if ($cek_produk_stok) {
                $data_update = [
                    'JUMLAH_STOK' => $cek_produk_stok->JUMLAH_STOK + $item['JUMLAH_PERMINTAAN']
                ];
                $this->M_PRODUK_STOK->update($cek_produk_stok->UUID_STOK, $data_update);
            } else {
                $data_insert = [
                    'UUID_STOK' => $this->uuid->v4(),
                    'KODE_ITEM' => $item['KODE_ITEM'],
                    'JUMLAH_STOK' => $item['JUMLAH_PERMINTAAN'],
                    'KODE_AREA' => $list_maping['AREA_AKHIR'],
                    'KODE_RUANGAN' => $list_maping['RUANGAN_AKHIR'],
                    'KODE_LOKASI' => $list_maping['LOKASI_AKHIR'],
                    'KODE_DEPARTEMEN' => $list_maping['DEPARTEMEN_AKHIR'],
                ];
                $this->M_PRODUK_STOK->insert($data_insert);
            }

            $data_jurnal_in = [
                'KODE_ITEM' => $item['KODE_ITEM'],
                'KODE_TRANSAKSI' => $list_maping['UUID_TRANSAKSI_PERMINTAAN'],
                'AREA' => $list_maping['AREA_AKHIR'],
                'RUANGAN' => $list_maping['RUANGAN_AKHIR'],
                'LOKASI' => $list_maping['LOKASI_AKHIR'],
                'DEPARTEMEN' => $list_maping['DEPARTEMEN_AKHIR'],
                'JUMLAH' => $item['JUMLAH_PERMINTAAN'],
                'JENIS_TRANSAKSI' => 'PENERIMAAN - PENYERAHAN BARANG',
                'TANGGAL_TRANSAKSI' => date('Y-m-d H:i:s'),
                'IN_OUT' => 'IN',

            ];
             $this->M_TRANSAKSI_PERMINTAAN->insert_produk_item_jurnal($data_jurnal_in);

             $data_jurnal_out = [
                'KODE_ITEM' => $item['KODE_ITEM'],
                'KODE_TRANSAKSI' => $list_maping['UUID_TRANSAKSI_PERMINTAAN'],
                'AREA' => $list_maping['AREA_AWAL'],
                'RUANGAN' => $list_maping['RUANGAN_AWAL'],
                'LOKASI' => $list_maping['LOKASI_AWAL'],
                'DEPARTEMEN' => $list_maping['DEPARTEMEN_AWAL'],
                'JUMLAH' => $item['JUMLAH_PERMINTAAN'],                
                'JENIS_TRANSAKSI' => 'PENERIMAAN - PENGELUARAN BARANG',
                'TANGGAL_TRANSAKSI' => date('Y-m-d H:i:s'),
                'IN_OUT' => 'OUT',

            ];
             $this->M_TRANSAKSI_PERMINTAAN->insert_produk_item_jurnal($data_jurnal_out);

        }

        


        echo json_encode(['success' => true]);
    }


    public function update()
    {
        $KODE_ITEM = $this->input->post('NIK');

        // Validasi
        if (empty($KODE_ITEM)) {
            $errors[] = 'NIK tidak boleh kosong.';
        }

        $inputan = $this->input->post(null, TRUE);
        $result = $this->M_TRANSAKSI_PERMINTAAN->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PERMINTAAN->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}