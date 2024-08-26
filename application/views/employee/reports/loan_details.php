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

    /* #miLnDetailsShow div {
        border-bottom: 1px dashed #000;
    } */

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

<div class="card">
    <div class="ami_dev"><span><i class="bx bx-wallet-alt"></i></span> <span id="mstrTitle"><?php echo $title ?></span>
    </div>
    <span id="uriActn"><?php echo $uriActn; ?></span>

    <div class="card-body">
        <div class="row">
            <!-- ----------------------------------------------------------------  -->

            <!-- ----------------------------------------------------------------  -->

        </div>
        <?php if ($miActn == 'clientWiseLoanReport') { ?>
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
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <!-- <input type="text" name="miCode" id="miCode" class="form-control"> -->
                                <select class="form-control select2" name="miCode" id="miCode">
                                    <option value="" style="margin-top: 10px;"> --- Select One --- </option>
                                    <?php foreach ($member as $mem) { ?>
                                        <option value="<?php echo $mem['member_id'] ?>"><?php echo $mem['field_name'] .  "(" . $mem['member_id'] . ")" ?></option>
                                    <?php } ?>
                                </select>
                                <label for="userId"><?php echo $txtWithIcon; ?> <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <button type="button" class="btn btn-outline-primary ActnCmdByAmi" id="miReports" style="margin-top:10px; float:right;">
                                <i class="bx bx-search-alt"></i> Search
                            </button>
                            <button type="button" class="btn btn-outline-dark ActnCmdByAmi" disabled id="miPrintReports" style="margin-top:10px; margin-right:10px; float:right;">
                                <i class="bx bx-printer"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div style="padding:10px;">
                        <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                            <div class="brAddr"><?php echo $this->session->userdata('branch_office') ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"><span class="tTyp">Member Code </span>: <span id="memCode" class="srcText"></span></div>
                            <div class="col-lg-3"><span class="tTyp">Member Name</span>: <span id="memName" class="srcText"></span></div>
                            <div class="col-lg-3"><span class="tTyp">Loan Purpose</span>: <span id="loanPrps" class="srcText"></span></div>
                            <div class="col-lg-3"><span class="tTyp">Disbursement Date</span>: <span id="disbursDate" class="srcText"></span></div>
                            <div class="col-lg-3"><span class="tTyp">Center</span> : <span id="mCenter" class="srcText"></span></div>
                            <div class="col-lg-3"><span class="tTyp">Nominee Name</span> : <span id="gurdianName" class="srcText"></span></div>
                            <div class="col-lg-3"><span class="tTyp">Disbursement Type</span> : <span id="memCode1" class="srcText">Cash</span></div>
                            <div class="col-lg-3"><span class="tTyp">Loan Amount</span> : <span id="memLnAmt" class="srcText"></span></div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <div class="col-lg-12">
                        <table id="miPrintDocResult" class="table align-middle table-striped table-nowrap mb-0">
                            <thead class="header-green">
                                <tr>
                                    <th>S No.</th>
                                    <th>Week</th>
                                    <th>Exp Date</th>
                                    <th>Collection</th>
                                    <th>OS</th>
                                    <th>Rec Date</th>
                                    <th>Recovery Rs.</th>
                                    <th>Payment Status</th>
                                    <th>Customer Sign.</th>
                                    <th>Center Manger.</th>
                                    <th>Visitor Sign.</th>
                                </tr>
                            </thead>
                            <tbody id="miLnDetailsShow">
                                <tr>
                                    <td colspan="11" class="mtNtFnd">
                                        <div class="noDTfound">
                                            <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                            <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else if ($miActn == 'centerWiseLoanReport') { ?>
            <form method="post" id="search_loan_disbursment">
                <div class="col-xl-12">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="date" name="strtDt" id="strtDt" onchange="strtDtForColl(this.value)" ; class="form-control">
                                <label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Start Date </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <!-- <input type="text" name="miCode" id="miCode" class="form-control"> -->
                                <select class="form-control select2 test_2" name="miCode" id="miCode">
                                    <option value="" style="margin-top: 10px;"> --- Select One --- </option>
                                    <?php foreach ($fdsfsd as $mem) { ?>
                                        <option value="<?php echo $mem['member_id'] ?>"><?php echo $mem['field_name'] .  "(" . $mem['member_id'] . ")" ?></option>
                                    <?php } ?>
                                </select>
                                <label for="userId"><?php echo $txtWithIcon; ?> <span class="text-danger">*</span></label>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-lg-5">
                            <button type="button" class="btn btn-outline-primary ActnCmdByAmi" id="miReports" style="margin-top:10px; float:right;">
                                <i class="bx bx-search-alt"></i> Search
                            </button>
                            <button type="button" class="btn btn-outline-dark ActnCmdByAmi" disabled id="miPrintReports" style="margin-top:10px; margin-right:10px; float:right;">
                                <i class="bx bx-printer"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
            <div class="col-lg-12">
                    <div style="padding:10px;">
                        <div class="cmpnyHedng">
                            <?php echo config_item('company_name') ?> <br />
                            <div class="brAddr"><?php echo $this->session->userdata('branch_office'); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><span class="tTyp">Week: </span>:<span class="srcText"><?php echo date('W'); ?></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><span class="tTyp">Staff Name </span>:<span id="staffName" class="srcText">----------</span></div>
                            <div class="col-lg-6">  
                                <div style="float:right;">
                                    <span class="tTyp">Date</span>: <span class="srcText" id="schedule_date">-------------</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <table id="miPrintDocResult" class="table align-middle table-striped table-nowrap mb-0">
                            <thead class="header-green">
                                <tr>
                                    <th>S No.</th>
                                    <th>M.Code</th>
                                    <th>Member Name</th>
                                    <th>Guardian</th>
                                    <th>Dis Date</th>
                                    <th>Dw.</th>
                                    <th>INT.</th>
                                    <th>Loan</th>
                                    <th>Recovered</th>
                                    <th>OS Due.</th>
                                    <th>Rec.</th>
                                    <th>Total.</th>
                                    <th>Note.</th>
                                </tr>
                            </thead>
                            <tbody id="miLnDetailsShow">
                                <tr>
                                    <td colspan="14" class="mtNtFnd">
                                        <div class="noDTfound">
                                            <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                            <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <style>
                .miGrA {
                    text-align: left;
                    border-bottom: 0px;
                    color: #8a0505;
                    background-color: #d7c566;
                    margin: -12px -12px -12px -12px;
                    padding: 5px 0px 5px 15px;
                }
            </style>
            <script>
                $(document).ready(function() {
                    startTime();
                });
            </script>

        <?php } else { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="noDTfound">
                        <div><i class="bx bx-error"></i> Oops it seems you have choosen wrong way</div>
                        <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/employee/reports.js"></script>

<!-- test_2 -->
<script>
    $(document).ready(function() {
        $("#strtDt").on("change", function() {
            var strtDt = $("#strtDt").val();
           // alert(strtDt);
            $.ajax({
                type: "POST",
                url: base_url + "employee/Reports/test_collectioin",
                data: {
                    'str_data': strtDt
                },
                dataType:"json",
                success: function(data) {
                    var option = "<option>Select</option>";
                    $.each(data, function(index, val) {
                        option += "<option value='"+val.center_id+"'>" + val.center_name + "</option>";
                    });
                    $('#miCode').append(option);

                },
            });
        });
    });

</script>