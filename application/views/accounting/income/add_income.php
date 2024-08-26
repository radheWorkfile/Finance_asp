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
        <form id="add_agent_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Source <span class="text-danger">*</span></label>
                        <select class="form-control" name="source" id="source">
                        <option value=""> ---- Select One ---- </option>
                        <?php //foreach($product as $pro) { ?>
                            <option value="1">collection Amount</option>
                            <option value="2">Interest Amount</option>
                            <option value="3">Processing Fee</option>
                        <?php //} ?>
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">Mode of Payment <span class="text-danger">*</span></label>
                        <select class="form-control" name="mop" id="mop">
                            <option value="0"> ---- Select one --- </option>
                            <option value="1">Cash</option>
                            <option value="2">Online</option>
                            <option value="3">cheque</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6"  id="cash_received_section" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">cash Received By <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="cash_received_by" id="cash_received_by" placeholder="Enter name">
                    </div>
                </div>
                <div class="col-lg-6" id="received_acc_section" style="display: none;">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Received Account No. <span class="text-danger">*</span></label>
                        <select class="form-control" name="Received_acc_no" id="Received_acc_no">
                            <option value=""> ---- Select one --- </option>
                            <option value="1">879565239595</option>
                            <option value="2">489575621365</option>
                            <option value="3">479845896585</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-email-input" class="form-label">Amount <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount" id="example-email-input">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="lab">Income Date: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="income_date" id="income_date" value="<?php echo date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Verification Proof Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="varification_proof_type" id="varification_proof_type" onchange="return upload_proof(this.value)">
                            <option value="0"> ---- Select one --- </option>
                            <option value="1">Receipt</option>
                            <option value="2">Bank Statement</option>
                            <option value="3">Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6" id="proof_image_section" style="display: none;">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Upload proof image<span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                        <input class="form-control" type="file" name="proof_image" id="proof_image">
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/accounting/income.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>