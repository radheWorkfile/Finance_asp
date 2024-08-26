<style>

.header-green {background-color: #008288;color: #fff;}

.ami_dev{padding:10px 0px 10px 10px;background-color:#3b5998;color:#fff;border:1px solid #3b5998;text-transform:uppercase;font-weight:bold;}
.ami_dev span i{padding:5px;background-color:#fff;border-radius:5px;color:#3b5998;}
.fntClr{color:#007a80;}
.srcText{ font-weight:900;color: #8a0505;font-size: 0.75rem}
.cmpnyHedng{text-align: center;font-weight: bold;color: #0576B9;font-size: 1.6rem;line-height: 1.3;margin-bottom: 5px;text-transform: uppercase;}
.brAddr{ font-size:1rem !important;text-transform: capitalize;}
.tTyp{ font-size: 0.75rem;font-weight:bold;}
#uriActn,#uriPrintActn{ display:none;}

:root{--mi-bar-color: #229197;--mi-bar-bg-color: #fff;--mi-bar_color: #fff;}
.table-responsive:hover{scrollbar-color: var(--mi-bar-color) var(--mi-bar-bg-color);}
.table-responsive{overflow-x:scroll;scrollbar-width:thin;scrollbar-color:var(--mi-bar_color) var(--mi-bar-bg-color);padding-bottom:15px;}
.noDTfound{text-align:center;padding:10px;margin:-12px;color: #b72200;text-transform:uppercase;font-weight:bold;}

.noDTfound i{color:#fff;background-color:#b72200;padding:5px;border-radius:7px;}
#miLnDetailsShow tr td,th{ text-align:center !important;}
#miLnDetailsShow span {color:#ff6000;font-weight: bold;}
#miLnDetailsShow label {color:green;font-weight: bold;}
#miLnDetailsShow div {border-bottom: 1px dashed #000;}
.mtNtFnd div{ border-bottom: 0px dashed #000 !important;}
.partiallyPaid{ color:#3E9593 !important;}
#currentClock{ color:#345829 !important;font-size:.95rem !important;}
.tfntBld{font-weight:900;}
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
                <form id="filter_report_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                   
                   
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-outline-dark ActnCmdByAmi" style="margin-top:10px; margin-right:10px; float:right;" id="miPrintReports" >
                                <i class="bx bx-printer"></i> Print 
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-12">
                        <div style="padding:10px;">
                            <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br/>
                                <div class="brAddr">Due Collection | <?php echo $this->session->userdata('branch_office') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                    </div>
                </div>
                <table id="due_collection" class="table align-middle table-striped table-nowrap mb-0 table-responsive">
                    <thead class="header-green">
                        <tr>
                            <th>Sl. No.</th>
                            <th>Center Code</th>
                            <th>Center Name</th>
                            <th>Staff Name</th>
                            <th>Clients</th>
                            <th>Recovery</th>
                            <th>Due Recovery</th>
                            <th>Sum Reco</th>
                            <th>Rec Post</th>
                            <th>Due Post</th>
                            <th>Receive Sum</th>
                            <th>Rec Due</th>

                          
                          
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
