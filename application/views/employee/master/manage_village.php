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
        <span id="adBtnActn">employee/master/village/addNew</span>
        <span id="minBtnActn">employee/master/village/cStatus</span>
        <span id="nCreateCode">
            <?php echo $vCodeAuto; ?>
        </span>
        <a href="javascript:void(0);" class="ititle miAction" id="miniMize" data-id="Manage Village"
            title="Back to dashboard"><i class="bx bx-minus"></i></a>
        <a href="javascript:void(0);" class="ititle miAction" id="AddNew" data-id="Add New Village"
            title="Create New"><i class="fas fa-plus"></i></a>
        <!--data-bs-toggle="modal" data-bs-target=".bs-example-modal-md"-->
    </div>

    <div class="card-body">
        <div class="row" id="vTbleShw">
            <div class="col-12">
                <table id="villagetable" class="table align-middle table-striped table-nowrap mb-0">
                    <thead class="header-green">
                        <tr>
                            <th>S No.</th>
                            <th>Village Id</th>
                            <th>District Name</th>
                            <th>Village Name</th>
                            <th>Distance</th>
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
                        <label class="form-label">Village Code </label>
                        <input class="form-control mIsCode" type="text" readonly="readonly"
                            value="<?php echo $vCodeAuto; ?>" name="vCode" id="vCode">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">District <span class="text-danger">*</span></label>
                        <select class="form-control" id="district" name="district">
                            <option value="">----Select One----</option>
                            <?php
                            if ($getDistrict) {
                                foreach ($getDistrict as $dist) {
                                    ?>
                                    <option value="<?php echo $dist['id']; ?>">
                                        <?php echo $dist['district_name']; ?>
                                    </option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Village Category <span class="text-danger">*</span></label>
                        <select class="form-control" id="vill_cate" name="vill_cate">
                            <option value="">----Select One----</option>
                            <option value="Rural">Rural</option>
                            <option value="Urban">Urban</option>
                            <option value="Semi Urban">Semi Urban</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Village Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="village_name" id="village_name"
                            placeholder="Enter Village Name"  maxlength="50" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Distance (in Km)<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="distance" id="distance"
                            placeholder="Enter Distance value" maxlength="5" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Opening Date<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="openingDate" id="openingDate" value="<?php echo date('Y-m-d') ?>" readonly>
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
                    <label class="form-label">Number of Center<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="noCentr" id="noCentr" value="5" readonly>
                </div>

                <div class="col-md-12" style="margin-top:20px;">
                    <div class="mb-3">
                        <button type="button" class="btn btn-outline-dark waves-effect miAction" id="miBck"><i
                                class="bx bx-arrow-back"></i> Back </button>
                        <button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right"
                            id="sbmtBtn"><i class="bx bx-save"></i> Submit</button>
                    </div>
                </div>
            </div>
            <input type="hidden" id="target" name="target" value="<?php echo $target; ?>">
        </form>

    </div>

</div>
</div>

<input type="hidden" id="locTrgt" value="employee/master/village/cStatus">
<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/employee/village.js"></script>