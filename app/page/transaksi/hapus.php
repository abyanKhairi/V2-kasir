<?php
$pdo = Koneksi::connect();
$transaksi = new Transaksi($pdo);

if (isset($_GET['id_produk'], $_GET['id_transaksi'], $_GET['id_detail'])) {

    $id_produk = $_GET['id_produk'];
    $id = $_GET['id_transaksi'];
    $id_detail = $_GET['id_detail'];
    $transaksi->hapusDetail($id_produk, $id_detail);

    if ($transaksi->hapusDetail($id_produk, $id_detail)) {
?>
        <script>
            window.location.href = "index.php?page=transaksi&act=detail&id=<?= $id ?>"
        </script>
    <?php
    } else {
        echo "gagal menghapus Transaksi";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($transaksi->hapusTransaksi($id)) {
    ?>
        <script>
            window.location.href = "index.php?page=transaksi"
        </script>
<?php
    } else {
        echo "Masih Ada Transaksi Yang Sedang Dilakukan";
    }
}

$pdo =  Koneksi::disconnect();
