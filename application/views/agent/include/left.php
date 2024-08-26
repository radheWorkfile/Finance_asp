<div class="vertical-menu">

    <div data-simplebar class="h-100">

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
                
                <!-- Member Section Start Here -->
                <li>

                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-user-circle'></i>
                        <span key="t-authentication">Member</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">

                        <li>

                            <a href="<?php echo base_url('agent/Member/add_member'); ?>" key="t-login">
                                Add Member
                            </a>

                        </li>

                        <li>

                            <a href="<?php echo base_url('agent/Member/manage_member'); ?>" key="t-login">
                                Membere List
                            </a>

                        </li>

                    </ul>

                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>