<?php
class Produk_item_jurnal extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_PRODUK_ITEM_JURNAL');
        $this->load->model('maping_area/M_MAPING_AREA');
        $this->load->model('maping_ruangan/M_MAPING_RUANGAN');
        $this->load->model('maping_lokasi/M_MAPING_LOKASI');
        $this->load->model('departement/M_DEPARTEMENT');
        $this->load->model('produk_stok/M_PRODUK_STOK');
        $this->load->model('produk_item/M_PRODUK_ITEM');
        $this->load->helper('url_helper');
        $this->load->model('role/M_ROLE');
    }

    public function index($page = 'produk_stok')
    {

        $data['M_PRODUK_ITEM_JURNAL'] = $this->M_PRODUK_ITEM_JURNAL->get_produk_stok();
        $data['M_PRODUK_STOK'] = $this->M_PRODUK_STOK->get_produk_stok();
        $data['get_area'] = $this->M_MAPING_AREA->get_area();
        $data['get_ruangan'] = $this->M_MAPING_RUANGAN->get_maping_ruangan();
        $data['get_lokasi'] = $this->M_MAPING_LOKASI->get_maping_lokasi();
        $data['get_departemen'] = $this->M_DEPARTEMENT->get_departemen();
        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        //$data['get_kategori'] = $this->M_PRODUK_STOK->get_kategori();

        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item_jurnal', $data);
    }

    public function get_single($KODE_ITEM)
    {
        $result = $this->M_PRODUK_ITEM_JURNAL->get_produk_item_single($KODE_ITEM);
        echo json_encode($result);
    }

    public function get_produk_stok_by_area()
    {
        $AREA_PENEMPATAN = $this->input->post('AREA_PENEMPATAN');
        $RUANGAN_PENEMPATAN = $this->input->post('RUANGAN_PENEMPATAN');
        $LOKASI_PENEMPATAN = $this->input->post('LOKASI_PENEMPATAN');
        $DEPARTEMEN_PENEMPATAN = $this->input->post('DEPARTEMEN_PENEMPATAN');
        $result = $this->M_PRODUK_STOK->getProdukMaping($AREA_PENEMPATAN, $RUANGAN_PENEMPATAN, $LOKASI_PENEMPATAN, $DEPARTEMEN_PENEMPATAN);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function get_produk_by_kode_item()
    {
        $KODE_ITEM = $this->input->post('KODE_ITEM');
        $result = $this->M_PRODUK_ITEM->get_produk_item_single($KODE_ITEM);
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }

    public function get_produk_item_jurnal_detail()
    {
        $data = array(
            'AREA' => $this->input->post('AREA'),
            'DEPARTEMEN' => $this->input->post('DEPARTEMEN'),
            'RUANGAN' => $this->input->post('RUANGAN'),
            'LOKASI' => $this->input->post('LOKASI'),
            'KODE_ITEM' => $this->input->post('KODE_ITEM')
        );

        $result = $this->M_PRODUK_ITEM_JURNAL->get_produk_item_jurnal_detail($data);

        if ($result) {
            echo json_encode(array(
                'status' => 'success',
                'data' => $result
            ));
        } else {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ));
        }
    }

    public function get_kategori_produk()
    {
        $result = $this->M_PRODUK_ITEM_JURNAL->get_kategori_produk();
        echo json_encode($result);
    }


    public function tambah($page = 'produk_stok')
    {
        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'PRODUK ITEM JURNAL', 'TAMBAH');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM_JURNAL->get_kategori_produk();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item_jurnal_tambah', $data);
    }

    public function edit($KODE_ITEM, $page = 'produk_stok')
    {
        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'PRODUK ITEM JURNAL', 'EDIT');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_ITEM_JURNAL->get_produk_item_single($KODE_ITEM);
        $data['get_kategori_produk'] = $this->M_PRODUK_ITEM_JURNAL->get_kategori_produk();
        $data['get_produk_item'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item_jurnal_edit', $data);
    }

    public function detail($KODE_ITEM, $page = 'produk_stok')
    {
        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'PRODUK ITEM JURNAL', 'DETAIL');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $this->session->set_userdata('page', $page);
        $data['page'] = $this->session->userdata('page');
        $query = $this->M_PRODUK_ITEM_JURNAL->get_produk_item_single($KODE_ITEM);
        $data['get_produk_item'] = $query;
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('produk_item_jurnal_detail', $data);
    }


    public function insert()
    {
        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'PRODUK ITEM JURNAL', 'TAMBAH');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        // Ambil data dari POST
        $inputan = $this->input->post(null, TRUE);
        $KODE_ITEM = $this->input->post('KODE_ITEM');

        $config['upload_path'] = APPPATH . '../assets/uploads/item/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $KODE_ITEM;

        $this->load->library('upload', $config);
        $result = '';

        if (!$this->upload->do_upload('FOTO_ITEM')) {
            echo json_encode(['success' => false, 'error' => 'Gagal upload foto.']);
        } else {
            // Ambil data file yang diupload
            $data = $this->upload->data();
            $extension = $data['file_ext'];
            $inputan['FOTO_ITEM'] = $KODE_ITEM . $extension;

            $result = $this->M_PRODUK_ITEM_JURNAL->insert($inputan);
        }

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan data.']);
        }
    }

    public function update($KODE)
    {
        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'PRODUK ITEM JURNAL', 'EDIT');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        $KODE_ITEM = $KODE;
        $NAMA_ITEM = $this->input->post('NAMA_ITEM');
        $KODE_KATEGORI = $this->input->post('KODE_KATEGORI');
        $KETERANGAN_ITEM = $this->input->post('KETERANGAN_ITEM');

        // Validasi 
        $errors = [];
        if (empty($KODE_ITEM)) {
            $errors[] = 'KODE ITEM tidak boleh kosong.';
        }
        if (empty($NAMA_ITEM)) {
            $errors[] = 'NAMA ITEM tidak boleh kosong.';
        }
        if (empty($KODE_KATEGORI)) {
            $errors[] = 'KODE KATEGORI tidak boleh kosong.';
        }
        if (empty($KETERANGAN_ITEM)) {
            $errors[] = 'KETERANGAN ITEM tidak boleh kosong.';
        }

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'error' => implode(', ', $errors)]);
            return;
        }

        // Ambil data produk item lama
        $produk_item = $this->M_PRODUK_ITEM_JURNAL->get_produk_item_single($KODE_ITEM);
        $foto_lama = $produk_item->FOTO_ITEM;

        // Konfigurasi Upload
        $config['upload_path'] = APPPATH . '../assets/uploads/item/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $KODE_ITEM;

        $inputan = $this->input->post(null, TRUE);

        if (!empty($_FILES['FOTO_ITEM']['name'])) { // Jika ada file yang diupload
            // Hapus foto lama jika ada
            if (!empty($foto_lama) && file_exists(APPPATH . '../assets/uploads/item/' . $foto_lama)) {
                unlink(APPPATH . '../assets/uploads/item/' . $foto_lama);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('FOTO_ITEM')) {
                // Ambil data file baru
                $data = $this->upload->data();
                $extension = $data['file_ext'];
                $inputan['FOTO_ITEM'] = $KODE_ITEM . $extension;
            } else {
                echo json_encode(['success' => false, 'error' => 'Gagal upload foto.']);
                return;
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal upload foto.']);
            return;
        }

        // Update data di database
        $result = $this->M_PRODUK_ITEM_JURNAL->update($KODE_ITEM, $inputan);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal memperbarui data.']);
        }
    }


    public function hapus($KODE_ITEM)
    {

        $this->load->library('session');
        $SESSION_ROLE = $this->session->userdata('ROLE');
        $CEK_ROLE = $this->M_ROLE->get_role_session($SESSION_ROLE, 'PRODUK ITEM JURNAL', 'HAPUS');
        if (!$CEK_ROLE) {
            redirect('non_akses');
        }


        // Proses hapus data
        $result = $this->M_PRODUK_ITEM_JURNAL->hapus($KODE_ITEM);
        redirect('produk_item_jurnal');
    }

    // public function coba($KODE)
    // {
    //     $produk_item = $this->M_PRODUK_ITEM->get_produk_item_single($KODE);
    //     echo json_encode($produk_item);
    // }

    // Untuk Print Jurnal Per Item
    public function print_jurnal_per_item($kode_transaksi)
    {
        // Ambil data transaksi berdasarkan kode transaksi
        $transaksi = $this->M_PRODUK_ITEM_JURNAL->get_jurnal_produk_by_kode($kode_transaksi);

        // Ambil data item terkait
        $item = $this->M_PRODUK_ITEM->get_produk_item_single($transaksi->KODE_ITEM);
        $stok_akhir = $this->M_PRODUK_STOK->get_produk_stok_single_by_kode_item($transaksi->KODE_ITEM);

        // Ambil semua transaksi untuk item ini di lokasi yang sama
        $all_transaksi = $this->M_PRODUK_ITEM_JURNAL->get_all_jurnal_for_item(
            $transaksi->KODE_ITEM,
            $transaksi->AREA,
            $transaksi->DEPARTEMEN,
            $transaksi->RUANGAN,
            $transaksi->LOKASI
        );

        // Siapkan data untuk view
        $data = [
            'kode_item' => $item->KODE_ITEM,
            'nama_item' => $item->NAMA_ITEM,
            'kategori' => $item->NAMA_PRODUK_KATEGORI,
            'satuan' => $item->SATUAN,
            'keterangan_item' => $item->KETERANGAN_ITEM,
            'in_out' => $transaksi->IN_OUT,
            'jumlah' => $transaksi->JUMLAH,
            'area' => $transaksi->NAMA_AREA,
            'departemen' => $transaksi->NAMA_DEPARTEMEN,
            'stok_akhir' => $stok_akhir->JUMLAH_STOK,
            'ruangan' => $transaksi->NAMA_RUANGAN,
            'lokasi' => $transaksi->NAMA_LOKASI,
            'foto_item' => $item->FOTO_ITEM ? base_url('assets/uploads/item/' . $item->FOTO_ITEM) : null,
            'transaksi' => $all_transaksi
        ];

        // Load view print
        $this->load->view('produk_item_jurnal/print_jurnal_item_per_item', $data);
    }

    // MAS JUNIYAR
    public function print_jurnal_item_grouped_by_area()
    {
        // Ambil semua data jurnal yang sudah dikelompokkan
        $jurnal_data = $this->M_PRODUK_ITEM_JURNAL->get_all_jurnal_grouped_by_area();

        // Kelompokkan data berdasarkan area
        $grouped_data = [];
        foreach ($jurnal_data as $item) {
            $area_key = $item->AREA;
            if (!isset($grouped_data[$area_key])) {
                $grouped_data[$area_key] = [
                    'nama_area' => $item->NAMA_AREA,
                    'items' => []
                ];
            }
            $grouped_data[$area_key]['items'][] = $item;
        }

        // Siapkan data untuk view
        $data = [
            'grouped_data' => $grouped_data,
            'total_areas' => count($grouped_data),
            'total_items' => count($jurnal_data)
        ];

        // Load view
        $this->load->view('produk_item_jurnal/jurnal_item_report_v2', $data);
    }
    // MAS JUNIYAR
}
