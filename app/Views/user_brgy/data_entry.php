<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar_user.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>


            <div class="container">

                <section class="content ">

                    <div class="container-fluid">
                        <input type="hidden" value="<?php
                                                    echo $rowSub;
                                                    ?>" id="hidden_row">
                        <div class="row" id="hideMe">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-success alert-dismissible">

                                    <h5><i class="icon fas fa-check"></i> Data Submitted.</h5>
                                    If you want to alter the

                                    data, you may go to this <a href="<?= site_url('review') ?>">link</a>.
                                </div>

                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row hide">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- jquery validation -->
                                <div class="card card-primary">
                                    <div class="card-header">

                                        <h3 class="card-title">
                                            PLEASE INPUT DAILY DATA
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
                                    <div class="card-footer"> Note: The weight limit is <strong> <?php
                                                                                                    $dataR = readfile("data.txt");


                                                                                                    echo   substr($dataR, 0, -1); ?> tons</strong>.</div>
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
<script>
    $(document).ready(function() {
        $(".Page_title").text("Data Entry");
        $("#b_crumb_subtitle").text("Data Entry");
        $('#dashboardnav').addClass("active");

    });
</script>
<script>
    $(document).ready(function() {
        var hidden_row = $("#hidden_row").val();
        if (hidden_row == 1) {
            $(".hide").hide();
            $("#hideMe").show();
        } else {
            $("#hideMe").hide();
            $("hide").show();
        }

    })
</script>
<script>
    $(document).ready(function() {
        $('input').on('input', function() {
            var limitW = $('#limitvalue').val();
            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, limitW), 0));

            }

        });

        $('#user_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('UserBarangay/actionB') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.card-title').text('Processing please wait...');
                    $('#submit_button').attr('disabled', 'disabled');
                },

                success: function() {

                    $('#submit_button').attr('disabled', 'disabled');
                    $('.card-title').text('PLEASE INPUT DAILY DATA');
                    window.location = "<?= site_url('dataEntry') ?>";
                    $('#user_form')[0].reset();
                }
            });
        });



    });
</script>


</html>