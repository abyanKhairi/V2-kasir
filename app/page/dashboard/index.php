<?php
include '../database/class/count.php';

?>

<div class="section-header">
    <h1>Dashboard</h1>
</div>
<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <a href="index.php?page=user">
                        <h4>Total User</h4>
                    </a>
                </div>
                <div class="card-body">
                    <?php
                    $pdo = Koneksi::connect();
                    $count =  new count($pdo);
                    echo $count->count("user");
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon shadow-danger bg-danger">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <a href="index.php?page=costumer">
                        <h4>Total Costumers</h4>
                    </a>
                </div>
                <div class="card-body">
                    <?php echo $count->count('pembeli'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon shadow-warning bg-warning">
                <i class="fas fa-archive"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <a href="index.php?page=product">
                        <h4>Total Product</h4>
                    </a>
                </div>
                <div class="card-body">
                    <?php echo $count->count('product');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon shadow-info bg-info">
                <i class="fas fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <a href="index.php?page=transaksi">
                        <h4>Total Transaksi</h4>
                    </a>
                </div>
                <div class="card-body">
                    <?php echo $count->count('transaksi');
                    $pdo =  Koneksi::disconnect();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-success bg-success">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4></h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div> -->


</div>