<div class="vertical-menu">

    <div data-simplebar class="h-100">
    <div style="margin:14px auto -20px auto;padding:30px 0px 1px 0px;border-bottom: 1px solid #2f2f2f;border-top: 1px solid #2f2f2f;">
            <p style="margin-left:45px;margin-top:-20px;color:#00ca88;font-weight:700;font-family:emoji;margin-bottom: 5px;">
                Branch: <?php echo $this->session->userdata('name') ?> <br> Date: <?php echo date('d-m-Y') ?> <br>Week: <?php echo date('W'); ?>
            </p>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="<?php echo base_url();?>customer/Dashboard" class="waves-effect">
                        <i class='bx bxs-dashboard'></i>
                        <span key="t-dashboard">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-cog'></i>
                        <span key="t-apps">User Information</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('customer/Loan_detials'); ?>">
                                <span>User details</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-cog'></i>
                        <span key="t-apps">Loan Details</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('customer/Loan_detials/loan_info'); ?>">
                                <span>Loan Disbursement </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Category Section Start Here -->


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>