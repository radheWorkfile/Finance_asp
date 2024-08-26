<div class="row">
    <div class="col-lg-6">
        <label>Total Payble Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="hidden" class="form-control" name="commission_earning_id" id="commission_earning_id" value="<?php echo $upd_commission['id'] ?>">
            <input type="hidden" class="form-control" name="agent_id" id="agent_id" value="<?php echo $upd_commission['agent_name'] ?>">
            <input type="text" class="form-control" name="total_payble_amount" id="total_payble_amount" value="<?php echo $upd_commission['total_commission_amount'] ?>" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <label>Current Rest Amount:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" name="current_rest_amount" id="current_rest_amount" value="<?php if(!empty($rest_amt['rest_amount'])) { echo $rest_amt['rest_amount']; } else { echo "0"; } ?>" readonly>
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
        <label>Mode Of Payment:<span class="text-danger">*</span></label>
        <div class="mb-3">
            <select name="mop" id="mop" class="form-control">
                <option value="">----Select One----</option>
                <option value="1">Online</option>
                <option value="2">Cheque</option>
                <option value="3">Cash</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6" id="acc_no_section" style="display:none;">
        <label>Account No.:</label>
        <div class="mb-3">
            <select name="acc_no" id="acc_no" class="form-control">
                <option value="">----Select One----</option>
                <option value="1">5745457445</option>
                <option value="2">24545445744</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6" id="cash_received_section" style="display: none;">
        <label>Cash Received By: <span class="text-danger">*</span></label>
        <div class="mb-3">
            <input type="text" class="form-control" name="cash_received_by" id="cash_received_by" placeholder="Enter Name Of Cash Receiver">
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
    <div class="col-lg-6">
        <label>Upload Recipet:</label>
        <div class="mb-3">
            <input type="file" name="recipet" id="recipet" class="form-contol">
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

            }
        })
    });
</script>