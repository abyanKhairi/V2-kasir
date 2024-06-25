<!--sideBard-->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.php">ZKASIR</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.php"><span>Z</span></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown ">
                <a href="index.php"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <?php
            if ($currentUser['role'] === 'superAdmin') {
            ?>
                <li class="menu-header">User</li>
                <li class="dropdown ">

                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>User Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="index.php?page=user">User</a></li>
                        <li><a class="nav-link" href="index.php?page=user&act=create">Tambah User</a></li>

                    </ul>
                </li>
            <?php } elseif ($currentUser['role'] === 'admin') {
                echo "<script>window.location.href = 'index.php </script>";
            } ?>

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
                    <li><a class="nav-link" href="index.php?page=product&act=create">Tambah Product</a></li>
                </ul>


            <li class="menu-header">Transaksi</li>
            <li class="dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>Transaksi</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index.php?page=transaksi">Transaksi</a></li>
                    <li><a class="nav-link" href="index.php?page=transaksi&act=create">Buat Transaksi</a></li>
                </ul>

        </ul>
    </aside>
</div>
</div>