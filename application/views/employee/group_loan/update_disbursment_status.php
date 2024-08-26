<div class="row">
    <p style="font-family: ui-monospace; font-weight: 600; font-size: 15px; color: darkred;">Did you Want to Approve Disburshment of <?php echo $refresh['first_name']. " ". $refresh['mid_name']. " ". $refresh['last_name'] ?>!</p>
    <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $refresh['id']; ?>">
    <input type="hidden" name="member_id" id="member_id" value="<?php echo $refresh['member_id'] ?>">
</div>