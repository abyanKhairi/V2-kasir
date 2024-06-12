<?php

include("../../database/koneksi.php");
$pdo = Koneksi::connect();
include "../class/auth.php";
$user = new Auth($pdo);
$user->logout();
Koneksi::disconnect();

header("Location: ../../app/index.php");
