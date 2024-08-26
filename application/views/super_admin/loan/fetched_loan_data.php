<div class="card-body">
    <h4 class="text-center">personal Details</h4>
    <div class="row">
        <div class="col-md-3">
            <p class="text-sm">Name
                <b class="d-block">
                    <?php echo $member['full_name'] ?>
                </b>
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-sm">Mobile
                <b class="d-block">
                    <?php echo $member['mobile_no'] ?>
                </b>
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-sm">Email
                <b class="d-block">
                    <?php echo $member['email'] ?>
                </b>
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-sm">Address
                <b class="d-block">
                    <?php echo $member['address'] ?>
                </b>
            </p>
        </div>
    </div>

    <form id="add_loan_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Loan Product</label>
                    
                    <input type="hidden" name="member_id" id="member_id" class="form-control" value="<?php echo $member['id']; ?>">
                    <select class="form-control" name="loan_product" id="loan_product" onchange="return loan_product_data(this.value)">
                        <option value=""> ---- Select One ---- </option>
                        <?php foreach($product as $pro) { ?>
                            <option value="<?php echo $pro['id'] ?>"><?php echo $pro['loan_product_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount" readonly>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Loan Tenure <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="tenure" id="tenure" placeholder="Enter tenure">
                    <select class="form-control" name="tenure_type" id="tenure_type">
                        <option value=""> ---- Select One ---- </option>
                        <option value="1"> Daily </option>
                        <option value="2"> Weekely </option>
                        <option value="3"> Monthly </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Rate of Interest <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="roi" id="roi" placeholder="Enter Rate of Interest" id="example-number-input" readonly>
                    <input type="hidden" name="interest_type" id="interest_type" class="form-control" readonly>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-number-input" class="form-label">Loan Type <span class="text-danger">*</span></label><br>
                    <input type="radio" name="loan_type" id="loan_type" value="1" onchange="view_chrt_fxd(this.value)"> <span style="color: gray; font-size: 15px; font-weight:600;">Fixed</span><br>

                    <div id="reducing_section" style="display:none;">
                        <input type="radio" name="loan_type" id="loan_type" value="2" onchange="view_chrt_reducng(this.value)"> <span style="color: gray; font-size: 15px; font-weight:600;">Reducing</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="lab">Payment Start Date: <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="loan_start_date" id="loan_start_date">
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-sm-1" id="btn_fixed" style="display:none; margin-top:20px;">
                <input type="button" id="view_chart_btn_fixed" value="View Chart"  class="btn btn-primary">
            </div>
            <div class="col-sm-1" id="btn_reducing" style="display:none; margin-top:20px;">
                <input type="button" id="view_chart_btn_reducing" value="View Chart" class="btn btn-primary">
            </div>
            <div class="col-sm-1" style="margin-left:15px; margin-top:20px;" >
                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
            </div>
        </div>
    </form>
    <div class="row" style="margin-top:20px;">
        <table class="table table-bordered table-striped view_chart_fixed" style="display:none;">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Payment Date</th>
                    <th>Principal Amount O/S</th>
                    <th>Monthly EMI</th>
                    <th>Interest Paid</th>
                    <th>Principal Paid</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody id = "emi_chart_fixed">
                    
            </tbody>
            <tfoot>
                <tr>
                    <th>Sl. No.</th>
                    <th>Payment Date</th>
                    <th>Principal Amount O/S</th>
                    <th>Monthly EMI</th>
                    <th>Interest Paid</th>
                    <th>Principal Paid</th>
                    <th>Balance</th>
                    
                </tr>
            </tfoot>
        </table>
        <table class="table table-bordered table-striped view_chart_reducing" style="display:none;">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Payment Date</th>
                    <th>Principal Amount O/S</th>
                    <th>Monthly EMI</th>
                    <th>Interest Paid</th>
                    <th>Principal Paid</th>
                    <th>Balance</th>
                    
                </tr>
            </thead>
            <tbody id = "emi_chart_reducing">

            </tbody>
            <tfoot>
                <tr>
                    <th>Sl. No.</th>
                    <th>Payment Date</th>
                    <th>Principal Amount O/S</th>
                    <th>Monthly EMI</th>
                    <th>Interest Paid</th>
                    <th>Principal Paid</th>
                    <th>Balance</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/loan.js"></script>