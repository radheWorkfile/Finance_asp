<style>
    .newSec{color:#5b83a6;font-weight:800;margin-top:-1rem;}
</style>
<div class="row">

    <p class="newSec">Name - <?php echo $ad_data['first_name']. " ". $ad_data['mid_name']. " ". $ad_data['last_name'] ?></p>
    <p class="newSec">Nominee Name - <?php echo $ad_data['nominee_name'] ?></p>
    <p class="newSec">Loan Id - <?php echo $ad_data['emi_id'] ?></p>
    <p class="newSec">Emi Amount - ₹<?php echo $ad_data['monthly_emi'];?></p>
     <?php 
        if($ad_data['adv_amount'] >= $ad_data['monthly_emi'])
        {
           echo '<span style="font-size:800;color:#509d96;margin-top:-1rem;">Remailing Amo - </span>'.$ad_data['adv_amount']-$ad_data['monthly_emi'];
        }
     ?>
    <p class="newSec">Advance Amount is - ₹<?php echo $ad_data['adv_amount'];?></p>

    

<!-- ===================================== No Need This section ============================== -->
    <input type="hidden" name="id" id="id" value="<?php echo $ad_data['id'] ?>">
    <input type="hidden" name="monthly_emi" id="monthly_emi" value="<?php echo $ad_data['monthly_emi'] ?>">
    <input type="hidden" name="emi_id" id="emi_id" value="<?php echo $ad_data['emi_id'] ?>">
    <input type="hidden" name="group_loan_id" id="group_loan_id" value="<?php echo $ad_data['group_loan_id'] ?>">
    <input type="hidden" name="paid_amount" id="paid_amount" value="<?php echo $ad_data['paid_amount'] ?>">
    <input type="hidden" name="adv_amount" id="adv_amount" value="<?php echo $ad_data['adv_amount'] ?>">
<!-- ===================================== No Need This section ============================== -->

</div>

<!-- loan_no   emi_id -->