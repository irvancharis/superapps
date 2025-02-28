<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="<?php echo base_url('assets/img/Logo SA.png'); ?>" class="header-logo" /> <span
                    class="logo-name">SAGROUP</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">MASTER</li>
            <li class="dropdown">
                <a href="<?php echo base_url('dashboard'); ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'maping_area') || (isset($page) && $page == 'maping_lokasi') || (isset($page) && $page == 'maping_ruangan') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="map"></i><span>Maping</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('maping_area'); ?>" class="nav-link"><i data-feather="map"></i><span>Area</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('maping_ruangan'); ?>" class="nav-link"><i data-feather="map"></i><span>Ruangan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('maping_lokasi'); ?>" class="nav-link"><i data-feather="map"></i><span>Lokasi</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'produk_item') || (isset($page) && $page == 'produk_kategori') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="box"></i><span>Produk</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('produk_kategori'); ?>" class="nav-link"><i data-feather="box"></i><span>Kategori</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('produk_item'); ?>" class="nav-link"><i data-feather="box"></i><span>Item</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('produk_stok'); ?>" class="nav-link"><i data-feather="box"></i><span>Stok</span></a>
                    </li>                    
                </ul>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'departement') || (isset($page) && $page == 'jabatan') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="layers"></i><span>Divisi</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('departement'); ?>" class="nav-link"><i data-feather="layers"></i><span>Departemen</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('jabatan'); ?>" class="nav-link"><i data-feather="layers"></i><span>Jabatan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('departement_joblist'); ?>" class="nav-link"><i data-feather="layers"></i><span>Joblist</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'karyawan') || (isset($page) && $page == 'technician') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Karyawan</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('karyawan'); ?>" class="nav-link"><i data-feather="users"></i><span>Karyawan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('technician'); ?>" class="nav-link"><i data-feather="user"></i><span>Teknisi</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'user') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="settings"></i><span>User</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('fitur'); ?>" class="nav-link"><i data-feather="settings"></i><span>Fitur</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('role'); ?>" class="nav-link"><i data-feather="settings"></i><span>Role</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('user'); ?>" class="nav-link"><i data-feather="settings"></i><span>User</span></a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Ticketing</li>
            <li class="dropdown <?php (isset($page) && $page == 'ticket') ? print 'active' : ''; ?>">
                <a href="<?php echo base_url('ticket'); ?>" class="nav-link"><i data-feather="mail"></i><span>Ticket</span></a>
            </li>
            <li class="menu-header">INVENTORY</li>
            <li class="dropdown <?php (isset($page) && $page == 'transaksi_pengadaan') ? print 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="dollar-sign"></i><span>Transaksi</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('transaksi_pengadaan'); ?>" class="nav-link"><i data-feather="dollar-sign"></i><span>Pengadaan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi_pemindahan'); ?>" class="nav-link"><i data-feather="dollar-sign"></i><span>Pemindahan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi_penghapusan'); ?>" class="nav-link"><i data-feather="dollar-sign"></i><span>Penghapusan</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi_opname'); ?>" class="nav-link"><i data-feather="dollar-sign"></i><span>Opname</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>