<?php if ($view_staff['status'] == 1) {
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
                                <?php echo $view_staff['full_name'] . "(" . $view_staff['staff_id'] . ")" ;?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Guardian Name</b>
                            <a style="float: right;">
                                <?php echo $view_staff['guardian_name'] ;?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>D.O.B</b>
                            <a style="float: right;">
                                <?php echo $view_staff['dob'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b>
                            <a style="float: right;">
                                <?php echo $view_staff['address'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile No</b>
                            <a style="float: right;">
                                <?php echo $view_staff['mobile_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b>
                            <a style="float: right;">
                                <?php echo $view_staff['email'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Aadhar Card No.</b>
                            <a style="float: right;">
                                <?php echo $view_staff['aadhar_card_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Pan No.</b>
                            <a style="float: right;">
                                <?php echo $view_staff['pan_no'];?>
                            </a>
                        </li>
						<li class="list-group-item">
                            <b>Branch</b>
                            <a style="float: right;">
                                <?php echo $view_staff['branch_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Designation</b>
                            <a style="float: right;">
                                <?php echo $view_staff['designation_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Password</b>
                            <a style="float: right;">
                                <?php echo $view_staff['password'];?>
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
                                <?php echo $view_staff['account_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>IFSC Code</b>
                            <a style="float: right;">
                                <?php echo $view_staff['ifsc_code'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Branch Name</b>
                            <a style="float: right;">
                                <?php echo $view_staff['branch_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Bank Name</b>
                            <a style="float: right;">
                                <?php echo $view_staff['bank_name'];?>
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
            <img src="<?php echo base_url($view_staff['aadhar_image']); ?>" style="width: 100%; height: 80%; border: 1px solid black; border-radius:25px;">
        </div>
        <div class="col-lg-6">
            <label><b>Pan Image:</b> </label>
            <img src="<?php echo base_url($view_staff['pan_image']); ?>" style="width: 100%; height: 80%; border: 1px solid black; border-radius:25px;">
        </div>
    </div>
</div>