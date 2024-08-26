<div class="card-body">
    <?php if(!empty($fld_schdl['schCode'])) { ?>
        <h4 class="text-center">personal Details</h4>
        <div class="row">
            <!-- <div class="col-md-6">
                <p class="text-sm">Village
                    <b class="d-block">
                        <?php echo $group_details['village_name'] ?>
                    </b>
                </p>
            </div> -->
            <div class="col-md-6">
                <p class="text-sm">Center
                    <b class="d-block">
                        <?php echo $group_details['center_name'] ?>
                    </b>
                </p>
            </div>
            <div class="col-md-6">
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
                                    <th>Sl.No.</th>
                                    <th>Name</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($group_member as $gm => $grp_memb) { ?>
                                    <tr>
                                        <td><?php echo $gm +1 ?></td>
                                        <td><?php echo $grp_memb['first_name'] ." ". $grp_memb['mid_name'] ." ". $grp_memb['last_name'] . "(". $grp_memb['member_id'] .")" ?></td>
                                        <td><?php echo $grp_memb['mobile_no'] ?></td>
                                        <td><?php echo $grp_memb['email'] ?></td>
                                        <td>
                                            <?php if($grp_memb['referesh_disbursment_status'] == 1) { ?>
                                                <b class="text-success">Done <i class="fa fa-check"></i></b>&emsp;
                                            <?php } else { ?>
                                                <a href="add_group_loan/<?php echo $grp_memb['mem_id'] ?>" title="Click to View Lead Details" style="margin-left:-5px; padding: 3px; width: 85px;" class="btn btn-primary">Add Loan</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <h3 style="text-align: center;font-family: emoji; color: #e70303;">Please, Create Field Schedule Date!</h3>
    <?php } ?>
</div>

<div id="show_add_group_loan"></div>

<!-- Pay EMI Modal Start -->
<div class="modal fade" id="pay_emi_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pay EMI</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="pay" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="rd_data"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" id="bill_data" class="btn btn-primary" name="submit"  value="Pay">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Lead Modal Start -->
<div class="modal fade" id="view_paid_emi_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body  card-primary card-outline">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Paid EMI Data Details</h4>
                <div id="show_paid_rd_payment"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- View Lead Modal End-->

<script src="<?php echo base_url() ?>media/js/employee/group_loan.js"></script>
<!-- <script src="<?php echo base_url() ?>media/js/employee/emi.js"></script> -->
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>