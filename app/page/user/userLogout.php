<?php

$pdo = Koneksi::connect();
include "../../../database/class/auth.php";
$user = new Auth($pdo);
$user->logout();
if ($user->logout()) {
    echo "<script>window.location.href='index.php'</script>";
}
Koneksi::disconnect();
