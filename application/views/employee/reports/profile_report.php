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
                            <button type="button" class="btn btn-outline-dark ActnCmdByAmi" style="margin-top:10px; margin-right:10px; float:right;" id="miPrintReports" >
                                <i class="bx bx-printer"></i>Download pdf 
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row">
                <div class="col-lg-12">
                
                    <div class="row">
                        <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                        <div class="col-lg-6 ">
                            <span class="srcText float-end" id="brnacDet">&nbsp;</span>&nbsp;
                            <span class="tTyp float-end">Center Name : &nbsp;</span>
                        </div>
                    </div>
                </div>
              </div>
            <table id="profiletable" class="table align-middle table-striped table-nowrap mb-0 table-responsive">
                <thead class="header-green">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Customer Code</th>
                        <th>Group Code</th>
                        <th>Center Name</th>
                        <th>Customer Name</th>
                        <th>Voter No.</th>
                        <th>Guranter Name</th>
                        <th>Guaranter Voter No.</th>
                        <th>Relation</th>
                        <th>Religion</th>
                        <th>Date of Joining</th>
                        <th>status</th>
                    </tr>
                </thead>
            </table>
            <br><br><br><br><br>
<p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:40rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

<script src="<?php echo base_url() ?>media/js/employee/reports.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>


