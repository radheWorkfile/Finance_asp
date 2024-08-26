<div class="row">
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Loan Product</label>
            <input type="hidden" name="loan_id" id="loan_id" class="form-control" value="<?php echo $upd_loan['id']; ?>">
            <select class="form-control" name="loan_product" id="loan_product" onchange="return loan_product_data(this.value)">
                <option value=""> ---- Select One ---- </option>
                <?php foreach ($product as $pro) { ?>
                    <option value="<?php echo $pro['id'] ?>" <?php echo ($pro['id'] == $upd_loan['loan_product']) ? "Selected" : "" ; ?>><?php echo $pro['loan_product_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Amount <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount" value="<?php echo $upd_loan['amount'] ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Loan Tenure <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="tenure" id="tenure" placeholder="Enter tenure" value="<?php echo $upd_loan['tenure'] ?>">
            <select class="form-control" name="tenure_type" id="tenure_type">
                <option value=""> ---- Select One ---- </option>
                <option value="1" <?php echo ($upd_loan['tenure_type'] == 1) ? "Selected" : "" ; ?>> Daily </option>
                <option value="2" <?php echo ($upd_loan['tenure_type'] == 2) ? "Selected" : "" ; ?>> Weekely </option>
                <option value="3" <?php echo ($upd_loan['tenure_type'] == 3) ? "Selected" : "" ; ?>> Monthly </option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Rate of Interest <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="roi" id="roi" placeholder="Enter Rate of Interest"
                id="example-number-input" value="<?php echo $upd_loan['rate_of_interest']; ?>" readonly>
            <input type="hidden" name="interest_type" id="interest_type" class="form-control" value="<?php echo $upd_loan['interest_type']; ?>" readonly>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="example-number-input" class="form-label">Loan Type <span class="text-danger">*</span></label><br>
            <input type="radio" name="loan_type" id="loan_type" value="1" <?php echo ($upd_loan['loan_type'] == 1) ? "Checked" : "" ; ?> onchange="view_chrt_fxd(this.value)"> <span style="color: gray; font-size: 15px; font-weight:600;">Fixed</span><br>

            <?php if($upd_loan['interest_type'] == 1) { ?>
                <input type="radio" name="loan_type" id="loan_type" value="2" <?php echo ($upd_loan['loan_type'] == 2) ? "Checked" : "" ; ?> onchange="view_chrt_reducng(this.value)"><span style="color: gray; font-size: 15px; font-weight:600;">Reducing</span>
            <?php } ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="lab">Payment Start Date: <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="loan_start_date" id="loan_start_date" value="<?php echo $upd_loan['loan_start_date'] ?>">
        </div>
    </div>
</div>