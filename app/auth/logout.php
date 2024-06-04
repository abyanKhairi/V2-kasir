<?php

include("../../database/koneksi.php");

$user->logout();

header("Location: login.php");