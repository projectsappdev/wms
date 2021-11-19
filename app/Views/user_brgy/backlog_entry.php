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


                        <!-- left column -->

                        <!-- jquery validation -->

                        <!-- /.card-header -->
                        <!-- form start -->


                        <form id="user_form_backlog">
                            <input type="hidden" value="<?= session()->get('name') ?>" id="sessionValue" name="sessionValue">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6><strong> Choose date:</strong></h6>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="date" name="backLogDate" id="backLogDate" class="form-control form-control-sm" />
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" value="<?php
                                                        $dataR = readfile("data.txt");
                                                        echo   substr($dataR, 0, -1); ?> " step="any" id="limitvalue" name="limitvalue">

                            <div class="row" id="entryBacklog">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php
                                        foreach ($data_waste as $row) {
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
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" id="submit_button" class="btn btn-primary">Submit</button>
                                    </div><br>


                                    <!-- /.card -->
                                    <div class="card-footer"> Note: The weight limit is <strong> <?php
                                                                                                    $dataR = readfile("data.txt");


                                                                                                    echo   substr($dataR, 0, -1); ?> tons</strong>.</div>

                                </div>
                            </div>


                        </form>


                        </br>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="sample_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Waste Type</th>
                                            <th>Volume</th>
                                            <th>Attempt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>



                        <br>
                        <br>


                        <!--/.col (right) -->

                        <!-- /.row -->
                    </div>


                </section>



            </div>

        </div>
    </div>
    <?= $this->include("layouts/modal.php"); ?>
    <div class="modal fade" id="userModal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Data</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="attempt_content">
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-bell"></i> Sorry you cannot update your Entry. You have used all the update attempts.</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div id="edit_content">
                        <form action="" method="post" id="user_form">

                            <input type="number" step="any" id="wastes" name="wastes" class="form-control" /> </br></br>




                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="hidden" name="attempt" id="attempt">
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit_button" id="submit_button"><i class="fas fa-save" id="icon_saved"></i> Save</button>

                                <!--     <input type="submit" class="btn btn-success" name="submit" id="submit_button" /> -->
                            </div>
                            <div class="card-footer">
                                <h6 class="text-danger">You still have <strong id="attempt_count"></strong> attempt.</h6>
                                <h6> Note: The weight limit is <strong> <?php
                                                                        $dataR = readfile("data.txt");


                                                                        echo   substr($dataR, 0, -1); ?> tons</strong>.</h6>
                            </div>
                        </form>
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
        $(".Page_title").text("Backlog Entry");
        $("#b_crumb_subtitle").text("Backlog Entry");
        $('#backlogbrgynav').addClass("active");

    });
</script>
<script>
    $(document).ready(function() {
        $('.getNum').on('input', function() {
            var limitW = $('#limitvalue').val();
            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, limitW), 0));

            }
        });


    })
</script>

<script>

</script>
<script>
    $(document).ready(function() {
        var d = new Date();
        d.setDate(d.getDate())
        var a = d.toLocaleDateString().split('/')
        var today = a[2] + "-" + ("0" + a[0]).slice(-2) + "-" + ("0" + a[1]).slice(-2);
        $("#backLogDate").val(today)
        $('#entryBacklog').hide();

        var datatable = $('#sample_table').DataTable({

            "order": [],
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('UserBarangay/backLogDisplay') ?>",
                "method": "POST",
                "data": function(data) {
                    data.backLogDate = $('#backLogDate').val();

                }
            },
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bAutoWidth": false,
            "bSort": false,

        });


        $('#backLogDate').change(function() {
            datatable.draw();

            setTimeout(() => {
                var table_length = datatable.data().count();
                if ($('#backLogDate').val() == "") {
                    alert("Date field must no be empty!")
                } else {
                    if (table_length == 0) {

                        $('#sample_table').hide();
                        $('#entryBacklog').show();


                    } else {
                        $('#entryBacklog').hide();
                        $('#sample_table').show();

                    }
                    console.log(table_length)
                }
            }, 1000);


        });
        $('#user_form_backlog').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('UserBarangay/backLogInput') ?>",
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
                    toastr.success('Data Submitted!');
                    $('#user_form')[0].reset();
                }
            });
        });
        $('#user_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('UserBarangay/updateReview') ?>",
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
                    toastr.success('Data Updated!');
                    $('#sample_table').DataTable().ajax.reload();


                }

            });
        });
        $(document).on('click', '.edit', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "<?= site_url('UserBarangay/fetch_single_data') ?>",
                method: "POST",
                data: {
                    id: id
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#wastes').val(data.volume);
                    $('#attempt').val(data.attempt);
                    $('#attempt_count').text(data.attempt);
                    $('.modal-title').text('Update ' + data.waste_type + ' weight');
                    $('#userModal').modal('show');
                    if ($("#attempt").val() == 0) {
                        $("#edit_content").hide();
                        $('#attempt_content').show();
                        $('.modal-title').text('Update Attempt');
                    } else {
                        $("#edit_content").show();
                        $('#attempt_content').hide();
                        $('.modal-title').text('Update ' + data.waste_type + ' weight');
                    }

                    $('#hidden_id').val(id);


                }
            });
        });
    });
</script>

</html>