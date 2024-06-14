<?php

$id_detail = $_GET['id_detail'];
$id_produk = $_GET['id_produk'];

$pdo = Koneksi::connect();
$transaksi = new Transaksi($pdo);
$transaksi->hapusDetail($id_produk, $id_detail);

if ($transaksi->hapusDetail($id_produk, $id_detail) == true) {
?><script>
        window.location.href = "index.php?page=transaksi&act=detail&id=<?php echo $id_detail ?>"
    </script>
<?php
}
$pdo =  Koneksi::disconnect();
