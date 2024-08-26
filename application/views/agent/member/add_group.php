<div class="row">
    <div class="col-12">
        <label>Group Name:<span class="text-danger">*</span></label>
        <div class="input-group mb-3" style="height: 115px;">
            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $member_data['id'] ?>">
            <select name="group_name[]" id="group_name" class="form-control" multiple>
                <?php foreach ($group as $grp) { ?>
                    <option value="<?php echo $grp['id'] ?>" <?php $str = explode(",", $member_data['group_name']);foreach ($str as $d) {echo ($d == $grp['id'])?"Selected":""; }?>><?php echo $grp['group_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>