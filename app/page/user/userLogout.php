<?php

include("../../../database/koneksi.php");
$pdo = Koneksi::connect();
include "../../../database/class/auth.php";
$user = new Auth($pdo);
$user->logout();
Koneksi::disconnect();

header("Location: ../../index.php");
