<?php

$id_produk = $_GET['id'];

$pdo = Koneksi::connect();
$produk = new produk($pdo);

$produk->delete($id_produk);
if ($produk->delete($id_produk) == true) {
    echo "<script>window.location.href = 'index.php?page=product'</script>";
} else {
    echo "<script>window.location.href = 'index.php?page=product'</script>";
    $error = NULL;
    return $error;
}
$pdo =  Koneksi::disconnect();
