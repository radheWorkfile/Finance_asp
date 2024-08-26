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
<div class="card-body">
    <h4 class="text-center">personal Details</h4>
    <div class="row">
        <div class="col-md-3">
            <p class="text-sm">Name
                <b class="d-block">
                    <?php echo $member['first_name'] ." ". $member['mid_name'] ." ". $member['last_name'] ."(". $member['member_id'] .")" ?>
                </b>
            </p>
        </div>
        <div class="col-md-2">
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
        <div class="col-md-2">
            <p class="text-sm">Center
                <b class="d-block">
                    <?php echo $member['center_name']; ?>
                </b>
            </p>
        </div>
        <div class="col-md-2">
            <p class="text-sm">Group
                <b class="d-block">
                    <?php echo $member['group_name'] ?>
                </b>
            </p>
        </div>
    </div>

    <form id="add_group_loan_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Loan Type</label>
                    <input type="hidden" name="member_id" id="member_id" class="form-control" value="<?php echo $member['id']; ?>">
                    <input type="hidden" name="center_id" id="center_id" class="form-control" value="<?php echo $member['cntr_id']; ?>">
                    <input type="hidden" name="group_id" id="group_id" class="form-control" value="<?php echo $member['grp_id']; ?>">
                    <input type="text" name="schedule_date" id="schedule_date" class="form-control" value="<?php echo $member['schedule_date']; ?>">
                    <select class="form-control" name="loan_product" id="loan_product" onchange="return group_loan_product_datas(this.value)">
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
                    <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Loan Tenure <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="tenure" id="tenure" placeholder="Enter tenure">
                    <select class="form-control" name="tenure_type" id="tenure_type" onchange="return biweek_tenure(this.value)">
                        <option value=""> ---- Select One ---- </option>
                        <!-- <option value="1"> Weekely </option> -->
                        <option value="2"> Bi-Weekly</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Interest Amount <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="roi" id="roi" placeholder="Enter Rate of Interest" id="example-number-input" readonly>
                    <input type="hidden" name="interest_type" id="interest_type" class="form-control" readonly>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="lab">Processing Fee: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="processing_fee" id="processing_fee" placeholder="Enter processing fee Here!" readonly>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="lab">Disbursement Date: <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="loan_start_date" id="loan_start_date">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="lab">Purpose: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Enter Loan Purpose Here!"maxlength="80"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-1" id="btn_fixed">
                <input type="button" id="view_chart_btn_fixed" value="View Chart"  class="btn btn-primary">
            </div>
            <div class="col-sm-1" style="margin-left: 15px;">
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
            <tbody id = "emi_chart_fixed"></tbody>
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
        <!-- <table class="table table-bordered table-striped view_chart_reducing" style="display:none;">
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
        </table> -->
    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/employee/group_loan.js"></script>