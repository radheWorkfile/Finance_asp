<h3>Personal Details</h3>
<section>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $upd_memb['id'] ?>">
                <input class="form-control" type="hidden" name="member_id" id="member_id" value="<?php echo $upd_memb['member_id'] ?>">
                <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo $upd_memb['first_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Mid Name </label>
                <input class="form-control" type="text" name="mid_name" id="mid_name" value="<?php echo $upd_memb['mid_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $upd_memb['last_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Email Id <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" id="email" value="<?php echo $upd_memb['email'] ?>">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="mobile" id="mobile" value="<?php echo $upd_memb['mobile_no'] ?>"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-date-input" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="dob" id="dob" value="<?php echo $upd_memb['dob'] ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Religion </label>
                <select name="religion" id="religion" class="form-control">
                    <option value=""> --- Select One --- </option>
                    <option value="1" <?php echo ($upd_memb['religion'] == 1) ? "Selected" : ""; ?>>Hinduism</option>
                    <option value="2" <?php echo ($upd_memb['religion'] == 2) ? "Selected" : ""; ?>>Islam</option>
                    <option value="3" <?php echo ($upd_memb['religion'] == 3) ? "Selected" : ""; ?>>Christianity</option>
                    <option value="4" <?php echo ($upd_memb['religion'] == 4) ? "Selected" : ""; ?>>Sikhism</option>
                    <option value="5" <?php echo ($upd_memb['religion'] == 5) ? "Selected" : ""; ?>>Others</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Date of Joining </label>
                <input class="form-control" type="date" name="doj" id="doj" value="<?php echo $upd_memb['doj'] ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">State </label>
                <input class="form-control" type="text" name="state" id="state" value="<?php echo $upd_memb['state'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">District </label>
                <input class="form-control" type="text" name="district" id="district" value="<?php echo $upd_memb['district'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Village </label>
                <input class="form-control" type="text" name="village" id="village" value="<?php echo $upd_memb['village'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Post Office </label>
                <input class="form-control" type="text" name="p_office" id="p_office" value="<?php echo $upd_memb['p_office'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Police Station </label>
                <input class="form-control" type="text" name="p_station" id="p_station" value="<?php echo $upd_memb['p_station'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Pin Code </label>
                <input class="form-control" type="text" name="pin_code" id="pin_code" value="<?php echo $upd_memb['pin_code'] ?>"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="mobile_no" id="mobile_no" value="<?php echo $upd_memb['mobile_no'] ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-email-input" class="form-label">Email </label>
                <input class="form-control" type="email" name="email" id="email" value="<?php echo $upd_memb['email'] ?>">
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Aadhar Card No.<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="aadhar_card_no" id="aadhar_card_no" value="<?php echo $upd_memb['aadhar_card_no'] ?>"id="aadhar_card_no" maxlength="12" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Voter Card No. </label>
                <input class="form-control" type="text" maxlength="10" name="voter_card_no" id="voter_card_no" value="<?php echo $upd_memb['aadhar_voter_no'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Pan No.</label>
                <input class="form-control" type="text" name="pan_no" id="pan_no" value="<?php echo $upd_memb['pan_no'] ?>"oninput="validatePAN(this)">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Password </label>
                <input class="form-control" type="text" name="password" id="password" value="<?php echo $upd_memb['password'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
    </div>
</section>

<h3>Family KYC</h3>
<section>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Relation </label>
                <select class="form-control" type="text" name="nominee_relation" id="nominee_relation">
                    <option> --- Select One --- </option>
                    <?php foreach($relation as $reln) { ?>
                        <option value="<?php echo $reln['id'] ?>" <?php echo ($reln['id'] == $upd_memb['nominee_relation']) ? "Selected" : ""; ?>><?php echo $reln['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Guarantor Name </label>
                <input class="form-control" type="text" name="nominee_name" id="nominee_name" value="<?php echo $upd_memb['nominee_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Guarantor Mobile No.</label>
                <input class="form-control" type="text" name="nominee_mobile" id="nominee_mobile" value="<?php echo $upd_memb['nominee_mobile'] ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-date-input" class="form-label">Guarantor Email </label>
                <input class="form-control" type="email" name="nominee_email" id="nominee_email" value="<?php echo $upd_memb['nominee_email']; ?>">
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Guarantor Addhaar No. </label>
                <input class="form-control" type="text" name="nominee_aadhaar" id="nominee_aadhaar" value="<?php echo $upd_memb['nominee_aadhaar'] ?>"maxlength="12" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Guarantor Voter Card No. </label>
                <input class="form-control" type="text" name="nominee_voter" id="nominee_voter" value="<?php echo $upd_memb['nominee_voter'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"maxlength="12">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Guarantor Address </label>
                <textarea class="form-control" type="text" name="nominee_address" id="nominee_address" value="<?php echo $upd_memb['nominee_address'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"></textarea>
            </div>
        </div>
    </div>
</section>

<h3>Bank Details</h3>
<section>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Account No.</label>
                <input class="form-control" type="number" name="account_no" id="account_no" value="<?php echo $upd_memb['account_no'] ?>"oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"maxlength="20">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">IFSC Code</label>
                <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?php echo $upd_memb['ifsc_code'] ?>"oninput="validateIFSC(this)">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Branch Name</label>
                <input class="form-control" type="text" name="branch_name" id="branch_name" value="<?php echo $upd_memb['branch_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Bank Name</label>
                <input class="form-control" type="text" name="bank_name" id="bank_name" value="<?php echo $upd_memb['bank_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
            </div>
        </div>
    </div>
</section>

<h3>Center Status</h3>
<section>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label>Center Name: <span class="text-danger">*</span></label>
                <select name="center_name" id="center_name" class="form-control" onchange="return get_group_name(this.value)">
                    <option value=""> --- Select One --- </option>
                    <?php foreach ($center as $cntr) { ?>
                        <option value="<?php echo $cntr['id'] ?>" <?php echo ($cntr['id'] == $upd_memb['center_name']) ? "Selected" : ""; ?>><?php echo $cntr['center_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label>Group Name: <span class="text-danger">*</span></label>
                <select name="group_name" id="group_name" class="form-control">
                    <option> --- Select One --- </option>
                    <?php foreach($group as $grp) { ?>
                        <option value="<?php echo $grp['grp_id'] ?>" <?php echo ($grp['grp_id'] == $upd_memb['group_name']) ? "Selected" : ""; ?>><?php echo $grp['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</section>

<h3>Document Details</h3>
<div class="row">
    <div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label">Document Type</label>
            <select name="document_type" id="document_type" class="form-control"  onchange="return get_document_type_data(this.value)" readonly>
                <option value=""> ---- Select One ---- </option>
                <?php foreach ($document as $doc) { ?>
                <option value="<?php echo $doc['id'] ?>" <?php echo ($doc['id'] == $upd_memb['document_type']) ? "Selected" : "" ; ?>><?php echo $doc['document_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <?php $doc = json_decode($upd_memb['documents']); ?>
    <?php foreach($doc as $docs => $docmnt) { ?>
        <div class="col-lg-4">
            <div class="mb-3">
                <?php $vals = str_replace('_', ' ', $docs) ?>
                <label for="example-number-input" class="form-label"><?php echo ucfirst(strtolower($vals)); ?> <span class="text-danger" style="font-weight: 400; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                <input class="form-control" type="file" name="<?php echo $docs; ?>" id="<?php echo $docs; ?>">
                <input type="hidden" name="pan_img_upd" id="pan_img_upd" value="<?php echo $docmnt; ?>" class="form-control">
            </div>
        </div>
    <?php } ?>
</div>
<div class="row">
    <?php $docus = json_decode($upd_memb['documents']); ?>
    <?php foreach ($docus as $doc => $document ) { ?>
        <?php $val = str_replace('_', ' ', $doc) ?>
        <div class="col-lg-6">
            <label><b><?php echo "Current ". ucfirst(strtolower($val));?> Image:</b> </label>
            <img src="<?php echo base_url($document); ?>" style="width: 100%; height: 80%; border: 1px solid black; border-radius:25px;">
        </div>
    <?php } ?>
</div>