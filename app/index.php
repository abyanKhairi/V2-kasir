


<?php
include_once("layout/header.php");
include_once("layout/sidebar.php");

$page = isset($_GET["page"]) ? $_GET["page"] : '';
switch ($page) {


    case 'user':
        include('page/user/default.php');
        break;

    case 'costumer':
        include('page/costumer/default.php');
        break;

    case 'product':
        include('page/product/default.php');
        break;

    case 'transaksi':
        include('page/transaksi/default.php');
        break;

    default:
        include('page/dashboard/index.php');
}

include_once("layout/footer.php");
