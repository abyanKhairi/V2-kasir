<?php
include "../database/class/transaksi.php";
include "../database/class/page.php";


$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'create':
        include 'add.php';
        break;
    case 'detail':
        include 'detail.php';
        break;
    case 'delete':
        include 'hapus.php';
        break;
    case 'edit':
        include 'detail.php';
        break;
    default:
        include 'index.php';
        break;
}
