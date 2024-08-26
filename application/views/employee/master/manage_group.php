<style>
.ami_dev{padding:10px 0px 10px 10px;background-color:#3b5998;color:#fff;border:1px solid #3b5998;}
.ami_dev span i{ padding:5px;background-color:#fff;border-radius:5px;color:#3b5998;}

.ititle i{ font-weight:900;}
.ititle {padding:4px 8px ;background-color:#fff;border-radius:15px;float:right;margin:-3px 10px -5px -5px; color:#3b5998;}
.ititle:hover{background-color:#D3D3D3;}
.dataTables_processing{ background-color:#e4ffc4;margin-top: 30px !important;color: #396800;}
.header-green {
  background-color: #008288;
  color: #fff;
}
.header-green tr th{ border:1px solid #008288; }



.actv-btn {width: 90px;padding: 4px 0px 4px 0px;cursor: pointer;text-align: center;color: #f2f2f2;border-radius: 5px;}
.bg-olive{border:1px solid #019b5d;color:#019b5d;}
.bg-orange{border:1px solid  #d56301;color:#d56301;}
.bg-olive:hover{background-color: #008650; color:#fff;}
.bg-orange:hover{background-color: #c45a00;color:#fff;}
.modal-title span i{ padding:5px;background-color:#3b5998;border-radius:5px;color:#fff;}
.modal-title{ color:#3b5998;}

.form-control[readonly]{background-color: #fff !important;}
#miniMize,#adBtnActn,#minBtnActn,#nCreateCode{ display:none;}
#mstrTitle{ font-weight:900;text-transform: uppercase;}
.pull-right{ float:right;}

</style>


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $bredcrums ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="card">
<div class="ami_dev"><span><i class="bx bx-home"></i></span> <span id="mstrTitle"><?php echo $title ?></span>
<!--data-bs-toggle="modal" data-bs-target=".bs-example-modal-md"-->
<span id="minBtnActn">employee/master/group/cStatus</span>
</div>
    <input type="hidden" id="locTrgt" value="employee/master/group/cStatus">
    <div class="card-body">
	   <div class="row" id="vTbleShw">
            <div class="col-12">
                <table id="villagetable" class="table align-middle table-striped table-nowrap mb-0">
                    <thead class="header-green">
                        <tr>
                            <th>S No.</th>
                            <th>Group ID. </th>
                            <th>Center Name</th>
                            <th>Name</th>
                            <th>Opening Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        <!-- end col -->
        </div>
    <form id="villageMaster" method="post" accept-charset="utf-8" enctype="multipart/form-data">        
        <input type="hidden" id="target" name="target" value="<?php echo $target;?>">
        <!--<div id="testing_pr" style="background-color: #ccc;padding: 10px;margin-bottom: 20px;border: 1px solid #9f9a9a;">Change Value show here </div>-->
       <div class="row" id="vCreateNew" style="display:none;">
            <div class="col-md-6">
               <div class="mb-3">   
                  <label class="form-label">Group Code</label>
                  <input class="form-control mIsCode" type="text" readonly="readonly" name="grpCode" id="grpCode"> 
               </div>   
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Group Name <span class="text-danger">*</span></label>
                    <input class="form-control miCln" type="text" name="group_name" id="group_name" placeholder="Enter Group Name"maxlength="20"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');">
                </div>
            </div>
            <div class="col-md-4"> 
               <div class="mb-3">
                <label class="form-label">Center Name<span class="text-danger">*</span> </label>
                <select  name="centerID" class="form-control miCln" id="centerID">
                    <option value="">----Select One----</option>
                    <?php 
                        if($getCenter)
                        {
                         foreach($getCenter as $cent)
                          {
                            ?>
                    <option value="<?php echo $cent['id'];?>"><?php echo $cent['center_name'].'('.$cent['center_id'].')';?></option>   
                    <?php }}?>    
                </select>
               </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label class="form-label">Assigned Employee<span class="text-danger">*</span></label>
                    <select class="form-control miCln" id="staffID" name="staffID">
                        <option value="">----Select One----</option>
                        <?php 
                            if($getEmployee)
                            {
                             foreach($getEmployee as $emp)
                              {
                                ?>
                        <option value="<?php echo $emp['id'];?>"><?php echo $emp['full_name'].'('.$emp['staff_id'].')';?></option>   
                        <?php }}?>    
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label class="form-label">Opening Date<span class="text-danger">*</span></label>
                    <input class="form-control miCln" type="date" name="openingDate" id="openingDate" value="<?php echo date('Y-m-d') ?>">
                </div>
            </div>
            <div class="col-md-12" style="margin-top:20px;"> 
               <div class="mb-3">
                  <button type="button" class="btn btn-outline-dark waves-effect miAction" id="miBck"><i class="bx bx-arrow-back"></i> Back </button>
                  <button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" id="sbmtBtn"><i class="bx bx-save"></i> Submit</button>
                </div>  
            </div>
       </div> 
     </form>        
        
</div>




    </div>
</div>


<!-- JavaScript -->

<script src="<?php echo base_url() ?>media/js/employee/village.js"></script>
