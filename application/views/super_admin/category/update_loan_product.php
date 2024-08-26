<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Loan Product Name</label>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $loan['id']; ?>">
            <input class="form-control" type="text" name="loan_product_name" id="loan_product_name" value="<?php echo $loan['loan_product_name']; ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input class="form-control" type="text" name="amount" id="amount" value="<?php echo $loan['amount'] ?>"oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Tenure</label>
            <input class="form-control" type="text" name="tenure" id="tenure" value="<?php echo $loan['tenure'] ?>"oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Processing Fee</label>
            <input class="form-control" type="text" name="processing_fee" id="processing_fee" value="<?php echo $loan['processing_fee'] ?>"oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Interest Type</label>
            <select class="form-control" name="interest_type" id="interest_type">
                <option value=""> ---- Select One ---- </option>
                <option value="1" <?php echo ($loan['interest_type'] == 1) ? "Selected" : ""; ?>>Percentage</option>
                <option value="2" <?php echo ($loan['interest_type'] == 2) ? "Selected" : ""; ?>>Amount</option>
            </select>
        </div>
    </div>
    <?php if($loan['interest_type'] == 1) { ?>
        <div class="col-lg-12" id="percentage_section">
            <div class="mb-3">
                <label class="form-label">Interest Percentage (%)</label>
                <input class="form-control" type="text" name="interest_percentage" id="interest_percentage" value="<?php echo $loan['interest_percentage']; ?>"oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
    <?php } ?>
    <?php if($loan['interest_type'] == 2) { ?>
        <div class="col-lg-12" id="amount_section">
            <div class="mb-3">
                <label class="form-label">Interest Amount</label>
                <input class="form-control" type="text" name="interest_amount" id="interest_amount" value="<?php echo $loan['interest_amount']; ?>"oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
    <?php } ?>
</div>