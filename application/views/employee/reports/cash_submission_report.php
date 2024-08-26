<style>

.header-green {background-color: #008288;color: #fff;}

.ami_dev{padding:10px 0px 10px 10px;background-color:#3b5998;color:#fff;border:1px solid #3b5998;text-transform:uppercase;font-weight:bold;}
.ami_dev span i{padding:5px;background-color:#fff;border-radius:5px;color:#3b5998;}
.brAddr{ font-size:1rem !important;text-transform: capitalize;}
.cmpnyHedng{text-align: center;font-weight: bold;color: #0576B9;font-size: 1.6rem;line-height: 1.3;margin-bottom: 5px;text-transform: uppercase;}
#uriActn{ display: none;}
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
<span id="uriActn"><?php echo $uriActn;?></span>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="filter_cash_report_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-floating mb-3">
                                <select class="form-control select2" name="center_name" id="miCode">
                                    <option value="" style="margin-top: -10px important;"> --- Select One --- </option>
                                    <?php foreach($center_data as $cntr) { ?>
                                        <option value="<?php echo $cntr['id'] ?>"><?php echo $cntr['center_name'].  "(". $cntr['center_id'] . ")" ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <button type="submit" class="btn btn-outline-primary ActnCmdByAmi" style="margin-top:10px; float:right;">
                                <i class="bx bx-search-alt"></i> Search 
                            </button> 
                            <button type="button" class="btn btn-outline-dark ActnCmdByAmi" style="margin-top:10px; margin-right:10px; float:right;" id="miPrintReports" >
                                <i class="bx bx-printer"></i> Print 
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row">
                <div class="col-lg-12">
                    <div style="padding:10px;">
                        <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                            <div class="brAddr">Weekly Cash Submission Report Report | <?php echo $this->session->userdata('branch_office') ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                    </div>
            </div>
                <table id="submissiontable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead class="header-green">
                        <tr>
                            <th>Sl. No.</th>
                            <th>Center Code</th>
                            <th>Center Name</th>
                            <th>clients</th>
                            <th>Recovery</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

<script src="<?php echo base_url() ?>media/js/employee/reports.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>