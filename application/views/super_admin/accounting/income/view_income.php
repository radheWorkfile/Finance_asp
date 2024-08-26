
<div class="card-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Source</b>
                            <a style="float: right;">
                                <?php if($income['source'] == 1) { echo "Collection Amount"; } elseif($income['source'] == 2) { echo "Interest Amount"; } elseif($income['source']) { echo "Processing Fee";} ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Mode of Payment</b>
                            <a style="float: right;">
                                <?php if($income['mop'] == 1) {echo "Cash"; }elseif($income['mop'] == 2) {echo "Online"; }elseif($income['mop'] == 3) { echo "Cheque"; } ?>
                            </a>
                        </li>
                        <?php if($income['mop'] == 1) { ?>
                            <li class="list-group-item">
                                <b>Cash Received By</b>
                                <a style="float: right;">
                                    <?php echo $income['cash_received_by']; ?>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($income['mop'] == 2 || $income['mop'] == 3) { ?>
                        <li class="list-group-item">
                            <b>Received Account No.</b>
                            <a style="float: right;">
                                <?php echo $income['Received_acc_no']; ?>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="list-group-item">
                            <b>Amount</b>
                            <a style="float: right;">
                                <?php echo $income['amount']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Income Date</b>
                            <a style="float: right;">
                                <?php echo $income['income_date']; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Verification Proof</b>
                            <a style="float: right;">
                                <?php if($income['varification_proof_type'] == 1) { echo'Receipt'; } elseif($income['varification_proof_type'] == 2) { echo "Bank Statement"; } elseif($income['varification_proof_type'] == 3) { echo "Others"; } ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Proof image</b>
                            <a style="float: right;">
                                <?php echo $income['proof_image']; ?>
                            </a>
                        </li>
                </div>
            </div>
        </div>
    </div>
</div>