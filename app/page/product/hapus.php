<?php

$id_produk = $_GET['id'];

$pdo = Koneksi::connect();
$produk = new produk($pdo);

$produk->delete($id_produk);
if ($produk->delete($id_produk)) {
?><script>
        window.location.href = "index.php?page=product"
    </script>
<?php
}
$pdo =  Koneksi::disconnect();
