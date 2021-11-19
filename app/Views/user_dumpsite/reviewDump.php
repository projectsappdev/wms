<?= $this->include('layouts/header.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" id="mybody">
    <div class="wrapper">
        <?= $this->include("layouts/navbar.php"); ?>
        <?= $this->include("layouts/sidebar_user_dump.php"); ?>
        <div class="content-wrapper">
            <?= $this->include("layouts/breadcrumb.php"); ?>
            <div class="content">
                <div class="container">

                    <span id="message"></span>
                    <div class="card">
                        <div class="card-header bg-info">Your Current Data</div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="sample_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Waste Type</th>
                                            <th>Volume</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>



                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-info">Your Record As of <strong><?php

                                                                                    echo date('M d, Y', strtotime("-1 days"));

                                                                                    ?></strong> </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="yesterday_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Waste Type</th>
                                            <th>Volume</th>

                                        </tr>
                                    </thead>


                                </table>
                            </div>
                        </div>
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
                        <h4 class="modal-title">Update Data</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="" method="post" id="user_form">

                            <input type="number" step="any" id="wastes" name="wastes" class="form-control">
                            <?php


                            /*  foreach ($data as $rows) {
                                echo '
                                            <div class="card-body">
                                            <div class="input-group mb-8">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">' . $rows["waste_type"] . '</span>
                                                </div>
                                                <input type="number" step="any" value="' .  $rows["volume"] . '" class="form-control getNum"  placeholder="Input Volume (tons)" name="' .  $rows["waste_type"] . '" id="' .  $rows["waste_type"] . '">
                                            </div>
                                        </div>';
                            } */
                            ?>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit_button" id="submit_button"><i class="fas fa-save" id="icon_saved"></i> Save</button>

                        <!--     <input type="submit" class="btn btn-success" name="submit" id="submit_button" /> -->
                    </div>
                </form>

            </div>
        </div>
        </form>
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
                url: "<?= site_url('UserDumpsite/fetchData') ?>",
                type: "POST",
            },
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bAutoWidth": false,
            "bSort": false,
            "langugae": {
                "emptyTable": "You have not submitted any data for this day yet."
            }
        });

        $('#yesterday_table').DataTable({
            "language": {
                "emptyTable": "You have not submitted any data on this day."
            },
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?= site_url('UserDumpsite/fetchBacklog') ?>",
                type: "POST",
            },
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bAutoWidth": false,
            "bSort": false,
            "langugae": {
                "emptyTable": "You have not submitted any data for this day yet."
            }
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
        /*  $('input').on('input', function() {
              var limitW = $('#limitvalue').val();
              var value = $(this).val();

              if ((value !== '') && (value.indexOf('.') === -1)) {

                  $(this).val(Math.max(Math.min(value, limitW), 0));

              }

          });

          $('#submit_button').click(function() {

              alert($('#wastes').val());
          }) */

        /*     $('input').on('input', function() {
                 var limitW = $('#limitvalue').val();
                 var value = $(this).val();

                 if ((value !== '') && (value.indexOf('.') === -1)) {

                     $(this).val(Math.max(Math.min(value, limitW), 0));

                 }

             }); */
        $('#user_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= site_url('UserDumpsite/updateReview') ?>",
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
                url: "<?= site_url('UserDumpsite/fetch_single_data') ?>",
                method: "POST",
                data: {
                    id: id
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#wastes').val(data.volume);
                    $('.modal-title').text('Alter ' + data.waste_type + ' weight');
                    $('#userModal').modal('show');
                    $('#hidden_id').val(id);

                }
            });
        });

    });
</script>

</html>