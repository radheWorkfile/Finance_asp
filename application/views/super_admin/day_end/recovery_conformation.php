<div class="row">

    <p style="font-family: ui-monospace; font-weight: 600; font-size: 15px; color: darkred;">Are you sure you want to Save Recovery Loan ID <?php echo $all_data['loan_no'] ?> Client Name <?php echo $all_data['first_name']. " ". $all_data['mid_name']. " ". $all_data['last_name'] ?> Guardian <?php echo $all_data['nominee_name'] ?> and Amount is <?php echo $all_data['monthly_emi'] ?> ?</p>
    <input type="hidden" name="emi_id" id="emi_id" value="<?php echo $all_data['id'] ?>">
    <input type="hidden" name="member_id" id="member_id" value="<?php echo $all_data['mem_id'] ?>">
    <input type="hidden" name="group_loan_id" id="group_loan_id" value="<?php echo $all_data['group_loan_id'] ?>">
    <input type="hidden" name="total_payble_amount" id="total_payble_amount" value="<?php echo $all_data['monthly_emi'] ?>">
    <input type="hidden" name="emi_date" id="emi_date" value="<?php echo $all_data['payment_date'] ?>">
    <input type="hidden" name="paid_amount" id="paid_amount" value="<?php echo $all_data['monthly_emi'] ?>">

</div>