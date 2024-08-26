<!-- <?php if ($member['status'] == 1) {
    echo "<span class='text-success'><b> Active <i class='fa fa-check'></i> </b></span>";
} else {
    echo "<span class='text-danger'><b> De-Active <i class='fa fa-times'></i> </b></span>";
} ?> -->
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
                                <?php echo $member['full_name'] . "(" . $member['member_id'] . ")"; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>D.O.B</b>
                            <a style="float: right;">
                                <?php echo $member['dob']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>State</b>
                            <a style="float: right;">
                                <?php echo $member['state']; ?>
                            </a>
                        </li><li class="list-group-item">
                            <b>District</b>
                            <a style="float: right;">
                                <?php echo $member['district']; ?>
                            </a>
                        </li><li class="list-group-item">
                            <b>Village</b>
                            <a style="float: right;">
                                <?php echo $member['village']; ?>
                            </a>
                        </li><li class="list-group-item">
                            <b>Post Office</b>
                            <a style="float: right;">
                                <?php echo $member['p_office']; ?>
                            </a>
                        </li><li class="list-group-item">
                            <b>police Station</b>
                            <a style="float: right;">
                                <?php echo $member['p_station']; ?>
                            </a>
                        </li><li class="list-group-item">
                            <b>Pin Code</b>
                            <a style="float: right;">
                                <?php echo $member['pin_code']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile No</b>
                            <a style="float: right;">
                                <?php echo $member['mobile_no']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b>
                            <a style="float: right;">
                                <?php echo $member['email']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Aadhar Card No.</b>
                            <a style="float: right;">
                                <?php echo $member['aadhar_card_no']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Voter Card No.</b>
                            <a style="float: right;">
                                <?php echo $member['voter_card_no']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Pan No.</b>
                            <a style="float: right;">
                                <?php echo $member['pan_no']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Password</b>
                            <a style="float: right;">
                                <?php echo $member['password']; ?>
                            </a>
                        </li>
                </div>
                <div class="col-6 col-sm-6">
                    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Account Details</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Account NO. </b>
                            <a style="float: right;">
                                <?php echo $member['account_no']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>IFSC Code</b>
                            <a style="float: right;">
                                <?php echo $member['ifsc_code']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Branch Name</b>
                            <a style="float: right;">
                                <?php echo $member['branch_name']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Bank Name</b>
                            <a style="float: right;">
                                <?php echo $member['bank_name']; ?>
                            </a>
                        </li>
                    </ul>

                    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Guarantor Details</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                            <b>relation </b>
                            <a style="float: right;">
                                <?php echo $member['relation_name']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Guarantor Name </b>
                            <a style="float: right;">
                                <?php echo $member['nominee_name']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Guarantor Mobile No.</b>
                            <a style="float: right;">
                                <?php echo $member['nominee_mobile']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Guarantor Email</b>
                            <a style="float: right;">
                                <?php echo $member['nominee_email']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Guarantor Addhaar No.</b>
                            <a style="float: right;">
                                <?php echo $member['nominee_aadhaar']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Guarantor Voter No.</b>
                            <a style="float: right;">
                                <?php echo $member['nominee_voter']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Guarantor Address</b>
                            <a style="float: right;">
                                <?php echo $member['nominee_address']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php $doc = json_decode($member['documents']); ?>

    <div class="row">
        <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Document Details</h3>
        <?php foreach ($doc as $doc => $document ) { ?>
            <?php $val = str_replace('_', ' ', $doc) ?>
            <div class="col-lg-6">
                <label><b><?php echo ucfirst(strtolower($val));?> Image:</b> </label>
                <img src="<?php echo base_url($document); ?>" style="width: 100%; height: 80%; border: 1px solid black; border-radius:25px;">
            </div>
        <?php } ?>
    </div>
</div>