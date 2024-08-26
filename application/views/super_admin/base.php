<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title ?> | <?php echo config_item('company_name') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo config_item('company_name') ?>" name="description" />
    <meta content="<?php echo config_item('company_name') ?>" name="author" />
    <?php $this->load->view('super_admin/include/css') ?>
</head>

<body data-sidebar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>


    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php $this->load->view('super_admin/include/header') ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('super_admin/include/left') ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php if (!empty($layout) && trim($layout) !== "") {
                        require_once($layout);
                    } else { ?>
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
                                    <h4 class="mb-sm-0 font-size-16 fw-bold">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cash-multiple text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13">Total Revenue</p>
                                            <h4 class="mb-1 mt-1">₹<span class="counter-value">0</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-refresh-circle text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13">Total Refunds</p>
                                            <h4 class="mb-1 mt-1">₹<span class="counter-value">0</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-account-group text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13">Active Users</p>
                                            <h4 class="mb-1 mt-1"><span class="counter-value">0</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cart-check text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13">All Time Orders</p>
                                            <h4 class="mb-1 mt-1"><span class="counter-value">0</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                    <?php } ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php $this->load->view('super_admin/include/footer') ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php $this->load->view('super_admin/include/js') ?>

</body>


</html>