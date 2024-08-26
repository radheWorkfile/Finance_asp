<style>
    .ami_dev {
        padding: 10px 0px 10px 10px;
        background-color: #3b5998;
        color: #fff;
        border: 1px solid #3b5998;
    }

    .ami_dev span i {
        padding: 5px;
        background-color: #fff;
        border-radius: 5px;
        color: #3b5998;
    }

    .ititle i {
        font-weight: 900;
    }

    .ititle {
        padding: 4px 8px;
        background-color: #fff;
        border-radius: 15px;
        float: right;
        margin: -3px 10px -5px -5px;
        color: #3b5998;
    }

    .ititle:hover {
        background-color: #D3D3D3;
    }

    .dataTables_processing {
        background-color: #e4ffc4;
        margin-top: 30px !important;
        color: #396800;
    }

    .header-green {
        background-color: #008288;
        color: #fff;
    }

    .header-green tr th {
        border: 1px solid #008288;
    }



    .actv-btn {
        width: 90px;
        padding: 4px 0px 4px 0px;
        cursor: pointer;
        text-align: center;
        color: #f2f2f2;
        border-radius: 5px;
    }

    .bg-olive {
        border: 1px solid #019b5d;
        color: #019b5d;
    }

    .bg-orange {
        border: 1px solid #d56301;
        color: #d56301;
    }

    .bg-olive:hover {
        background-color: #008650;
        color: #fff;
    }

    .bg-orange:hover {
        background-color: #c45a00;
        color: #fff;
    }

    .modal-title span i {
        padding: 5px;
        background-color: #3b5998;
        border-radius: 5px;
        color: #fff;
    }

    .modal-title {
        color: #3b5998;
    }

    .form-control[readonly] {
        background-color: #fff !important;
    }

    #miniMize,
    #adBtnActn,
    #minBtnActn,
    #nCreateCode {
        display: none;
    }

    #mstrTitle {
        font-weight: 900;
        text-transform: uppercase;
    }

    .pull-right {
        float: right;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold">
                <?php echo $title ?>
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active">
                        <?php echo $bredcrums ?>
                    </li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="ami_dev"><span><i class="bx bx-home"></i></span> <span id="mstrTitle">
            <?php echo $title ?>
        </span>
        <span id="adBtnActn">employee/master/field_schedule/addNew</span>
        <span id="minBtnActn">employee/master/field_schedule/cStatus</span>
        <span id="nCreateCode">
            <?php echo $vCodeAuto; ?>
        </span>
        <a href="javascript:void(0);" class="ititle miAction" id="miniMize" data-id="Field Schedule Manage "
            title="Back to dashboard"><i class="bx bx-minus"></i></a>
        <a href="javascript:void(0);" class="ititle miAction" id="AddNew" data-id="Add New Field Schedule"
            title="Create New"><i class="fas fa-plus"></i></a>
        <!--data-bs-toggle="modal" data-bs-target=".bs-example-modal-md"-->
    </div>

    <div class="card-body">
    
    
        <div class="row" id="vTbleShw" >
            <div class="col-12">
                <table id="villagetable" class="table align-middle table-striped table-nowrap mb-0">
                    <thead class="header-green">
                        <tr>
                            <th>S No.</th>
                            <th>Schedule Id</th>
                            <th>Center Name</th>
                            <th>Staff Name</th>
                            <th>Schedule Day</th>
                            <th>Schedule Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- end col -->
        </div>

        <form id="villageMaster" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row" id="vCreateNew"  style="display:none;">
            
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Schedule Code </label>
                        <input class="form-control" type="text" readonly="readonly" value="<?php echo $vCodeAuto; ?>" name="vCode" id="vCode">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Center Name <span class="text-danger">*</span></label>
                        <select class="form-control" id="centerName" name="centerName">
                            <option value="">----Select One----</option>
                            <?php
                            if ($getMsCenter) {
                                foreach ($getMsCenter as $msCenter) {
                                    ?>
                                    <option value="<?php echo $msCenter['id']; ?>">
                                        <?php echo $msCenter['center_name'].'('.$msCenter['center_id'].')'; ?>
                                    </option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                 <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Assigned Employee<span class="text-danger">*</span></label>
                        <select class="form-control" id="staffID" name="staffID">
                            <option value="">----Select One----</option>
                            <?php
                            if ($getEmployee) {
                                foreach ($getEmployee as $emp) {
                                    ?>
                                    <option value="<?php echo $emp['id']; ?>">
                                        <?php echo $emp['full_name'] . '(' . $emp['staff_id'] . ')'; ?>
                                    </option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Schedule Date<span class="text-danger">*</span></label>
                        <input class="form-control empSelectR" type="date" name="fSchDate" id="fSchDate" value="<?php echo date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Schedule Day</label>
                           <input class="form-control" type="text" readonly="readonly" name="dayName" id="dayName">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Schedule time</label>
                    <input class="form-control" type="text" readonly="readonly" name="scheduleTime" id="scheduleTime" value="<?php echo date('h : i : 00 A');?>">
					<div id="schTime"><i class="bx bx-time"></i></div>
                </div>

                <div class="col-md-12" style="margin-top:20px;">
                    <div class="mb-3">
                        <button type="button" class="btn btn-outline-dark waves-effect miAction" id="miBck"><i
                                class="bx bx-arrow-back"></i> Back </button>
                        <button class="btn btn-outline-primary waves-effect waves-light pull-right" id="sbmtBtn"><i class="bx bx-save"></i> Submit</button>
                    </div>
                </div>
            </div>
            <input type="hidden" id="target" name="target" value="<?php echo $target; ?>">
        </form>

    </div>

</div>
</div>

<input type="hidden" id="locTrgt" value="employee/master/field_schedule/cStatus">
<!-- JavaScript -->

<div id="miTimeModel" class="modal_mi">
  <!-- Modal content -->
  <div class="modal_mi-content">
    <div class="mi-header"><?php echo date('D,d-M-Y');?><span class="mi-close"><i class="bx bx-x"></i></span></div>
    <div class="miPaddIn">
    	<div  class="row">
            <div class="col-md-4">
            		<div class="miBtn miAction" id="hourUp"><i class="bx bx-chevron-up"></i></div>
                    <input class="miTime" type="text" name="schHour" value="<?php echo date('h');?>" id="schHour">
                   <div class="miBtn miAction" id="hourDown"><i class="bx bx-chevron-down"></i></div> 
             </div><!--Hour-->
            <div class="col-md-4">
            	<div class="miBtn miAction" id="minuteUp"><i class="bx bx-chevron-up"></i></div>
                <input class="miTime" type="text" name="schMinute" value="<?php echo date('i');?>" id="schMinute">
                <div class="miBtn miAction" id="minuteDown"><i class="bx bx-chevron-down"></i></div> 
                </div><!--Minute-->
            <div class="col-md-4">
            	<div class="miBtn miAction" id="changeAmPm"><i class="bx bx-chevron-up"></i></div>
                	<input class="miTime" type="text" name="schTimeType" value="<?php echo date('A');?>" id="schTimeType">
                <div class="miBtn miAction" id="changePmAm"><i class="bx bx-chevron-down"></i></div> 
                </div><!--AM/PM-->
    	</div>
    </div>
  </div>

</div>


<style>

#scheduleTime{cursor:pointer;}
#schTime{ float:right;margin: -30px 10px auto auto;color: #3130309e;}#schTime i{ font-size:1.25rem}
.miBtn{width:60px; background-color:#FFFFFF; font-size:1.5rem;text-align: center; cursor: pointer;}
.miPaddIn{padding: 2rem 50px 2rem 50px; background-color:#ccc;}
.miTime:focus{color:var(--bs-input-color);background-color:var(--bs-input-bg);border-color:#fff;outline:0;-webkit-box-shadow:none;box-shadow:none}

input[class=miTime]{display: block;width:60px !important;font-weight: bold;text-align:center;padding:10px;font-size:.875rem;line-height:1.5;color:var(--bs-input-color);background-color: var(--bs-input-bg);background-clip: padding-box;border: 1px solid #fff;-webkit-appearance: none;-moz-appearance: none;
  appearance: none;-webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;}
.mi-header{ background-color: #0576b9;width: 100%;padding: 10px; color:#fff; font-weight:900;}
.modal_mi {display: none;position: fixed;z-index: 1;padding-top: 150px;left: 0; top: 0;width:100%;height: 100%;overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4);


}.modal_mi-content {background-color: #fefefe;margin: auto;border: 1px solid #888;width: 320px;}
.mi-close {color: #f9f9f9;float: right;font-size: 28px;font-weight: bold;margin-top: -10px;margin-right: -5px}
.mi-close:hover,.mi-close:focus {color: #C7C7C7;text-decoration: none;cursor: pointer;}
</style>
<script>
var modal = document.getElementById("miTimeModel");
var btn = document.getElementById("scheduleTime");
var clockTm = document.getElementById("schTime");
var span = document.getElementsByClassName("mi-close")[0];
btn.onclick = function() {modal.style.display = "block";}
clockTm.onclick = function() {modal.style.display = "block";}

span.onclick = function() { modal.style.display = "none";}
window.onclick = function(event) {if (event.target == modal) {modal.style.display = "none";}}
</script>


<script src="<?php echo base_url() ?>media/js/employee/village.js"></script>