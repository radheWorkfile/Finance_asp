

            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Source <span class="text-danger">*</span></label>
                        <select class="form-control" name="source" id="source">
                        <option value=""> ---- Select One ---- </option>
                            <option value="1" <?php echo 1 == $income_data['source']?"Selected":"";?>>collection Amount</option>
                            <option value="2"<?php echo 2 == $income_data['source']?"Selected":"";?>>Interest Amount</option>
                            <option value="3"<?php echo 3 == $income_data['source']?"Selected":"";?>>Processing Fee</option>
                         </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">Mode of Payment <span class="text-danger">*</span></label>
                        <select class="form-control" name="mop" id="mop">
                            <option value=""> ---- Select one --- </option>
                            <option value="1"<?php echo 1 == $income_data['mop']?"Selected":"";?>>Cash</option>
                            <option value="2"<?php echo 2 == $income_data['mop']?"Selected":"";?>>Online</option>
                            <option value="3"<?php echo 3 == $income_data['mop']?"Selected":"";?>>cheque</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12"  id="cash_received_section" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">cash Received By <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="cash_received_by" id="cash_received_by" placeholder="Enter name">
                    </div>
                </div>
                <div class="col-lg-12" id="received_acc_section" style="display: none;">
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
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="example-email-input" class="form-label">Amount <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount" id="example-email-input" value="<?php echo $income_data['amount'];?>">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="lab">Income Date: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="income_date" id="income_date" value="<?php echo $income_data['income_date'];?>">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Verification Proof Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="varification_proof_type" id="varification_proof_type" onchange="return upload_proof(this.value)">
                            <option value=""> ---- Select one --- </option> 
                            <option value="1" <?php echo 1 == $income_data['varification_proof_type']?"Selected":"";?>>Receipt</option>
                            <option value="2" <?php echo 2 == $income_data['varification_proof_type']?"Selected":"";?>>Bank Statement</option>
                            <option value="3" <?php echo 3 == $income_data['varification_proof_type']?"Selected":"";?>>Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12" id="proof_image_section" style="display: none;">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Upload proof image<span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                        <input class="form-control" type="file" name="proof_image" id="proof_image">
                    </div>
                </div>
            </div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/accounting/income.js"></script>