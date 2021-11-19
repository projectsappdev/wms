<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>

            <div class="content">
                <div class="container">

                    <span id="message"></span>
                    <div class="text-right">
                        <button type="button" class="btn bg-info btn-sm" name="add_record" id="add_record" data-toggle="modal"><i class="fas fa-plus"></i> New</button>
                        <br><br>
                    </div>

                    <div class="table-responsive">
                        <table id="sample_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Account Type</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Position</th>
                                    <th>Username</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <?= $this->include("layouts/modal.php"); ?>

    <div class="modal fade" id="userModal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" method="post" id="user_form">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="" method="post" id="user_form">

                            <div class="form-group">
                                <select name="userSelect" id="userSelect" class="form-control" required>
                                    <option value="" disabled selected>Choose users account type..</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">MIS</option>
                                </select>

                            </div>
                            <div class="user_account" hidden>
                                <div class="form-group">
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name">
                                    <span id="lname_b_error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name">
                                    <span id="fname_b_error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mname" id="mname" class="form-control" placeholder="Enter Middle Name">
                                    <span id="mname_b_error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
                                    <span id="username_error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="position" id="position" class="form-control" placeholder="Enter Position">
                                    <span id="position_error" class="text-danger"></span>
                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="hidden" name="action" id="action" value="Add">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit" id="submit_button"><i class="fas fa-save" id="icon_saved"></i> Save</button>

                                <!--     <input type="submit" class="btn btn-success" name="submit" id="submit_button" /> -->
                            </div>
                        </form>

                    </div>
            </div>
            </form>
        </div>
    </div>
    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>
    <?= $this->include('settings/limit.php'); ?>
</body>
<Script>
    $(document).ready(function() {

        $("#Page_title").text("Manage Admin Account");
        $("#b_crumb_subtitle").text("Admin");
        $('#adminnav').addClass("active");
        $('#manage').addClass("active");
        $('#manage_nav_item').attr("class", "nav-item menu-open");

        $('#manage_nav_item').click(function() {
            $('#manage_nav_item').attr("class", "nav-item menu-close");
            $('#settings_nav_item').attr("class", "nav-item menu-close");
            $('#monitoring_nav_item').attr("class", "nav-item menu-close");
        });
        $('#monitoring_nav_item').click(function() {
            $('#manage_nav_item').attr("class", "nav-item menu-close");
            $('#settings_nav_item').attr("class", "nav-item menu-close");
            $('#monitoring_nav_item').attr("class", "nav-item menu-close");
        });
        $('#settings_nav_item').click(function() {
            $('#manage_nav_item').attr("class", "nav-item menu-close");
            $('#settings_nav_item').attr("class", "nav-item menu-close");
            $('#monitoring_nav_item').attr("class", "nav-item menu-close");
        });

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
        $('#userSelect').on('change', function() {
            $('.user_account').removeAttr('hidden');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#sample_table').DataTable({
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?= site_url('ManageAccountAdmin/fetch_allB') ?>",
                type: "POST",
            },
            lengthMenu: [
                [10, 25, 150, -1],
                [10, 25, 150, "All"]
            ],
        });
    });
</script>
<script>
    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: true,
            timer: 1000
        });
        $('.toastrDefaultSuccess').click(function() {
            toastr.success('Data Succesfully Added!');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#add_record').click(function() {
            //       $('#user_form')[0].reset();

            $('.modal-title').text('Add New Account');

            $('#lname_error').text('');
            $('#fname_error').text('');
            $('#mname_error').text('');
            $('#username_error').text('');
            $('#position_error').text('');
            $('#action').val('Add');
            //    $('#submit_button').val('Add');
            $('#userModal').modal('show');
        });

        $('#user_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('ManageAccountAdmin/actionB') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.modal_title').text('Saving...');
                    $('#submit_button').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('.modal-title').text('Add New Account');
                    $('#submit_button').attr('disabled', false);

                    if (data.error == 'yes') {
                        $('#lname_error').text(data.lname_error);
                        $('#fname_error').text(data.fname_error);
                        $('#mname_error').text(data.mname_error);
                        $('#username_error').text(data.username_error);
                        $('#position_error').text(data.position_error);
                    } else if (data.updated == 'yes') {
                        $('#userModal').modal('hide');
                        toastr.info('Data Updated!');
                        $('#sample_table').DataTable().ajax.reload();
                        $('.modal-title').text('');
                        $('#user_form')[0].reset();
                    } else {

                        $('#userModal').modal('hide');
                        toastr.success('Data Saved!');
                        $('#sample_table').DataTable().ajax.reload();
                        $('.modal-title').text('');
                        $('#user_form')[0].reset();
                    }
                }

            });
        });
    });

    $(document).on('click', '.edit', function() {
        $('.user_account').removeAttr('hidden');
        var id = $(this).data('id');

        $.ajax({
            url: "<?= site_url('ManageAccountAdmin/fetch_single_dataB') ?>",
            method: "POST",
            data: {
                id: id
            },
            dataType: 'JSON',

            success: function(data) {
                $('#lname').val(data.lname);
                $('#fname').val(data.fname);
                $('#mname').val(data.mname);
                $('#username').val(data.username);
                $('#position').val(data.position);

                var a_type = data.account_type;
                if (a_type == 'Administrator') {
                    $('#userSelect').val(1);
                } else {
                    $('#userSelect').val(2);
                }


                $('.modal-title').text('Edit Account');
                $('#lname_error').text('');
                $('#fname_error').text('');
                $('#mname_error').text('');
                $('#username_error').text('');
                $('#position_error').text('');

                $('#action').val('Edit');
                $('submit_button').val('Edit');
                $('#userModal').modal('show');
                $('#hidden_id').val(id);
            }
        });
    });
    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        //  getName(id);

        $('#deleteModal').modal('show');

        $('#deleteData').on('click', function() {
            $.ajax({
                url: "<?= site_url('ManageAccountAdmin/delete') ?>",
                method: "POST",
                data: {
                    id: id
                },

                success: function(data) {
                    $('#deleteModal').modal('hide');
                    toastr.error('Account has been deleted!');
                    $('#sample_table').DataTable().ajax.reload();
                }

            });

        });

        /*  function getName()
          {
              $.ajax({
                  url: "",
                  type: 'POST',
                  data:{
                      id: id
                  },
                  dataType: 'json',
                  success: function(response){
                      $('.id').val(response.brgy_id);
                      $('.Bname').html(response);
                  }
              });
          } */
    });

    $(document).on('click', '#try', function() {
        var id = "hello";
        //  getName(id);

        $.ajax({
            url: "<?= site_url('ManageAccountAdmin/try') ?>",
            method: "POST",
            data: {
                id: id
            },

            success: function(data) {
                console.log(id);

            }

        });
    });
</script>
<script>
    $('#setLimit').click(function() {
        $('#limitModal').modal('show');
        $('#limit_button').click(function() {
            var limitW = $('#limitW').val();
            $.ajax({
                url: "<?= site_url('ConfigLimit/writeLimit') ?>",
                method: "POST",
                data: {
                    limitW: limitW
                },
                success: function() {
                    $('#limitModal').modal('hide');
                }
            });
        });
    })
</script>

</html>