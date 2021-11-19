<?= $this->include('layouts/header.php'); ?>
<?php date_default_timezone_set('Asia/Manila');  ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>


            <div class="container">

                <section class="content ">

                    <div class="row ">
                        <div class="col-lg-2 col-3">
                            <!-- small box -->
                            <div class="small-box bg-info ">
                                <div class="inner ">
                                    <h3><?php
                                        $percentage = ($brgyN / $totalBrgy) * 100;

                                        echo number_format($percentage, 0) . " %";


                                        ?></h3>

                                    <h5>Barangay</h5>
                                    <h6>Daily Submission</h6>
                                </div>
                                <div class="icon ">
                                    <i class="ion ion-bag "></i>
                                </div>
                                <a href="<?= site_url('barangay_daily_submission') ?>" class="small-box-footer ">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success ">
                                <div class="inner ">
                                    <h3><?php

                                        $percentage = ($dumpN / $totalDump) * 100;

                                        echo number_format($percentage, 0) . " %";



                                        ?></h3>

                                    <h5>Dumpsite</h5>
                                    <h6>Daily Submission</h6>
                                </div>
                                <div class="icon ">
                                    <i class="ion ion-stats-bars "></i>
                                </div>
                                <a href="# " class="small-box-footer ">More info <i class="fas fa-arrow-circle-right "></i></a>
                            </div>
                        </div>

                        <?php
                        $n = 0;
                        foreach ($wasteN as $row) {
                            if ($n == 0) {
                                $classC = "bg-warning";
                                $icon = "fas fa-recycle";
                            } else if ($n == 1) {
                                $classC = "bg-danger";
                                $icon = "fas fa-trash-restore";
                            } else if ($n == 2) {
                                $classC = "bg-info";
                                $icon = "fas fa-syringe";
                            } else {
                                $classC = "bg-success";
                                $icon = "fas fa-trash";
                            }
                        ?>

                            <div class="col-lg-2 col-6">
                                <!-- small box -->
                                <div class="small-box <?php echo $classC; ?>">
                                    <div class="inner ">
                                        <h3> <?= $row['vol'] ?> T
                                        </h3>

                                        <h5>Barangay</h5>
                                        <h6> <?= $row['wasteName']; ?> </h6>

                                    </div>
                                    <div class="icon ">
                                        <i class="ion ion-stats-bars "></i>
                                    </div>
                                    <a href="# " class="small-box-footer ">More info <i class="fas fa-arrow-circle-right "></i></a>
                                </div>
                            </div>
                        <?php $n++;
                        } ?>
                        <!-- ./col -->
                        <?php
                        $n = 0;
                        foreach ($dumpWaste as $row) {
                            if ($n == 0) {
                                $classC = "bg-warning";
                            } else if ($n == 1) {
                                $classC = "bg-danger";
                            } else if ($n == 2) {
                                $classC = "bg-info";
                            } else {
                                $classC = "bg-success";
                            }
                        ?>
                            <!-- ./col -->
                            <div class="col-lg-2 col-3">
                                <!-- small box -->
                                <div class="small-box <?php echo $classC;
                                                        ?>">
                                    <div class="inner ">
                                        <h3><?= $row['vol'] ?></h3>

                                        <h5>Dumpsite</h5>
                                        <h6><?= $row['wasteName'] ?></h6>
                                    </div>
                                    <div class="icon ">
                                        <i class="ion ion-bag "></i>
                                    </div>
                                    <a href="# " class="small-box-footer ">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                    <!--     <div class="card ">
                        <div class="card-header ui-sortable-handle " style="cursor: move; ">
                            <h3 class="card-title ">
                                <i class="fas fa-chart-pie mr-1 "></i> MONITORING
                            </h3>
                            <div class="card-tools ">
                                <ul class="nav nav-pills ml-auto ">
                                    <li class="nav-item ">
                                        <a class="nav-link active " href="#revenue-chart " data-toggle="tab ">Area</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link " href="#sales-chart " data-toggle="tab ">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                    <!-- /.card-header -->
                    <div class="row">
                        <div class="col-sm-12">


                            <div class="card  card-danger">
                                <div class=" card-header">
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <h3 class="card-title">Barangay Daily Records</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="wasteT" id="wasteT" class="form-control">
                                                <option value="">Select Waste</option>
                                                <?php
                                                foreach ($wasteType as $row) {
                                                    echo '<option value="' . $row["waste_type"] . '">' . $row["waste_type"] . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chart_area" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.card-header -->
        </div>
        <!-- /.ROW -->


        </section>



    </div>

    </div>
    </div>

    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>
    <?= $this->include('settings/limit.php'); ?>
</body>
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
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback();

    function loadData(wasteT, title) {
        var temp = title + ' ' + wasteT;
        $.ajax({
            url: "<?= site_url('Dashboard/chartData') ?>",
            method: "POST",
            data: {
                wasteT: wasteT
            },
            dataType: "JSON",
            success: function(data) {
                drawData(data, temp);
            }
        });
    }

    function drawData(chart_data, chart_title) {
        var jsonData = chart_data;
        var currentDate = new Date()
        var day = currentDate.getDate()
        var month = currentDate.getMonth() + 1
        var year = currentDate.getFullYear()
        var d = month + "/" + day + "/" + year;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Current');
        data.addColumn('number', 'Volume');

        $.each(jsonData, function(i, jsonData) {
            var collection_date = jsonData.collection_date;
            var volume = parseFloat($.trim(jsonData.volume));
            data.addRows([
                [collection_date, volume]
            ]);
        });
        var options = {
            title: chart_title,
            hAxis: {
                title: "Current Week "
            },
            vAxis: {
                title: 'Volume(tons)'
            },
            chartArea: {
                width: '70%',
                height: '60%'
            }
        }

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));

        chart.draw(data, options);
    }
    $(document).ready(function() {
        $('#wasteT').change(function() {
            var wasteT = $('#wasteT').val();
            if (wasteT != '') {
                loadData(wasteT, 'Daily Records For ');
            }

        })
    })
</script>
<Script>
    $(document).ready(function() {
        $(".Page_title").text("Dashboard");
        $("#b_crumb_subtitle").text("Dashboard");
        $('#dashboardnav').addClass("active");
        //  $('#mynav').attr("class", "main-header navbar navbar-expand navbar-dark");
        //  $('#sidebarNavBar').attr("class", "main-sidebar sidebar-dark-primary elevation-4")
        //  $('#sidebar').attr("class", "sidebar sidebar-dark-primary")

    });
</script>
<!-- BLOCK OF CODES FOR DARK MODE -->
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
<!-- END OF BLOCK OF CODES FOR DARK MODE -->
<script>
    $(document).ready(function() {
        $('#add_record').click(function() {
            //       $('#user_form')[0].reset();

            $('.modal-title').text('Add New Info');

            $('#course_error').text('');


            $('#action').val('Add');

            //    $('#submit_button').val('Add');
            $('#userModal').modal('show');
        });
    });
</script>
<script>
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
    $('#setLimit').click(function() {
        $('#limitModal').modal('show');

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