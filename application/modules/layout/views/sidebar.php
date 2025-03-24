<!-- Ambil Jumlah Ticket DALAM ANTRIAN -->
<?php
$CI = &get_instance();
$CI->load->model('ticket/M_TICKET'); // Load model dari module "ticket"
if ($this->session->userdata('NAMA_ROLE') == 'IT') {
    $jumlah_ticket = $CI->M_TICKET->count_ticket_by_approval(0)->JUMLAH_TICKET;
    if ($jumlah_ticket > 0) {
        $jumlah_ticket = $CI->M_TICKET->count_ticket_by_approval(0)->JUMLAH_TICKET;
    } else {
        $jumlah_ticket = 0;
    }
} elseif ($this->session->userdata('NAMA_ROLE') == 'IT TEKNISI') {
    $jumlah_ticket = $CI->M_TICKET->count_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 0)->JUMLAH_TICKET;
    if ($jumlah_ticket > 0) {
        $jumlah_ticket = $CI->M_TICKET->count_ticket_by_technician($this->session->userdata('ID_KARYAWAN'), 0)->JUMLAH_TICKET;
    } else {
        $jumlah_ticket = 0;
    }
}
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#"> <img alt="image" src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>"
                    class="header-logo" />
                <span class="logo-name"><span class="SA">SA</span> <span class="GROUP">GROUP</span></span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown">
                <a href="<?php echo base_url('dashboard'); ?>" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="menu-header">MASTER</li>

            <li
                class="dropdown <?php (isset($page) && $page == 'maping_area') || (isset($page) && $page == 'maping_lokasi') || (isset($page) && $page == 'maping_ruangan') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Maping</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('maping_area'); ?>" class="nav-link"><i
                                data-feather="map"></i><span>Area</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('maping_ruangan'); ?>" class="nav-link"><i
                                data-feather="map"></i><span>Ruangan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('maping_lokasi'); ?>" class="nav-link"><i
                                data-feather="map"></i><span>Lokasi</span></a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown <?php (isset($page) && $page == 'produk_item') || (isset($page) && $page == 'produk_kategori') || (isset($page) && $page == 'produk_stok') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="box"></i><span>Produk</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('produk_kategori'); ?>" class="nav-link"><i
                                data-feather="box"></i><span>Kategori</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('produk_item'); ?>" class="nav-link"><i
                                data-feather="box"></i><span>Item</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('produk_stok'); ?>" class="nav-link"><i
                                data-feather="box"></i><span>Stok</span></a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown <?php (isset($page) && $page == 'departement') || (isset($page) && $page == 'jabatan') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="layers"></i><span>Divisi</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('departement'); ?>" class="nav-link"><i
                                data-feather="layers"></i><span>Departemen</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('jabatan'); ?>" class="nav-link"><i
                                data-feather="layers"></i><span>Jabatan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('departement_joblist'); ?>" class="nav-link"><i
                                data-feather="layers"></i><span>Joblist</span></a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown <?php (isset($page) && $page == 'karyawan') || (isset($page) && $page == 'technician') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Karyawan</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('karyawan'); ?>" class="nav-link"><i
                                data-feather="users"></i><span>Karyawan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('technician'); ?>" class="nav-link"><i
                                data-feather="user"></i><span>Teknisi</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'user') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="settings"></i><span>User</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('fitur'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>Fitur</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('role'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>Role</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('user'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>User</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">

            <li class="menu-header">TRANSAKSI</li>

            <li class="dropdown <?php (isset($page) && $page == 'ticket') ? print 'active' : ''; ?>">
                <a href="<?php echo base_url('ticket'); ?>" class="nav-link"><i
                        data-feather="mail"></i><span>TICKET</span><span class="badge badge-primary"
                        style="width: auto;"><?php echo $jumlah_ticket; ?></span></a>
            </li>

            <li class="dropdown <?php (isset($page) && $page == 'transaksi') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="package"></i><span>INVENTORI</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('transaksi_pengadaan'); ?>" class="nav-link"><i
                                data-feather="dollar-sign"></i><span>Pengadaan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi_pemindahan'); ?>" class="nav-link"><i
                                data-feather="dollar-sign"></i><span>Pemindahan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi_penghapusan'); ?>" class="nav-link"><i
                                data-feather="dollar-sign"></i><span>Penghapusan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi_opname'); ?>" class="nav-link"><i
                                data-feather="dollar-sign"></i><span>Opname</span></a>
                    </li>
                </ul>
            </li>

            <li class="dropdown <?php (isset($page) && $page == 'checkup') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="settings"></i><span>CHECK
                        UP</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('checkup_cctv'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>CCTV</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('checkup_server'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>SERVER</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('checkup_jaringan'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>JARINGAN</span></a>
                    </li>
                </ul>
            </li>

            <li class="dropdown <?php (isset($page) && $page == 'absensi') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="settings"></i><span>ABSENSI</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('checkup_cctv'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>REKAP ABSENSI</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('checkup_server'); ?>" class="nav-link"><i
                                data-feather="settings"></i><span>SETTING ABSENSI</span></a>
                    </li>
                </ul>
            </li>

        </ul>


    </aside>
</div>