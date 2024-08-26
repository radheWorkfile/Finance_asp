<div class="row">
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Group Name <span class="text-danger">*</span></label>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $upd_grp['id'] ?>">
            <input class="form-control" type="text" name="group_name" id="group_name" value="<?php echo $upd_grp['group_name'] ?>"maxlength="12" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9,. ]/g, '').replace(/\s+/g, ' ');">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Village Name</label>
            <input class="form-control" type="text" name="village_name" id="village_name" value="<?php echo $upd_grp['village_name'] ?>"maxlength="55" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Center Name <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="center_name" id="center_name" value="<?php echo $upd_grp['center_name'] ?>"maxlength="55" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="<?php echo $upd_grp['mobile_no'] ?>"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label">Address <span class="text-danger">*</span></label>
            <textarea class="form-control" name="address" id="address" row="2"maxlength="80"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"><?php echo $upd_grp['address'] ?></textarea>
        </div>
    </div>
</div>