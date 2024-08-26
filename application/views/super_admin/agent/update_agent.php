<div class="row">
<h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Personal Details</h3>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $upd_agent['id'] ?>">
            <input class="form-control" type="hidden" name="agent_id" id="agent_id" value="<?php echo $upd_agent['agent_id'] ?>">
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $upd_agent['name'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-date-input" class="form-label">Date of Birth <span class="text-danger">*</span></label>
            <input class="form-control" type="date" name="dob" id="dob" value="<?php echo $upd_agent['dob'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Full Address <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="address" id="address" value="<?php echo $upd_agent['address'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Mobile Number <span class="text-danger">*</span></label>
            <input class="form-control" type="number" name="mobile_no" id="mobile_no" id="example-number-input" value="<?php echo $upd_agent['mobile_no'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-email-input" class="form-label">Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email" id="email" id="example-email-input" value="<?php echo $upd_agent['email'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Password <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="password" id="password" value="<?php echo $upd_agent['password'] ?>" >
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Aadhar Card No. <span class="text-danger">*</span></label>
            <input class="form-control" type="number" name="aadhar_card_no" id="aadhar_card_no" id="example-number-input" value="<?php echo $upd_agent['aadhar_card_no'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Upload Aadhar Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
            <input class="form-control" type="file" name="aadhar_image" id="aadhar_image">
            <input type="hidden" name="aadhar_img_upd" id="aadhar_img_upd" value="<?php echo $upd_agent['aadhar_image'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Pan No. <span class="text-danger">*</span></label>
            <input class="form-control" type="number" name="pan_no" id="pan_no" id="example-number-input" value="<?php echo $upd_agent['pan_no'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Upload Pan Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
            <input class="form-control" type="file" name="pan_image" id="pan_image">
            <input type="hidden" name="pan_img_upd" id="pan_img_upd" value="<?php echo $upd_agent['pan_image'] ?>" class="form-control">
        </div>
    </div>
    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Account Details</h3>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="example-number-input" class="form-label">Account No.</label>
            <input class="form-control" type="number" name="account_no" id="account_no" id="example-number-input" value="<?php echo $upd_agent['account_no'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">IFSC Code</label>
            <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?php echo $upd_agent['ifsc_code'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Branch Name</label>
            <input class="form-control" type="text" name="branch_name" id="branch_name" value="<?php echo $upd_agent['branch_name'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Bank Name</label>
            <input class="form-control" type="text" name="bank_name" id="bank_name" value="<?php echo $upd_agent['bank_name'] ?>">
        </div>
    </div>
    <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Nominee Details</h3>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Nominee Name</label>
            <input class="form-control" type="text" name="nominee_name" id="nominee_name" value="<?php echo $upd_agent['nominee_name'] ?>">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Nominee Mobile No.</label>
            <input class="form-control" type="number" name="nominee_number" id="nominee_number" value="<?php echo $upd_agent['nominee_number'] ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Current Aadhar Image</label><br>
                <img src="<?php echo $upd_agent['aadhar_image'] ?>" style="width: 100%; border: 1px solid black;border-radius:25px;">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Current Pan Image</label><br>
                <img src="<?php echo $upd_agent['pan_image'] ?>" style="width: 100%; border: 1px solid black; border-radius:25px;">
            </div>
        </div>
    </div>
</div>