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

                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Set Data Entry for Dumpsite</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Waste Type</th>
                                        <th>Status</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $status = '';
                                    foreach ($data as $row) {
                                        if ($row['status'] == 1) {
                                            $status = '<span class="badge bg-success">allowed</span>';
                                        } else {
                                            $status = '<span class="badge bg-danger">not allowed</span>';
                                        }
                                        echo "
                                <tr>
                                 
                                    <td>" . $row['waste'] . "</td>
                                    <td>" . $status . "</td>
                                    <td><button type='button' name='edit' class='btn btn-warning btn-sm allow' data-id='" . $row['id'] . " '><i class='fas fa-pen-square'></i></button></td>
                                </tr>
                            ";
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->include("layouts/modal.php"); ?>

    <div class="modal fade" id="allowModal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" method="post" id="user_form">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Set Status</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="" method="post" id="user_form">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input custom-control-input-success rdv" type="radio" id="allow" name="allowNum" checked value="1">
                                        <label for="allow" class="custom-control-label">Allow</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input custom-control-input-danger rdv" type="radio" id="allowN" name="allowNum" value="0">
                                        <label for="allowN" class="custom-control-label">Do Not Allow</label>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <?php


                            /*  foreach ($data as $rows) {
                                echo '
                                            <div class="card-body">
                                            <div class="input-group mb-8">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">' . $rows["waste_type"] . '</span>
                                                </div>
                                                <input type="number" step="any" value="' .  $rows["volume"] . '" class="form-control getNum"  placeholder="Input Volume (tons)" name="' .  $rows["waste_type"] . '" id="' .  $rows["waste_type"] . '">
                                            </div>
                                        </div>';
                            } */
                            ?>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="rdhidden" id="rdhidden" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit_button" id="submit_button"><i class="fas fa-save" id="icon_saved"></i> Save</button>

                        <!--     <input type="submit" class="btn btn-success" name="submit" id="submit_button" /> -->
                    </div>
                </form>

            </div>
        </div>
        </form>
    </div>
    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>
</body>
<script>
    $('.rdv').change(function() {
        var radioValue = $("input[name='allowNum']:checked").val();
        $('#rdhidden').val(radioValue);

    });
</script>
<Script>
    $(document).ready(function() {

        $("#Page_title").text("Others");
        $("#b_crumb_subtitle").text("others");
        $('#settings_nav').addClass("active");
        $('#others').addClass("active");
        $('#settings_nav_item').attr("class", "nav-item menu-open");

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
                    $('#preloader').attr("class", "preloader flex-column justify-content-center dark-mode align-items-center");
                    //   $('#add_record').attr("class", "btn bg-gradient-info btn-sm");
                    $('#darkmode').prop('checked', true);
                } else {
                    $('#mybody').attr("class", "hold-transition sidebar-mini layout-navbar-fixed layout-fixed");
                    $('#mynav').attr("class", "main-header navbar navbar-expand navbar-primary navbar-light");
                    $('#sidebar').attr("class", "sidebar sidebar-light-primary");
                    $('#sidebarNavBar').attr("class", "main-sidebar bg-primary elevation-4");
                    $('#preloader').attr("class", "preloader flex-column justify-content-center align-items-center");
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
                        $('#preloader').attr("class", "preloader flex-column justify-content-center dark-mode align-items-center");
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
                        $('#preloader').attr("class", "preloader flex-column justify-content-center align-items-center");
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
        var Toast = Swal.mixin({
            toast: true,
            position: 'bottomRight',
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

        /*  $('input').on('input', function() {
              var limitW = $('#limitvalue').val();
              var value = $(this).val();

              if ((value !== '') && (value.indexOf('.') === -1)) {

                  $(this).val(Math.max(Math.min(value, limitW), 0));

              }

          });

          $('#submit_button').click(function() {

              alert($('#wastes').val());
          }) */

        /*     $('input').on('input', function() {
                 var limitW = $('#limitvalue').val();
                 var value = $(this).val();

                 if ((value !== '') && (value.indexOf('.') === -1)) {

                     $(this).val(Math.max(Math.min(value, limitW), 0));

                 }

             }); */
        $('#user_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('Others/updateAllow') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.modal-title').text('Please wait...');
                    $('#submit_button').attr('disabled', 'disabled');
                },

                success: function() {
                    $('#submit_button').attr('disabled', false);
                    $('#userModal').modal('hide');
                    toastr.success('Data Allowed!');
                    window.location = '<?= site_url('others')  ?>'


                }

            });
        });

        $(document).on('click', '.allow', function() {

            var id = $(this).data('id');

            $.ajax({
                url: "<?= site_url('Others/fetch_single_data') ?>",
                method: "POST",
                data: {
                    id: id,

                },
                dataType: 'JSON',

                success: function(data) {
                    $('.modal-title').text('Set Status');
                    if (data.status == 1) {
                        $('#allow').prop('checked', true);
                    } else {
                        $('#allowN').prop('checked', true);
                    }
                    $('#allowModal').modal('show');
                    $('#hidden_id').val(id);
                    $('#rdhidden').val(data.status);
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