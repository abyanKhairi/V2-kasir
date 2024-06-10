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
                            <div class="d-sm-none d-lg-inline-block"><?php echo $currentUser['nama']; ?></div>


                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a style="cursor: pointer;" data-toggle="tooltip" data-confirm="Yakin Ingin Log Out?" data-confirm-yes="window.location.href='auth/logout.php'" class="dropdown-item has-icon text-danger">
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
                                <li><a class="nav-link" href="index.php?page=user">User</a></li>
                                <li><a class="nav-link" href="index.php?page=user&act=create">Tambah User</a></li>
                                <!-- <li><a class="nav-link" href="index.php?page=user/edit&id_user= ">Edit User</a></li> -->

                            </ul>
                        </li>
                        <?php ?>

                        <li class="menu-header">Customers</li>
                        <li class="dropdown ">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Costumers</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index.php?page=costumer">Customers</a></li>
                                <li><a class="nav-link" href="index.php?page=costumer&act=create">Tambah Costumers</a></li>
                            </ul>

                        <li class="menu-header">Produck</li>
                        <li class="dropdown ">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-basket"></i><span>Produck</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index.php?page=product">Product</a></li>
                                <li><a class="nav-link" href="index.php?page=product&act=create">Product Settings</a></li>
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
        </div>
    </div>