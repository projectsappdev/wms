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
                            <a href="<?= site_url('report'); ?>"> <i class="fa fa-arrow-alt-circle-left"></i> Back</a>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-right">

                                <button type="button" class="btn bg-gradient-info btn-sm" name="add_record" id="add_record" data-toggle="modal"><i class="fas fa-plus"></i> New</button>
                                <br>
                                <br>
                            </div>

                            <div class="table-responsive">
                                <table id="sample_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Middle Initial</th>
                                            <th>Last Name</th>
                                            <th>Suffix</th>
                                            <th>Position</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>



                                </table>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
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
                            <div class="user_account">

                                <div class="form-group">
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="mname" id="mname" class="form-control" placeholder="Enter Middle Initial">
                                            <span id="mname_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Enter Suffix">
                                            <span id="suffix_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="position" id="position" class="form-control" placeholder="Enter Position">
                                    <span id="position_error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <select name="authority" id="authority" class="form-control" required>
                                        <option value="" selected disabled>Signature Authority</option>
                                        <option value="1">Prepared By</option>
                                        <option value="2">Approved By</option>
                                        <option value="3">Noted By</option>
                                    </select>
                                    <span id="authority_error" class="text-danger"></span>
                                </div>
                                <div class="custom-control custom-checkbox display">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2">
                                    <label for="customCheckbox2" class="custom-control-label">Job Order</label>
                                </div>
                            </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="check_hidden_id" id="check_hidden_id" />
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
    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>
    <?= $this->include('settings/limit.php'); ?>
</body>
<script>
    $(document).ready(function() {
        $('#sample_table').DataTable({
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?= site_url('ManageReports/fetch_allB') ?>",
                type: "POST",
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
<script>
    $(document).ready(function() {

        $('.display').hide();



        $('#authority').change(function() {
            var getVar = $('#authority').val();

            if (getVar == 1) {
                $('.display').show();

            } else {
                $('.display').hide();

            }
        });

        $('#customCheckbox2').click(function() {
            if ($('#customCheckbox2').prop('checked')) {
                $('#check_hidden_id').val('1');
            } else {
                $('#check_hidden_id').val('0');
            }

        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#add_record').click(function() {
            //       $('#user_form')[0].reset();

            $('.modal-title').text('Add New Waste Type');

            $('#fname_error').text('');
            $('#lname_error').text('');


            $('#position_error').text('');
            $('#authority_error').text('');

            $('#action').val('Add');

            //    $('#submit_button').val('Add');
            $('#userModal').modal('show');
        });

        $('#user_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('ManageReports/actionB') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.modal_title').text('Saving...');
                    $('#submit_button').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('.modal-title').text('Add New');
                    $('#submit_button').attr('disabled', false);

                    if (data.error == 'yes') {
                        $('#lname_error').text(data.lname_error);
                        $('#fname_error').text(data.fname_error);
                        $('#authority_error').text(data.authority_error);
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

        var id = $(this).data('id');

        $.ajax({
            url: "<?= site_url('ManageReports/fetch_single_dataB') ?>",
            method: "POST",
            data: {
                id: id
            },
            dataType: 'JSON',

            success: function(data) {
                $('#lname').val(data.lname);
                $('#fname').val(data.fname);
                $('#mname').val(data.mname);
                $('#suffix').val(data.suffix);
                $('#position').val(data.position);
                $('#authority').val(data.status);

                $('.modal-title').text('Update Waste Type');
                $('#lname_error').text('');
                $('#fname_error').text('');
                $('#position_error').text('');
                $('#authority_error').text('');

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
                url: "<?= site_url('ManageReports/delete') ?>",
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
</script>
<Script>
    $(document).ready(function() {

        $("#Page_title").text("Manage Reports");
        $("#b_crumb_subtitle").text("Reports/Manage");
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
<script>
    /*   $(document).on('click', '#btn-cweek', function() {
        var select_waste = $('#select_waste').val();
        //  getName(id);
        if (select_waste == 'Non-Biodegradable') {
            $("#btn-cweek").prop("href", "<? //= site_url('generatereport/printpdf') 
                                            ?>");

        } else if (select_waste == 'Biodegradable') {

            $("#btn-cweek").prop("href", "<? //= site_url('generatereport/printpdfBio') 
                                            ?>");
        } else if (select_waste == 'Infectious') {
            toastr.warning('No available report for this!');
        } else {
            toastr.error('Please select from the options on what type of waste you want to generate!');
        }
    });
    $(document).on('click', '#btn-cmonthPDF', function() {
        var select_waste = $('#select_waste').val();
        //  getName(id);
        if (select_waste == 'Non-Biodegradable') {
            alert("No Non-Biodegradable Report Generation yet.");

        } else if (select_waste == 'Biodegradable') {

            $("#btn-cmonthPDF").prop("href", "<? //= site_url('generatereport/monthlyReport') 
                                                ?>");
        } else if (select_waste == 'Infectious') {
            toastr.warning('No available report for this!');
        } else {
            toastr.error('Please select from the options on what type of waste you want to generate!');
        }
    });

    $(document).on('click', '#btn-cmonthEx', function() {
        var select_waste = $('#select_waste').val();
        //  getName(id);
        if (select_waste == 'Non-Biodegradable') {
            $("#btn-cmonthEx").prop("href", "  <? //= site_url('generatereport/excel_monthly_Now')  
                                                ?>");

        } else if (select_waste == 'Biodegradable') {

            $("#btn-cmonthEx").prop("href", "  <? //= site_url('generatereport/excel_monthly')  
                                                ?>");
        } else if (select_waste == 'Infectious') {
            toastr.warning('No available report for this!');
        } else {
            toastr.error('Please select from the options on what type of waste you want to generate!');
        }

    });

    $(document).on('click', '#btn-cweekEx', function() {
        alert('Sorry! Currently no daily report generation for excel yet.');
    });*/
</script>
<script>
    /*  $(document).ready(function() {
        $('#btn_daily').click(function() {
            var select_waste = $('#select_waste').val();

            $.ajax({
                url: "<? //= site_url('ReportGeneration/DailyReport') 
                        ?>",
                type: "POST",
                data: {
                    select_waste: select_waste
                }
            });
            window.location = "hello.php";
        });
    });*/
</script>

</html>