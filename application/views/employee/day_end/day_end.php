<!-- vTbleShw     vCreateNew---and also---display:none;    -->
<style>
    .ami_dev {
        padding: 10px 0px 10px 10px;
        background-color: #3b5998;
        color: #fff;
        border: 1px solid #3b5998;
    }

    .ami_dev span i {
        padding: 5px;
        background-color: #fff;
        border-radius: 5px;
        color: #3b5998;
    }

    .ititle i {
        font-weight: 900;
    }

    .ititlee {
        float: right;
        margin: -35px 10px -5px -5px;
        color: #3b5998;
    }

    .ititle {
        padding: 4px 8px;
        background-color: #fff;
        border-radius: 15px;
        float: right;
        margin: -3px 10px -5px -5px;
        color: #3b5998;
    }

    .ititle:hover {
        background-color: #D3D3D3;
    }

    .dataTables_processing {
        background-color: #e4ffc4;
        margin-top: 30px !important;
        color: #396800;
    }

    .header-green {
        background-color: #008288;
        color: #fff;
    }

    .header-green tr th {
        border: 1px solid #008288;
    }



    .actv-btn {
        width: 90px;
        padding: 4px 0px 4px 0px;
        cursor: pointer;
        text-align: center;
        color: #f2f2f2;
        border-radius: 5px;
    }

    .bg-olive {
        border: 1px solid #019b5d;
        color: #019b5d;
    }

    .bg-orange {
        border: 1px solid #d56301;
        color: #d56301;
    }

    .bg-olive:hover {
        background-color: #008650;
        color: #fff;
    }

    .bg-orange:hover {
        background-color: #c45a00;
        color: #fff;
    }

    .modal-title span i {
        padding: 5px;
        background-color: #3b5998;
        border-radius: 5px;
        color: #fff;
    }

    .modal-title {
        color: #3b5998;
    }

    .form-control[readonly] {
        background-color: #fff !important;
    }

    #miniMize,
    #adBtnActn,
    #minBtnActn,
    #nCreateCode {
        display: none;
    }

    #mstrTitle {
        font-weight: 900;
        text-transform: uppercase;
    }

    .pull-right {
        float: right;
    }
</style>


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold">
                <p>End Day</p>
            </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $bredcrums ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="ami_dev"><span><i class="bx bxs-user-pin" style="font-size:1.1rem;"></i></span> <span id="mstrTitle">&nbsp;<?php echo config_item('work_end'); ?></span><span id="reload"></span>
        <form action="<?php echo base_url(); ?>employee/Day_end/day_end" method="post" id="addEndDataa">
            <a href="javascript:void(0);" class="ititlee miAction" id="AddNewww" data-id="<?php echo 'Date :-' . date('Y-m-d'); ?>" title="Back to dashboard"><span class="btn btn-light text-primary">
                    <input type="hidden" id="date" name="date" value="<?php echo ($radhe) ? $radhe : date('Y-m-d'); ?>">
                    <?php if (count($dayEndData) == 0) { ?>
                        <button type="submit" id="submit" style="border:2px solid #eff2f7;">End Day</button>
                    <?php } else if (count($dayEndData) != 0) { ?>
                        <button  style="border:2px solid #eff2f7;">End Day</button>
                    <?php } ?>
                </span></a>
        </form>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form id="filter_recovery_date" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="col-md-1" style="float: right;margin-top: 10px;">
                        <!-- <input type="submit" value="search" name="submit" class="btn btn-primary" style="margin-left: 5px;padding-bottom:1rem;padding-top:0.7rem;"> -->
                    </div>
                    <div class="col-6" style="margin-top: 10px; margin-right: 10px; float: right;">
                        <div class="input-group mb-3">
                            <!-- <select name="center" id="center" class="form-control select2 empSelectR"> -->
                            <!-- <option value="">---- Select One Center ----</option> -->
                            <? //php foreach ($center as $scent) { 
                            ?>
                            <!-- <option value="<? //php echo $scent['id'] 
                                                ?>"><? //php echo $scent['center_name'] 
                                                                                ?></option> -->
                            <? //php } 
                            ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <table id="dayEnd" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Loan Id</th>
                                <th>Client Name</th>
                                <th>Date</th>
                                <th>Guardian Name</th>
                                <th>Recovery Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>


    <!-- Pay EMI Modal Start -->
    <div class="modal fade recovery_posting_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Save Recovery Conformation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="recovery_conformation_updata" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="up_details"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Remove OD Modal Start -->
    <div class="modal fade remove_od_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Remove In OD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="remove_od_updata" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="remove_od_details"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




</div>
<!-- =======================================================================================   -->
</div>
<input type="hidden" id="locTrgt" value="super_admin/master/branch/cStatus">
<script src="<?php echo base_url() ?>media/js/employee/day-end.js"></script>

<script>
    $("#reload").click(function() {
        location.reload();
    });
</script>