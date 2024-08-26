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
    <div class="card-body">
        <form id="add_agent_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <h2 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Personal Details</h2>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Your Name">
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
                        <label class="form-label">Full Address <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="address" id="address" placeholder="Enter Full Address">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="mobile_no" id="mobile_no" placeholder="Enter Number" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-email-input" class="form-label">Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email" id="example-email-input">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Password <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="password" id="password" placeholder="Enter Password Here!" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Aadhar Card No. <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="aadhar_card_no" id="aadhar_card_no" placeholder="Enter Aadhar Number" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Upload Aadhar Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                        <input class="form-control" type="file" name="aadhar_image" id="aadhar_image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Pan No. <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="pan_no" id="pan_no" placeholder="Enter Pan Number" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Upload Pan Image <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                        <input class="form-control" type="file" name="pan_image" id="pan_image" >
                    </div>
                </div>
                <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Account Details</h3>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Account No.</label>
                        <input class="form-control" type="number" name="account_no" id="account_no" placeholder="Enter Account Number">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">IFSC Code</label>
                        <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Branch Name</label>
                        <input class="form-control" type="text" name="branch_name" id="branch_name" placeholder="Enter Branch Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Bank Name</label>
                        <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name">
                    </div>
                </div>
                <h3 class="mb-sm-0 font-size-18 fw-bold" style="padding: 15px;">Nominee Details</h3>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Nominee Name</label>
                        <input class="form-control" type="text" name="nominee_name" id="nominee_name" placeholder="Enter Nominee Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Nominee Mobile No.</label>
                        <input class="form-control" type="number" name="nominee_number" id="nominee_number" placeholder="Enter Nominee Mobile no.">
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

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/agent.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>