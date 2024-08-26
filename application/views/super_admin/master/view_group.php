<?php if ($view_grp['status'] == 1) {
    echo "<span class='text-success'><b> Active <i class='fa fa-check'></i> </b></span>";
} else {
    echo "<span class='text-danger'><b> De-Active <i class='fa fa-times'></i> </b></span>";
}  ?>
<div class="card-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Group Name</b>
                            <a style="float: right;">
                                <?php echo $view_grp['group_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Village Name</b>
                            <a style="float: right;">
                                <?php echo $view_grp['village_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Center Name</b>
                            <a style="float: right;">
                                <?php echo $view_grp['center_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile No</b>
                            <a style="float: right;">
                                <?php echo $view_grp['mobile_no'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b>
                            <a style="float: right;">
                                <?php echo $view_grp['address'];?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>