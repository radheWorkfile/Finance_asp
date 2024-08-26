<?php if ($agent['status'] == 1) {
    echo "<span class='text-success'><b> Active <i class='fa fa-check'></i> </b></span>";
} else {
    echo "<span class='text-danger'><b> De-Active <i class='fa fa-times'></i> </b></span>";
}  ?>
<div class="card-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
            <div class="row">
                <div class="col-6 col-sm-6">
                    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Personal Details</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Full Name</b>
                            <a style="float: right;">
                                <?php echo $agent['name'] . "(" . $agent['agent_id'] . ")" ;?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>D.O.B</b>
                            <a style="float: right;">
                                <?php echo $agent['dob'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b>
                            <a style="float: right;">
                                <?php echo $agent['address'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile No</b>
                            <a style="float: right;">
                                <?php echo $agent['mobile_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b>
                            <a style="float: right;">
                                <?php echo $agent['email'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Aadhar Card No.</b>
                            <a style="float: right;">
                                <?php echo $agent['aadhar_card_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Pan No.</b>
                            <a style="float: right;">
                                <?php echo $agent['pan_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Password</b>
                            <a style="float: right;">
                                <?php echo $agent['password'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Commission Type</b>
                            <a style="float: right;">
                                <?php 
                                    $val = $agent['commission_type'];
                                    $commission = explode(",", $val);
                                    foreach($commission as $comm) {

                                    if((int)$comm == 1) { echo $val == "On File"; } elseif((int)$comm == 2) { echo $val = "On Approve"; } 

                                    }
                                ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-sm-6">
                    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Account Details</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Account NO. </b>
                            <a style="float: right;">
                                <?php echo $agent['account_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>IFSC Code</b>
                            <a style="float: right;">
                                <?php echo $agent['ifsc_code'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Branch Name</b>
                            <a style="float: right;">
                                <?php echo $agent['branch_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Bank Name</b>
                            <a style="float: right;">
                                <?php echo $agent['bank_name'];?>
                            </a>
                        </li>
                    </ul>

                    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Nominee Details</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nominee Name </b>
                            <a style="float: right;">
                                <?php echo $agent['nominee_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Nominee Mobile No.</b>
                            <a style="float: right;">
                                <?php echo $agent['nominee_number'];?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label><b>Aadhaar Image:</b> </label>
            <img src="<?php echo $agent['aadhar_image'] ?>" style="width: 100%; height: 80%; border: 1px solid black; border-radius:25px;">
        </div>
        <div class="col-lg-6">
            <label><b>Pan Image:</b> </label>
            <img src="<?php echo $agent['pan_image'] ?>" style="width: 100%; height: 80%; border: 1px solid black; border-radius:25px;">
        </div>
    </div>
</div>