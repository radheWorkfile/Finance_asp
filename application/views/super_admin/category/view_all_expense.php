<?php if ($all_exp['status'] == 1) {
    echo "<span class='text-success'><b> Active <i class='fa fa-check'></i> </b></span>";
} else {
    echo "<span class='text-danger'><b> De-Active <i class='fa fa-times'></i> </b></span>";
}  ?>
<div class="card-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b> Expense Name</b> 
                            <a style="float: right;">
                                <?php echo $all_exp['exp_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Amount</b>
                            <a style="float: right;">
                                ₹&nbsp;<?php echo $all_exp['amount'];?>.00
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Cash Received</b>
                            <a style="float: right;">  
                                <?php 
                                if($all_exp['mop'] == 1)
                                {
                                    echo $all_exp['cash_received_by'];
                                }else if($all_exp['mop'] == 2 ||$all_exp['mop'] == 3)
                                {
                                    echo "By Account / By check";
                                }
                                
                                ?>
                            </a>
                        </li>
                        <?php    if($all_exp['mop'] == 2 || $all_exp['mop'] == 2) :?>
                        <li class="list-group-item">
                            <b>Account Number</b>
                            <a style="float: right;">
                                <?php echo "**** **** ****";?>
                            </a>
                        </li>
                        <?php endif;?>

                        <li class="list-group-item">
                            <b>Date</b>
                            <a style="float: right;">
                                <?php echo $all_exp['expense_data'];?>
                            </a>
                        </li>


                        <li class="list-group-item">
                            <b>Verification Type</b>
                            <a style="float: right;">
                            <?php 
                               if($all_exp['varification_proof_type'] == 1)
                               {
                                  echo "Receipt";
                               }else  if($all_exp['varification_proof_type'] == 2)
                               {
                                  echo "Bank Statement";
                               }else {
                                echo "Others";
                               }
                             ?>
                                <?//php echo $all_exp['varification_proof_type'];?>
                            </a>
                             
                        </li>
                       <?php  if($all_exp['varification_proof_type'] != ""):?>
                        <li class="list-group-item">
                            <b>Verification Doc</b>
                            <a style="float: right;">
                             <img src="<?php echo base_url().'uploads/expense_proof/'.$all_exp['proof']; ?>" alt=""style="height:1rem;" class="zoom">
                            </a>
                        </li>
                        <?php endif;?>
                        <style>
                            .zoom:hover {
                            -ms-transform: scale(10.5); /* IE 9 */
                            -webkit-transform: scale(10.5); /* Safari 3-8 */
                            transform: scale(10.5); 
                            }
                        </style>
                      
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>