<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Document Name</label>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $doc['id']; ?>">
            <input class="form-control" type="text" name="document_name" id="document_name" value="<?php echo $doc['document_name'] ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"><?php echo $doc['description'] ?></textarea>
        </div>
    </div>
</div>