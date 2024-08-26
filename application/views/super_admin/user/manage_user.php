<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->session->userdata('company_name') ?> | <?php echo $title; ?></title>
    <?php $this->load->view('super_admin/include/css') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed ">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view('super_admin/include/header') ?>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php $this->load->view('super_admin/include/left') ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?php echo $title; ?></h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><?php echo $breadcrums; ?></li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_user_modal" title='Click Add User' class="btn btn-outline-primary float-right"> <i class="fas fa-plus"></i> Add User</a><br><br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $us => $usr) { ?>
                                <tr>
                                    <td><?php echo $us + 1; ?></td>
                                    <td><?php echo $usr['name'] ?></td>
                                    <td><?php echo $usr['email'] ?></td>
                                    <td><?php echo $usr['mobile'] ?></td>
                                    <td><?php echo $usr['department_name'] ?></td>
                                    <td>
                                        <a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#view_modal" onclick="get_data_user(<?php echo $usr['id'] ?>)" title='Click to View <?php echo $usr['name'] ?> Data'><i class="fas fa-eye text-success"></i></a>&emsp;
                                        <a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#edit_modal" onclick="get_data_edit_user(<?php echo $usr['id'] ?>)" title='Click to View <?php echo $usr['name'] ?> Data'><i class="fas fa-edit text-primary"></i></a>&emsp;
                                        <?php $status = ($usr['status'] == 1) ?
                                            "<a style='color:green' href='javascript:void()' onClick='return changeStatus(\"" . $usr['id'] . "\",\"0\",\"Users\",\"super_admin/common/chageStatus\")' title='Click to Di-Active User'><b><i class='fa fa-check'></i> </b></a>"
                                            :
                                            "<a style='color:red'  href='javascript:void()'  onClick='return changeStatus(\"" . $usr['id'] . "\",\"1\",\"Users\",\"super_admin/common/chageStatus\")' title='Click to Active User'><b><i class='fa fa-times'></i> </b></a>";
                                        echo "<span id=" . $usr['id'] . ">" . $status . "</span>";
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>


    <!-- Add User Modal Start -->
    <div class="modal fade" id="add_user_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New User </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="add_user" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="modal-body text-md">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>User Name <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" placeholder="Enter User Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>Email <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>Mobile <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    </div>
                                    <input type="number" name="mobile" id="mobile" placeholder="Enter Mobile Number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>Password <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal-dialog -->
    <!-- Add User Modal End-->


    <!-- User Update Modal Start -->
    <div class="modal fade" id="edit_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content text-sm">
                <div class="modal-header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update_user" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="edit_user"></div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <!-- User Update Modal End-->

    <!-- User View Modal Start -->
    <div class="modal fade" id="view_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content text-sm">
                <div class="modal-header">
                    <h5 class="modal-title">User View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="view_user"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <!-- User View Modal End-->


    <?php $this->load->view('super_admin/include/footer') ?>
    </div>
    <!-- ./wrapper -->
    <?php $this->load->view('super_admin/include/js') ?>
    <script src="<?php echo  base_url() ?>media/js/super_admin.js"></script>

</body>

</html>