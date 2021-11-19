<?= $this->include('layouts/header.php'); ?>
<style>
    .login-page {
        background: url("<?= base_url('assets/img/photo1.png') ?>");
        min-height: 100%;
        min-width: 100%;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        overflow-y: hidden;
        overflow-x: hidden;
    }
</style>

<body>

    <div class="hold-transition login-page">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo " style="width:110px; ">
        <nav class="navbar navbar-expand-md bg-primary navbar-dark fixed-top ">
            <a class="navbar-brand " href="admin.html ">
                <b> Dagupan City Waste Management Division</b></a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#collapsibleNavbar ">
                <span class="navbar-toggler-icon "></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse " id="collapsibleNavbar ">

                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link " href="# ">About Us</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="FAQ.html ">FAQ</a>
                    </li>
                </ul>
        </nav>
        <br>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-warning">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <div class="card" style="opacity: .6;">
            <div class="container">
                <div class="card-body " style="fill-opacity: 1;">
                    <p class="login-box-msg "><b>Please fill up needed information</b></p>

                    <form action="<?php echo base_url(); ?>/administrator/loginAuth" method="post">
                        <div class="input-group mb-3 ">
                            <input type="email" class="form-control" name="username" placeholder="Email ">
                            <div class="input-group-append ">
                                <div class="input-group-text ">
                                    <span class="fas fa-envelope "></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 ">
                            <input type="password" class="form-control" name="password" placeholder="Password ">
                            <div class="input-group-append ">
                                <div class="input-group-text ">
                                    <span class="fas fa-lock "></span>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-8 ">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                                    <label for="customCheckbox2" class="custom-control-label">Remember Me</label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4 ">
                                <button type="submit " class="btn btn-primary btn-block ">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>

                    </form>



                    <!-- /.login-card-body -->
                </div>
            </div>
            <!-- /.login-box -->
        </div>
    </div>


    <?= $this->include('layouts/script.php'); ?>
</body>

</html>