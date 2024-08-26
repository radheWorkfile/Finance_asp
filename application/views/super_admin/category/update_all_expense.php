                <input  type="hidden" name="id" id="id" value="<?php echo $up_mis_exp['id'];?>">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">Expense <span class="text-danger">*</span></label>

                        <select class="form-control" name="expense_name" id="expense_name">
                            <option value=""> ---- Select one --- </option>
                             <?php foreach($expense as $exp):?> 
                                <option value="<?php echo $exp['id'];?>"<?php echo $exp['id'] == $up_mis_exp['expNameId']?'selected':"";?>><?php echo $exp['exp_name'];?></option>
                                <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">Mode of Payment <span class="text-danger">*</span></label>
                        <select class="form-control" name="mop" id="mop">
                            <option value=""> ---- Select one --- </option>
                            <option value="1"<?php if($up_mis_exp['mop'] == 1){ echo 'selected';}?>>Cash</option>
                            <option value="2"<?php if($up_mis_exp['mop'] == 2){ echo 'selected';}?>>Online</option>
                            <option value="3"<?php if($up_mis_exp['mop'] == 3){ echo 'selected';}?>>cheque</option>  
                        </select>
                    </div>
                </div>
                <div class="col-lg-12"  id="cash_received_section" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">cash Received By <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="cash_received_by" id="cash_received_by" placeholder="Enter name"value="<?php echo $up_mis_exp['cash_received_by'];?>">
                    </div>
                </div>
                <div class="col-lg-12" id="received_acc_section" style="display: none;">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Received Account No. <span class="text-danger">*</span></label>
                        <select class="form-control" name="Received_acc_no" id="Received_acc_no">
                            <option value=""> ---- Select one --- </option>
                            <option value="1"<?php if($up_mis_exp['Received_acc_no'] == 1){ echo 'selected';}?>>879565239595</option>
                            <option value="2"<?php if($up_mis_exp['Received_acc_no'] == 1){ echo 'selected';}?>>489575621365</option>
                            <option value="3"<?php if($up_mis_exp['Received_acc_no'] == 1){ echo 'selected';}?>>479845896585</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="example-email-input" class="form-label">Amount <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount" value="<?php echo $up_mis_exp['amount'];?>">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="lab">Expense Date: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="expense_data" id="expense_data" value="<?php echo date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-lg-12"> 
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Verification Proof Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="varification_proof_type" id="varification_proof_type" onchange="return upload_proof(this.value)">
                            <option value=""> ---- Select one --- </option>
<<<<<<< HEAD
                            <option value="1"<?php if($up_mis_exp['varification_proof_type'] == 1){ echo 'selected';}else{echo '0';}?>>Receipt</option>
                            <option value="2"<?php if($up_mis_exp['varification_proof_type'] == 2){ echo 'selected';}else{echo '0';}?>>Bank Statement</option>
                            <option value="3"<?php if($up_mis_exp['varification_proof_type'] == 3){ echo 'selected';}else{echo '0';}?>>Others</option>
=======
                            <option value="1"<?php if($up_mis_exp['varification_proof_type'] == 1){ echo 'selected';}?>>Receipt</option>
                            <option value="2"<?php if($up_mis_exp['varification_proof_type'] == 2){ echo 'selected';}?>>Bank Statement</option>
                            <option value="3"<?php if($up_mis_exp['varification_proof_type'] == 3){ echo 'selected';}?>>Others</option>
>>>>>>> radhe_1
                        </select>
                    </div>
                </div>
                <div class="col-lg-12" id="proof_image_section" style="display: none;">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Upload proof image<span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
<<<<<<< HEAD
                        <input class="form-control" type="file" name="proof_image" id="proof_image">
=======
                        <input class="form-control" type="file" name="proof" id="proof"value="<?php echo $up_mis_exp['proof'] ?>">
>>>>>>> radhe_1
                    </div>
                </div>

<script src="<?php echo base_url() ?>media/js/super_admin/category/expense.js"></script>
