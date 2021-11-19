<div class="modal fade" id="limitModal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="" method="" id="limit_form">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Weight Limit</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form action="" method="post" id="limit_form">

                        <div class="form-group">
                            <input type="number" value="<?php
                                                        $dataR = readfile("data.txt");


                                                        echo   substr($dataR, 0, -1); ?>" placeholder=" Enter weight limit" class="form-control" name="limitW" id="limitW">

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="limit_button" id="limit_button"><i class="fas fa-save" id="icon_saved"></i> Save</button>

                            <!--     <input type="submit" class="btn btn-success" name="submit" id="submit_button" /> -->
                        </div>
                    </form>

                </div>
        </div>
        </form>
    </div>
</div>


<!--$myfile = fopen("testfile.txt", "w") -->