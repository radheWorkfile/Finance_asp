<?php if ($view_commission['status'] == 1) {
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
                            <b>Agent Name</b>
                            <a style="float: right;">
                                <?php echo $view_commission['agent_names'] . "(" . $view_commission['agent_id'] . ")" ;?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Customer Name</b>
                            <a style="float: right;">
                                <?php echo $view_commission['customer_names'] . "(". $view_commission['customer_id'] .")";?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Loan Type</b>
                            <a style="float: right;">
                                <?php echo $view_commission['loan_type_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Commission Type</b>
                            <a style="float: right;">
                                <?php 
                                    if($view_commission['commission_type'] == 1) {
                                        echo "On File";
                                    } else if($view_commission['commission_type'] == 2) {
                                        echo "On Approve";
                                    }
                                ?>
                            </a>
                        </li>
                        <?php if($view_commission['commission_type'] == 2) { ?>
                        <li class="list-group-item">
                            <b>Commission</b>
                            <a style="float: right;">
                                <?php 
                                    if($view_commission['commission'] == 1) {
                                        echo "In Percentage";
                                    } else if($view_commission['commission'] == 2) {
                                        echo "In Amount";
                                    }
                                ?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($view_commission['commission_type'] == 1) { ?>
                        <li class="list-group-item">
                            <b>Commission Amount</b>
                            <a style="float: right;">
                                <?php echo "₹ " . $view_commission['commission_amount'];?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($view_commission['commissiom'] == 2) { ?>
                        <li class="list-group-item">
                            <b>Commission Amount</b>
                            <a style="float: right;">
                                <?php echo "₹ " . $view_commission['commission_amount'];?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($view_commission['commission'] == 1) { ?>
                        <li class="list-group-item">
                            <b>Loan Amount</b>
                            <a style="float: right;">
                                <?php echo "₹ " . $view_commission['loan_amount'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Commission Percentage</b>
                            <a style="float: right;">
                                <?php echo $view_commission['commission_percentage'] . " %" ;?>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="list-group-item">
                            <b>Total Commission Amount</b>
                            <a style="float: right;">
                                <?php echo "₹ " . $view_commission['total_commission_amount'];?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>