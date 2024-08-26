<div class="row">
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Loan Product</label>
            <input type="hidden" name="loan_id" id="loan_id" class="form-control" value="<?php echo $upd_group_loan['id']; ?>">
            <input type="hidden" name="mem_id" id="mem_id" class="form-control" value="<?php echo $upd_group_loan['mem_id']; ?>">
            <select class="form-control" name="loan_product" id="loan_product" onchange="return loan_product_data(this.value)" readonly>
                <option value=""> ---- Select One ---- </option>
                <?php foreach ($product as $pro) { ?>
                    <option value="<?php echo $pro['id'] ?>" <?php echo ($pro['id'] == $upd_group_loan['loan_product']) ? "Selected" : "" ; ?>><?php echo $pro['loan_product_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount" value="<?php echo $upd_group_loan['amount'] ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Loan Tenure</label>
            <input class="form-control" type="text" name="tenure" id="tenure" placeholder="Enter tenure" value="<?php echo $upd_group_loan['tenure'] ?>" readonly>
            <select class="form-control" name="tenure_type" id="tenure_type" readonly>
                <option value=""> ---- Select One ---- </option>
                <option value="1" <?php echo ($upd_group_loan['tenure_type'] == 1) ? "Selected" : "" ; ?>> Weekly </option>
                <option value="2" <?php echo ($upd_group_loan['tenure_type'] == 2) ? "Selected" : "" ; ?>> Bi-Weekly </option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Rate of Interest</label>
            <input class="form-control" type="text" name="roi" id="roi" placeholder="Enter Rate of Interest"
                id="example-number-input" value="<?php echo $upd_group_loan['roi']; ?>" readonly>
            <input type="hidden" name="interest_type" id="interest_type" class="form-control" value="<?php echo $upd_group_loan['interest_type']; ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Processing Fee</label>
            <input class="form-control" type="text" name="processing_fee" id="processing_fee" value="<?php echo $upd_group_loan['processing_fee'] ?>" readonly>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="lab">Disbursement Date:</label>
            <input type="date" class="form-control" name="loan_start_date" id="loan_start_date" value="<?php echo $upd_group_loan['loan_start_date'] ?>">
        </div>
    </div>
    <?php $date = $upd_group_loan['week']; ?>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-control" name="disbursment_status" id="disbursment_status">
                <option value=""> ---- Select One ---- </option>
                <option value="1" <?php echo ($upd_group_loan['disbursment_status'] == 1) ? "Selected" : ""; ?>>pending</option>
                <?php //if(date('W') > $date) { ?>
                    <option value="2" <?php echo ($upd_group_loan['disbursment_status'] == 2) ? "Selected" : ""; ?>>Approved</option>
                <?php //} ?>
            </select>
        </div>
    </div>
</div>