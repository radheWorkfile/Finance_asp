<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Document Name</label>
            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $sub['id'] ?>">
            <select name="document_name" id="document_name" class="form-control">
                <option value=""> ---- Select One ---- </option>
                <?php foreach ($docu as $do) { ?>
                    <option value="<?php echo $do['id'] ?>" <?php echo ($do['id'] == $sub['document_name']) ? "Selected" : ""; ?>><?php echo $do['document_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">SubDocument Name</label>
            <input class="form-control" type="text" name="sub_document_name" id="sub_document_name" value="<?php echo $sub['sub_document_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"><?php echo $sub['description'] ?></textarea>
        </div>
    </div>
</div>