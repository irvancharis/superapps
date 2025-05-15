<?php

class Transaksi_produksi extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('role/M_ROLE');
        $this->load->model('M_TRANSAKSI_PRODUKSI');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('maping_default/M_MAPING_DEFAULT');
        $this->load->model('karyawan/M_KARYAWAN');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->model('produk_stok/M_PRODUK_STOK');
        $this->load->helper('url_helper');
        $this->load->library('Uuid');
        $this->load->library('TanggalIndo');
        $this->load->database();

        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function index($page = 'transaksi')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PRODUKSI', 'LIST');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        //echo $this->uuid->v4();

        $data['M_TRANSAKSI_PRODUKSI'] = $this->M_TRANSAKSI_PRODUKSI->get_data();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_produksi', $data);
    }

    public function get_single($KODE)
    {
        $result = $this->M_TRANSAKSI_PRODUKSI->get_single($KODE);
        echo json_encode($result);
    }

    public function get_kategori_produk()
    {
        $result = $this->M_TRANSAKSI_PRODUKSI->get_kategori_produk();
        echo json_encode($result);
    }

    public function get_maping_default()
    {
        $area = $this->session->userdata('ID_AREA');
        $result = $this->M_TRANSAKSI_PRODUKSI->get_maping_default($area);
        echo json_encode($result);
    }

    public function get_produk_by_aset()
    {
        $kode = $this->input->post('kode_aset');
        $result = $this->M_TRANSAKSI_PRODUKSI->get_produk_by_aset($kode);
        echo json_encode($result);
    }

    public function get_produk_maping()
    {
        $this->load->library('session');

        $area = $this->uri->segment(3);
        $ruangan = $this->uri->segment(4);
        $lokasi = $this->uri->segment(5);
        $departemen = $this->uri->segment(6);
        $data['produk'] = $this->M_TRANSAKSI_PRODUKSI->list_produk_maping($area, $ruangan, $lokasi, $departemen);
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

    public function get_produk_input_produksi()
    {
        $KODE_AREA = $this->input->get('KODE_AREA');
        $KODE_RUANGAN = $this->input->get('KODE_RUANGAN');
        $KODE_LOKASI = $this->input->get('KODE_LOKASI');
        $KODE_DEPARTEMEN = $this->input->get('KODE_DEPARTEMEN');
        $result = $this->M_TRANSAKSI_PRODUKSI->get_produk_input_produksi($KODE_AREA, $KODE_RUANGAN, $KODE_LOKASI, $KODE_DEPARTEMEN);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function transaksi_produksi_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_produksi');
        $data['page'] = $this->session->userdata('page');

        $this->load->view('transaksi_produksi_produk', $data);
    }

    public function transaksi_produksi_tambah_produk()
    {
        $this->load->library('session');
        $this->session->set_userdata('page', 'transaksi_produksi');
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM->get_kategori_produk();

        $this->load->view('transaksi_produksi_tambah_produk', $data);
    }

    public function get_ruangan_by_area()
    {
        $KODE_AREA = $this->input->post('AREA_PENEMPATAN');

        $result = $this->M_TRANSAKSI_PRODUKSI->get_ruangan_by_area($KODE_AREA);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function tambah($page = 'transaksi_produksi')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PRODUKSI', 'PENGAJUAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_produk'] = $this->M_PRODUK_ITEM->get_produk_custom();
        $data['get_karyawan'] = $this->M_KARYAWAN->get_karyawan();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_produksi_tambah', $data);
    }

    public function tambah_by_aset($page = 'transaksi_produksi')
    {

        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PRODUKSI', 'PENGAJUAN');
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
            $this->load->view('transaksi_produksi_by_aset', $data);
    }

    public function aproval_kabag($KODE, $page = 'transaksi_produksi')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PRODUKSI', 'APROVAL KABAG');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PRODUKSI->get_single($KODE);
        $data['get_single'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_produksi_aproval_kabag', $data);
    }



    public function proses_penyerahan_bahan($KODE, $page = 'transaksi_produksi')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PRODUKSI', 'PENYERAHAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PRODUKSI->get_single($KODE);
        $data['get_single'] = $query;
        $data['lokasi_asal'] = $this->M_MAPING_DEFAULT->get_maping_default_single($this->session->userdata('ID_AREA'));

        $KODE_DEPARTEMEN = $query->DEPARTEMEN;
        $karyawan = $this->M_KARYAWAN->get_karyawan_by_departemen($KODE_DEPARTEMEN);
        $data['karyawan'] = $karyawan;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_produksi_proses', $data);
    }

    public function proses_penyerahan_hasil($KODE, $page = 'transaksi_produksi')
    {
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PRODUKSI', 'PENYERAHAN');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_TRANSAKSI_PRODUKSI->get_single($KODE);
        $data['get_single'] = $query;
        $data['lokasi_asal'] = $this->M_MAPING_DEFAULT->get_maping_default_single($this->session->userdata('ID_AREA'));

        $KODE_DEPARTEMEN_AKHIR = $query->DEPARTEMEN;
        $karyawan = $this->M_KARYAWAN->get_karyawan();
        $data['karyawan'] = $karyawan;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('transaksi_produksi_penyerahan_hasil', $data);
    }


    public function list_produk($KODE)
    {
        $query = $this->M_TRANSAKSI_PRODUKSI->get_detail_single($KODE);
        echo json_encode($query);
    }

    public function list_maping($KODE)
    {
        $query = $this->M_TRANSAKSI_PRODUKSI->get_single($KODE);
        echo json_encode($query);
    }

    public function detail($KODE, $page = 'transaksi_produksi')
    {
        // $SESSION_ROLE = $this->session->userdata('ROLE');
        // $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'TRANSAKSI PRODUKSI', 'DETAIL PRODUKSI');
        // if (!$CEK_ROLE) {
        //     redirect('non_akses');
        // }

        $this->load->library('session');
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query_transaksi = $this->M_TRANSAKSI_PRODUKSI->get_single($KODE);
        $query_detail_transaksi = $this->M_TRANSAKSI_PRODUKSI->get_detail_single($KODE);
        $data['transaksi'] = $query_transaksi;
        $data['detail_transaksi'] = $query_detail_transaksi;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('detail', $data);
    }


    public function kirim_wa($data)
    {
        $setting = $this->db->get('SETTING')->row();
        $token_wa = $setting->TOKEN_WA;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $data['target'],
                'message' => $data['message'],
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token_wa
            ),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            echo $error_msg;
        }
    }

    public function insert()
    {
        $inputan = $this->input->post(null, TRUE);
        $KODE_ITEM = $this->input->post('KODE_ITEM');
        $uuid_transaksi = $this->uuid->v4();

        $get_maping_default = $this->M_TRANSAKSI_PRODUKSI->get_maping_default($this->session->userdata('ID_AREA'));

        $data_transaksi = [
            'USER_PENGAJUAN' => $this->session->userdata('ID_KARYAWAN'),
            'UUID_TRANSAKSI_PRODUKSI' => $uuid_transaksi,
            'TANGGAL_PENGAJUAN' => date('Y-m-d H:i:s'),
            'KETERANGAN' => $inputan['KETERANGAN'],
            'JUMLAH_ESTIMASI_PRODUKSI' => $inputan['JUMLAH_PRODUKSI'],
            'AREA' => $get_maping_default->AREA,
            'DEPARTEMEN' => $inputan['DEPARTEMEN'],
            'STATUS_TRANSAKSI_PRODUKSI' => 'MENUNGGU PENYERAHAN BAHAN',
        ];

        $this->db->insert('TRANSAKSI_PRODUKSI', $data_transaksi);
        $get_transaksi = $this->db->get_where('VIEW_TRANSAKSI_PRODUKSI', ['UUID_TRANSAKSI_PRODUKSI' => $uuid_transaksi])->row();

        $count = count($KODE_ITEM);
        for ($i = 0; $i < $count; $i++) {
            $data_produk = [
                'UUID_TRANSAKSI_PRODUKSI' => $uuid_transaksi,
                'UUID_PRODUK_STOK' => $inputan['UUID_STOK'][$i],
                'KODE_ITEM' => $inputan['KODE_ITEM'][$i],
                'JUMLAH_KEBUTUHAN' => $inputan['JUMLAH_KEBUTUHAN'][$i],
            ];
            $insert = $this->db->insert('TRANSAKSI_PRODUKSI_DETAIL', $data_produk);
        }

        if ($insert) {

            //                 $get_kontak_kabag = $this->M_TRANSAKSI_PRODUKSI->get_karyawan_by_departemen($inputan['DEPARTEMEN_AKHIR'], 'KABAG');                

            //                 $data = [
            //                 "target" => $get_kontak_kabag->TELEPON,
            //                 "message" => 'PEMBERITAHUAN!
            // Transaksi Produksi Baru dengan detail berikut:

            // Nomor Transaksi: ' . $uuid_transaksi . '
            // Departemen : ' . $get_transaksi->NAMA_DEPARTEMEN_AKHIR . '
            // User Pengajuan: ' . $this->session->userdata('NAMA_KARYAWAN') . '
            // Tanggal Pengajuan: ' . $get_transaksi->TANGGAL_PENGAJUAN . '
            // Total Item: ' . $count . '
            // Keterangan: ' . $get_transaksi->KETERANGAN_PRODUKSI . '

            // Mohon segera ditindaklanjuti untuk kelancaran proses produksi. Terima kasih!

            // Salam,
            // Sejahtera Abadi Group'
            //             ];

            //             //send message
            //             $this->kirim_wa($data);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function disapprove_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PRODUKSI'); // Ambil ID transaksi
        $form = $this->input->post('KETERANGAN_CANCEL');

        // Update tabel transaksi_produksi
        $data_update = [
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'STATUS_PRODUKSI' => 'DITOLAK KABAG',
            'KETERANGAN_CANCEL_KABAG' => $form,
        ];

        $update = $this->M_TRANSAKSI_PRODUKSI->update_transaksi($id_transaksi, $data_update);

        if ($update) {
            echo json_encode(['success' => true]); 
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function update_approval_kabag()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PRODUKSI'); // Ambil ID transaksi


        $form = $this->input->post('form');
        $items = $this->input->post('items');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'KODE_APROVAL_KABAG' => $this->session->userdata('ID_KARYAWAN'),
            'KETERANGAN_PRODUKSI' => $form['KETERANGAN_PRODUKSI'],
            'TANGGAL_APROVAL_KABAG' => date('Y-m-d'),
            'STATUS_PRODUKSI' => 'MENUNGGU PENYERAHAN',
        ];

        $update = $this->M_TRANSAKSI_PRODUKSI->update_transaksi($id_transaksi, $data_update);

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        echo json_encode(['success' => true]);
    }


    public function update_proses_penyerahan()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PRODUKSI'); // Ambil ID transaksi
        $USER_PENERIMA_BAHAN = $this->input->post('USER_PENERIMA_BAHAN');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'USER_PENYERAHAN_BAHAN' => $this->session->userdata('ID_KARYAWAN'),
            'USER_PENERIMA_BAHAN' => $USER_PENERIMA_BAHAN,
            'TANGGAL_PENYERAHAN_BAHAN' => date('Y-m-d H:i:s'),
            'STATUS_TRANSAKSI_PRODUKSI' => 'PROSES PRODUKSI',
        ];

        $update = $this->M_TRANSAKSI_PRODUKSI->update_transaksi($id_transaksi, $data_update);

        $get_transaksi = $this->db->get_where('VIEW_TRANSAKSI_PRODUKSI', ['UUID_TRANSAKSI_PRODUKSI' => $id_transaksi])->row();

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        $items = $this->input->post('items');
        $list_maping = $this->input->post('form');
        $lokasiAsal = $this->input->post('lokasiAsal');

        $count = count($items);

        foreach ($items as $item) {
            //pengurangan stok
            $UUID_STOK = $item['UUID_PRODUK_STOK'];
            $data_produk = $item['JUMLAH_KEBUTUHAN'];
            $this->M_TRANSAKSI_PRODUKSI->pengurangan_real_stok($UUID_STOK, $data_produk);


            // Update stok barang jika barang tidak ada di tabel Produk_Stok maka Insert jika ada maka Update
            $cek_produk_stok = $this->M_PRODUK_STOK->get_produk_stok_single($item['KODE_ITEM'], $list_maping['AREA'], $list_maping['DEPARTEMEN'], $list_maping['RUANGAN'], $list_maping['LOKASI'])->row();
            // echo json_encode($cek_produk_stok);
            // exit();

            if ($cek_produk_stok) {
                $data_update = [
                    'JUMLAH_STOK' => $cek_produk_stok->JUMLAH_STOK + $item['JUMLAH_KEBUTUHAN'],
                ];
                $this->M_PRODUK_STOK->update($cek_produk_stok->UUID_STOK, $data_update);
            } else {
                $data_insert = [
                    'UUID_STOK' => $this->uuid->v4(),
                    'KODE_ITEM' => $item['KODE_ITEM'],
                    'JUMLAH_STOK' => $item['JUMLAH_KEBUTUHAN'],
                    'KODE_AREA' => $list_maping['AREA'],
                    'KODE_RUANGAN' => $list_maping['RUANGAN'],
                    'KODE_LOKASI' => $list_maping['LOKASI'],
                    'KODE_DEPARTEMEN' => $list_maping['DEPARTEMEN'],
                ];
                $this->M_PRODUK_STOK->insert($data_insert);
            }

            $data_jurnal_in = [
                'KODE_ITEM' => $item['KODE_ITEM'],
                'KODE_TRANSAKSI' => $list_maping['UUID_TRANSAKSI_PRODUKSI'],
                'AREA' => $list_maping['AREA'],
                'RUANGAN' => $list_maping['RUANGAN'],
                'LOKASI' => $list_maping['LOKASI'],
                'DEPARTEMEN' => $list_maping['DEPARTEMEN'],
                'JUMLAH' => $item['JUMLAH_KEBUTUHAN'],
                'JENIS_TRANSAKSI' => 'PENERIMAAN - PENYERAHAN BARANG',
                'TANGGAL_TRANSAKSI' => date('Y-m-d H:i:s'),
                'IN_OUT' => 'IN',

            ];
            $this->M_TRANSAKSI_PRODUKSI->insert_produk_item_jurnal($data_jurnal_in);

            $data_jurnal_out = [
                'KODE_ITEM' => $item['KODE_ITEM'],
                'KODE_TRANSAKSI' => $list_maping['UUID_TRANSAKSI_PRODUKSI'],
                'AREA' => $lokasiAsal['AREA'],
                'RUANGAN' => $lokasiAsal['RUANGAN'],
                'LOKASI' => $lokasiAsal['LOKASI'],
                'DEPARTEMEN' => $lokasiAsal['DEPARTEMEN'],
                'JUMLAH' => $item['JUMLAH_KEBUTUHAN'],
                'JENIS_TRANSAKSI' => 'PENERIMAAN - PENGELUARAN BARANG',
                'TANGGAL_TRANSAKSI' => date('Y-m-d H:i:s'),
                'IN_OUT' => 'OUT',

            ];
            $this->M_TRANSAKSI_PRODUKSI->insert_produk_item_jurnal($data_jurnal_out);
        }

        $get_kontak_kabag = $this->M_TRANSAKSI_PRODUKSI->get_karyawan_by_departemen($list_maping['DEPARTEMEN'], 'KABAG');
        $get_user_penyerahan_bahan = $this->M_KARYAWAN->get_karyawan_by_id($get_transaksi->USER_PENYERAHAN_BAHAN);
        $get_user_penerima_bahan = $this->M_KARYAWAN->get_karyawan_by_id($get_transaksi->USER_PENERIMA_BAHAN);

        $data = [
            "target" => $get_kontak_kabag->TELEPON,
            "message" => 'PEMBERITAHUAN!
                        Transaksi Produksi sudah diterima dengan detail berikut:

                        Nomor Transaksi : ' . $id_transaksi . '
                        Departemen : ' . $get_transaksi->NAMA_DEPARTEMEN . '
                        User Pengajuan : ' . $get_transaksi->NAMA_PENGAJUAN . '
                        Tanggal Pengajuan : ' . $get_transaksi->TANGGAL_PENGAJUAN . '
                        User Realisasi : ' . $get_user_penyerahan_bahan->NAMA_KARYAWAN . '
                        User Penerima : ' . $get_user_penerima_bahan->NAMA_KARYAWAN . '
                        Tanggal Realisasi : ' . $get_transaksi->TANGGAL_PENYERAHAN_BAHAN . '
                        Total Item : ' . $count . '
                        Keterangan : ' . $get_transaksi->KETERANGAN . '

                        Terimakasih

                        Salam,
                        Sejahtera Abadi Group'
        ];

        //send message
        $this->kirim_wa($data);

        echo json_encode(['success' => true]);
    }

    public function update_proses_penyerahan_hasil()
    {
        $id_transaksi = $this->input->post('UUID_TRANSAKSI_PRODUKSI'); // Ambil ID transaksi
        $USER_PENERIMA_HASIL_PRODUKSI = $this->input->post('USER_PENERIMA_HASIL_PRODUKSI');

        // Update tabel transaksi_pengadaan
        $data_update = [
            'USER_PENYERAHAN_HASIL_PRODUKSI' => $this->session->userdata('ID_KARYAWAN'),
            'USER_PENERIMA_HASIL_PRODUKSI' => $USER_PENERIMA_HASIL_PRODUKSI,
            'TGL_PENYERAHAN_HASIL_PRODUKSI' => date('Y-m-d H:i:s'),
            'STATUS_TRANSAKSI_PRODUKSI' => 'SELESAI',
        ];

        $update = $this->M_TRANSAKSI_PRODUKSI->update_transaksi($id_transaksi, $data_update);

        $get_transaksi = $this->db->get_where('VIEW_TRANSAKSI_PRODUKSI', ['UUID_TRANSAKSI_PRODUKSI' => $id_transaksi])->row();

        if (!$update) {
            echo json_encode(['success' => false, 'error' => 'Gagal update transaksi_pengadaan!']);
            return;
        }

        $items = $this->input->post('items');
        $list_maping = $this->input->post('form');
        $lokasiAsal = $this->input->post('lokasiAsal');

        $count = count($items);

        foreach ($items as $item) {
            //pengurangan stok
            $UUID_STOK = $item['UUID_PRODUK_STOK'];
            $data_produk = $item['JUMLAH_KEBUTUHAN'];
            $this->M_TRANSAKSI_PRODUKSI->pengurangan_real_stok($UUID_STOK, $data_produk);


            // Update stok barang jika barang tidak ada di tabel Produk_Stok maka Insert jika ada maka Update
            $cek_produk_stok = $this->M_PRODUK_STOK->get_produk_stok_single($item['KODE_ITEM'], $list_maping['AREA'], $list_maping['DEPARTEMEN'], $list_maping['RUANGAN'], $list_maping['LOKASI'])->row();
            // echo json_encode($cek_produk_stok);
            // exit();

            if ($cek_produk_stok) {
                $data_update = [
                    'JUMLAH_STOK' => $cek_produk_stok->JUMLAH_STOK + $item['JUMLAH_KEBUTUHAN'],
                ];
                $this->M_PRODUK_STOK->update($cek_produk_stok->UUID_STOK, $data_update);
            } else {
                $data_insert = [
                    'UUID_STOK' => $this->uuid->v4(),
                    'KODE_ITEM' => $item['KODE_ITEM'],
                    'JUMLAH_STOK' => $item['JUMLAH_KEBUTUHAN'],
                    'KODE_AREA' => $list_maping['AREA'],
                    'KODE_RUANGAN' => $list_maping['RUANGAN'],
                    'KODE_LOKASI' => $list_maping['LOKASI'],
                    'KODE_DEPARTEMEN' => $list_maping['DEPARTEMEN'],
                ];
                $this->M_PRODUK_STOK->insert($data_insert);
            }

            $data_jurnal_in = [
                'KODE_ITEM' => $item['KODE_ITEM'],
                'KODE_TRANSAKSI' => $list_maping['UUID_TRANSAKSI_PRODUKSI'],
                'AREA' => $list_maping['AREA'],
                'RUANGAN' => $list_maping['RUANGAN'],
                'LOKASI' => $list_maping['LOKASI'],
                'DEPARTEMEN' => $list_maping['DEPARTEMEN'],
                'JUMLAH' => $item['JUMLAH_KEBUTUHAN'],
                'JENIS_TRANSAKSI' => 'PENERIMAAN - PENYERAHAN BARANG',
                'TANGGAL_TRANSAKSI' => date('Y-m-d H:i:s'),
                'IN_OUT' => 'IN',

            ];
            $this->M_TRANSAKSI_PRODUKSI->insert_produk_item_jurnal($data_jurnal_in);

            $data_jurnal_out = [
                'KODE_ITEM' => $item['KODE_ITEM'],
                'KODE_TRANSAKSI' => $list_maping['UUID_TRANSAKSI_PRODUKSI'],
                'AREA' => $lokasiAsal['AREA'],
                'RUANGAN' => $lokasiAsal['RUANGAN'],
                'LOKASI' => $lokasiAsal['LOKASI'],
                'DEPARTEMEN' => $lokasiAsal['DEPARTEMEN'],
                'JUMLAH' => $item['JUMLAH_KEBUTUHAN'],
                'JENIS_TRANSAKSI' => 'PENERIMAAN - PENGELUARAN BARANG',
                'TANGGAL_TRANSAKSI' => date('Y-m-d H:i:s'),
                'IN_OUT' => 'OUT',

            ];
            $this->M_TRANSAKSI_PRODUKSI->insert_produk_item_jurnal($data_jurnal_out);
        }

        $get_kontak_kabag = $this->M_TRANSAKSI_PRODUKSI->get_karyawan_by_departemen($list_maping['DEPARTEMEN'], 'KABAG');
        $get_user_penyerahan_hasil_produksi = $this->M_KARYAWAN->get_karyawan_by_id($get_transaksi->USER_PENYERAHAN_HASIL_PRODUKSI);
        $get_user_penerima_hasil_produksi = $this->M_KARYAWAN->get_karyawan_by_id($get_transaksi->USER_PENERIMA_HASIL_PRODUKSI);

        $data = [
            "target" => $get_kontak_kabag->TELEPON,
            "message" => 'PEMBERITAHUAN!
                        Transaksi Produksi sudah diterima dengan detail berikut:

                        Nomor Transaksi : ' . $id_transaksi . '
                        Departemen : ' . $get_transaksi->NAMA_DEPARTEMEN . '
                        User Pengajuan : ' . $get_transaksi->NAMA_PENGAJUAN . '
                        Tanggal Pengajuan : ' . $get_transaksi->TANGGAL_PENGAJUAN . '
                        User Realisasi : ' . $get_user_penyerahan_hasil_produksi->NAMA_KARYAWAN . '
                        User Penerima : ' . $get_user_penerima_hasil_produksi->NAMA_KARYAWAN . '
                        Tanggal Realisasi : ' . $get_transaksi->TANGGAL_PENYERAHAN_BAHAN . '
                        Total Item : ' . $count . '
                        Keterangan : ' . $get_transaksi->KETERANGAN . '

                        Terimakasih

                        Salam,
                        Sejahtera Abadi Group'
        ];

        //send message
        $this->kirim_wa($data);

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
        $result = $this->M_TRANSAKSI_PRODUKSI->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function hapus($KODE_ITEM)
    {
        // Proses hapus data
        $result = $this->M_TRANSAKSI_PRODUKSI->hapus($KODE_ITEM);
        redirect('karyawan');
    }
}
