<div class="row">
    <div class="col-12">
        <label>Center Name:<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $member_data['id'] ?>">
            <select name="center_name" id="center_name" class="form-control" onchange="return get_group_name(this.value)">
                <option value=""> --- Select One --- </option>
                <?php foreach ($center as $cntr) { ?>
                    <option value="<?php echo $cntr['id'] ?>" <?php echo ($cntr['id'] == $member_data['center_name']) ? "Selected" : ""; ?>><?php echo $cntr['center_name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-12">
            <label>Group Name:<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
            <select name="group_name" id="group_name" class="form-control">
            </select>
            </div>
        </div>
    </div>
</div>