<?php
if (isset($_POST['tambahTransaksi'])) {
    $id_pembeli = $_POST['id_pembeli'];
    $tanggal = $_POST['tanggal'];

    $pdo = Koneksi::connect();

    $transaksi = new Transaksi($pdo);
    $transaksi->tambahTransaksi($id_pembeli, $tanggal);

    $pdo =  Koneksi::disconnect();
}





?>

<div class="section-header">
    <h1>Tambah Transaksi</h1>
</div>

<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <div class="card-body">
                        <label for="nama">Name Pelanggan</label>
                        <select class="form-control selectric" name="id_pembeli">
                            <option>Pilih Nama Pelanngan</option>
                            <?php
                            $pdo = Koneksi::connect();
                            $transaksi = new Transaksi($pdo);
                            $rows = $transaksi->getCustomer("pembeli");
                            foreach ($rows as $row) {
                            ?>
                                <option value="<?= $row['id_pembeli'] ?>"><?= $row['nama'] ?></option>

                            <?php
                            }
                            $pdo = Koneksi::disconnect();
                            ?>

                        </select>
                        <br>
                        <div class="form-group">
                            <label>Tanggal Transaksi (YY/MM/DD)</label>
                            <input type="datetime" required class="form-control" name="tanggal" value="<?= date('y/m/d') ?>" placeholder="(YY/MM/DD)">
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="tambahTransaksi">
                                Tambah Transaksi
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>