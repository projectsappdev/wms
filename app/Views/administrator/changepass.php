<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar_admin.php"); ?>
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
        $('#changepass_administrator').addClass("active");
        $('#settings_nav').addClass('active');

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