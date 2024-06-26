<?php
$id_struk = $_GET['id_struk'];

$pdo = Koneksi::connect();
$bayar = new Bayar($pdo);
$cek = $bayar->getBayar($id_struk);
$get = $bayar->getTransaksi($cek['id_transaksi']);
$rows = $bayar->getStruk($cek['id_transaksi']);

$pdo = Koneksi::disconnect();
?>

<div class="col-18 col-sm-14 offset-sm-2 col-md-10 col-lg-10 offset-lg-3">

    <div class="card text-bg-primary mb-2" style="max-width: 33rem">
        <div class="card-header font-weight-bold">Zkasir
        </div>
        <div class="card-body">
            <h5 class="card-title">Struk Transaksi</h5>
            <div class="text-right"><?= $get['tanggal_transaksi'] ?></div>
            <div class="col">
                <p>ID transaksi : <?= $cek['id_transaksi'] ?> </p>
                <p>ID Pembayaran : <?= $id_struk ?> </p>
            </div>
            <hr>
            <div class="tabel-responsive">
                <table class="table table-striped table-md">
                    <tr>
                        <th scope="col">Nama Product</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Total</th>
                    </tr>
                    <tr>
                        <?php
                        foreach ($rows as $row) {
                        ?>
                            <td><?= $row['nama_produk'] ?></td>
                            <td><?= $row['qty'] ?></td>
                            <td>Rp. <?= number_format($row['harga_produk']) ?></td>
                            <td>Rp. <?= number_format($row['qty'] * $row['harga_produk']) ?></td>
                    </tr>
                <?php } ?>
                </table>
                <hr>
                </table>
                <table class="table table-striped table-md">
                    <tr>
                        <th>Total Harga</th>
                        <th>Jumlah Yang Dibayarkan</th>
                        <th>Kembalian</td>
                    </tr>
                    <tr>
                        <td>Rp. <?= number_format($cek['total_harga']) ?></td>
                        <td>Rp. <?= number_format($cek['jumlah_bayar']) ?></td>
                        <td>Rp. <?= number_format($cek['kembalian']) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>