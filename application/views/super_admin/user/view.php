<?php if ($users['status'] == 1) { ?>
    <b class="text-success"> Active <i class="fa fa-check"></i> </b>
<?php } else { ?>
    <b class="text-danger"> Di-Active <i class="fa fa-times"></i> </b>
<?php } ?>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url(). $users['photo'] ?>" alt="User profile picture">
        </div>
        <h3 class="profile-username text-center"><?php echo $users['name'] ?></h3>
        <p class="text-muted text-center"><?php echo $users['department_name'] ?></p>
        <div class="row">
            <div class="col-12 col-sm-12">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b>
                        <a class="float-right"><?php echo $users['email'] ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Mobile Number</b>
                        <a class="float-right"><?php echo $users['mobile'] ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Password</b>
                        <p class="float-right">
                            <span id="show_pass">
                                ****** &nbsp;
                                <a href="javascript:void(0);" onclick="pass(1)"><i class="fas fa-eye"></i></a>
                            </span>
                            <input type="hidden" id="ps" value="<?php echo $users['show_ps'] ?>">
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>