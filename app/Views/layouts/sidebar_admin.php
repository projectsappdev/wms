<aside class="main-sidebar bg-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dagupan City WMD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-light-primary">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-bold text-md-center" style="color: gray;"><?= session()->get('lname') ?></a>
            </div>
        </div>

        <nav class=" mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="darkmode" class="dmode">
                            <label class=" custom-control-label" for="darkmode" id="cbox" style="color: white;"></label>
                        </div>
                    </div>
            </ul>
            </li>
        </nav>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">

                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item" id="">
                    <a href="<?= site_url('/dashboards') ?>" class="nav-link" id="dashboardnav">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item menu-close" id="settings_nav_item">
                    <a href="#" class="nav-link" id="settings_nav">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('change_password_administrator') ?>" class="nav-link" id="changepass_administrator">
                                <i class="fas fa-lock nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('reports') ?>" class="nav-link" id="report">
                                <i class="far fa-file-archive nav-icon"></i>
                                <p>Reports</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('logout') ?>" class="nav-link">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <p class="text-bold text-md-center">LOGOUT</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>