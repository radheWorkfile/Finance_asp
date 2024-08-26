<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <p class="text-sm">Center
                <b class="d-block">
                    <?php echo $group_details['center_name'] ?>
                </b>
            </p>
        </div>
        <div class="col-md-3">
            <p class="text-sm">Group
                <b class="d-block">
                    <?php echo $group_details['group_name'] ?>
                </b>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row bg-white">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Client Name</th>
                                <th>Client Mobile No.</th>
                                <th>Client KYC</th>
                                <th>Amount</th>
                                <th>Disbursment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($group_member as $gmm => $grp_memb) { ?>
                                <tr>
                                    <td><?php echo $gmm +1 ?></td>
                                    <td><?php echo $grp_memb['first_name']." ". $grp_memb['mid_name']." ". $grp_memb['last_name'] ."(". $grp_memb['member_id'] .")" ?></td>
                                    <td><?php echo $grp_memb['mobile_no'] ?></td>
                                    <td><?php echo $grp_memb['aadhar_card_no'] ?></td>
                                    <td><?php echo $grp_memb['amount'] ?></td>
                                    <td>
                                        <?php if($grp_memb['disbursment_status'] == 2) { ?>
                                            
                                            <a href="javascript:void(0);" class="text-success"><b>Approved</b> <i class="fa fa-check text-success"></i></a>&emsp;

                                        <?php } else { ?>

                                            <a href="javascript:void(0);" class="text-danger"><b>Pending</b> <i class="fa fa-times text-danger"></i></a>&emsp;

                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_group_loan_details(' <?php echo $grp_memb['id'] ?> ')" title="Click to View Loan Details"><i class="fas fa-eye text-success"></i></a>&emsp;
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_model" onclick="update_group_loan_details(' <?php echo $grp_memb['id'] ?> ')" title="Click to Update Loan Details"><i class="fas fa-edit"></i></a>&emsp;

                                        <a href="view_group_loan_emi_details/<?php echo $grp_memb['id'] ?>" title="Click to View EMI Details"><i class="fas fa-money-bill text-success"></i></a>&emsp;
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <table id="grouploantable" class="table table-bordered dt-responsive nowrap w-100">
        <thead>
            <tr>
            <th>S.No.</th>
            <th>Center Name</th>
            <th>Client Name</th>
            <th>Client KYC</th>
            <th>Amount</th>
            <th>Action</th>
            </tr>
        </thead>
    </table> -->
</div>

<!--  Update Member Data Model -->
<div class="modal fade update_category" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Update Group Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="group_updata" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="up_group"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--  Update Member Data Model -->
<div class="modal fade update_disbursment_status" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Update Disbursment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="disbursment_updata" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="up_disbursment"></div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--  View Group Data Model -->
<div class="modal fade view_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">View Group Loan Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="show_group_loan"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--  View Group Member Data Model -->
<div class="modal fade update_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Update Group Loan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="group_loan_updata" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="up_group_loan"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--  View Loan Emi Data Model -->
<div class="modal fade emi_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">View Group Loan Emi Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="show_group_loan_emi"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="<?php echo base_url() ?>media/js/super_admin/group_loan.js"></script>
<script src="<?php echo base_url() ?>media/js/super_admin/group_loan_emi.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>