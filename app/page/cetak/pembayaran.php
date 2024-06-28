<?php

$id_transaksi = $_GET["id"];
$pdo = Koneksi::connect();
$bayar = new Bayar($pdo);

if (isset($_POST['bayar'])) {
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $total_harga = $bayar->hitungTotal($id_transaksi);
    $kembalian = $jumlah_bayar - $total_harga;
    if ($jumlah_bayar >= $total_harga) {
        $id_bayar = $bayar->simpanPembayaran($id_transaksi, $total_harga, $jumlah_bayar, $kembalian);
        $bayar->statusUpdate($id_transaksi);
        echo "<script>window.location.href ='index.php?page=struk&act=total&id_struk=$id_bayar'</script>";
    } else {
        $error = $bayar->getError();
    }
    $pdo = Koneksi::disconnect();
}
?>
<br>
<?php
if (isset($error)) {
    echo "<div class='card-body'> 
            <div class='alert alert-danger alert-dismissible show fade'>
                <div class='alert-body'>
                    <button class='close' data-dismiss='alert'>
                        <span>&times;</span>
                    </button>
                        Uang Yang Dimasukan Tidak Cukup, Pastikan Memiliki Uang Yang Cukup Untuk Membayar
                </div>
            </div>
        </div>";
}
?>
<br>
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
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="bayar">
                                Bayar
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>