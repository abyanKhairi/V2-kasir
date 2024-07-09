<?php
include '../database/class/count.php';

$pdo = Koneksi::connect();

$count =  count::getInstance($pdo);
$jual = $count->chart('SELESAI');
$blmjual = $count->chart('PENDING');
$user = $count->count("user");
$pembeli = $count->count('pembeli');
$product = $count->count('product');
$transaksiTl = $count->count('transaksi');
$pdSelesai = $count->countJual("SELESAI");
$pdBelum = $count->countJual("PENDING");
$bayar = $count->countUang('bayar');

$pdo =  Koneksi::disconnect();

?>

<!-- main content -->

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
                    <?= $user ?>
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
                    <?= $pembeli  ?>
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
                    <?= $product;
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
                    <?= $transaksiTl
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-success bg-success">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pendapatan</h4>
                </div>
                <div class="card-body">
                    Rp. <?= number_format($bayar);
                        ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-box"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Terjual</h4>
                </div>
                <div class="card-body">
                    <?= $pdSelesai
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-danger bg-danger">
                <i class="fas fa-box"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Belum Dibayar</h4>
                </div>
                <div class="card-body">
                    <?= $pdBelum;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-warning bg-warning">
                <i class="fas fa"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Lorem</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Chart -->

<div class="row">
    <div class="col-lg-6 col-md-10 col-sm-15">
        <div class="card">
            <div class="card-header">
                <h4>Product Telah Dibayar</h4>
            </div>
            <div class="card-body">
                <canvas id="chartBayar"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-10 col-sm-15">
        <div class="card">
            <div class="card-header">
                <h4>Product Belum Dibayar</h4>
            </div>
            <div class="card-body">
                <canvas id="chartBelum"></canvas>
            </div>
        </div>
    </div>
</div>


<!-- cart script -->
<script>
    const chart1 = document.getElementById("chartBayar");
    new Chart(chart1, {
        type: "bar",
        data: {
            labels: <?= json_encode(array_column($jual, 'nama_produk')) ?>,
            datasets: [{
                label: "Dibayar",
                data: <?= json_encode(array_column($jual, 'total_terjual')) ?>,
                backgroundColor: "#6777ef",
                borderColor: "#6777ef",
                borderWidth: 2.5,
                pointBackgroundColor: "#ffffff",
                pointRadius: 4,
            }, ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });


    const chart2 = document.getElementById("chartBelum");
    new Chart(chart2, {
        type: "bar",
        data: {
            labels: <?= json_encode(array_column($blmjual, 'nama_produk')) ?>,
            datasets: [{
                label: "Belum Dibayar",
                data: <?= json_encode(array_column($blmjual, 'total_terjual')) ?>,
                backgroundColor: "#6777ef",
                borderColor: "#6777ef",
                borderWidth: 2.5,
                pointBackgroundColor: "#ffffff",
                pointRadius: 4,
            }, ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>