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
        <form method="post" id="search_for_close">
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
                <button type="submit" class="btn btn-raised btn-outline-primary srchBtn pull-right" onclick="return get_search(reportForClose,'#search_for_close','#closeLoanReport')">
                    <i class="bx bx-search-alt"></i> Search
                </button>
                <button type="button" class="btn btn-outline-success ActnCmdByAmi" id="miBranchWiseReports" style=" margin-right:10px; float:right;">
                    <i class="bx bx-printer"></i> Print
                </button>

            </div>
        </form>

        <div class="row">
                <div class="col-lg-12">
                    <div style="padding:10px;">
                        <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br/>
                            <div class="brAddr">Fore Close Report | <?php echo $this->session->userdata('branch_office') ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                    </div>
            </div>
                
            <div class="table-responsive">
            <table id="closeLoanReport" class="table align-middle table-striped table-nowrap mb-0 ">
                    <thead class="header-green">
                        <tr>
                            <th>Sl. No.</th>
                            <th>Center ID </th>
                            <th>Center Name</th>
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Client DOB</th>
                            <th>Guardian  Name </th>
                            <th>Disburse Date</th>
                            <th>Forse Close Date</th>
                            <th>Recovered</th>
                            <th>Lst Recovered</th>
                            <th>Pre Closed </th>
                            <!-- <th>LST Recover</th> -->
                            <th>Remark</th>
                            <th>status</th>
                        </tr>
                    </thead>
                </table>
                </div>
     

    </div>
</div>
<input type="hidden" id="target" value="<?php echo $target;?>" />
<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/employee/reports.js"></script>