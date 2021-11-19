<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar_user_dump.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>


            <div class="container">

                <section class="content ">

                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- jquery validation -->
                                <div class="card card-primary">
                                    <div class="card-header">

                                        <h3 class="card-title">
                                            PLEASE INPUT DAILY DATA

                                            <?php


                                            ?>
                                        </h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->


                                    <form id="user_form">
                                        <input type="hidden" value="<?= session()->get('name') ?>" id="sessionValue" name="sessionValue">
                                        <?php
                                        foreach ($data as $row) {
                                            echo '
                                            <div class="card-body">
                                            <div class="input-group mb-8">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">' . $row["waste"] . '</span>
                                                </div>
                                                <input type="number" step="any" class="form-control getNum"  placeholder="Input Volume (tons)" name="' .  $row["waste"] . '" id="' .  $row["waste"] . '">
                                            </div>
                                        </div>';
                                        }
                                        ?>
                                        <input type="hidden" value="<?php
                                                                    $dataR = readfile("data.txt");
                                                                    echo   substr($dataR, 0, -1); ?> " step="any" id="limitvalue" name="limitvalue">
                                        <!--   <div class="card-body">
                                            <div class="input-group mb-10">
                                                <div class="input-group-prepend ">
                                                    <span class="input-group-text bg-red  ">Non-Biodegradable</span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="Input Volume (tons)">

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="input-group mb-8">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-green">Recycable Waste</span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="Input Volume (tons)">

                                            </div>
                                        </div>  -->
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" id="submit_button" class="btn btn-primary">Submit</button>

                                        </div>
                                    </form>

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
    <?= $this->include("layouts/modal.php"); ?>
    <?= $this->include('layouts/footer.php'); ?>
    <?= $this->include('layouts/script.php'); ?>

</body>
<Script>
    $(document).ready(function() {
        $(".Page_title").text("Dashboard");
        $("#b_crumb_subtitle").text("Dashboard");
        $('#dashboardnav').addClass("active");

    });
</script>

<script>
    $(document).ready(function() {
        $('input').on('input', function() {
            var limitW = 100;
            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, limitW), 0));

            }

        });

        $('#user_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('UserDumpsite/actionD') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.card-title').text('Processing please wait...');
                    $('#submit_button').attr('disabled', 'disabled');
                },

                success: function(data) {

                    $('#submit_button').attr('disabled', false);
                    $('.card-title').text('PLEASE INPUT DAILY DATA');
                    toastr.success('Data Submitted!');

                    $('#user_form')[0].reset();
                }

            });
        });

    });
</script>


</html>