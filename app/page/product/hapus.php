<?php

$id_produk = $_GET['id'];

$pod = Koneksi::connect();
$produk = new produk($pdo);

$produk->delete($id_produk);

Koneksi::disconnect();
