<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="<?php echo base_url('assets/img/Logo SA.png'); ?>" class="header-logo" /> <span
                    class="logo-name">SAGROUP</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
                <a href="index.html" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'departement') ? print 'active' : ''; ?>">
                <a href="<?php echo base_url('departement'); ?>" class="nav-link"><i data-feather="layers"></i><span>Departemen</span></a>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'jabatan') ? print 'active' : ''; ?>">
                <a href="<?php echo base_url('jabatan'); ?>" class="nav-link"><i data-feather="briefcase"></i><span>Jabatan</span></a>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'karyawan') ? print 'active' : ''; ?>">
                <a href="<?php echo base_url('karyawan'); ?>" class="nav-link"><i data-feather="users"></i><span>Karyawan</span></a>
            </li>
            <li class="dropdown <?php (isset($page) && $page == 'technician') ? print 'active' : ''; ?>">
                <a href="<?php echo base_url('technician'); ?>" class="nav-link"><i data-feather="user"></i><span>Teknisi</span></a>
            </li>
            <li class="menu-header">Ticketing</li>
        </ul>
    </aside>
</div>