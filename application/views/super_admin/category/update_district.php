<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">District Name</label>
            <input class="form-control" type="text" name="id" id="id" value="<?php echo $district['id']; ?>">
            <input class="form-control" type="text" name="district_name" id="district_name" value="<?php echo $district['district_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
        </div>
    </div>
</div>