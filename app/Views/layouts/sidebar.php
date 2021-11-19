<aside class="main-sidebar bg-primary elevation-4" id="sidebarNavBar">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= base_url('assets/img/logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Dagupan City WMD</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar sidebar-light-primary" id="sidebar">
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
          <a href="<?= site_url('/dashboard') ?>" class="nav-link" id="dashboardnav">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item" id="manage_nav_item">
          <a href="#" class="nav-link" id="manage">
            <i class="nav-icon fas fa-user-edit"></i>
            <p>
              Manage
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('manage/users') ?>" class="nav-link" id="usernav">
                <i class="fas fa-user nav-icon"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('manage/admin') ?>" class="nav-link" id="adminnav">
                <i class="fas fa-user-secret nav-icon"></i>
                <p>Administrator</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('manage/waste') ?>" class="nav-link" id="wastenav">
                <i class="fas fa-recycle nav-icon"></i>
                <p>Waste</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item" id="monitoring_nav_item">
          <a href="# " class="nav-link" id="monitoring_nav">
            <i class="nav-icon fas fa-edit "></i>

            <p>Monitoring
              <i class="right fas fa-angle-left "></i>
            </p>
          </a>
          <ul class="nav nav-treeview ">
            <li class="nav-item ">
              <a href="<?= site_url("/waste/dumpsite") ?>" class="nav-link" id="dump_nav">
                <i class="nav-icon fas fa-dumpster  "></i>
                <p>Dumpsite</p>
              </a>
            </li>

            <li class="nav-item ">
              <a href="<?= site_url("/waste/barangay") ?>" class="nav-link" id="brgy_nav">
                <i class="nav-icon fas fa-home "></i>
                <p>Barangay</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item" id="settings_nav_item">
          <a href="#" class="nav-link" id="settings_nav">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('change_password_superadmin') ?>" class="nav-link" id="changePass">
                <i class="fas fa-lock nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('report') ?>" class="nav-link" id="report">
                <i class="far fa-file-archive nav-icon"></i>
                <p>Reports</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" id="setLimit">
                <i class="fas fa-ban nav-icon"></i>
                <p>Set Limit</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('others') ?>" class="nav-link" id="others">
                <i class="fas fa-globe nav-icon"></i>
                <p>Others</p>
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
<script>

</script>