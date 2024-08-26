<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrums?></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row mb-4">
    <div class="col-xl-4">

        <div class="card h-100">

            <div class="card-body">
                <div>
                    <div class="clearfix"></div>

                    <div class="text-center bg-pattern">
                        <img src="<?php echo base_url() . '/' . $users['photo']; ?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3">
                        <h4 class="text-primary mb-2"><?php echo $users['name'] ?></h4>
                        <h5 class="text-muted font-size-13 mb-3"><?php echo $department['name'] ?></h5>
                        <div class="text-center">
                            <a href="mailto:<?php echo $users['email'] ?>" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
                            <a href="tel:<?php echo $users['mobile'] ?>" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>PhoneCall</a>
                        </div>
                    </div>

                </div>

                <hr class="my-4">
                <div class="table-responsive">
                    <h5 class="font-size-16 mb-3">Personal Information</h5>

                    <div>
                        <p class="mb-1 text-muted font-size-13">Mobile :</p>
                        <h5 class="font-size-14"><?php echo $users['mobile'] ?></h5>
                    </div>
                    <div class="mt-3">
                        <p class="mb-1 text-muted font-size-13">E-mail :</p>
                        <h5 class="font-size-14"><?php echo $users['email'] ?></h5>
                    </div>
                    <div class="mt-3">
                        <p class="mb-1 text-muted font-size-13">Location :</p>
                        <h5 class="font-size-14"><?php echo $users['address'] ?></h5>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Details</h4>
            </div>
            <div class="card-body p-4">
                <form id="profile_data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $users['name']; ?>">
                                <label for="Name">Name</label>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $users['id']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="number" name="number" value="<?php echo $users['mobile']; ?>" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="10">
                                <label for="Name">Contact</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $users['email']; ?>">
                                <label for="Email">Email</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="password">
                                <label for="Password">Password</label>
                                <input type="hidden" class="form-control" name="oldpassword" id="oldpassword" value="<?php echo $users['password'] ?>">
                                <input type="hidden" class="form-control" name="oldshow_ps" id="oldshow_ps" value="<?php echo $users['show_ps'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="address" id="address"><?php echo $users['address']; ?></textarea>
                                <label for="Address">Address</label>
                            </div>
                        </div>
                        <div class="col-lg-12 ">
                            <button type="submit" class="btn btn-lg btn-info">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- end row -->

<script src="<?php echo base_url() ?>media/js/agent/common.js"></script>