

<!-- Main Content dashboard -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <a href="index.php?page=user/index">
                                <h4>Total User</h4>
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Jumlah Admin -->
                            <?php echo $count->jumlahAdmin()?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <a href="index.php?page=costumer/index">
                                <h4>Total Costumers</h4>
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Total Costumer -->
                            <?php echo $count->jumlahCostumer()?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <a href="index.php?page=product/index">
                            <h4>Total Product</h4></a>
                        </div>
                        <div class="card-body">
                            <!-- Total Product -->
                            <?php echo $count->jumlahProduk()?>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <!-- Total Transaksi -->
                            <?php echo $count->jumlahtransaksi()?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
