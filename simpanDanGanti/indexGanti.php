

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ZKasir</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../assets/modules/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="../assets/modules/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="../assets/modules/summernote/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>

                </form>


                <!-- NavBAr-->

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Abyan</div>


                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a> -->
                            <!-- <div class="dropdown-divider"></div> -->
                            <a style="cursor: pointer;" data-toggle="tooltip" data-confirm="Yakin Ingin Log Out?" data-confirm-yes="window.location.href='app/auth/logout.php'" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                        </div>
                    </li>
                </ul>
            </nav>
            <!--sideBard-->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href=" ">ZKASIR</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href=" ">Z</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="dropdown active">
                            <a href="index.php"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>

                        <li class="menu-header">User</li>
                        <li class="dropdown ">


                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>User Management</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index.php?page=user/index">User</a></li>
                                <li><a class="nav-link" href="index.php?page=user/add">Tambah User</a></li>
                                <!-- <li><a class="nav-link" href="index.php?page=user/edit&id_user= ">Edit User</a></li> -->

                            </ul>
                        </li>
                        <?php ?>

                        <li class="menu-header">Customers</li>
                        <li class="dropdown ">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Costumers</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index.php?page=costumer/index">Customers</a></li>
                                <li><a class="nav-link" href="index.php?page=costumer/add">Tambah Costumers</a></li>
                            </ul>

                        <li class="menu-header">Produck</li>
                        <li class="dropdown ">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-basket"></i><span>Produck</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index.php?page=product/index">Product</a></li>
                                <li><a class="nav-link" href="index.php?page=product/add">Product Settings</a></li>
                            </ul>


                        <li class="menu-header">Transaksi</li>
                        <li class="dropdown ">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-credit-card"></i><span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="">Transaksi</a></li>
                                <li><a class="nav-link" href="">Detail Transaksi</a></li>
                            </ul>

                    </ul>
                </aside>
            </div>



            <!-- General JS Scripts -->
            <script src="../assets/modules/jquery.min.js"></script>
            <script src="../assets/modules/popper.js"></script>
            <script src="../assets/modules/tooltip.js"></script>
            <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
            <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
            <script src="../assets/modules/moment.min.js"></script>
            <script src="../assets/js/stisla.js"></script>

            <!-- JS Libraies -->
            <script src="../assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
            <script src="../assets/modules/chart.min.js"></script>
            <script src="../assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
            <script src="../assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
            <script src="../assets/modules/summernote/summernote-bs4.js"></script>
            <script src="../assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
            <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>


            <!-- Page Specific JS File -->
            <script src="../assets/js/page/index-0.js"></script>
            <script src="../assets/js/page/bootstrap-modal.js"></script>
            <script src="../assets/js/page/modules-sweetalert.js"></script>


            <!-- Template JS File -->
            <script src="../assets/js/scripts.js"></script>
            <script src="../assets/js/custom.js"></script>
</body>

</html>