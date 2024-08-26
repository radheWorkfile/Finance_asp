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
<span id="adBtnActn">employee/master/branch/addNew</span>
<span id="minBtnActn">employee/master/branch/cStatus</span>
<span id="nCreateCode"><?php echo $vCodeAuto;?></span>
<a href="javascript:void(0);" class="ititle miAction" id="miniMize" data-id="Manage Branch" title="Back to dashboard" ><i class="bx bx-minus"></i></a>
<a href="javascript:void(0);" class="ititle miAction" id="AddNew" data-id="Add New Branch " title="Create New"><i class="fas fa-plus"></i></a>
<!--data-bs-toggle="modal" data-bs-target=".bs-example-modal-md"-->

</div>
    
    <div class="card-body">
	   <div class="row" id="vTbleShw">
            <div class="col-12">
                <table id="villagetable" class="table align-middle table-striped table-nowrap mb-0">
                    <thead class="header-green">
                        <tr>
                            <th>S No.</th>
                            <th>Branch ID. </th>
                            <th>Branch Name</th>
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
    <div class="row" id="vCreateNew" style="display:none;">
        <div class="col-md-6">
           <div class="mb-3">   
              <label class="form-label">Office Id </label>
              <input class="form-control mIsCode" type="text" readonly="readonly" value="<?php echo $vCodeAuto;?>" name="branchCode" id="branchCode"> 
           </div>   
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Branch Name <span class="text-danger">*</span></label>
                <input class="form-control miCln" type="text" name="branch_name" id="branch_name" placeholder="Enter Branch Name"maxlength="50" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
            </div>
        </div>
         <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input class="form-control miCln" type="text" name="mobile" id="mobile" maxlength="10" placeholder="Enter Mobile Number"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
		<div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Email id <span class="text-danger">*</span></label>
                <input class="form-control miCln" type="email" name="email" id="email" placeholder="Enter Branch Name">
            </div>
        </div>
		<div class="col-lg-12">
            <div class="mb-3">
                <label class="form-label">Office Address<span class="text-danger">*</span></label>
				<textarea class="form-control miCln" rows="2" name="off_addr" id="off_addr" placeholder="Enter Office Address"maxlength="80"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"></textarea>
			</div>
        </div>
		<div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">State<span class="text-danger">*</span></label>
                <select class="form-control miCln empSelectR" id="state" name="state">
                <option value="">----Select One----</option>
                <?php 
                    if($getState)
                    {
                     foreach($getState as $stt)
                      {
                        ?>
                <option value="<?php echo $stt['id'];?>"><?php echo $stt['state_cities'];?></option>   
                <?php }}?>    
            </select>
            </div>
        </div>
		<div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">District <span class="text-danger">*</span></label>
                <select class="form-control miCln" id="district" name="district">
                     <option value="" >----Select One----</option>
				</select>
            </div>
        </div>
		<div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Zipcode <span class="text-danger">*</span></label>
                <input class="form-control miCln" type="text" name="zipcode" id="zipcode" placeholder="Enter pincode of office" maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Opening Date<span class="text-danger">*</span></label>
                <input class="form-control miCln" type="date" name="openingDate" id="openingDate">
            </div>
        </div>
        
     <div class="col-md-12" style="margin-top:20px;"> 
       <div class="mb-3">
          <button type="button" class="btn btn-outline-dark waves-effect miAction" id="miBck"><i class="bx bx-arrow-back"></i> Back </button>
          <button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" id="sbmtBtn"><i class="bx bx-save"></i> Submit</button>
        </div>  
     </div>
    </div>
    <input type="hidden" id="target" name="target" value="<?php echo $target;?>">
</form>   

    
    
    
    
</div>




    </div>
</div>
 
 <input type="hidden" id="locTrgt" value="employee/master/branch/cStatus">
<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/employee/village.js"></script>


