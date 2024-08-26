<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>
        <?php echo $title ?> |
        <?php echo config_item('company_name') ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo config_item('company_name') ?>" name="description" />
    <meta content="<?php echo config_item('company_name') ?>" name="author" />
    <?php $this->load->view('employee/include/css') ?>

</head>

<body data-sidebar="dark">

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
    <?php $designation = $this->db->select('s.designation')->where('u.id', $this->session->userdata('user_id'))->join('staff as s', 's.staff_id = u.staff_id', 'left')->get('users as u')->row_array(); ?>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php $this->load->view('employee/include/header') ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('employee/include/left') ?>
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
                                    <h4 class="mb-sm-0 font-size-16 fw-bold">Dashboard / <?php if($designation['designation'] == 7) { echo "Staff"; } elseif($designation['designation'] == 5) { echo "Branch Manager"; } elseif($designation['designation'] == 3) { echo "Collection & Bisionas(F.O)"; } elseif($designation['designation'] == 4) { echo "Assistant Branch Manager"; } elseif($designation['designation'] == 6) { echo "Area Manager";}  ?> </h4>

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
                        
                        <?php 
								//$getBrnDet=$this->common->getBranchDetails('staff',array(),'*');
								/*print_r($this->session->userdata('branch_office'));
						       echo '<br>';*/
						
						?>
                        

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-account text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13">Total Customer</p>
                                            <h4 class="mb-1 mt-1"><?php echo $total_customer; ?></h4>
                                            </p>
                                        </div>
                                        <center><a href="<?php echo base_url('employee/Customer/manage_customer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-account text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13">Follow Up Customer
                                            </p>
                                            <h4 class="mb-1 mt-1"><?php echo $follow_customer; ?></h4>
                                            </p>
                                        </div>
                                        <center><a href="<?php echo base_url('employee/Customer/manage_follow_customer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-account text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted text-uppercase fw-semibold font-size-13">Approved Customer
                                            </p>
                                            <h4 class="mb-1 mt-1"><?php echo $approve_customer; ?></h4>
                                            </p>
                                        </div>
                                        <center><a href="<?php echo base_url('employee/Customer/manage_approve_customer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                    <?php } ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php $this->load->view('employee/include/footer') ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php $this->load->view('employee/include/js') ?>

</body>


</html>