<?php if ($man_exp['status'] == 1) {
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
                            <b>Expense Name</b>
                            <a style="float: right;">
                                <?php echo $man_exp['exp_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Description</b>
                            <a style="float: right;">
                                <?php echo $man_exp['exp_description'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Date</b>
                            <a style="float: right;">
                                <?php echo $man_exp['created_at'];?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>