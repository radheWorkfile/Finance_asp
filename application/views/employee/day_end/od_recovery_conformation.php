<div class="row">

    <p style="font-family: ui-monospace; font-weight: 600; font-size: 15px; color: darkred;">Are you sure you want to Recovery OD Loan ID <?php echo $od_data['loan_no'] ?> Client Name <?php echo $od_data['first_name']. " ". $od_data['mid_name']. " ". $od_data['last_name'] ?> Guardian <?php echo $od_data['nominee_name'] ?> and Amount is <?php echo $od_data['rest_amount'] ?> ?</p>
    <input type="hidden" name="id" id="id" value="<?php echo $od_data['id'] ?>">
    <input type="hidden" name="emi_id" id="emi_id" value="<?php echo $od_data['emi_id'] ?>">
    <input type="hidden" name="group_loan_id" id="group_loan_id" value="<?php echo $od_data['group_loan_id'] ?>">
    <input type="hidden" name="paid_amount" id="paid_amount" value="<?php echo $od_data['paid_amount'] ?>">
    <input type="hidden" name="rest_amount" id="rest_amount" value="<?php echo $od_data['rest_amount'] ?>">

</div>