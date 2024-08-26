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
                    <a href="<?php echo base_url(); ?>" class="waves-effect">
                        <i class='bx bxs-dashboard'></i>
                        <span key="t-dashboard">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-cog'></i>
                        <span key="t-apps"> Software Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/setting/basic_setting'); ?>">
                                <span>Basic Setting</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Category Section Start Here -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/category/Relationship/create_relationship'); ?>" key="t-login">
                                Create Relationship
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/category/District/create_District'); ?>" key="t-login">
                                Create District
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/category/Designation/create_designation'); ?>" key="t-login">
                                Create Designation
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/category/Loan_product/create_loan_product'); ?>" key="t-login">
                                Create Loan Product
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/category/Document/create_document'); ?>" key="t-login">
                                Create Document
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/category/Sub_Document/create_sub_document'); ?>" key="t-login">
                                Create SubDocument
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/category/Commission_Category/create_commission_category'); ?>" key="t-login">
                                Create Commission Category
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Member Section Start Here -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Client</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/Member/add_member'); ?>" key="t-login">
                                Add Client
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Member/manage_member'); ?>" key="t-login">
                                Client List
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Staff Section Start Here -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Staff</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/Staff/add_staff'); ?>" key="t-login">
                                Add Staff
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Staff/manage_staff'); ?>" key="t-login">
                                Staff List
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Agent Section Start Here -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Agent</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/Agent/add_agent'); ?>" key="t-login">
                                Add Agent
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Agent/manage_agent'); ?>" key="t-login">
                                Agent List
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- Master Section Start Here -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo base_url('super_admin/master/branch'); ?>" key="t-login">Manage Branch</a></li>
                        <li><a href="<?php echo base_url('super_admin/master/village'); ?>" key="t-login">Manage Village</a></li>
                        <li><a href="<?php echo base_url('super_admin/master/center'); ?>" key="t-login">Manage Center</a></li>
                         <li><a href="<?php echo base_url('super_admin/master/group'); ?>" key="t-login">Manage Group</a></li>
						
                    </ul>
                </li> -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?php echo base_url('super_admin/master/branch'); ?>" key="t-login">Manage Branch</a></li>
                        <li><a href="<?php echo base_url('super_admin/master/village'); ?>" key="t-login">Manage Village</a></li>
                        <li><a href="<?php echo base_url('super_admin/master/center'); ?>" key="t-login">Manage Center</a></li>
                         <li><a href="<?php echo base_url('super_admin/master/group'); ?>" key="t-login">Manage Group</a></li>
                        <li><a href="<?php echo base_url('super_admin/master/field_schedule'); ?>"   key="t-login">Field Schedule</a></li>
                    </ul>
                </li>
                <!-- Master Section End Here ----->

                <!-- Staff Section Start Here -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Loan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/Loan/add_loan'); ?>" key="t-login">
                                Add Loan
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Loan/manage_loan'); ?>" key="t-login">
                                Manage Loan
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Loan/manage_paid_emi'); ?>" key="t-login">
                                Paid EMI Details
                            </a>
                        </li>
                    </ul>
                </li> -->
               
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Group Loan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/Group_loan/group_member_data'); ?>" key="t-login">
                                Application
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Group_loan/loan_disbursment_data'); ?>" key="t-login">
                                Loan Disbursment
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Group_loan/manage_refresh_disburse_loan'); ?>" key="t-login">
                            Referesh Disburse Loan
                            </a>   
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url();?>super_admin/Day_end" class="waves-effect">
                    <i class='bx bx-user-circle'></i>
                        <span key="t-dashboard">Day End</span>
                    </a>
                </li>

                <!-- Create Commission Section Start Here -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Commission</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('super_admin/Commission/add_commission'); ?>" key="t-login">
                                Create Commission
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Group_loan/'); ?>" key="t-login">
                                Commission List
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('super_admin/Group_loan/'); ?>" key="t-login">
                                Commission Payment List
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li class="menu-title" key="t-menu">Accounting</li> -->
                <!-- Create Commission Section Start Here -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Group</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?//php echo base_url('super_admin/accounting/Group/add_group'); ?>" key="t-login">
                                Create Group
                            </a>
                        </li>
                        <li>
                            <a href="<?//php echo base_url('super_admin/Group_loan/'); ?>" key="t-login">
                                Group List
                            </a>
                        </li>
                    </ul>
                </li> -->


                

                <!-- <li class="menu-title" key="t-menu">Accounting Section</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Income Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?//php echo base_url('super_admin/accounting/Income/add_income'); ?>" key="t-login">
                                Add Incomes
                            </a>
                        </li>
                        <li>
                            <a href="<?//php echo base_url('super_admin/Staff/'); ?>" key="t-login">
                                Incomes List
                            </a>
                        </li>
                    </ul>
                </li> -->





            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>