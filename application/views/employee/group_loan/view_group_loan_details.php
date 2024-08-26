<?php

    if ($vw_group_loan['status'] == 1) {
        echo "<span class='text-success'><b> Active <i class='fa fa-check'></i> </b></span>";
    } else {
        echo "<span class='text-danger'><b> De-Active <i class='fa fa-times'></i> </b></span>";
    }  

?>

<div class="card-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
            <div class="col-12 col-md-12 col-lg-12">
                <h4 class="text-center">Member Details</h4>
                <div class="row">
                    <div class="col-md-5">
                        <p class="text-sm">Member Name
                            <b class="d-block"><?php echo $vw_group_loan['first_name']." ". $vw_group_loan['mid_name']." ". $vw_group_loan['last_name'] ."(".$vw_group_loan['member_id'].")" ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Mobile
                            <b class="d-block"><?php echo $vw_group_loan['mobile_no'] ?></b>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-sm">Email
                            <b class="d-block"><?php echo $vw_group_loan['email'] ?></b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Receipt No.</b>
                            <a style="float: right; color: #0576b9;">
                                <?php echo $vw_group_loan['receipt_no'] ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Loan No.</b>
                            <a style="float: right; color: #0576b9;">
                                <?php echo $vw_group_loan['loan_no'] ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Loan Product Name</b>
                            <a style="float: right; color: #0576b9;">
                                <?php echo $vw_group_loan['loan_product_name'] ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Disbursement Date</b>
                            <a style="float: right; color: #0576b9;">
                                <?php echo $vw_group_loan['loan_start_date'] ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Amount</b>
                            <a style="float: right; color: #0576b9;">
                                <?php echo "₹ ". $vw_group_loan['amount'] ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Loan Tenure</b>
                            <a style="float: right; color: #0576b9;">
                                <?php echo $vw_group_loan['tenure'] ?>
                                <?php
                                    if($vw_group_loan['tenure_type'] == 1 ) {
                                        echo "Weeks";
                                    } elseif($vw_group_loan['tenure_type'] == 2) {
                                        echo "Bi-Week";
                                    }
                                ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Rate of Interest</b>
                            <a style="float: right; color: #0576b9;">
                                <?php if($vw_group_loan['interest_type'] == 1)  { echo $vw_group_loan['roi'] . "%" ;} elseif($vw_group_loan['interest_type'] == 2) { echo "₹". $vw_group_loan['roi']; }   ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Processing Fee</b>
                            <a style="float: right; color: #0576b9;">
                                <?php echo "₹ ". $vw_group_loan['processing_fee']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>