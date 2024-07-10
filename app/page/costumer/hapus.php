<?php

$id_pembeli = $_GET['id'];
$pdo = Koneksi::connect();
$costumer = costumer::getInsatance($pdo);

if ($costumer->delete($id_pembeli)) {
        echo " <script>window.location.href = 'index.php?page=costumer&pesan=success'</script>";
} else {
        echo "<script>window.location.href = 'index.php?page=costumer&pesan=gagal'</script>";
}
