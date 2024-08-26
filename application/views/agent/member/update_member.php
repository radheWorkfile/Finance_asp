<h3>Personal Details</h3>
<section>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $upd_memb['id'] ?>">
                <input class="form-control" type="hidden" name="member_id" id="member_id" value="<?php echo $upd_memb['member_id'] ?>">
                <input class="form-control" type="text" name="full_name" id="full_name" value="<?php echo $upd_memb['full_name'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-date-input" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="dob" id="dob" value="<?php echo $upd_memb['dob'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Full Address <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="address" id="address" value="<?php echo $upd_memb['address'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="mobile_no" id="mobile_no" value="<?php echo $upd_memb['mobile_no'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-email-input" class="form-label">Email <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" id="email" value="<?php echo $upd_memb['email'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Aadhar Card No.<span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="aadhar_card_no" id="aadhar_card_no" value="<?php echo $upd_memb['aadhar_card_no'] ?>" >
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Pan No. <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="pan_no" id="pan_no" value="<?php echo $upd_memb['pan_no'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Password <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="password" id="password" value="<?php echo $upd_memb['password'] ?>">
            </div>
        </div>
    </div>
</section>

<h3>Bank Details</h3>
<section>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="example-number-input" class="form-label">Account No.</label>
                <input class="form-control" type="number" name="account_no" id="account_no" value="<?php echo $upd_memb['account_no'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">IFSC Code</label>
                <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?php echo $upd_memb['ifsc_code'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Branch Name</label>
                <input class="form-control" type="text" name="branch_name" id="branch_name" value="<?php echo $upd_memb['branch_name'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Bank Name</label>
                <input class="form-control" type="text" name="bank_name" id="bank_name" value="<?php echo $upd_memb['bank_name'] ?>">
            </div>
        </div>
    </div>
</section>

<h3>Document Details</h3>
<div class="row">
    <div class="col-lg-6">
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
    <?php $doc = json_decode($upd_memb['documents']); 
    // print_r($doc);die;?>
    <?php foreach($doc as $docs => $docmnt) { ?>
        <div class="col-lg-6">
            <div class="mb-3">
                <?php $vals = str_replace('_', ' ', $docs) ?>
                <label for="example-number-input" class="form-label"><?php echo ucfirst(strtolower($vals)); ?> <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span></label>
                <input class="form-control" type="file" name="<?php echo $docs; ?>" id="<?php echo $docs; ?>">
                <input type="text" name="pan_img_upd" id="pan_img_upd" value="<?php echo $docmnt; ?>" class="form-control">
            </div>
        </div>
    <?php } ?>
</div>
<div class="row">
    <?php $docus = json_decode($upd_memb['documents']); ?>
    <?php foreach ($docus as $doc => $document ) { ?>
        <?php $val = str_replace('_', ' ', $doc) ?>
        <div class="col-lg-6">
            <label><b><?php echo ucfirst(strtolower($val));?> Image:</b> </label>
            <img src="<?php echo base_url($document); ?>" style="width: 100%; height: 80%; border: 1px solid black; border-radius:25px;">
        </div>
    <?php } ?>
</div>