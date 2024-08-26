<div class="card-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
            <div class="col-12 col-md-12 col-lg-12">
                <h4 class="text-center">Paid EMI Details</h4>
                <div class="row">
                    <div class="col-md-4">
                        <p class="text-sm">Client Name
                            <b class="d-block"><?php echo $vw_paid_emi['first_name'] . " " . $vw_paid_emi['mid_name'] ." " . " ". $vw_paid_emi['mid_name'] . "(". $vw_paid_emi['member_id'] .")" ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Village
                            <b class="d-block"><?php echo $vw_paid_emi['name'] ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Center
                            <b class="d-block"><?php echo $vw_paid_emi['center_name'] ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Group
                            <b class="d-block">Group 2</b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">EMI Amount
                            <b class="d-block"><?php echo $vw_paid_emi['total_payble_amount']?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">EMI Date
                            <b class="d-block"><?php echo $vw_paid_emi['emi_date'] ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Paid Amount
                            <b class="d-block"><?php echo $vw_paid_emi['paid_amount'] ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Rest Amount
                            <b class="d-block"><?php echo $vw_paid_emi['rest_amount'] ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Penalty Amount
                            <b class="d-block"><?php if(!empty($vw_paid_emi['penelty_amount'])) { echo $vw_paid_emi['penelty_amount']; }else{ echo "0"; } ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Mode of Payment
                            <b class="d-block"><?php if($vw_paid_emi['mop'] == 1) { echo "Online"; } elseif($vw_paid_emi['mop'] == 2) { echo "Cheque"; } elseif($vw_paid_emi['mop'] == 3) { echo "Cash"; } ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">Payment Date
                            <b class="d-block"><?php echo $vw_paid_emi['pay_date'] ?></b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm">EMI Remark
                            <b class="d-block"><?php echo $vw_paid_emi['pay_remarks'] ?></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="text-center">
                <b>Receipt</b>
            </p>
        </div>
        <center>
            <div class="col-6">
                <p class="text-center">
                <img class="profile_img" src="<?php echo !empty($vw_paid_emi['recipet']) ? base_url($vw_paid_emi['recipet']) : base_url("uploads/no_image.jpg") ?>" alt="User EMI Paid Receipt document" style="width:100%;">
                </p>
            </div>
        </center>
    </div>
</div>