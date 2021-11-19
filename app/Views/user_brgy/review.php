<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar_user.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>
            <div class="content">
                <div class="container">

                    <span id="message"></span>

                    <div class="table-responsive">
                        <table id="sample_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Waste Type </th>
                                    <th>Volume</th>
                                    <th>Attempt</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>



                        </table>
                    </div>

                </div>

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
<Script>
    $(document).ready(function() {

        $("#Page_title").text("Review Data");
        $("#b_crumb_subtitle").text("waste");
        $('#wastenav').addClass("active");
        $('#manage').addClass("active");
        $('#manage_nav_item').attr("class", "nav-item menu-open");

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
        $('#sample_table').DataTable({
            "language": {
                "emptyTable": "You have not submitted any data for this day yet."
            },
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?= site_url('UserBarangay/fetchData') ?>",
                type: "POST",
            },
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bAutoWidth": false,
            "bSort": false

        });
    });
</script>

<script>
    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'bottomRight',
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


    });
</script>
<script>
    $(document).ready(function() {

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