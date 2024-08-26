<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title ?> | <?php echo config_item('company_name') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo config_item('company_name') ?>" name="description" />
    <meta content="<?php echo config_item('company_name') ?>" name="author" />
    <?php $this->load->view('customer/include/css') ?>
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

        <?php $this->load->view('customer/include/header') ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('customer/include/left') ?>
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
                                <div class="card"style="background: linear-gradient(to right, #36d1dc, #5b86e5);">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24 hhh">
                                                    <i class="mdi mdi-cash-multiple text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13"style="color:#325097!important;">Total Loan</p>
                                            <h4 class="mb-1 mt-1"><span style="color:#053;"></span><span class="counter_value"style="color:#1c5093;">1</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card"style="background: linear-gradient(to right, #36d1dc, #5b86e5);">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-refresh-circle text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13"style="color:#325097!important;">Loan Amount</p>
                                            <h4 class="mb-1 mt-1"><span style="color:#053;">₹&nbsp;</span><span class="counter_value"style="color:#1c5093;"><?php echo number_format($unPaidAmo[0]['emisec'],2)?number_format($unPaidAmo[0]['emisec'],2):0;?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card"style="background: linear-gradient(to right, #36d1dc, #5b86e5);">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-account-group text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13"style="color:#325097!important;">Total Paid Amount</p>
                                            <h4 class="mb-1 mt-1"style="color:#1c5093;"><span style="color:#053;">₹&nbsp;</span><span class="counter_value"><?php echo number_format($paidAmo[0]['emisec'],2)?number_format($paidAmo[0]['emisec'],2):number_format(0);?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card"style="background: linear-gradient(to right, #36d1dc, #5b86e5);">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cart-check text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13"style="color:#325097!important;">Total Unpaid</p>
                                            <h4 class="mb-1 mt-1"style="color:#1c5093;"><span style="color:#053;">₹&nbsp;</span><span><?php echo number_format($unPaidAmo[0]['emisec'],2);?></span></h4>
                                           
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

            <?php $this->load->view('customer/include/footer') ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php $this->load->view('customer/include/js') ?>

</body>


</html>