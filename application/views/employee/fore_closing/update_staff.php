<div class="row">
    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Personal Details</h3>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Full Name <span class="text-danger">*</span></label>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $upd_staff['id'] ?>">
            <input class="form-control" type="hidden" name="staff_id" id="staff_id" value="<?php echo $upd_staff['staff_id'] ?>">
            <input class="form-control" type="text" name="full_name" id="full_name" value="<?php echo $upd_staff['full_name'] ?>"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());"
            >
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Guardian Name</label>
            <input class="form-control" type="text" name="guardian_name" id="guardian_name" value="<?php echo $upd_staff['guardian_name'] ?>"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());"
            >
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-date-input" class="form-label">Date of Birth <span class="text-danger">*</span></label>
            <input class="form-control" type="date" name="dob" id="dob" value="<?php echo $upd_staff['dob'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Mobile Number <span class="text-danger">*</label>
            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="<?php echo $upd_staff['mobile_no'] ?>" maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Full Address <span class="text-danger">*</span></label>
			<textarea  name="address" id="address" placeholder="Enter Full Address" class="form-control" rows="2" maxlength="80"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"><?php echo $upd_staff['address'] ?></textarea>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-email-input" class="form-label">Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $upd_staff['email'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Aadhar Card No. <span
                    class="text-danger">*</span></label>
            <input class="form-control" type="text" name="aadhar_card_no" id="aadhar_card_no" value="<?php echo $upd_staff['aadhar_card_no'] ?>" maxlength="12" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Upload Aadhar Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
            <input class="form-control" type="file" name="aadhaar_img" id="aadhaar_img">
            <input type="hidden" name="aadhar_img_upd" id="aadhar_img_upd" value="<?php echo $upd_staff['aadhar_image'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Pan No. <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="pan_no" id="pan_no"  value="<?php echo $upd_staff['pan_no'] ?>"maxlength="10" oninput="validatePAN(this)">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Upload Pan Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
            <input class="form-control" type="file" name="pan_img" id="pan_img">
            <input type="hidden" name="pan_img_upd" id="pan_img_upd" value="<?php echo $upd_staff['pan_image'] ?>" class="form-control">
        </div>
    </div>
	<div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="password" id="password" value="<?php echo $upd_staff['password'] ?>">
        </div>
    </div>
	<div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Branch <span class="text-danger">*</span></label>
            <select class="form-control" name="branch" id="branch">
                <option value=""> --- Select One --- </option>
                <?php foreach ($getBranch as $br) { ?>
                    <option value="<?php echo $br['id']; ?>" <?php echo($br['id'] == $upd_staff['branch_id']) ? "Selected" : "" ; ?>>
						<?php echo $br['branch_name'].'('.$br['br_id'].')'; ?>
					</option>
					
					
	
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Designation <span class="text-danger">*</span></label>
            <select class="form-control" name="designation" id="designation">
                <option value=""> --- Select One --- </option>
                <?php foreach ($designation as $desig) { ?>
                    <option value="<?php echo $desig['id'] ?>" <?php echo($desig['id'] == $upd_staff['designation']) ? "Selected" : "" ; ?>><?php echo $desig['designation_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Account Details</h3>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Account No.</label>
            <input class="form-control" type="number" name="account_no" id="account_no"  value="<?php echo $upd_staff['account_no'] ?>"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">IFSC Code</label>
            <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?php echo $upd_staff['ifsc_code'] ?>"oninput="validateIFSC(this)">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Branch Name</label>
            <input class="form-control" type="text" name="branch_name" id="branch_name" value="<?php echo $upd_staff['branch_name'] ?>"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Bank Name</label>
            <input class="form-control" type="text" name="bank_name" id="bank_name" value="<?php echo $upd_staff['bank_name'] ?>"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Current Aadhar Image</label><br>
                <img src="<?php echo base_url($upd_staff['aadhar_image']) ?>" style="width: 100%; border: 1px solid black;border-radius:25px;">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Current Pan Image</label><br>
                <img src="<?php echo base_url($upd_staff['pan_image']) ?>" style="width: 100%; border: 1px solid black; border-radius:25px;">
            </div>
        </div>
    </div>
</div>
<!-- end row -->