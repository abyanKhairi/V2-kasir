<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                lowwwwwww
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

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
            <?php
            @$nav = isset($_GET['page']) ? $_GET['page'] : '';
            if ($nav === 'dashboard' || $nav === '') {
            ?>
                <li class="dropdown active ">
                <?php } else { ?>
                <li class="dropdown ">
                <?php } ?>
                <a href="index.php?page=dashboard"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>


                <?php
                if ($currentUser['role'] === 'superAdmin') {
                ?>
                    <li class="menu-header">User</li>
                    <?php if ($nav === 'user') {
                    ?>
                        <li class="dropdown active ">
                        <?php } else { ?>
                        <li class="dropdown ">
                        <?php } ?>
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
                    <?php if ($nav === 'costumer') {
                    ?>
                        <li class="dropdown active ">
                        <?php } else { ?>
                        <li class="dropdown ">
                        <?php } ?>
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Costumers</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="index.php?page=costumer">Customers</a></li>
                            <li><a class="nav-link" href="index.php?page=costumer&act=create">Tambah Costumers</a></li>
                        </ul>


                        <li class="menu-header">Product</li>
                        <?php if ($nav === 'product') {
                        ?>
                            <li class="dropdown active ">
                            <?php } else { ?>
                            <li class="dropdown ">
                            <?php } ?>
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-basket"></i><span>Product</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index.php?page=product">Product</a></li>
                                <li><a class="nav-link" href="index.php?page=product&act=create">Tambah Product</a></li>
                            </ul>


                            <li class="menu-header">Transaksi</li>
                            <?php if ($nav === 'transaksi') {
                            ?>
                                <li class="dropdown active ">
                                <?php } else { ?>
                                <li class="dropdown ">
                                <?php } ?>
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>Transaksi</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="index.php?page=transaksi">Transaksi</a></li>
                                    <li><a class="nav-link" href="index.php?page=transaksi&act=create">Buat Transaksi</a></li>
                                </ul>
        </ul>
    </aside>
</div>
</div>