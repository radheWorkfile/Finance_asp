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
                        <?php echo $breadcrums ?>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <form id="filter_recovery_date" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="col-4" style="margin-top: 10px; margin-right: 10px; float: right;">
                    <div class="input-group mb-3">
                        <select name="center" id="center" class="form-control select2">
                            <option value="">---- Select One Center ----</option>
                            <?php foreach ($center as $scent) { ?>
                                <option value="<?php echo $scent['id'] ?>"><?php echo $scent['center_name'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="search" name="submit" class="btn btn-primary" style="margin-left: 10px;">
                    </div>
                </div>
            </form>
            <div class="card-body">
                <table id="paidtable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Group Name</th>
                            <th>Client Name</th>
                            <th>EMI Amount</th>
                            <th>Emi Date</th>
                            <th>Paid Amount</th>
                            <th>Rest Amount</th>
                            <th>Action</th>
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

<!-- View Lead Modal Start -->
<div class="modal fade view_paid_emi_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">View Paid EMI Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="show_group_loan_paid_emi"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Pay EMI Modal Start -->
<div class="modal fade refresh_paid_emi_model" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Refresh Paid emi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="refresh_paid_emi_datas" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="refresh_paid_emi_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Yes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
 
<!-- View Lead Modal End-->
<script src="<?php echo base_url() ?>media/js/super_admin/group_loan_emi.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>

<script>

    $(document).ready(function() {
        let searchObj = {};

        let reportTable = {

            printTable: function(search_data) {

                $("#paidtable").DataTable({

                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    'columnDefs': [{
                        'targets': [1, 2, 3, 4, 5, 6, 7, ],
                        'orderable': true
                    }],

                    "ajax": {

                        "url": base_url + 'super_admin/Group_loan/all_group_loan_paid_emi_data',
                        "type": "POST",
                        "dataSrc": "data",
                        "data": search_data

                    },

                    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "lengthMenu": [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],

                    "buttons": ["excel", "pdf", "print"]

                });

            }

        }

        reportTable.printTable(searchObj);
        $('#filter_recovery_date').submit(function(e) {
            e.preventDefault();
            $("#paidtable").DataTable().clear().destroy();
            let search = $('#filter_recovery_date').serializeArray();
            let searchObj = {};
            $.each(search, function(i, row) {
                searchObj[row.name] = row.value;
            });
            reportTable.printTable(searchObj);
        });

    });

</script>
