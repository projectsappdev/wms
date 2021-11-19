<?= $this->include('layouts/header.php'); ?>
<?php date_default_timezone_set('Asia/Manila');  ?>


<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar_admin.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>


            <div class="container">

                <section class="content">
                    <div class="text-danger" id="dateRange_error"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <input placeholder="Start Date" class="form-control" type="text" onfocusin="(this.type='date')" onfocusout="(this.type='text')" id="dateFrom">
                        </div>
                        <div class="col-md-6">
                            <input placeholder="End Date" class="form-control" type="text" onfocusin="(this.type='date')" onfocusout="(this.type='text')" id="dateTo">

                        </div>
                    </div><br>
                    <div class="row">

                        <div class="col-md-12 text-right">
                            <button class="btn btn-warning " id="btn_filter"> <i class="fas fa-check-square"></i> Filter</button>
                            <button class="btn btn-danger" id="btn_reset"><i class="fas fa-times"></i> Reset</button>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Barangay Submitted</span>
                                    <span class="info-box-number">
                                        <?php
                                        $percentage = ($brgyN / $totalBrgy) * 100;

                                        echo number_format($percentage, 0);


                                        ?>
                                        <small>%</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <?php
                        $n = 0;
                        foreach ($wasteN as $row) {
                            if ($n == 0) {
                                $classC = "bg-warning";
                                $icon = "fas fa-trash-restore-alt";
                            } else if ($n == 1) {
                                $classC = "bg-danger";
                                $icon = "fas fa-syringe";
                            } else if ($n == 2) {
                                $classC = "bg-info";

                                $icon = "fas fa-recycle";
                            } else {
                                $classC = "bg-success";
                                $icon = "fas fa-trash";
                            }

                        ?>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon  <?php echo $classC; ?> elevation-1"><i class="<?php echo $icon; ?>"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $row['wasteName']; ?></span>
                                        <span class="info-box-number"><?= $row['vol'] ?> <small> Tons</small> </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <?php
                            $n++;
                        }
                        if (empty($wasteN[0])) {
                            $a = 0;
                            foreach ($wasteList as $rows) {
                                if ($a == 0) {
                                    $classC = "bg-warning";
                                    $icon = "fas fa-trash-restore-alt";
                                } else if ($a == 1) {
                                    $classC = "bg-danger";
                                    $icon = "fas fa-syringe";
                                } else if ($a == 2) {
                                    $classC = "bg-info";

                                    $icon = "fas fa-recycle";
                                } else {
                                    $classC = "bg-success";
                                    $icon = "fas fa-trash";
                                }
                            ?>
                                <div class="col-12 col-sm-6 col-md-3" id="box">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon <?php echo $classC; ?> elevation-1"><i class="<?php echo $icon; ?>"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text"><?= $rows['waste']; ?></span>
                                            <span class="info-box-number">0<small> Ton</small> </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                        <?php
                                $a++;
                            }
                        }

                        ?>

                        <div class="clearfix hidden-md-up"></div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Dumpsite Submitted</span>
                                    <span class="info-box-number">
                                        <?php

                                        $percentage = ($dumpN / $totalDump) * 100;

                                        echo number_format($percentage, 0);



                                        ?>
                                        <small>%</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <?php
                        $n = 0;
                        foreach ($dumpWaste as $row) {
                            if ($n == 0) {
                                $classC = "bg-info";
                                $icon = "fas fa-recycle ";
                            } else if ($n == 1) {
                                $classC = "bg-danger";
                                $icon = "fas fa-syringe";
                            } else if ($n == 2) {
                                $classC = "bg-warning";

                                $icon = "fas fa-trash-restore-alt";
                            } else {
                                $classC = "bg-success";
                                $icon = "fas fa-trash";
                            }

                        ?>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon  <?php echo $classC; ?> elevation-1"><i class="<?php echo $icon; ?>"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $row['wasteName']; ?></span>
                                        <span class="info-box-number"><?= $row['vol'] ?> <small> Tons</small> </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <?php
                            $n++;
                        }
                        if (empty($wasteN[0])) {
                            $a = 0;
                            foreach ($wasteList as $rows) {
                                if ($a == 0) {
                                    $classC = "bg-warning";
                                    $icon = "fas fa-trash-restore-alt";
                                } else if ($a == 1) {
                                    $classC = "bg-danger";
                                    $icon = "fas fa-syringe";
                                } else if ($a == 2) {
                                    $classC = "bg-info";

                                    $icon = "fas fa-recycle";
                                }
                            ?>
                                <div class="col-12 col-sm-6 col-md-3" id="box">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon <?php echo $classC; ?> elevation-1"><i class="<?php echo $icon; ?>"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text"><?= $rows['waste']; ?></span>
                                            <span class="info-box-number">0<small> Ton</small> </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                        <?php
                                $a++;
                            }
                        }



                        ?>


                        <div class="clearfix hidden-md-up"></div>


                    </div>
                    <!-- Start For Barangay Records Only -->
                    <div class="card">
                        <div class="row appendDiv" id="">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-home"></i></span>
                                    <h5 class="description-header">Barangay Records</h5>

                                    <small id="datesRange"></small>

                                </div>
                            </div>
                        </div>
                        <div class="row appendDivDump" id="">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-dumpster"></i></span>
                                    <h5 class="description-header">Dumpsite Records</h5>

                                    <small id="datesRangeD"></small>

                                </div>
                            </div>
                        </div>

                    </div>

            </div>

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
        $('#btn_reset').click(function() {
            window.location.reload();
        });
        $('#btn_filter').click(function() {
            //for (let i = 0; i < 3; i++) {
            //  $(".appendDiv").append('<div class="appendDiv2">'),
            /*      $('.appendDiv').append([
                      $('<div/>', {
                          "class": "col-sm-3 col-6 appendDiv2",

                      }).append([
                          $('<div/>', {
                              "class": "description-block border-right",


                          }).append([
                              $('<span/>', {
                                  "class": "description-percentage text-success",
                                  "text": "133"
                              }).append([
                                  $('<i/>', {
                                      "class": "fas fa-caret-up",

                                  })
                              ])

                          ]).append([
                              $('<h5/>', {
                                  "class": "description-header",
                                  "text": "Tons"
                              })
                          ]).append([
                              $('<span/>', {
                                  "class": "description-text",
                                  "text": "Volume"
                              })
                          ])
                      ])
                  ]) */

            //      }


            var dateFrom = $('#dateFrom').val();
            var dateTo = $('#dateTo').val();
            if (dateFrom > dateTo) {
                toastr.error('Date range is invalid! Please try again!');
                exit();
            } else if (dateFrom == "" || dateTo == "") {
                toastr.warning('Please enter a date.');
                exit();
            }

            $.ajax({
                url: "<?= site_url('dashboard/FiltersDate') ?>",
                method: "POST",
                data: {
                    dateFrom: dateFrom,
                    dateTo: dateTo
                },
                dataType: "JSON",
                success: function(data) {
                    $('#datesRange').text(dateFrom + " to " + dateTo);
                    for (let i = 0; i < data.length; i++) {
                        var volume = data[i].vol;
                        var name = data[i].wasteName;
                        $('.namesT').text(name);
                        $('.volumeT').text(volume);
                        $('.appendDiv').append([
                            $('<div/>', {
                                "class": "col-sm-3 col-6 appendDiv2",

                            }).append([
                                $('<div/>', {
                                    "class": "description-block border-right",


                                }).append([
                                    $('<span/>', {
                                        "class": "description-percentage text-success",
                                        "text": volume
                                    }).append([
                                        $('<i/>', {
                                            "class": "fas fa-caret-up",

                                        })
                                    ])

                                ]).append([
                                    $('<h5/>', {
                                        "class": "description-header",
                                        "text": "Tons"
                                    })
                                ]).append([
                                    $('<span/>', {
                                        "class": "description-text",
                                        "text": name
                                    })
                                ])
                            ])
                        ])

                    }
                }

            });
            $.ajax({
                url: "<?= site_url('dashboard/FiltersDateDump') ?>",
                method: "POST",
                data: {
                    dateFrom: dateFrom,
                    dateTo: dateTo
                },
                dataType: "JSON",
                success: function(data) {
                    $('#datesRangeD').text(dateFrom + " to " + dateTo);
                    for (let i = 0; i < data.length; i++) {
                        var volume = data[i].vol;
                        var name = data[i].wasteName;
                        $('.namesT').text(name);
                        $('.volumeT').text(volume);
                        $('.appendDivDump').append([
                            $('<div/>', {
                                "class": "col-sm-3 col-6 appendDiv2",

                            }).append([
                                $('<div/>', {
                                    "class": "description-block border-right",


                                }).append([
                                    $('<span/>', {
                                        "class": "description-percentage text-success",
                                        "text": volume
                                    }).append([
                                        $('<i/>', {
                                            "class": "fas fa-caret-up",

                                        })
                                    ])

                                ]).append([
                                    $('<h5/>', {
                                        "class": "description-header",
                                        "text": "Tons"
                                    })
                                ]).append([
                                    $('<span/>', {
                                        "class": "description-text",
                                        "text": name
                                    })
                                ])
                            ])
                        ])

                    }
                }

            })
            $('#btn_filter').attr('disabled', 'disabled');
            $('#dateFrom').attr('disabled', 'disabled');
            $('#dateTo').attr('disabled', 'disabled');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#dateFrom').change(function() {
            var m_names = new Array("January", "February", "March",
                "April", "May", "June", "July", "August", "September",
                "October", "November", "December");

            var d = new Date($('#dateFrom').val());
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            $('#fromD').text(m_names[curr_month] + " " + curr_date + ", " +
                curr_year);

        })
        $('#dateTo').change(function() {
            var m_names = new Array("January", "February", "March",
                "April", "May", "June", "July", "August", "September",
                "October", "November", "December");

            var d = new Date($('#dateTo').val());
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            $('#toD').text(m_names[curr_month] + " " + curr_date + ", " +
                curr_year);

        })
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