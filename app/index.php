<?php
include("layout/header.php");
include("layout/sidebar.php");

$page = isset($_GET["page"]) ? $_GET["page"] : '';
switch ($page) {

        // Page User
    case 'user/index':
        include('page/user/index.php');
        break;
    case 'user/add':
        include('page/user/add.php');
        break;
    case 'user/edit':
        include('page/user/edit.php');
        break;
    case 'user/hapus':
        include('page/user/hapus.php');
        include('page/user/index.php');
        break;

        // Page Costumer/Pembeli
    case 'costumer/index':
        include('page/costumer/index.php');
        break;
    case 'costumer/add':
        include('page/costumer/add.php');
        break;
    case 'costumer/edit':
        include('page/costumer/edit.php');
        break;
    case 'costumer/hapus':
        include('page/costumer/hapus.php');
        include('page/costumer/index.php');
        break;

        //Page Produk
    case 'product/index':
        include('page/product/index.php');
        break;
    case 'product/add':
        include('page/product/add.php');
        break;
    case 'product/edit':
        include('page/product/edit.php');
        break;
    case 'product/hapus':
        include('page/product/hapus.php');
        include('page/product/index.php');
        break;
    default:
        include('page/user/default.php');
        break;
        }
        ?>
<?php






include("layout/footer.php");