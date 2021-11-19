<?= $this->include('layouts/header.php'); ?>
<style>

</style>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar_admin.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-sm-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h6 class="card-title">Generate Report</h6>
                                </div>
                                <div class="card-body">

                                    <form action="<?= site_url('ReportGeneration/DailyReport') ?>" method="post" id="form-filter" class="form-horizontal">
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
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-success rdv" type="radio" id="allowE" name="allowNum" value="2" disabled>
                                                            <label for="allowE" class="custom-control-label"> Daily Excel Report</label>
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
                                                    <input type="submit" class="form-control btn-sm btn-success" name="submit" value="Print" />

                                                </div>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="card-footer">
                                    <strong>Note:</strong> Generating reports is only available for Biodegradable and Non-Biodegradable.
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