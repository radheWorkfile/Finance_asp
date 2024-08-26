<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrums ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="commission_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Agent Name </label>
                        <select name="agent_name" id="agent_name" class="form-control">
                            <option value=""> ---- Select One ---- </option>
                            <?php foreach($agent as $age) { ?>
                                <option value="<?php echo $age['id'] ?>"><?php echo $age['name'] . "(" . $age['agent_id'] . ")" ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">loan Product <span class="text-danger">*</span></label>
                        <select name="loan_product" id="loan_product" class="form-control">
                            <option value=""> ---- Select One ---- </option>
                            <?php foreach($loan_product as $loan_prod) { ?>
                                <option value="<?php echo $loan_prod['id'] ?>"><?php echo $loan_prod['loan_product_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
            </div>
            <!-- <input type="submit" class="btn btn-primary" value="create"> -->
        </form>
    </div>
</div>

<!-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="leadtable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Customer Name</th>
                            <th>Agent Name</th>
                            <th>Loan Type</th>
                            <th>Commission Type</th>
                            <th>Commission Amount</th>
                        </tr>
                    </thead>
                </table>
            </div>  -->
            <!-- end card-body -->
        <!-- </div> -->
        <!-- end card -->
    <!-- </div> -->
    <!-- end col -->
<!-- </div> -->

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/commission.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>