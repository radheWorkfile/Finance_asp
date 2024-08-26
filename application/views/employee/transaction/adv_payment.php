<div class="row">
    <div class="col-lg-6">
        <label>Total Payble Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="hidden" class="form-control" name="emi_id" id="emi_id" value="<?php echo $adv_pay_data['id'] ?>">
            <input type="hidden" class="form-control" name="member_id" id="member_id" value="<?php echo $adv_pay_data['member_id'] ?>">
            <input type="hidden" class="form-control" name="group_loan_id" id="group_loan_id" value="<?php echo $adv_pay_data['group_loan_id'] ?>">
            <input type="text" class="form-control" name="total_payble_amount" id="total_payble_amount" value="<?php echo $adv_pay_data['monthly_emi'] ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>Current Adv Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>EMI date:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="date" class="form-control" name="emi_date" id="emi_date" value="<?php echo $adv_pay_data['payment_date'] ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>Paid Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" onchange="return paid_adv_amo(this.value)" name="paid_amount" id="paid_amount" placeholder="Enter Paid Amount">
        </div>
    </div>
    <div class="col-lg-6">
        <label>Adv Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" name="adv_amount" id="adv_amount" placeholder="Enter Advance Amount" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>Payment date:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="date" class="form-control" name="pay_date" id="pay_date" value="<?php echo date('Y-m-d')?>">
        </div>
    </div>
    <div class="col-lg-6">
        <label>Payment Remarks:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <textarea name="pay_remarks" id="pay_remarks" class="form-control"></textarea>
        </div>
    </div>
</div>

<script>


function paid_adv_amo(value) {
   var  total_payble_amount = $("#total_payble_amount").val();
   var paid = value;
   var totCalAmo = parseInt(paid)-parseInt(total_payble_amount)
   var  adv_amount = $("#adv_amount").val(totCalAmo);
}
</script>