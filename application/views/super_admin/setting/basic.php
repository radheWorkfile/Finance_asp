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
<div class="row">
    <p class="alert alert-danger" role="alert">
        <strong>Warning!</strong> Please donot change any setting here until and unless you know what you are doing. Please
        take support team or developer advice before making any changes at live site.
    </p>
    <div class="col-lg-8">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Company Basic Details</h4>
                </div>
                <div class="card-body">
                    <form id="basic_data">
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <label for="Company Name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_name" placeholder="Enter Your Company Name" value="<?php echo config_item('company_name') ?>"oninput="this.value = this.value.toLowerCase().replace(/[^a-z ]/g, '').replace(/\s+/g, ' ');">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Mobile Number" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mobile" placeholder="Enter Your Mobile Number" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="10" value="<?php echo config_item('mobile_number') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Email Id" class="form-label">Email ID <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email ID" value="<?php echo config_item('email') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" placeholder="Enter Your Address"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"><?php echo config_item('address') ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 pt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Light Logo </h4>
                    </div>
                    <div class="card-body">
                        <form id="light_logo_update" enctype="multipart/form-data" method="POST">
                            <div class="input-group">
                                <input type="file" class="form-control" name="light_logo">
                                <input type="submit" class="input-group-text" value="Update">
                            </div>
                        </form>
                        <div class="text-center mt-3 pt-2 bg-danger">
                            <img src="<?php echo base_url('media/images/'.config_item('logo_light')) ?>" alt="Logo" width="100%">
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Light Favicon </h4>
                    </div>
                    <div class="card-body">
                        <form id="light_favicon_update" enctype="multipart/form-data" method="POST">
                            <div class="input-group">
                                <input type="file" class="form-control" name="light_favicon">
                                <input type="submit" class="input-group-text" value="Update">
                            </div>
                        </form>
                        <div class="text-center mt-3 pt-2 bg-danger">
                            <img src="<?php echo base_url('media/images/'.config_item('logo_sm_light')) ?>" alt="Logo" width="30%">
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Logo Dark </h4>
            </div>
            <div class="card-body">
                <form id="dark_logo_update" enctype="multipart/form-data" method="POST">
                    <div class="input-group">
                        <input type="file" class="form-control" name="dark_logo">
                        <input type="submit" class="input-group-text" value="Update">
                    </div>
                </form>
                <div class="text-center pt-2">
                    <img src="<?php echo base_url('media/images/'.config_item('logo_dark')) ?>" alt="Dark Logo" width="100%">
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Dark Favicon </h4>
            </div>
            <div class="card-body">
                <form id="dark_favicon_update" enctype="multipart/form-data" method="POST">
                    <div class="input-group">
                        <input type="file" class="form-control" name="dark_favicon">
                        <input type="submit" class="input-group-text" value="Update">
                    </div>
                </form>
                <div class="text-center pt-2">
                    <img src="<?php echo base_url('media/images/'.config_item('logo_sm')) ?>" alt="Small Logo" width="35%">
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
</div>



<!-- end page title -->

<script src="<?php echo base_url() ?>media/js/super_admin/setting.js"></script>