<style>
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

    #uriActn {
        display: none;
    }

    .cmpnyHedng {
        text-align: center;
        font-weight: bold;
        color: #0576B9;
        font-size: 2.25rem;
        line-height: 1.3;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .header-green {
        background-color: #008288;
        color: #fff;
    }

    .brAddr {
        font-size: 1rem !important;
        text-transform: capitalize;
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

    .pull-right {
        float: right !important;
    }

    .fntClr {
        color: #a21f00;
    }

    .miFonts {
        font-weight: 700;
    }
</style>
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
<input type="hidden" name="target" id="target" value="<?php echo $target; ?>">
<div class="card">
    <div class="ami_dev"><span><i class="bx bx-wallet-alt"></i></span> <span id="mstrTitle"><?php echo $title ?></span></div>
    <span id="uriActn"><?php echo $uriActn; ?></span>
    <div class="card-body">

        <form method="post" id="search_loan_disbursment">
            <div class="col-xl-12">
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
                </div>

                <a href="<?php echo base_url('employee/dashboard'); ?>" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
                <button type="submit" class="btn btn-raised btn-outline-primary pull-right" onclick="return get_search(<?php echo ($miActn=='fieldScheduleWiseReport')?'reportForClose':'reportBranchWise';?>,'#search_loan_disbursment','<?php echo ($miActn=='fieldScheduleWiseReport')?'#closeLoanReport':'#brReport';?>')">
                
                    <i class="bx bx-search-alt"></i> Search
                </button>
                <button type="button" class="btn btn-outline-success ActnCmdByAmi" id="miBranchWiseReports" style=" margin-right:10px; float:right;">
                    <i class="bx bx-printer"></i> Print
                </button>

            </div>
        </form>

        <div class="row">

            <div class="table-responsive">
                <div class="col-lg-12">
                    <?php 
					 if($miActn == 'branchWiseLoanDisReport') { ?>
                        <div class="col-lg-12">
                            <div style="padding:10px;">
                                <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                                    <div class="brAddr">
                                        <?php if ($miActn == 'fieldScheduleWiseReport') {
                                            echo 'Field Schedule';
                                        } else { ?>Daily Summary Sheet<?php } ?> Report <?php echo $this->session->userdata('branch_office') ?></div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                        </div>

                        <table id="brReport" class="table align-middle table-striped table-nowrap mb-0">

                            <thead class="header-green">
                                <tr>
                                    <th>S No.</th>
                                    <th>C.Code</th>
                                    <th>Center Name</th>
                                    <th>Disburse</th>
                                    <th>Fee</th>
                                    <th>Adv</th>
                                    <th>OD</th>
                                    <th>Arr</th>
                                    <th>CLS</th>
                                    <th>Loan M</th>
                                    <th>Int L.M.</th>
                                    <th>Collection.</th>
                                    <th>Total</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                //echo $this->db->last_query();exit;
                                if ($getReportList) {
                                    $cCnt = 0;
                                    $disbAmtDis = 0;
                                    foreach ($getReportList as $getRepL) {
                                        $cCnt++;
                                        if ($getRepL['intAmo']) {
                                            $disbAmDet = $getRepL['intAmo'];
                                        } else {
                                            $disbAmDet = '0.0';
                                        }
                                        // print_r($centr->processing_fee);echo '<br>';
                                ?>

                                        <tr>
                                            <td style="border: 1px solid black;"><strong><?php echo $cCnt; ?>.</strong></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->disDate; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->clientID; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->loanID; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->center_name; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->clientName; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->clientKyc; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->guardian_name; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->guardianKyc; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->pay_mode; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->ifsc_code; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->account_no; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->disAmt; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->processing_fee; ?></td>
                                        </tr>

                                    <?php  } ?>




                                <?php    } else {
                                ?>

                                    <tr>
                                        <td colspan="14" class="mtNtFnd">
                                            <div class="noDTfound">
                                                <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                                <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                            </div>

                                        </td>
                                    </tr>


                                <?php } ?>
                            </tbody>
                            <tfoot id="graAlTot">
                                <tr>
                                    <td colspan="3" style="text-align:right; font-weight:900;"> Total Amount</td>
                                    <td id="disbAmt" class="miFonts">0.00</td>
                                    <td id="prFeeAmt" class="miFonts">0.00</td>
                                    <td id="extraAmt" class="miFonts">0.00</td>
                                    <td id="duesRestAmt" class="miFonts">0.00</td>
                                    <td id="prevEmiAmt" class="miFonts">0.00</td>
                                    <td id="test_1" class="miFonts">0.00</td>
                                    <td id="loanMwithoutInt" class="miFonts">0.00</td>
                                    <td id="intPaid" class="miFonts">0.00</td>
                                    <td id="emi_total" class="miFonts">0.00</td>
                                    <td id="grAtotal" class="miFonts">0.00</td>
                                </tr>
                            </tfoot>

                        </table>
                    <?php }
					 elseif($miActn == 'centerWiseLoanDisReport') { ?>
                        <div class="col-lg-12">
                            <div style="padding:10px;">
                                <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                                    <div class="brAddr">
                                        <?php if ($miActn == 'fieldScheduleWiseReport') {
                                            echo 'Field Schedule';
                                        } else { ?>Daily Disbursement Sheet<?php } ?> Report <?php echo $this->session->userdata('branch_office') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                        </div>
                        <table id="brReport" class="table align-middle table-striped table-nowrap mb-0">
                            <thead class="header-green">
                                <tr>
                                    <th>S No.</th>
                                    <th>Disburse Date</th>
                                    <th>Client ID</th>
                                    <th>Loan ID</th>
                                    <th>Center Name</th>
                                    <th>Client Name</th>
                                    <th>Client KYC</th>
                                    <th>Guardian Name</th>
                                    <th>Guardian KYC</th>
                                    <th>Mode</th>
                                    <th>Disburse</th>
                                    <th>Profile Fee</th>
                                    <th>Bank IFSC</th>
                                    <th>Account No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //echo $this->db->last_query();exit;
                                if ($getCReportList) {
                                    $cCnt = 0;
                                    $tProFee = 0;
                                    $tCloanDisAmt = 0;
                                    foreach ($getCReportList as $centr) {
                                        $cCnt++;
                                        if ($centr->processing_fee) {
                                            $processing_fee = $centr->processing_fee;
                                        } else {
                                            $processing_fee = 0;
                                        }
                                        if ($centr->disAmt) {
                                            $disAmt = $centr->disAmt;
                                        } else {
                                            $disAmt = 0;
                                        }
                                        $tProFee += $processing_fee;
                                        $tCloanDisAmt += $disAmt;
                                        // print_r($centr->processing_fee);echo '<br>';
                                ?>

                                        <tr>
                                            <td style="border: 1px solid black;"><strong><?php echo $cCnt; ?>.</strong></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->disDate; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->clientID; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->loanID; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->center_name; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->clientName; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->clientKyc; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->guardian_name; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->guardianKyc; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->pay_mode; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->ifsc_code; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->account_no; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->disAmt; ?></td>
                                            <td style="border: 1px solid black;"><?php echo $centr->processing_fee; ?></td>
                                        </tr>

                                    <?php  } ?>




                                <?php    } else {
                                ?>

                                    <tr>
                                        <td colspan="14" class="mtNtFnd">
                                            <div class="noDTfound">
                                                <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                                <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                            </div>

                                        </td>
                                    </tr>


                                <?php } ?>
                            </tbody>
                            <tfoot id="graTotal">
                                <tr>
                                    <td colspan="10" style="text-align:right; font-weight:900;"> Total Disbursment</td>
                                    <td id="disTotalAmt" class="miFonts">0.00</td>
                                    <td id="proFeeTotalAmt" class="miFonts">0.00</td>
                                </tr>
                            </tfoot>





                        </table>
                        <table class="table align-middle table-striped table-nowrap mb-0" style="margin-left: 600px;">
                            <tbody>
                                <?php foreach ($getCReportList as $centr) { ?>
                                    <?php if ($centr->processing_fee) {
                                        $processing_fee = $centr->processing_fee;
                                    } else {
                                        $processing_fee = 0;
                                    }
                                    if ($centr->disAmt) {
                                        $disAmt = $centr->disAmt;
                                    } else {
                                        $disAmt = 0;
                                    }
                                    $tProFee += $processing_fee;
                                    $tCloanDisAmt += $disAmt; ?>
                                <?php } ?>

                            </tbody>
                        </table>
                    <?php }
					 elseif($miActn == 'fieldScheduleWiseReport') { ?>
                        <style>
                            #brReport>tbody>tr>td {
                                text-align: center !important;
                            }
                        </style>
                        <div class="row">
						
                            <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                        </div>
                        <table id="closeLoanReport" class="table align-middle table-striped table-nowrap mb-0">
                            <thead class="header-green">
                                <tr>
                                    <th>S No.</th>
                                    <th>Center ID</th>
                                    <th>Center Name</th>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Staff Name</th>
                                </tr>
                            </thead>
                        </table>
                    <?php }
					 else { ?>
                        <table>
                            <tbody id="miLnDetailsShow">
                                <tr>
                                    <td colspan="12" class="mtNtFnd">
                                        <div class="noDTfound">
                                            <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                            <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/employee/reports.js"></script>
<script>
    //    


    $(document).ready(function() {
        $("#graAlTot").hide();
        $(".btn-raised").click(function() {
            $("#graAlTot").show();
        });
    });
</script>