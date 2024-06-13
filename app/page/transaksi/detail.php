<?php
$pdo = Koneksi::connect();
$id_transaksi = $_GET['id'];
if (isset($_POST['tambahProduct'])) {

    $id_produk = $_POST['id_produk'];
    $id_transaksi = $_POST['id_transaksi'];
    $qty = $_POST['qty'];
    $transaksi = new Transaksi($pdo);

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
                        <label for="nama">Name Pelanggan</label>
                        <select class="form-control selectric" name="id_produk">
                            <option>Pilih Produk</option>
                            <?php
                            $transaksi = new Transaksi($pdo);
                            $rows = $transaksi->getProduk("product", $id_transaksi);

                            foreach ($rows as $row) {
                            ?>
                                <option value="<?= $row['id_produk'] ?>"><?= $row['nama_produk'] ?></option>

                            <?php
                            }
                            ?>

                        </select>
                        <br>
                        <div class="form-group">
                            <label>Jumlah Produk</label>
                            <input type="number" name="qty" required class="form-control">
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
            <div class="card-body p-0" style="text-align : center;">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                        <?php
                        $transaksi = new Transaksi($pdo);
                        $rows = $transaksi->getDetail("detail_transaksi", $id_transaksi);
                        $i = 1;
                        foreach ($rows as $row) :
                            $total = $row['qty'] * $row['harga_produk']
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row["nama_produk"] ?></td>
                                <td><?php echo number_format($row["harga_produk"]) ?></td>
                                <td><?php echo $row["qty"] ?></td>
                                <td><?php echo number_format($total) ?></td>
                                <td>
                                    <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Detail" href="index.php?page=transaksi&act=edit&id=<?php echo $row["id_transaksi"] ?>"><i class="fas fa-shopping-cart"></i></a>
                                    <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah Anda Yakin Ingin Menghapus Data Ini?" data-confirm-yes="window.location.href='index.php?page=product&act=delete&id=<?php echo $row['id_transaksi'] ?>'"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        endforeach;
                        $pdo =  Koneksi::disconnect();
                        ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>