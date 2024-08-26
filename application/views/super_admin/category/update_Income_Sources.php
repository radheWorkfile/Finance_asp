<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">&nbsp;&nbsp;Source Name</label>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $income_source['id']; ?>">
            <input class="form-control" type="text" name="source_name" id="source_name" value="<?php echo $income_source['source_name']; ?>">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">&nbsp;&nbsp;Description</label>
            <input class="form-control" type="text" name="description" id="description" value="<?php echo $income_source['description'] ?>">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">&nbsp;&nbsp;Date</label>
            <input class="form-control" type="text" name="date" id="date" value="<?php echo $income_source['created_at'] ?>">
        </div>
    </div>
</div>