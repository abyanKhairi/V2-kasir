<?php
include("layout/header.php");

$auth = isset($_GET['auth']) ? $_GET['auth'] : 'auth';
if(@$_GET['auth']){
switch($auth){
case 'login':
    include('auth/login.php');
break;
case 'register':
    include('auth/register.php');
break;

}
exit;
}


include("layout/sidebar.php");
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

include("layout/footer.php");
