<style>
.header-green {background-color: #008288;color: #fff;}
.fontColMan{color:#008288;border:1px dotted #008288;border-radius:0.2rem;padding:0.2rem 0.6rem;}
.ami_dev{padding:10px 0px 10px 10px;background-color:#3b5998;color:#fff;border:1px solid #3b5998;text-transform:uppercase;font-weight:bold;}
/* .tIcM{text-align:center!important;} */
.ami_dev span i{padding:5px;background-color:#fff;border-radius:5px;color:#3b5998;}
.brAddr{ font-size:1rem !important;text-transform: capitalize;}
.cmpnyHedng{text-align: center;font-weight: bold;color: #0576B9;font-size: 1.6rem;line-height: 1.3;margin-bottom: 5px;text-transform: uppercase;}
#uriActn{ display: none;}
</style>
<!-- start page title -->
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
            <form id="filter_recovery_date" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="col-4" style="margin-top: 10px; margin-right: 10px; float: right;">
                    <div class="input-group mb-3">
                        <select name="center" id="center" class="form-control select2">
                            <option value="">---- Select One Center ----</option>
                            <?php foreach ($forse_close_data as $scent) { ?>
                                <option value="<?php echo $scent['id'] ?>"><?php echo $scent['center_name'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="search" name="submit" class="btn btn-primary" style="margin-left: 10px;">
                    </div>
                </div>
            </form>
            <div class="card-body">
                <table id="leadtable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead class="header-green">
                        <tr>
                            <th class="tIcM">S.No.</th>
                            <th class="tIcM">Client Name</th>
                            <th class="tIcM">Loan Id</th>
                            <th class="tIcM">Recovery Amount</th>
                            <th class="tIcM">Fore Close Amount</th>
                            <th class="tIcM">Action</th>
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

<!-- View Lead Modal Start -->
<div class="modal fade view_paid_emi_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">View Paid EMI Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="show_group_loan_paid_emi"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Pay EMI Modal Start -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"style="border-top:0.2rem solid #0576b9;">
        <h1 class="modal-title fs-5" id="exampleModalLabel"style="color:#0576b9;"><i class="fas fa-regular fa-snowflake"></i>&nbsp;&nbsp;Force Close Loan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="viewDetails">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
 
<!-- View Lead Modal End-->
<input type="hidden" id="target" value="<?php echo $target;?>" />

<script src="<?php echo base_url() ?>media/js/employee/fore_close.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>



