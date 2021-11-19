<?= $this->include('layouts/header.php'); ?>


<style>
    .marginButton {
        margin-bottom: 20px;
    }

    .dt-button-collection button {
        color: #fff;
    }

    .dt-button-collection button:hover {
        background-color: lightslategray;
    }

    .buttons-columnVisibility {
        background-color: #3498DB;
        border: none;
        color: white;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;

        cursor: pointer;

    }

    .dt-button-collection {
        position: relative;
        display: inline-block;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #4f4f51;
    }
</style>


<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <!--<link rel="stylesheet" href="<? //= base_url('assets/css/choices.min.css') 
                                        ?>" />

   Select2 plugin -->

    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>

            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-sm-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h6 class="card-title">Filter Data</h6>
                                </div>
                                <div class="card-body">


                                    <form action="" id="form-filter" method="post" class="form-horizontal">
                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="Type of Waste" class="control-label">Name of Barangay</label>

                                                </div>
                                                <div class="col-sm-12">

                                                    <select name="select_names" id="select_names" class="mul-select form-control" multiple="true" required>
                                                        <option value="1" selected>All</option>
                                                        <?php

                                                        foreach ($userB as $row) {
                                                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                    <span class="text-danger" id="message_names"></span>
                                                </div>

                                            </div><br>
                                            <div class="row">
                                                <!--   <label for="Type of Waste" class="col-sm-4 control-label">Type of Waste</label> -->
                                                <div class="col-sm-4">
                                                    <label for="Type of Waste" class="control-label">Type of Waste</label>
                                                    <select name="select_waste" id="select_waste" class="form-control form-control-sm">
                                                        <option value="1" selected>All</option>
                                                        <?php
                                                        foreach ($wasteAll as $row) {
                                                            echo "<option value=" . $row['waste'] . ">" . $row['waste'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="Date From:" class="control-label">Date From:</label>
                                                    <input type="date" name="dateFrom" id="dateFrom" class="form-control form-control-sm" value="<?php date('Y-m-d'); ?>" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="Date From:" class="control-label">Date To:</label>
                                                    <input type="date" name="dateTo" id="dateTo" class="form-control form-control-sm" />
                                                </div>
                                            </div>

                                            <div class="form-group" style="padding-top: 20px;">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>

                                                        <button type="button" id="btn-reset" class="btn btn-default">Reset</button>

                                                        <button type="button" id="btnDate" class="btn btn-default">Show Date</button>
                                                    </div>

                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="table-responsive">

                        <table id="sample_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dumpsite</th>
                                    <th>Waste Type</th>
                                    <th>Volume</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                        </table>
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
    $('#btnDate').click(function() {
        var dateFrom = $('#dateFrom').val()
        var dateTo = $('#dateTo').val()
        var selects = $('#select_names').val();
        if (new Date(dateFrom) > new Date(dateTo)) {
            alert(selects);
        } else {
            alert(dateFrom);
        }

        //  console.log($('#dateFrom').val());
    })
</script>
<Script>
    $(document).ready(function() {

        $("#Page_title").text("Barangay Waste Monitoring");
        $("#b_crumb_subtitle").text("Barangay");
        $('#brgy_nav').addClass("active");
        $('#monitoring_nav').addClass("active");
        $('#monitoring_nav_item').attr("class", "nav-item menu-open");

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
        var currentDate = new Date()
        var day = currentDate.getDate()
        var month = currentDate.getMonth() + 1
        var year = currentDate.getFullYear()
        var d = month + "/" + day + "/" + year;

        var datatable = $('#sample_table').DataTable({
            "order": [],
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('WasteBarangay/table_data') ?>",
                "type": "POST",
                "data": function(data) {
                    data.select_waste = $('#select_waste').val();
                    data.dateFrom = $('#dateFrom').val();
                    data.dateTo = $('#dateTo').val();
                    data.select_names = $('#select_names').val();
                    console.log(data.select_names);
                },

            },



            "columnDefs": [{
                "targets": [0],
                "orderable": true,
            }, ],
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    title: "Dagupan Report",
                    className: 'btn btn-default marginButton',
                    messageTop: 'Waste Monitoring System ',

                    pageSize: 'LEGAL',
                    layout: 'noBorders',
                    exportOptions: {
                        columns: ':visible'

                    },
                    customize: function(doc) {
                        //   doc.content[0].text = doc.content[0].text.trim();
                        doc.styles = {
                            subheader: {
                                fontSize: 12,
                                bold: true,
                                color: 'black',


                            },
                            title: {
                                fontSize: 15,
                                bold: true,
                                color: 'black',
                                alignment: 'center',
                            },
                            tableHeader: {
                                bold: true,
                                fontSize: 12,
                                color: 'black',
                                margin: 15

                            }


                        }


                        doc.pageMargins = [50, 50, 50, 50];
                        doc['header'] = (function() {
                            return {
                                columns: [{


                                        alignment: 'left',
                                        italics: true,
                                        text: d,
                                        fontSize: 7,
                                        margin: [10, 0]
                                    },
                                    {
                                        alignment: 'right',
                                        fontSize: 7,
                                        text: 'Administrator'
                                    }
                                ],
                                margin: 20
                            }
                        });

                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [{
                                        alignment: 'left',
                                        italics: true,
                                        text: 'Copyright 2021 Dagupan',
                                        fontSize: 7,
                                        margin: [10, 0]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: 20
                            }

                        });


                    }

                },

                {
                    extend: 'csv',
                    className: 'btn btn-default marginButton',
                    messageTop: 'Waste Monitoring System',
                    messageBottom: 'Copyright 2021 Dagupan'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-default marginButton',
                    messageTop: 'Waste Monitoring System',
                    messageBottom: 'Copyright 2021 Dagupan'
                },
                {
                    extend: 'copy',
                    className: 'btn btn-default marginButton',
                    messageTop: 'Waste Monitoring System',
                    messageBottom: 'Copyright 2021 Dagupan'
                },
                {
                    extend: 'print',
                    className: 'btn btn-default marginButton',
                    messageTop: 'Waste Monitoring System',
                    messageBottom: 'Copyright 2021 Dagupan'
                },
                {
                    extend: 'colvis',
                    className: 'btn btn-default marginButton',
                    messageTop: 'Waste Monitoring System',
                    messageBottom: 'Copyright 2021 Dagupan'

                },

            ],

            lengthMenu: [
                [10, 15, 20, -1],
                [10, 15, 20, "All"]
            ],




        });


        $('#btn-filter').click(function() { //button filter event click
            var dateFrom = $('#dateFrom').val()
            var dateTo = $('#dateTo').val()
            var selects = $('#select_names').val();
            if (new Date(dateFrom) > new Date(dateTo)) {
                toastr.error('Invalid Date Range!');
            } else if (selects == "") {
                $('#message_names').html('Please do not leave this field blank!');
            } else {
                datatable.draw();
            }



        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            datatable.ajax.reload();
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
    $(".mul-select").select2({
        placeholder: "select Barangays", //placeholder
        tags: true,
        tokenSeparators: ['/', ',', ';', " "]
    });
</script>
<script>
    $(document).ready(function() {
        $('#btnsub').click(function() {


            var select_name = $('#select_name').val();

            $.ajax({
                url: "<?= site_url('WasteBarangay/Try') ?>",
                method: "POST",
                data: {
                    select_name: select_name
                },
                dataType: 'JSON',

                success: function(data) {
                    alert(data.select);

                }
            });
        });
    });
</script>
<script>
    /*   $(document).ready(function() {

        var table = $('#sample_table').DataTable({
            initComplete: function() {
                count = 0;
                this.api().columns().every(function() {
                    var title = this.header();
                    //replace spaces with dashes
                    title = $(title).html().replace(/[\W]/g, '-');
                    var column = this;
                    var select = $('<select id="' + title + '" class="select2" ></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            //Get the "text" property from each selected data 
                            //regex escape the value and store in array
                            var data = $.map($(this).select2('data'), function(value, key) {
                                return value.text ? '^' + $.fn.dataTable.util.escapeRegex(value.text) + '$' : null;
                            });

                            //if no data selected use ""
                            if (data.length === 0) {
                                data = [""];
                            }

                            //join array into string with regex or (|)
                            var val = data.join('|');

                            //search for the option(s) selected
                            column
                                .search(val ? val : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    });

                    //use column title as selector and placeholder
                    $('#' + title).select2({
                        multiple: true,
                        closeOnSelect: false,
                        placeholder: "Select a " + title
                    });

                    //initially clear select otherwise first option is selected
                    $('.select2').val(null).trigger('change');
                });
            }
        });
    }); */
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