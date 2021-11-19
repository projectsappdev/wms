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
                <a href="#" class="d-block text-bold text-md-center" style="color: gray;"><?= session()->get('name') ?></a>
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
                    <a href="<?= site_url('dataEntry') ?>" class="nav-link" id="dashboardnav">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data Entry</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('review') ?>" class="nav-link" id="report">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Review</p>
                    </a>
                </li>
                <li class="nav-item" id="">
                    <a href="<?= site_url('backlog_barangay') ?>" class="nav-link" id="backlogbrgynav">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Backlog Input</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('change_password_barangay') ?>" class="nav-link" role="" id="changepass_userB">
                        <i class="fas fa-lock nav-icon"></i>
                        <p>Change Password</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="<?= site_url('userlogout') ?>" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p class="text-bold text-md-center">LOGOUT</p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>