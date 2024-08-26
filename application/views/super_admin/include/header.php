<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url();?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url() ?>media/images/<?php echo config_item('logo_sm')?>" alt="logo-sm" width="85%">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>media/images/<?php echo config_item('logo_dark')?>" alt="logo-dark" width="85%">
                    </span>
                </a>

                <a href="<?php echo base_url();?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo base_url() ?>media/images/<?php echo config_item('logo_sm_light')?>" alt="logo-sm-light" width="85%">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>media/images/<?php echo config_item('logo_light')?>" alt="logo-light" width="85%">
                    </span>
                </a>
            </div>

            <!-- Bars -->
            <button type="button" class="btn btn-sm px-3 font-size-16 vertinav-toggle header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <button type="button" class="btn btn-sm px-3 font-size-16 horinav-toggle header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex" style="padding-top: 20px;">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Toggle Full Screen -->
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <!-- Notification -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell"></i>
                    <span class="badge bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="small" key="t-view-all"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="#" class="text-reset notification-item d-block active">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-cart"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1" key="t-your-order">Your order is placed</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                        <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-reset notification-item d-block ">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="<?php echo base_url() ?>media/images/users/admin.png" class="rounded-circle avatar-xs" alt="user-pic">
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                                        <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hour ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-reset notification-item d-block ">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="bx bx-badge-check"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="mb-1" key="t-shipped">Your item is shipped</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                        <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 hours ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="text-reset notification-item d-block ">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="<?php echo base_url() ?>media/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1" key="t-occidental">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">10 hours ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Setting -->
            <div class="dropdown d-inline-block">
                <!-- User Image -->
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo base_url().'/'.$this->session->userdata('photo'); ?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1"><?php echo $this->session->userdata('name') ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">Welcome <?php echo $this->session->userdata('name') ?>!</h6>
                    <a class="dropdown-item" href="<?php echo base_url() . 'super_admin/common/profile' ?>"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle" key="t-profile">Profile</span></a>
                    <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle" key="t-logout">Logout</span></a>
                </div>
            </div>

            <!-- Setting -->
            <div class="dropdown d-inline-block pt-2">
                <a href="<?php echo base_url('super_admin/setting/basic_setting'); ?>"  class="header-item noti-icon waves-effect mt-2">
                    <i class="bx bx-cog bx-spin"></i>
                </a>
            </div>

        </div>
    </div>
</header>

