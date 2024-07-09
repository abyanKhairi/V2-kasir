<?php

$id_pembeli = $_GET['id'];
$pdo = Koneksi::connect();
$costumer = costumer::getInsatance($pdo);
$costumer->delete($id_pembeli);

if ($costumer->delete($id_pembeli) == true) {
        echo " <script>window.location.href = 'index.php?page=costumer&pesan=success'</script>";
} else {
        echo "<script>window.location.href = 'index.php?page=costumer&pesan=gagal'</script>";
}
