<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Loan Product <span class="text-danger">*</span></label>
            <input type="hidden" name="commission_id" id="commission_id" class="form-control" value="<?php echo $commission_cate['id'] ?>">
            <select name="loan_product" id="loan_product" class="form-control">
                <option value=""> ---- Select One ---- </option>
                <?php foreach ($loan_product as $loan_prod) { ?>
                    <option value="<?php echo $loan_prod['id'] ?>" <?php echo ($loan_prod['id'] == $commission_cate['loan_product']) ? "Selected" : ""; ?>><?php echo $loan_prod['loan_product_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Commission Percentage <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="commission_percentage" id="commission_percentage" value="<?php echo $commission_cate['commission_percentage']; ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
        </div>
    </div>
</div>