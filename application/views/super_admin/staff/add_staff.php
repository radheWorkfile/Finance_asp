<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrums ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
<div class="ami_dev"><span><i class="bx bx-user"></i></span> <span id="mstrTitle">Add New Staff</span></div>
    <div class="card-body">
        <form id="add_staff_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="full_name" id="full_name" placeholder="Enter Your Name"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Guardian Name</label>
                        <input class="form-control" type="text" name="guardian_name" id="guardian_name" placeholder="Enter Gurdian Name"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="dob" id="dob">
                    </div>
                </div>
				<div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="mobile_no" id="mobile_no" placeholder="Enter Number" maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')"
                        >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Full Address <span class="text-danger">*</span></label>
						<textarea  name="address" id="address" placeholder="Enter Full Address" class="form-control" rows="2"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"
                        ></textarea>
                    </div>
                </div>
				<div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Branch <span class="text-danger">*</span></label>
                        <select class="form-control" name="branch" id="branch">
                            <option value=""> --- Select One --- </option>
                            <?php foreach($getBranch as $br) { ?>
                                <option value="<?php echo $br['id']; ?>"><?php echo $br['branch_name'].'('.$br['br_id'].')'; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Designation <span class="text-danger">*</span></label>
                        <select class="form-control" name="designation" id="designation">
                            <option value=""> --- Select One --- </option>
                            <?php foreach($designation as $desig) { ?>
                                <option value="<?php echo $desig['id'] ?>"><?php echo $desig['designation_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
				<div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-email-input" class="form-label">Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="password" id="password" placeholder="Enter Password"maxlength="15">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Aadhar Card No. <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="aadhar_card_no" id="aadhar_card_no" placeholder="Enter Aadhar Number" maxlength="12" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Upload Aadhar Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                        <input class="form-control" type="file" name="aadhaar_img" id="aadhaar_img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Pan No. <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="pan_no" id="pan_no" placeholder="Enter Pan Number"maxlength="10" oninput="validatePAN(this)" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Upload Pan Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                        <input class="form-control" type="file" name="pan_img" id="pan_img">
                    </div>
                </div>

                <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Account Details</h3>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Account No.</label>
                        <input class="form-control" type="text" name="account_no" id="account_no"
                            placeholder="Enter Account Number" maxlength="20" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">IFSC Code</label>
                        <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code"oninput="validateIFSC(this)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Branch Name</label>
                        <input class="form-control" type="text" name="branch_name" id="branch_name" placeholder="Enter Branch Name"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Bank Name</label>
                        <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </form>
    </div>
</div>
<style>
.ami_dev {
  padding: 10px 0px 10px 10px;
  background-color: #3b5998;
  color: #fff;
  border: 1px solid #3b5998;
}.ami_dev span i {
  padding: 5px;
  background-color: #fff;
  border-radius: 5px;
  color: #3b5998;
}
</style>
<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/staff.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>