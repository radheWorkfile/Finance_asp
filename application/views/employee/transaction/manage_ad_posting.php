<style>

.header-green {background-color: #008288;color: #fff;}

.ami_dev{padding:10px 0px 10px 10px;background-color:#3b5998;color:#fff;border:1px solid #3b5998;text-transform:uppercase;font-weight:bold;}
.ami_dev span i{padding:5px;background-color:#fff;border-radius:5px;color:#3b5998;}
.brAddr{ font-size:1rem !important;text-transform: capitalize;}
.cmpnyHedng{text-align: center;font-weight: bold;color: #0576B9;font-size: 1.6rem;line-height: 1.3;margin-bottom: 5px;text-transform: uppercase;}
#uriActn{ display: none;}
</style>
<!-- start page title -->
<?php echo $this->session->flashdata('common') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0 ami_dev" style="margin-left: 6px; margin-right: 6px; border-radius: 0px;">
            <h4 class="mb-sm-0 font-size-16 fw-bold" style="color: white;">
                <?php echo $title ?>
            </h4>

            <div class="page-title-right" style="color: white;">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item" style="color: white;"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active" style="color: white; margin-right: 5px;">
                        <?php echo $breadcrums ?>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <form id="filter_ad_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="col-4" style="margin-top: 10px; margin-right: 10px; float: right;">
                    <div class="input-group mb-3">
                        <select name="center" id="center" class="form-control select2">
                            <option value="">---- Select One Center ----</option>
                            <?php foreach ($center as $scent) { ?>
                                <option value="<?php echo $scent['id'] ?>"><?php echo $scent['center_name'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="search" name="submit" class="btn btn-primary" style="margin-left: 10px;">
                    </div>
                </div>
            </form>
            <div class="card-body">
                <table id="advRecData" class="table table-bordered dt-responsive nowrap w-100">
                    <thead class="header-green">
                        <tr>
                            <th>S.No.</th>
                            <th>Loan Id</th>
                            <th>Client Name</th>
                            <th>Guardian Name</th>
                            <th>Disburse Date</th>
                            <th>Adv Amount</th>
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
<div class="modal fade recovery_od_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">AD Recovery Conformation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ad_recovery_conformation_updata" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="up_ad_recovery"></div>
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

<script src="<?php echo base_url() ?>media/js/employee/transaction.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>




