<?php
$pdo = Koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$id_transaksi = $_GET['id'];


if (isset($_POST['tambahProduct'])) {

    $id_produk = htmlspecialchars($_POST['id_produk']);
    $id_transaksi = htmlspecialchars($_POST['id_transaksi']);
    $qty = htmlspecialchars($_POST['qty']);

    $transaksi->tambahDetail($id_transaksi, $id_produk, $qty);
}


?>

<div class="section-header">
    <h1>Detail Transaksi : <?= $id_transaksi ?> </h1>
</div>

<div class="row">
    <div class="col-3 col-md-29 col-lg-26">
        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Pelanggan</label>
                            <select class="form-control selectric" name="id_produk">
                                <?php
                                $rows = $transaksi->getProduk("product", $id_transaksi);

                                foreach ($rows as $row) {
                                ?>
                                    <option value="<?= $row['id_produk'] ?>"><?= $row['nama_produk'] ?></option>

                                <?php
                                }

                                ?>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Jumlah Produk</label>
                            <input min="1" type="number" name="qty" required class="form-control">
                        </div>
                        <input type="hidden" name="id_transaksi" class="form-control" value="<?= $id_transaksi ?>">
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="tambahProduct">
                                Tambah Product
                            </button>
                        </div>
                    </div>

            </form>

        </div>
    </div>
</div>


<!-- Produk yang dipesan-->

<div class="row">
    <div class="col-12 col-md-25 col-lg-25">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-md text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                        <?php
                        $rows = $transaksi->getDetailTransaksi($id_transaksi);
                        $i = 1;
                        foreach ($rows as $row) :
                            $total = $row['qty'] * $row['harga_produk'];
                        ?>
                            <tr>
                                <td class="align-middle"><?php echo $i ?></td>
                                <td class="align-middle">
                                    <img src="page/product/img/<?php echo $row["gambar"] ?>" width="90px" alt="gambar">
                                </td>
                                <td class="align-middle"><?php echo $row["nama_produk"] ?></td>
                                <td class="align-middle">Rp. <?php echo number_format($row["harga_produk"]) ?></td>
                                <td class="align-middle"><?php echo $row["qty"] ?></td>
                                <td class="align-middle">Rp. <?php echo number_format($total) ?></td>
                                <td class="align-middle">
                                    <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah Anda Yakin Ingin Menghapus Produk Dari Transaksi?" data-confirm-yes="window.location.href='index.php?page=transaksi&act=delete&id_produk=<?= $row['id_produk'] ?>&id_transaksi=<?= $row['id_transaksi'] ?>'"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="text-align: center;" class="col-lg-2">
    <div class="card">
        <div class="card-body">
            <?php
            $totals = $transaksi->totalHarga($id_transaksi);
            ?>
            <h5>Total Harga</h5>
            <h6>Rp. <?= number_format($totals["total_harga"]) ?></h6>
            <?php

            if ($rows == true) {
            ?>
                <br>
                <a href="index.php?page=struk&act=pembayaran&id=<?= $id_transaksi ?>"> <button type="submit" style="font-size: 10px;" class="btn btn-primary btn-block" name="">
                        Selesaikan Transaksi
                    </button></a>
            <?php } ?>
        </div>
    </div>
</div>