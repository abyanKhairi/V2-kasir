<?php
$pdo = Koneksi::connect();
$transaksi = new Transaksi($pdo);

//menghapus Transaksi
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($transaksi->hapusTransaksi($id)) {
        echo   "<script>window.location.href = 'index.php?page=transaksi&pesan=success'</script>";
        exit();
    } else {
        echo "<script>window.location.href = 'index.php?page=transaksi&pesan=gagal'</script>";
    }
}

if (isset($_GET['id_produk']) && isset($_GET['id_transaksi'])) {
    $id_produk = $_GET['id_produk'];
    $id_transaksi = $_GET['id_transaksi'];
    $low = $transaksi->hapusDetail($id_produk, $id_transaksi);
    if ($low) {
        echo   "<script>window.location.href = 'index.php?page=transaksi&act=detail&id=$id_transaksi'</script>";
        exit();
    } else {
        echo "gagal menghapus Transaksi";
    }
}




$pdo =  Koneksi::disconnect();
