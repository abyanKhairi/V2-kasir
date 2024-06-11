<?php

include("../../database/koneksi.php");
$pdo = Koneksi::connect();
$user = new Auth($pdo);
$user->logout();
Koneksi::disconnect();

header("Location: ../../app/index.php");
