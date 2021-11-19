<?= $this->include('layouts/header.php'); ?>
<style>

</style>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="<?= site_url('manage/reports'); ?>">Manage Reports</a>
                        </div>
                        <div class="col-sm-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h6 class="card-title">Generate Report</h6>
                                </div>
                                <div class="card-body">

                                    <form action="<?= site_url('ReportGeneration/DailyReport') ?>" method="post" id="form-filter" class="form-horizontal" target="_blank">
                                        <div class=" form-group">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <!--   <label for="Type of Waste" class="col-sm-4 control-label">Type of Waste</label> -->
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label for="Type of Waste" class="control-label">Type of Waste</label>
                                                        <select name="select_waste" id="select_waste" class="form-control form-control-lg" required>
                                                            <option value="" disabled selected>Choose type of waste...</option>
                                                            <?php
                                                            foreach ($data as $row) {
                                                                echo "<option value=" . $row['waste'] . ">" . $row['waste'] . "</option>";
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-success rdv" type="radio" id="allow" name="allowNum" checked value="0">
                                                            <label for="allow" class="custom-control-label">Daily PDF Report</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-success rdv" type="radio" id="allowN" name="allowNum" value="1">
                                                            <label for="allowN" class="custom-control-label">Monthly PDF Report</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-success rdv" type="radio" id="allowEd" name="allowNum" value="2">
                                                            <label for="allowEd" class="custom-control-label"> Daily Validation PDF Report</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-success rdv" type="radio" id="allowE" name="allowNum" value="4" disabled>
                                                            <label for="allowE" class="custom-control-label"> Daily Validation Excel Report</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-success rdv" type="radio" id="allowD" name="allowNum" value="3">
                                                            <label for="allowD" class="custom-control-label">Monthly Excel Report</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group" style="padding-top: 20px;">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-2">
                                                    <!--    <a href="#" role="button" target="__blank" aria-pressed="true" class="btn btn-warning btn-sm" id="btn-cweek"><i class="fa fa-print"> </i> Daily PDF Report</a>
                                                        <a href="#" role="button" target="__blank" aria-pressed="true" class="btn btn-warning btn-sm" id="btn-cmonthPDF"><i class="fa fa-print"> </i> Monthly PDF Report</a>
                                                        <a href="#>" role="button" aria-pressed="true" class="btn btn-success btn-sm" id="btn-cweekEx"><i class="fa fa-print"> </i> Daily Excel Report</a>
                                                        <a href="#" role="button" target="__blank" aria-pressed="true" class="btn btn-success btn-sm" id="btn-cmonthEx"><i class="fa fa-print"> </i> Monthly Excel Report</a>
                                                     <button id="btn_daily" class="form-control btn-danger">Daily PDF</button> -->
                                                    <input type="submit" class="form-control btn-sm btn-success request-callback" name="submit" value="Print" id="btnsub" />

                                                </div>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="card-footer">
                                    <strong>Note:</strong> Generating reports are only available for Biodegradable and Non-Biodegradable.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>
    <?= $this->include('settings/limit.php'); ?>
</body>

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
    $('#btnDate').click(function() {
        var dateFrom = $('#dateFrom').val()
        var dateTo = $('#dateTo').val()

        alert(dateFrom + " " + dateTo)
    })
</script>
<Script>
    $(document).ready(function() {

        $("#Page_title").text("Generate Reports");
        $("#b_crumb_subtitle").text("Reports");
        $('#report').addClass("active");
        $('#settings_nav').addClass("active");
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
        var rd = $('#allowEd').val();

        $('#allowEd').click(function() {
            toastr.warning('Only Non-Biodegradable type of waste entering RCA.');
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