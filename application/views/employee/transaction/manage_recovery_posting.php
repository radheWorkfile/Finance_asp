<style>
    .header-green {
        background-color: #008288;
        color: #fff;
    }

    .ami_dev {
        padding: 10px 0px 10px 10px;
        background-color: #3b5998;
        color: #fff;
        border: 1px solid #3b5998;
        text-transform: uppercase;
        font-weight: bold;
    }

    .ami_dev span i {
        padding: 5px;
        background-color: #fff;
        border-radius: 5px;
        color: #3b5998;
    }

    .brAddr {
        font-size: 1rem !important;
        text-transform: capitalize;
    }

    .cmpnyHedng {
        text-align: center;
        font-weight: bold;
        color: #0576B9;
        font-size: 1.6rem;
        line-height: 1.3;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    #uriActn {
        display: none;
    }
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
    <!----------------------------------------------------------------------------------->
    <div class="col-12">
        <?php
        // $getDetails=$this->transaction_model->manage_recover_details('36');
        //print_r($getDetails);
        //echo $this->db->last_query().'<br>';

        //$updateArr=array('name',);	
        ?>
    </div>
    <!----------------------------------------------------------------------------------->


    <div class="col-12">
        <div class="card">


            <div class="row">

                <div class="col-md-11">
                    <form id="filter_recovery_date" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="col-md-1" style="float: right;margin-top: 10px;">
                            <input type="hidden" id="dsfdfsd" value="<?php echo $scent['id']; ?>">
                            <input type="submit" value="search" name="submit" class="btn btn-primary" style="margin-left: 5px;padding-bottom:1rem;padding-top:0.7rem;">
                        </div>
                        <div class="col-6" style="margin-top: 10px; margin-right: 10px; float: right;">
                            <div class="input-group mb-3">
                                <select name="center" id="center" class="form-control select2 empSelectR">
                                    <option value="">---- Select One Center ----</option>
                                    <?php foreach ($center as $scent) { ?>
                                        <option value="<?php echo $scent['id'] ?>"><?php echo $scent['center_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-1" style="margin-left:-1rem;">
                    <form method="post" id="postingDAta">
                        <input type="hidden" id="psCenterId" name="psCenterId">
                        <input type="hidden" id="isPosting" name="isPosting" value="gotIt">
                        <button class="btn btn-primary" name="posting" type="submit" style="padding-bottom:1rem;padding-top:0.7rem;margin-top:10px">
                            Posting
                        </button>
                    </form>
                </div>

            </div>
            <div class="card-body">
                <table id="paidtable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead class="header-green">
                        <tr>
                            <th>S.No.</th>
                            <th>Loan Id</th>
                            <th>Client Name</th>
                            <th>Guardian Name</th>
                            <!-- <th>Emi</th> -->
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


<div class="modal fade adv_pay_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Advance Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="adv_payment_updata" method="post">
                <div class="modal-body">
                    <div id="adv_payment_details"></div>
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

<script>

</script>