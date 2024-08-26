
<!-- guardian_name -->
<div class="container">  
    <div class="row">
        <div class="col-md-12">
            <p style="color:#0c8b73;"><strong>Are you sure you want change.<br>Staff Name :- <?php echo $get_data['full_name'].'<br>Guardian Name :-&nbsp;'.$get_data['guardian_name']?></strong></p>
            <input type="hidden" name="pre_stf_id" id="pre_stf_id" value="<?php echo $get_data['id']?>">
            <input type="hidden" name="pre_status" id="pre_status" value="<?php echo $get_data['status']?>">
        <select class="form-control" id="staff_id" name="staff_id">
                <option value=""style="text-align:center;">----Select One----</option>
                <?php foreach($value as $val):?>
                <option value="<?php echo $val['id']?>"><?php echo $val['full_name']?></option>
            <?php endforeach;?>
		</select>
          
        </div>
    </div>
</div>