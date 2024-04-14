<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="https://www.srisadanandafoods.com//assets/images/logo.png" alt="homepage"
                            class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="https://www.srisadanandafoods.com//assets/images/logo.png" alt="homepage"
                            class="light-logo" style="height: 60px;" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                        <!-- <img src="https://www.srisadanandafoods.com//assets/images/logo.png" alt="homepage" class="dark-logo" /> -->
                        <!-- Light Logo text -->
                        <!-- <img src="https://www.srisadanandafoods.com//assets/images/logo.png" class="light-logo" alt="homepage" /> -->
                    </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                    data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto float-left">
                    <!-- This is  -->
                    <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                            href="javascript:void(0)"><i class="fa-solid fa-bars"></i></a> </li>
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Profile -->
                    <!-- ============================================================== -->
                    <li class="email" style="margin-top: 20px;margin-right: 10px;font-size: 15px;">
                        <?php if (session()->loggedin == 'loggedin'): ?>
                            <span class="name" style="color: #fff;">
                                <?= session()->username; ?>
                            </span>
                        <?php endif ?>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="../assets/images/users/1.png" alt="user" width="30"
                                class="profile-pic rounded-circle" />
                        </a> -->

                        <a class="nav-link dropdown-toggle waves-effect waves-dark"
                            href="<?= base_url('admin/logout') ?>">
                            <span> <i class="fas fa-power-off"></i> </span>
                        </a>
                        <!-- <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                            <ul class="dropdown-user list-style-none">
                                <li>
                                    <div class="dw-user-box p-3 d-flex">
                                        <div class="u-img"><img src="../assets/images/users/1.png" alt="user"
                                                class="rounded" width="80"></div>
                                        <div class="u-text ml-2">
                                            <h4 class="mb-0">Steave Jobs</h4>
                                            <p class="text-muted mb-1 font-14">varun@gmail.com</p>
                                            <a href="pages-profile.html"
                                                class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">View
                                                Profile</a>
                                        </div>
                                    </div>
                                </li>

                                <li class="user-list"><a class="px-3 py-2" href="#"><i class="fa fa-power-off"></i>
                                        Logout</a></li>
                            </ul>
                        </div> -->
                    </li>
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>

    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <!-- Dashboard -->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?= base_url('admin/dashboard') ?>"
                            aria-expanded="false">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span class="hide-menu">Dashboard </span>
                        </a>
                    </li>
                    <!-- Home -->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fa-solid fa-house"></i>
                            <span class="hide-menu">Home </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <span class="hide-menu"> Banner </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Category -->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?= base_url('admin/categories') ?>"
                            aria-expanded="false">
                            <!-- <i class="fa-solid fa-list"></i> -->
                            <i class="fa-solid fa-layer-group"></i>
                            <span class="hide-menu">Category </span>
                        </a>
                    </li>
                    <!-- Sub-Category -->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?= base_url('admin/subCategory') ?>"
                            aria-expanded="false">
                            <i class="fas fa-list-alt"></i>
                            <span class="hide-menu">Sub-Category </span>
                        </a>
                    </li>
                    <!-- Product -->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?= base_url('admin/products') ?>"
                            aria-expanded="false">
                            <i class="fas fa-shopping-basket "></i>
                            <span class="hide-menu">Products </span>
                        </a>
                    </li>
                    <!-- Weight / Size -->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?= base_url('admin/unitMaster') ?>"
                            aria-expanded="false">
                            <i class="fa-solid fa-maximize"></i>
                            <span class="hide-menu">Unit Master</span>
                        </a>
                    </li>
                    <!-- Product Stock-->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="fas fa-boxes"></i>
                            <span class="hide-menu">Product Stock </span>
                        </a>
                    </li>
                    <!-- User -->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="fa-solid fa-users"></i>
                            <span class="hide-menu">User Details </span>
                        </a>
                    </li>
                    <!-- Ordered Products -->
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="fa-solid fa-truck-fast"></i>
                            <span class="hide-menu">Ordered Product</span>
                        </a>
                    </li>
                    <!-- Contact -->
                    <!-- <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fas fa-phone"></i>
                            <span class="hide-menu">Contact Us</span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="<?= base_url('admin/contact') ?>" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Contact Details </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="<?= base_url('admin/bank') ?>" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Bank Details </span>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- Enquiry Form -->
                    <!-- <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?= base_url('admin/enquirydata') ?>"
                            aria-expanded="false">
                            <i class="mdi mdi-gradient"></i>
                            <span class="hide-menu">Enquiry Form Data</span>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>

    <!-- </div> -->