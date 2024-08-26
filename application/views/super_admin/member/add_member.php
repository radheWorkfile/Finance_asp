<style>
.valid {
    border: 2px solid green;
}
.invalid {
    border: 2px solid red;
}
</style>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold">
                <?php echo $title ?>
            </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active">
                        <?php echo $breadcrums ?>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="add_member_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="basic-example">
                                <h3>Personal Details</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter Your First Name" maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Mid Name</label>
                                                <input class="form-control" type="text" name="mid_name" id="mid_name" placeholder="Enter Your Mid Name" maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter Your Last Name"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                                <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff_id ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-date-input" class="form-label">Email Id <span class="text-danger">*</span></label>
                                                <input class="form-control" type="email" name="email" id="email"placeholder="Enter Email Id">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-date-input" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="mobile" id="mobile"placeholder="Enter Mobile Number" maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
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
                                                <label class="form-label">Religion <span class="text-danger">*</span></label>
                                                <select name="religion" id="religion" class="form-control">
                                                    <option value=""> --- Select One --- </option>
                                                    <option value="1">Hinduism</option>
                                                    <option value="2">Islam</option>
                                                    <option value="3">Christianity</option>
                                                    <option value="4">Sikhism</option>
                                                    <option value="5">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Date of Joining <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" name="doj" id="doj" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">State </label>
                                                <input class="form-control" type="text" name="state" id="state"
                                                    placeholder="Enter Your State"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">District </label>
                                                <input class="form-control" type="text" name="district" id="district"
                                                    placeholder="Enter Your District"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Village </label>
                                                <input class="form-control" type="text" name="village" id="village"
                                                    placeholder="Enter Your Village"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Post Office </label>
                                                <input class="form-control" type="text" name="p_office" id="p_office"
                                                    placeholder="Enter Your Post Office"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Police Station </label>
                                                <input class="form-control" type="text" name="p_station" id="p_station"
                                                    placeholder="Enter Your Police Station"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Pin Code </label>
                                                <input class="form-control" type="text" name="pin_code" id="pin_code"
                                                    placeholder="Enter Your Pin Code"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number-input" class="form-label">Mobile Number </label>
                                                <input class="form-control" type="number" name="mobile_no" id="mobile_no" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-email-input" class="form-label">Email </label>
                                                <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email" id="example-email-input">
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number-input" class="form-label">Voter Card No.
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="voter_card_no"
                                                    id="voter_card_no" maxlength="10" placeholder="Enter Voter Card No."oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number-input" class="form-label">Aadhaar Card No. <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="aadhar_card_no" placeholder="Enter Aadhaar Number" id="aadhar_card_no" maxlength="12" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number-input" class="form-label">Pan Card No.</label>
                                                <input class="form-control" type="text" name="pan_no" id="pan_no"
                                                    placeholder="Enter Pan Number"id="pan_card" maxlength="10" oninput="validatePAN(this)" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number-input" class="form-label">Password</label>
                                                <input class="form-control" type="text" name="password" id="password"
                                                    placeholder="Enter Password Here!">
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h3>Family KYC</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Relation </label>
                                                <select class="form-control" type="text" name="nominee_relation" id="nominee_relation">
                                                    <option> --- Select One --- </option>
                                                    <?php foreach($relation as $reln) { ?>
                                                        <option value="<?php echo $reln['id'] ?>"><?php echo $reln['category_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Guarantor Name </label>
                                                <input class="form-control" type="text" name="nominee_name" id="nominee_name" placeholder="Enter Guarantor Name"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Guarantor Mobile No.</label>
                                                <input class="form-control" type="text" name="nominee_mobile" id="nominee_mobile" placeholder="Enter Guarantor mobile no.">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-date-input" class="form-label">Guarantor Email </label>
                                                <input class="form-control" type="email" name="nominee_email" id="nominee_email" placeholder="Enter Guarantor Email">
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Guarantor Addhaar Card No. </label>
                                                <input class="form-control" type="text" name="nominee_aadhaar" id="nominee_aadhaar" placeholder="Enter Guarantor Aadhaar Card No." maxlength="12" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Guarantor Voter Card No. </label>
                                                <input class="form-control" type="text" name="nominee_voter" id="nominee_voter" placeholder="Enter Guarantor Voter Card No."maxlength="12" oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Guarantor Address </label>
                                                <textarea class="form-control" type="text" name="nominee_address" id="nominee_address" placeholder="Enter Guarantor Address" maxlength="55" ="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Company Document -->
                                <h3>Bank Details</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number-input" class="form-label">Account No.</label>
                                                <input class="form-control" type="text" name="account_no"
                                                    id="account_no" maxlength="20" placeholder="Enter Account Number"oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">IFSC Code</label>
                                                <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code" id="ifsc" oninput="validateIFSC(this)">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Branch Name</label>
                                                <input class="form-control" type="text" name="branch_name"
                                                    id="branch_name" placeholder="Enter Branch Name"maxlength="33" maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Bank Name</label>
                                                <input class="form-control" type="text" name="bank_name"maxlength="33" id="bank_name"
                                                    placeholder="Enter Bank Name"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Bank Details -->
                                <h3>Document</h3>
                                <section>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Document Type</label>
                                                    <select name="document_type" id="document_type" class="form-control"  onchange="return get_document_type_data(this.value)">
                                                        <option value=""> ---- Select One ---- </option>
                                                        <?php foreach ($document as $doc) { ?>
                                                            <option value="<?php echo $doc['id'] ?>"><?php echo $doc['document_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="documnt">

                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Center Section -->
                                <h3>Center</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Center Name:<span class="text-danger">*</span></label>
                                                <select name="center_name" id="center_name" class="form-control" onchange="return get_group_name(this.value)">
                                                    <option value=""> --- Select One --- </option>
                                                    <?php foreach ($center as $cntr) { ?>
                                                        <option value="<?php echo $cntr['id'] ?>" <?php echo ($cntr['id'] == $member_data['center_name']) ? "Selected" : ""; ?>><?php echo $cntr['center_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Group Name:<span class="text-danger">*</span></label>
                                                <select name="group_name" id="group_name" class="form-control">
                                                    <option> --- Select One --- </option>
                                                    <?php foreach($group as $grp) { ?>
                                                        <option value="<?php echo $grp['grp_id'] ?>" <?php echo ($grp['grp_id'] == $member_data['group_name']) ? "Selected" : ""; ?>><?php echo $grp['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/member.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>