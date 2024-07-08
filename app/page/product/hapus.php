<?php

$id_produk = $_GET['id'];

$pdo = Koneksi::connect();
$produk = produk::getInsatance($pdo);

$produk->delete($id_produk);
if ($produk->delete($id_produk) == true) {
    echo "<script>window.location.href = 'index.php?page=product&pesan=success'</script>";
} else {
    echo "<script>window.location.href = 'index.php?page=product&pesan=gagal'</script>";
}
$pdo =  Koneksi::disconnect();
