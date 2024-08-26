<div class="vertical-menu">
    <?php $designation = $this->db->select('s.designation')->where('u.id', $this->session->userdata('user_id'))->join('staff as s', 's.staff_id = u.staff_id', 'left')->get('users as u')->row_array(); ?>

    <div data-simplebar class="h-100">
        <div style="margin:14px auto -20px auto;padding:30px 0px 1px 0px;border-bottom: 1px solid #2f2f2f;border-top: 1px solid #2f2f2f;">
            <p style="margin-left:45px;margin-top:-20px;color:#00ca88;font-weight:700;font-family:emoji;margin-bottom: 5px;">
                Branch: <?php echo $this->session->userdata('branch_office') ?> <br> Date: <?php echo date('d-m-Y') ?> <br>Week: <?php echo date('W'); ?>
            </p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <?php if($designation['designation'] == 7) { ?>

                    <!-- Dashboard Section Start Here -->
                    <li>
                        <a href="<?php echo base_url('employee/Dashboard'); ?>" class="waves-effect">
                            <i class='bx bxs-dashboard'></i>
                            <span key="t-dashboard">Dashboards</span>
                        </a>
                    </li>

                    <!-- Client Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-user-circle'></i>
                            <span key="t-authentication">Client</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Member/add_member'); ?>" key="t-login">
                                    Add Client
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Member/manage_member'); ?>" key="t-login">
                                    Client List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Group Loan Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Group Loan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Group_loan/group_member_data'); ?>" key="t-login">
                                    Application
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- OD Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Other posting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Transaction/manage_od_posting'); ?>" key="t-login">
                                    OD Posting
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                <?php } elseif($designation['designation'] == 5) { ?>

                    <!-- Dashboard Section Start Here -->
                    <li>
                        <a href="<?php echo base_url('employee/Dashboard'); ?>" class="waves-effect">
                            <i class='bx bxs-dashboard'></i>
                            <span key="t-dashboard">Dashboards</span>
                        </a>
                    </li>

                    <!-- Client section start -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-user-circle'></i>
                            <span key="t-authentication">Client</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Member/add_member'); ?>" key="t-login">
                                    Add Client
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Member/manage_member'); ?>" key="t-login">
                                    Client List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Master Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-user-circle'></i>
                            <span key="t-authentication">Master</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?php echo base_url('employee/master/village'); ?>" key="t-login">Manage Village</a></li>
                            <li><a href="<?php echo base_url('employee/master/center'); ?>" key="t-login">Manage Center</a></li>
                            <li><a href="<?php echo base_url('employee/master/field_schedule'); ?>" key="t-login">Field Schedule</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                            <i class="bx bx-task"></i>
                            <span key="t-multi-level">Reports</span>
                        </a>
                        <ul class="sub-menu mm-collapse" aria-expanded="true">
                            <li><a href="<?php echo base_url('employee/Reports/profile_wise_report'); ?>" key="t-level-1-1" aria-expanded="false">Profile Report</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/od_payment_report'); ?>" key="t-level-1-1" aria-expanded="false">OD Payment Report</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/cash_submission_report'); ?>" key="t-level-1-1" aria-expanded="false">Cash Subbmission</a></li>
                            <li><a href="<?php echo base_url('employee/reports/fore_close_loan_report'); ?>" key="t-level-1-1" aria-expanded="false">Fore Close </a></li>
                            <li><a href="<?php echo base_url('employee/Reports/field_schedule'); ?>" key="t-level-1-1" aria-expanded="false">Field Schedule</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/voucher_report'); ?>" key="t-level-1-1" aria-expanded="false">Voucher Report</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/due_collection'); ?>" key="t-level-1-1" aria-expanded="false">Due Collection</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/advance_report'); ?>" 
                            key="t-level-1-1" aria-expanded="false">Advance Report</a></li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2" aria-expanded="true">Loan Details</a>
                                <ul class="sub-menu mm-collapse" aria-expanded="true">
                                    <li><a href="<?php echo base_url('employee/Reports/clientWiseLoan'); ?>" key="t-level-2-2">Passbook Sheet</a></li>
                                    <li><a href="<?php echo base_url('employee/Reports/centerWiseLoan'); ?>" key="t-level-2-1">Collection Sheet</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-3" aria-expanded="true">Daily Disbursment</a>
                                <ul class="sub-menu mm-collapse" aria-expanded="true">
                                    <li><a href="<?php echo base_url('employee/Reports/branchWiseLoanDisburshment'); ?>" key="t-level-2-2">Daily Summary Sheet</a></li>
                                    <li><a href="<?php echo base_url('employee/Reports/centerWiseLoanDisburshment'); ?>" key="t-level-2-1">Daily Disbursement Sheet</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Fore Closing Loan Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Fore Closing Loan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Fore_closing_loan/create_fore_closing'); ?>" class="waves-effect">
                                    <span key="t-dashboard">Fore Close </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('employee/Fore_closing_loan/manage_close_loan'); ?>" class="waves-effect">
                                    <span key="t-dashboard">Manage Fore Close </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Group Loan Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Group Loan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Group_loan/group_member_data'); ?>" key="t-login">
                                    Application
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Group_loan/loan_disbursment_data'); ?>" key="t-login">
                                    Loan Disbursment
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- OD Section Start -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Other posting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Transaction/manage_od_posting'); ?>" key="t-login">
                                    OD Posting
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Fore Closing Loan Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Fore Closing Loan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Fore_closing_loan/create_fore_closing'); ?>" class="waves-effect">
                                    <span key="t-dashboard">Fore Close </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('employee/Fore_closing_loan/manage_close_loan'); ?>" class="waves-effect">
                                    <span key="t-dashboard">Manage Fore Close </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>

                    <li>
                        <a href="<?php echo base_url('employee/Dashboard'); ?>" class="waves-effect">
                            <i class='bx bxs-dashboard'></i>
                            <span key="t-dashboard">Dashboards</span>
                        </a>
                    </li>

                    <!-- Client Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-user-circle'></i>
                            <span key="t-authentication">Client</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Member/add_member'); ?>" key="t-login">
                                    Add Client
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Member/manage_member'); ?>" key="t-login">
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
                                <a href="<?php echo base_url('employee/Staff/add_staff'); ?>" key="t-login">
                                    Add Staff
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Staff/manage_staff'); ?>" key="t-login">
                                    Staff List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Master Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-user-circle'></i>
                            <span key="t-authentication">Master</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?php echo base_url('employee/master/branch'); ?>" key="t-login">Manage Branch</a></li>
                            <li><a href="<?php echo base_url('employee/master/village'); ?>" key="t-login">Manage Village</a></li>
                            <li><a href="<?php echo base_url('employee/master/center'); ?>" key="t-login">Manage Center</a></li>
                            <li><a href="<?php echo base_url('employee/master/group'); ?>" key="t-login">Manage Group</a></li>
                            <li><a href="<?php echo base_url('employee/master/field_schedule'); ?>" key="t-login">Field Schedule</a></li>
                        </ul>
                    </li>

                    <!-- Master Section End Here --->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                            <i class="bx bx-task"></i>
                            <span key="t-multi-level">Reports</span>
                        </a>
                        <ul class="sub-menu mm-collapse" aria-expanded="true">
                            <li><a href="<?php echo base_url('employee/Reports/profile_wise_report'); ?>" key="t-level-1-1" aria-expanded="false">Profile Report</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/od_payment_report'); ?>" key="t-level-1-1" aria-expanded="false">OD Payment Report</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/cash_submission_report'); ?>" key="t-level-1-1" aria-expanded="false">Cash Subbmission</a></li>
                            <li><a href="<?php echo base_url('employee/reports/fore_close_loan_report'); ?>" key="t-level-1-1" aria-expanded="false">Fore Close </a></li>
                            <li><a href="<?php echo base_url('employee/Reports/field_schedule'); ?>" key="t-level-1-1" aria-expanded="false">Field Schedule</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/voucher_report'); ?>" key="t-level-1-1" aria-expanded="false">Voucher Report</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/due_collection'); ?>" key="t-level-1-1" aria-expanded="false">Due Collection</a></li>
                            <li><a href="<?php echo base_url('employee/Reports/advance_report'); ?>" 
                            key="t-level-1-1" aria-expanded="false">Advance Report</a></li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2" aria-expanded="true">Loan Details</a>
                                <ul class="sub-menu mm-collapse" aria-expanded="true">
                                    <li><a href="<?php echo base_url('employee/Reports/clientWiseLoan'); ?>" key="t-level-2-2">Passbook Sheet</a></li>
                                    <li><a href="<?php echo base_url('employee/Reports/centerWiseLoan'); ?>" key="t-level-2-1">Collection Sheet</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-3" aria-expanded="true">Daily Disbursment</a>
                                <ul class="sub-menu mm-collapse" aria-expanded="true">
                                    <li><a href="<?php echo base_url('employee/Reports/branchWiseLoanDisburshment'); ?>" key="t-level-2-2">Daily Summary Sheet</a></li>
                                    <li><a href="<?php echo base_url('employee/Reports/centerWiseLoanDisburshment'); ?>" key="t-level-2-1">Daily Disbursement Sheet</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Group Loan Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Group Loan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Group_loan/group_member_data'); ?>" key="t-login">
                                    Application
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Group_loan/loan_disbursment_data'); ?>" key="t-login">
                                    Loan Disbursment
                                </a>
                            </li>
                            <!-- <li>
                                <a href="<?php echo base_url('employee/Group_loan/manage_refresh_disburse_loan'); ?>" key="t-login">
                                    Referesh Disburse Loan
                                </a>
                            </li> -->
                        </ul>
                    </li>

                    <!-- Transaction Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Transaction</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Transaction/recovery_posting'); ?>" key="t-login">
                                    Recovery Posting
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Group_loan/manage_group_loan_paid_emi'); ?>" key="t-login">
                                    Recovery Update
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-money'></i>
                                    <span key="t-authentication">Other posting</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url('employee/Transaction/manage_od_posting'); ?>" key="t-login">
                                            OD Posting
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('employee/Transaction/manage_ad_posting'); ?>"             key="t-login">
                                            AD Posting
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Fore Closing Loan Section Start Here -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-money'></i>
                            <span key="t-authentication">Fore Closing Loan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?php echo base_url('employee/Fore_closing_loan/create_fore_closing'); ?>" class="waves-effect">
                                    <span key="t-dashboard">Fore Close </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('employee/Fore_closing_loan/manage_close_loan'); ?>" class="waves-effect">
                                    <span key="t-dashboard">Manage Fore Close </span>
                                </a>
                            </li>
                           
                        </ul>
                        <li>
                    <a href="<?php echo base_url();?>employee/day_end" class="waves-effect">
                    <i class='bx bx-user-circle'></i>
                        <span key="t-dashboard">Day End</span>
                    </a>
                    </li>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>