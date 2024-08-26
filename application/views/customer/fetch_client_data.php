<div class="row">
    <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="row bg-white">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="background-color:#4ab5f4;color:white;">
                            <th>Sl.No.</th>
                            <th>Group Id</th>
                            <th>Payment Date</th>
                            <th>Monthly Emi</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loan_det as $l => $loan): ?>
                            <tr>
                                <td><?php echo $l; ?></td>
                                <td><?php echo $loan['group_id']; ?></td>
                                <td><?php echo $loan['payment_date']; ?></td>
                                <td><?php echo $loan['monthly_emi']; ?></td>
                                <td><?php echo $loan['principal_amt']; ?></td>
                                <td style="text-align:center;">
                                    <?php if ($loan['payment_status'] == 1): ?>
                                        <p class="btn btn-outline-warning">Unpaid</p>

                                    <?php elseif ($loan['payment_status'] == 2): ?>
                                        <p class="btn btn-outline-success">Paid</p>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>