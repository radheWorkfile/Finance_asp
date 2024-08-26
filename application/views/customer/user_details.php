
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrums?>Client Details</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->




<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-body">
                <div>
                    <div class="clearfix"></div>
                    <div class="text-center bg-pattern">
                        <img src="<?php echo base_url();?>media/images/test_img.jpg" class="avatar-xl img-thumbnail rounded-circle mb-3" style="border:2px solid #016cd4;">
                        <h4 class="text-primary mb-2"><?php echo $user_data['first_name'].' '.$user_data['mid_name'].' '.$user_data['last_name'];?></h4>
                        <!-- <div class="text-center">
                            <a href="mailto:text@gmail.com" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
                            <a href="tel:8709732783" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>PhoneCall</a>
                        </div> -->
                    </div>
                </div>
                <hr class="my-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr><td><b>Name</b></td><td>:</td><td></td><td style="float:right;"><?php echo $user_data['first_name'].' '.$user_data['mid_name'].' '.$user_data['last_name'];?></td></tr>
                        <tr><td><b>Email Id</b></td><td>:</td><td></td><td style="float:right;"><?php echo $user_data['email'];?></td></tr>
                        <tr><td><b>Mobile No</b></td><td>:</td><td></td><td style="float:right;"><?php echo $user_data['mobile_no'];?></td></tr>
                        <tr><td><b>D.O.B</b></td><td>:</td><td></td><td style="float:right;"><?php echo $user_data['dob']?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">

            <div class="card-header">
            <div class="btn-group">
            <button id="user_info">User Information</button>
            <button id="nomni_info">Nominee Name</button>
            <button id="bank_info">Bank Details</button>
            <button id="other_info">Other</button>
            </div>
            </div>

            <div class="card-body p-4"id="user_info_body">
            <div class="row">
            <div class="col-md-9">
            <table class="table">
                  <tr><td><b>Name</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['first_name'].' '.$user_data['mid_name'].' '.$user_data['last_name'];?></td></tr>
                  <tr><td><b>Email</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['email'];?></td></tr>
                  <tr><td><b>Mobile Number</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['mobile_no'];?></td></tr>
                  <tr><td><b>D.O.B</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['dob']?></td></tr>
                  <tr><td><b>Address</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['village'];?></td></tr>
                  <tr><td><b>State</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['state'];?></td></tr>
                  <tr><td><b>District</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['district'];?></td></tr>
            </table>
            </div>
           </div>
            </div>


            <div class="card-body p-4"id="nomni_info_body" style="display:none;">
            <div class="row">
            <div class="col-md-9">
            <table class="table">
                  <tr><td><b>Nominee Name</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['first_name'].' '.$user_data['mid_name'].' '.$user_data['last_name'];?></td></tr>
                  <tr><td><b>Address</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['nominee_address'];?></td></tr>
                  <tr><td><b>Relation</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['nominee_relation'];?></td></tr>
                  <tr><td><b>Aadhaar No</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['nominee_aadhaar']?></td></tr>
                  <tr><td><b>Voter Card No</b></td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user_data['nominee_voter'];?></td></tr>
            </table>
            </div>
           </div>
            </div>

            <div class="card-body p-4"id="bank_info_body" style="display:none;">
            <table class="table">
                  <tr><td><b>Bank Name</b> &nbsp;&nbsp;&nbsp;:</td><td><?php echo $user_data['bank_name'];?></td></tr>
                  <tr><td><b>Branch Name</b> &nbsp;&nbsp;&nbsp;:</td><td><?php echo $user_data['branch_name'];?></td></tr>
                  <tr><td><b>Ifsc Code</b> &nbsp;&nbsp;&nbsp;:</td><td><?php echo $user_data['ifsc_code'];?></td></tr>
                  <tr><td><b>Account No</b>&nbsp;&nbsp;&nbsp;:</td><td><?php echo $user_data['account_no'];?></td></tr>
            </table>
            </div>

            <div class="card-body p-4"id="other" style="display:none;">
            <table class="table">
                <p></p><br><br><br><br>
                        <div class="w3-panel w3-blue">
                        <h1 style="text-shadow:1px 1px 0 green;text-align:center;color:green;">
                        <b>Success</b></h1>
                        </div>
                <p style="padding:5rem;"></p>
            </table>
            </div>


        </div>
    </div>
</div><!-- end row -->


<style>
.btn-group button {
  background-color: #0576b9; /* Green background */
  border: 1px solid white; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}
.btn-group button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}
.btn-group button:hover {
  background-color: #075b8c;;
}
</style>

    <script>
$(document).ready(function(){
  
  $("#nomni_info").click(function(){
    $("#nomni_info_body").show();
    $("#bank_info_body").hide();
    $("#user_info_body").hide();
    $("#other").hide();
  });
  $("#user_info").click(function(){
    $("#user_info_body").show();
    ("#nomni_info_body").hide();
    $("#bank_info_body").hide();
    $("#other").hide();
  });
  $("#bank_info").click(function(){
    $("#bank_info_body").show();
    $("#user_info_body").hide();
    $("#nomni_info_body").hide();
    $("#other").hide();
  });
  $("#other_info").click(function(){
    $("#other").show();
    $("#user_info_body").hide();
    $("#bank_info_body").hide();
    $("#nomni_info_body").hide();
  });
});
</script>








<!-- <script src="<?//php echo base_url() ?>media/js/customer/common.js"></script> -->