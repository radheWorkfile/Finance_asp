<div class="row">
    <div class="col-lg-6">
        <label>Total Payble Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="hidden" class="form-control" name="emi_id" id="emi_id" value="<?php echo $od_data['id'] ?>">
            <input type="hidden" class="form-control" name="member_id" id="member_id" value="<?php echo $od_data['member_id'] ?>">
            <input type="hidden" class="form-control" name="group_loan_id" id="group_loan_id" value="<?php echo $od_data['group_loan_id'] ?>">
            <input type="text" class="form-control" name="total_payble_amount" id="total_payble_amount" value="<?php echo $od_data['monthly_emi'] ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>Current Rest Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" name="current_rest_amount" id="current_rest_amount" value="<?php if(!empty($last_rest_amount['rest_amount'])) { echo $last_rest_amount['rest_amount']; } else { echo $emi_data['monthly_emi']; } ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>EMI date:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="date" class="form-control" name="emi_date" id="emi_date" value="<?php echo $od_data['payment_date'] ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>Paid Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" name="paid_amount" id="paid_amount" placeholder="Enter Paid Amount" onchange="return dues(this.value)">
        </div>
    </div>
    <div class="col-lg-6">
        <label>Rest Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" name="rest_amount" id="rest_amount" placeholder="Enter Rest Amount" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>Payment date:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="date" class="form-control" name="pay_date" id="pay_date" value="<?php echo date('Y-m-d') ?>">
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

    function dues(value) {

        var total_payble_amount = $('#total_payble_amount').val();
        var current_rest_amount = $('#current_rest_amount').val();
        var paid = value;
        if(current_rest_amount == 0) {

            var due = total_payble_amount - paid;
        } else {

            var due = current_rest_amount - paid;
        }
        $('#rest_amount').val(due);

    }

    $(document).ready(function() {

        $('#mop').on('change', function() {
            id = this.value;
            if (id == 1 || id == 2) {

                $("#acc_no_section").show('slow');
                $('#cash_received_section').hide('slow');

            } else if(id == 3) {

                $('#cash_received_section').show('slow');
                $("#acc_no_section").hide('slow');

            } else {

                $('#cash_received_section').hide('slow');
                $("#acc_no_section").hide('slow');
            }
        })

    });

</script>