<style>
    .header-green {
        background-color: #008288;
        color: #fff;
    }

    .ami_dev {
        padding: 10px 0px 10px 10px;
        background-color: #3b5998;
        color: #fff;
        border: 1px solid #3b5998;
        text-transform: uppercase;
        font-weight: bold;
    }

    .ami_dev span i {
        padding: 5px;
        background-color: #fff;
        border-radius: 5px;
        color: #3b5998;
    }

    .fntClr {
        color: #007a80;
    }

    .srcText {
        font-weight: 900;
        color: #8a0505;
        font-size: 0.75rem
    }

    .cmpnyHedng {
        text-align: center;
        font-weight: bold;
        color: #0576B9;
        font-size: 1.6rem;
        line-height: 1.3;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .brAddr {
        font-size: 1rem !important;
        text-transform: capitalize;
    }

    .tTyp {
        font-size: 0.75rem;
        font-weight: bold;
    }

    #uriActn,
    #uriPrintActn {
        display: none;
    }

    :root {
        --mi-bar-color: #229197;
        --mi-bar-bg-color: #fff;
        --mi-bar_color: #fff;
    }

    .table-responsive:hover {
        scrollbar-color: var(--mi-bar-color) var(--mi-bar-bg-color);
    }

    .table-responsive {
        overflow-x: scroll;
        scrollbar-width: thin;
        scrollbar-color: var(--mi-bar_color) var(--mi-bar-bg-color);
        padding-bottom: 15px;
    }

    .noDTfound {
        text-align: center;
        padding: 10px;
        margin: -12px;
        color: #b72200;
        text-transform: uppercase;
        font-weight: bold;
    }

    .noDTfound i {
        color: #fff;
        background-color: #b72200;
        padding: 5px;
        border-radius: 7px;
    }

    #miLnDetailsShow tr td,
    th {
        text-align: center !important;
    }

    #miLnDetailsShow span {
        color: #ff6000;
        font-weight: bold;
    }

    #miLnDetailsShow label {
        color: green;
        font-weight: bold;
    }

    #miLnDetailsShow div {
        border-bottom: 1px dashed #000;
    }

    .mtNtFnd div {
        border-bottom: 0px dashed #000 !important;
    }

    .partiallyPaid {
        color: #3E9593 !important;
    }

    #currentClock {
        color: #345829 !important;
        font-size: .95rem !important;
    }

    .tfntBld {
        font-weight: 900;
    }
</style>
<style>
    input[type=text] {
        border: none;
        float: right;
    }

    input {
        width: 30%;
    }

    .hhh {
        padding-left: 1.8rem;
    }

    .man-box {
        border-bottom: 1px solid #d2d2d2;
        border-radius: 0.5rem;
    }

    .man-text {
        margin-top: -0.5rem;
    }

    .f-right {
        float: right;
    }
</style>


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0  ami_dev" style="margin-left: 6px; margin-right: 6px; border-radius: 0px;">
            <h4 class="mb-sm-0 font-size-16 fw-bold" style="color: white;">
                <?php echo $title ?>
            </h4>

            <div class="page-title-right" style="color: white;">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item" style="color: white;"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active" style="color: white; margin-right: 5px;">
                        <?php echo $breadcrums ?>
                    </li>
                </ol>
            </div>

        </div>
    </div>
</div>
<span id="uriActn"><?php echo $uriActn; ?></span>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo base_url();?>super_admin/accounting/Balance_sheet/balance_report" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="date" name="strtDt" id="strtDt" class="form-control">
                                <label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Start Date </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">

                                <input type="date" name="endDt" id="endDt" class="form-control">
                                <label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> End Date </label>
                            </div>
                        </div>
                        <div class="col-ld-12">
                         <select class="" style="background-color:#f9f4f4;padding:1rem 2.5rem;border:1px solid #e2e2e2;" name="dmy" id="dmy" style="padding:0.2rem 2rem;">
                            <option value="">--- Select One --- </option>
                            <option value="<?php echo date('Y-m-d');?>">Day</option>
                            <option value="<?php echo date('Y-m').'-00';?>">Month</option>
                            <option value="<?php echo date('Y').'-00'.'-00';?>">year</option>
                         </select>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-outline-primary" style="margin-top:10px; float:right;">
                                <i class="bx bx-search-alt"></i> Search
                            </button>
                            <button type="button" class="btn btn-outline-dark ActnCmdByAmi" style="margin-top:10px; margin-right:10px; float:right;">
                                <i class="bx bx-printer"></i> Print
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-lg-12">
                        <div style="padding:10px;">
                            <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                                <div class="brAddr">Balance Sheet Report | <?php echo $this->session->userdata('branch_office') ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===========================================================================  -->

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <form id="balance_sheet" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    <div class="row" style="padding:1rem;">

                                        <table class="table">
                                            <tr style="background-color:#008288;line-height:0.6rem;">
                                                <td style="font-weight:600;color:white;">Net Profit</td>
                                                <td style="float:right;color:white;padding-right:2rem;">
                                                    <b> <?php echo '₹' . " " . number_format($total_inc[0]['total_inc'] + $total_exp[0]['total_exp'], 2); ?></b>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- -------------------------------------------------  -->

                                        <div class="row" id="tt">
                                            <table class="table" id="t">
                                                <tr>
                                                    <td style="padding-left:6rem;"><b>Total Income</b></td>
                                                    <td style="float:right;"><b><?php echo '₹' . " " . number_format($total_inc[0]['total_inc'], 2); ?></b></td>
                                                </tr>
                                                <?php foreach ($income_source as $pro => $icSor) {  ?>
                                                    <tr>
                                                        <td style="padding-left:5rem;">&nbsp;&nbsp;<?php echo $pro + 1; ?>.&nbsp;&nbsp;<?php echo $icSor['source_name']; ?></td>

                                                        <td style="float:right;"><?php echo $icSor['inc_all_amount']; ?></td>
                                                        <td></td>
                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <td style="padding-left:6rem;"><b>Total Expense</b></td>
                                                    <td style="float:right;"><b><?php echo '₹' . " " . number_format($total_exp[0]['total_exp'], 2); ?></b></td>
                                                </tr>

                                                <?php foreach ($expense as $e => $exp) {  ?>
                                                    <tr>
                                                        <td style="padding-left:5rem;">&nbsp;&nbsp;<?php echo $e + 1; ?>.&nbsp;&nbsp;<?php echo $exp['exp_name']; ?></td>
                                                        <td style="float:right;"><?php echo number_format($exp['all_amount'], 2) ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </table>
                                        </div>

                                        <!-- -------------------------------------------------  -->




                                    </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-1"></div>
                    <span id="test"></span>

                </div>
                <!-- ===========================================================================  -->





            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>

