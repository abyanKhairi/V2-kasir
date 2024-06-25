<?php

$id_transaksi = $_GET["id"];
$pdo = Koneksi::connect();
$bayar = new Bayar($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $total_harga = $bayar->hitungTotal($id_transaksi);
    $kembalian = $jumlah_bayar - $total_harga;

    $id_bayar = $bayar->simpanPembayaran($id_transaksi, $total_harga, $jumlah_bayar, $kembalian);
    $bayar->statusUpdate($id_transaksi);
    $pdo = Koneksi::disconnect();

    echo "<script>window.location.href ='index.php?page=struk&act=total&id_struk=$id_bayar'</script>";
    exit;
}
?>
<br><br><br>
<div class="row">
    <div class="col-10 col-sm-6 col-md-4 col-lg-4 offset-lg-4">
        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Jumlah Uang</label>
                            <input min="1" type="number" name="jumlah_bayar" autofocus required class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="tambahProduct">
                                Bayar
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>