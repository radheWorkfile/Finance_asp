<?php if ($category['status'] == 1) {
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
                            <b>Loan Product Name</b>
                            <a style="float: right;">
                                <?php echo $category['loan_product_name'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Amount</b>
                            <a style="float: right;">
                                <?php echo $category['amount'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Tenure</b>
                            <a style="float: right;">
                                <?php echo $category['tenure'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Processing Fee</b>
                            <a style="float: right;">
                                <?php echo $category['processing_fee'];?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Interest Type</b>
                            <a style="float: right;">
                                <?php if($category['interest_type'] == 1)  {
                                        echo "Percentage";
                                    } elseif($category['interest_type'] == 2) {
                                        echo "Amount";
                                    }
                                ?>
                            </a>
                        </li>
                        <?php if($category['interest_type'] ==1) { ?>
                            <li class="list-group-item">
                                <b>Interest Percentage</b>
                                <a style="float: right;">
                                    <?php echo $category['interest_percentage'] ?> <span>%</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($category['interest_type'] == 2) { ?>
                            <li class="list-group-item">
                                <b>Interest Amount</b>
                                <a style="float: right;">
                                    <?php echo $category['interest_amount']  ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>