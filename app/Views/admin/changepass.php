<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>


            <div class="container">

                <section class="content ">

                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-8">
                                <!-- jquery validation -->
                                <div class="card card-primary">
                                    <div class="card-header">

                                        <h3 class="card-title">
                                            Change Password
                                        </h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">

                                        <form id="pass_form">
                                            <div class="form-group">
                                                <h5 id="passcheck" style="color: red;">
                                                    **Please Fill the password field**
                                                </h5>
                                                <input type="text" class="form-control" placeholder="New Password" name="password" id="password">
                                            </div>
                                            <button type="submit" disabled id="btnchangePass" name="btnchangePass" class="btn btn-success">Save Password</button>
                                        </form>
                                    </div>
                                    <div class="card-footer">


                                    </div>


                                    <!-- /.card -->
                                </div>
                                <!--/.col (left) -->
                                <!-- right column -->
                                <div class="col-md-6">

                                </div>
                                <!--/.col (right) -->
                            </div>
                            <!-- /.row -->
                        </div>


                </section>



            </div>

        </div>
    </div>

    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>

</body>
<Script>
    $(document).ready(function() {
        $(".Page_title").text("Change Password");
        $("#b_crumb_subtitle").text("Change Password");
        $('#changePass').addClass("active");
        $('#settings_nav').addClass('active');

    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo base_url("/mode/dJson"); ?>",
            method: "POST",
            datatype: "JSON",
            success: function(data) {
                var fmode = JSON.parse(data);
                if (fmode['mode'] == 'on') {
                    $('#mybody').attr("class", "hold-transition sidebar-mini dark-mode layout-navbar-fixed layout-fixed");
                    $('#mynav').attr("class", "main-header navbar navbar-expand navbar-dark");
                    $('#sidebar').attr("class", "sidebar sidebar-dark-primary");
                    $('#sidebarNavBar').attr("class", "main-sidebar sidebar-dark-primary elevation-4");
                    //   $('#add_record').attr("class", "btn bg-gradient-info btn-sm");
                    $('#darkmode').prop('checked', true);
                } else {
                    $('#mybody').attr("class", "hold-transition sidebar-mini layout-navbar-fixed layout-fixed");
                    $('#mynav').attr("class", "main-header navbar navbar-expand navbar-primary navbar-light");
                    $('#sidebar').attr("class", "sidebar sidebar-light-primary");
                    $('#sidebarNavBar').attr("class", "main-sidebar bg-primary elevation-4");
                    //    $('#add_record').attr("class", "btn bg-gradient-dark btn-sm");
                    $('#darkmode').prop('checked', false);
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        /*  $("#b_crumb_title").text("Voters");
          $("#b_crumb_subtitle").text("Voters");
          $("#voters").addClass("active");
          $('#manage').attr("class", "nav-item menu-open"); */

        $('#darkmode').click(function() {
            if ($('#darkmode').prop('checked')) {
                $.ajax({
                    url: "<?php echo base_url('/mode/modeOn'); ?>",
                    method: "POST",
                    datatype: "JSON",
                    success: function(data) {
                        $('#mybody').attr("class", "hold-transition sidebar-mini dark-mode layout-navbar-fixed layout-fixed");
                        $('#mynav').attr("class", "main-header navbar navbar-expand navbar-dark");
                        $('#sidebar').attr("class", "sidebar sidebar-dark-primary");
                        $('#sidebarNavBar').attr("class", "main-sidebar sidebar-dark-primary elevation-4");
                        //    $('#add_record').attr("class", "btn bg-gradient-info btn-sm");
                        $('#darkmode').prop('checked', true);
                    }
                });
            } else {
                $.ajax({
                    url: "<?php echo base_url('/mode/modeOff'); ?>",
                    method: "POST",
                    datatype: "JSON",
                    success: function(data) {
                        $('#mybody').attr("class", "hold-transition sidebar-mini layout-navbar-fixed layout-fixed");
                        $('#mynav').attr("class", "main-header navbar navbar-expand navbar-primary navbar-light");
                        $('#sidebar').attr("class", "sidebar sidebar-light-primary");
                        $('#sidebarNavBar').attr("class", "main-sidebar bg-primary elevation-4");
                        //   $('#add_record').attr("class", "btn bg-gradient-dark btn-sm");
                        $('#darkmode').prop('checked', false);
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#passcheck').hide();
        let passwordError = true;
        $('#password').keyup(function() {
            validatePassword();
        });

        function validatePassword() {
            let passwrdValue =
                $('#password').val();
            if (passwrdValue.length == '') {
                $('#passcheck').show();
                $('#btnchangePass').attr('disabled', 'disabled');
                passwordError = false;
                return false;
            }
            if ((passwrdValue.length < 5) || (passwrdValue.length > 10)) {
                $('#passcheck').show();
                $('#passcheck').html("**length of your password must be betweeen 5 and 10**");
                $('#passcheck').css("color", "red");
                passwordError = false;
                $('#btnchangePass').attr('disabled', 'disabled');
                return false;
            } else {
                $('#passcheck').hide();
                $('#btnchangePass').attr('disabled', false);
            }
        }

        $('#pass_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('Password/UpdatePassAdmin') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.card-title').text('Changing...');
                    $('#btnchangePass').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#btnchangePass').attr('disabled', false);
                    $('.card-title').text('Change Password');
                    if (data.error == 'yes') {
                        console.log(data.error);
                    } else {
                        toastr.success('Password has changed!');
                        $('#pass_form')[0].reset();
                    }

                }

            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        load_unseen_notif();
        timesTamps();
        $('.notif_seen').click(function() {
            $.ajax({
                url: "<?= site_url('notif')  ?>",
                method: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status_a == 0) {
                        $('.badge').html('');
                        $('#num').html(data.status_a);
                        $('.dropdown-header').html(data.status_a);
                    } else {
                        $('.badge').html(data.status_a);
                        $('#num').html(data.status_a);
                        $('.dropdown-header').html(data.status_a + " " + "Notifications");
                    }

                }

            });
        });

        function load_unseen_notif() {
            $.ajax({
                url: "<?= site_url('notif/load_unseen')  ?>",
                method: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.stat == 0) {
                        $('.badge').html('');
                        $('#num').html(data.status_a);
                        $('.dropdown-header').html(data.status_a);
                    } else {
                        $('.badge').html(data.status_a);
                        $('#num').html(data.status_a);
                        $('.dropdown-header').html(data.status_a + " " + "Notifications");
                    }

                }

            });
        }

        function timesTamps() {
            $.ajax({
                url: "<?= site_url('notif/timeStamp')  ?>",
                method: "POST",
                dataType: "JSON",
                success: function(data) {
                    var a = new Date(data.collection_date);
                    $('.timesTamp').html(a.getMinutes() + " mins ago");

                }

            });
        }

    });
</script>

</html>



<!--<div class="modal fade" id="changePassModal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="" method="post" id="user_form">
      
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

        
                <div class="modal-body">
                    <form action="" method="" id="pass_form">
                        <span id="error_message" class="text-danger"></span>
                        <input type="text" id="cpass" placeholder="Enter your new password" name="cpass" class="form-control">

                </div>

 
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="btnchangePass" id="btnchangePass"><i class="fas fa-save" id="icon_saved"></i> Change</button>

            
                </div>
            </form>

        </div>
    </div>
    </form>
</div>  -->