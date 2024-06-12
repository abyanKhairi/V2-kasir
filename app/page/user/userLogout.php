<?php
$pdo = Koneksi::connect();
$user = new Auth($pdo);
$user->logout();
if ($user->logout()) {
    echo "<script>window.location.href='index.php'</script>";
}
$pdo = Koneksi::disconnect();
