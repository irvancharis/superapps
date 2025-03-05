<?php
class M_TRANSAKSI_PENGADAAN extends CI_Model
{

    // Nama tabel
    protected $table = 'TRANSAKSI_PENGADAAN';
    protected $VIEW_KARYAWAN = 'VIEW_KARYAWAN';
    protected $VIEW_RUANGAN = 'VIEW_RUANGAN';
    protected $VIEW_LOKASI = 'VIEW_LOKASI';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    // Read
    public function get_data_view()
    {
        $this->db->where('STATUS_PENGADAAN !=' ,'SELESAI');
        $this->db->where('STATUS_PENGADAAN !=' ,'DITOLAK KABAG');
        $this->db->where('STATUS_PENGADAAN !=' ,'DITOLAK GM');
        $this->db->where('STATUS_PENGADAAN !=' ,'DITOLAK HEAD');
        $this->db->order_by('TANGGAL_PENGAJUAN', 'DESC');        
        $query = $this->db->get('VIEW_TRANSAKSI_PENGADAAN');
        return $query->result_object();
    }

    public function get_karyawan_by_departemen($kode,$key)
    {
        $this->db->where('ID_DEPARTEMENT', $kode);
        $this->db->where('NAMA_JABATAN', $key);
        $query = $this->db->get('VIEW_KARYAWAN');
        return $query->row();
    }

    public function getuser($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_USER');
        $this->db->where('ID_KARYAWAN', $KODE);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_data()
    {
        $this->db->select('TRANSAKSI_PENGADAAN.*, DEPARTEMEN.*');
        $this->db->from('TRANSAKSI_PENGADAAN');
        $this->db->join('DEPARTEMEN', 'TRANSAKSI_PENGADAAN.KODE_DEPARTEMEN_PENGAJUAN = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_data_transaksi($id_transaksi_pengadaan)
    {
        $this->db->select('
        TRANSAKSI_PENGADAAN.*, 
        DEPARTEMEN.*, 
        ');
        $this->db->from('TRANSAKSI_PENGADAAN');
        $this->db->join('DEPARTEMEN', 'TRANSAKSI_PENGADAAN.KODE_DEPARTEMEN_PENGAJUAN = DEPARTEMEN.KODE_DEPARTEMEN', 'left');
        $this->db->where('TRANSAKSI_PENGADAAN.UUID_TRANSAKSI_PENGADAAN', $id_transaksi_pengadaan);

        $sql = $this->db->get();
        $query = $sql->row();
        return $query; // Mengembalikan banyak row
    }

    public function get_data_transaksi_detail($id_transaksi_pengadaan)
    {
        $this->db->select('TRANSAKSI_PENGADAAN_DETAIL.*, PRODUK_ITEM.*');
        $this->db->from('TRANSAKSI_PENGADAAN_DETAIL');
        $this->db->join('PRODUK_ITEM', 'TRANSAKSI_PENGADAAN_DETAIL.KODE_PRODUK_ITEM = PRODUK_ITEM.KODE_ITEM', 'left');
        $this->db->where('UUID_TRANSAKSI_PENGADAAN', $id_transaksi_pengadaan);
        $query = $this->db->get();
        return $query->result(); // Mengembalikan banyak row
    }

    public function get_karyawan()
    {
        $query = $this->db->get('VIEW_KARYAWAN');
        return $query->result_object();
    }

    public function get_single($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TRANSAKSI_PENGADAAN');
        $this->db->where('UUID_TRANSAKSI_PENGADAAN', $KODE);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_detail_token($token)
    {
        $this->db->select('*');
        $this->db->from('TOKEN');
        $this->db->where('UUID_TOKEN', $token);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_detail($KODE)
    {
        $this->db->select('*');
        $this->db->from('VIEW_TRANSAKSI_PENGADAAN_DETAIL');
        $this->db->where('UUID_TRANSAKSI_PENGADAAN', $KODE);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_area()
    {
        $query = $this->db->get('MAPING_AREA');
        return $query->result_object();
    }

    public function get_ruangan()
    {
        $query = $this->db->get('MAPING_RUANGAN');
        return $query->result_object();
    }

    public function get_lokasi()
    {
        $query = $this->db->get('MAPING_LOKASI');
        return $query->result_object();
    }

    public function get_departemen()
    {
        $query = $this->db->get('DEPARTEMEN');
        return $query->result_object();
    }

    public function get_jabatan()
    {
        $query = $this->db->get('JABATAN');
        return $query->result_object();
    }

    public function get_ruangan_by_area($KODE_AREA)
    {
        $this->db->select("*");
        $this->db->from('VIEW_RUANGAN');
        $this->db->where('KODE_AREA', $KODE_AREA);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_lokasi_by_ruangan($KODE_RUANGAN)
    {
        $this->db->select("*");
        $this->db->from('VIEW_LOKASI');
        $this->db->where('KODE_RUANGAN', $KODE_RUANGAN);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_latest_data()
    {
        $this->db->order_by('IDTICKET', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_object();
    }



    // Create, Update, Delete

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($KODE_ITEM, $data)
    {
        $this->db->where('NIK', $KODE_ITEM);
        return $this->db->update($this->table, $data);
    }

    public function hapus($KODE_ITEM)
    {
        $this->db->where('NIK', $KODE_ITEM);
        return $this->db->delete($this->table);
    }

    // Approval KABAG, GM, HEAD
    public function update_transaksi($id_transaksi, $data)
    {
        $this->db->where('UUID_TRANSAKSI_PENGADAAN', $id_transaksi);
        return $this->db->update('TRANSAKSI_PENGADAAN', $data);
    }

    public function delete_detail($id_transaksi)
    {
        $this->db->where('UUID_TRANSAKSI_PENGADAAN', $id_transaksi);
        return $this->db->delete('TRANSAKSI_PENGADAAN_DETAIL');
    }

    public function insert_detail($data)
    {
        return $this->db->insert('TRANSAKSI_PENGADAAN_DETAIL', $data);
    }
}