<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrums ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="add_group_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Code <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="group_name" id="group_name" placeholder="Auto Generate"maxlength="50" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Village Name</label>
                        <input class="form-control" type="text" name="village_name" id="village_name" placeholder="Enter Village Name"maxlength="50" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Center Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="center_name" id="center_name" placeholder="Enter Center Name"maxlength="50" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="mobile_no" id="mobile_no" placeholder="Enter Mobile no"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="address" id="address" row="2" placeholder="Enter Full Address Here!" maxlength="80"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"></textarea>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/group.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>