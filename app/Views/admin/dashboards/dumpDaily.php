<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>
            <div class="content">
                <div class="container">



                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Dumpsite</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Dumpsite Name</th>
                                        <th>Status</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dailyBrgy as $rows) {
                                        if ($rows['bid'] != "") {
                                            $status = '<span class="badge bg-success">submitted</span>';
                                        } else {
                                            $status = '<span class="badge bg-danger">pending</span>';
                                        }
                                        echo "
                                    <tr>                                  
                                        <td>" . $rows['bNames'] . "</td>
                                        <td>" . $status . "</td>
                                    </tr>
                                    ";
                                    }

                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>
    <?= $this->include("layouts/modal.php"); ?>

    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>
</body>
<Script>
    $(document).ready(function() {

        $("#Page_title").text("Daily Submission");
        $("#b_crumb_subtitle").text("Dashboard");

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