<?php


include("../database/koneksi.php");
include("layout/header.php");
include("layout/sidebar.php");
include("layout/footer.php");




if (!$user->isLoggedIn()) {
    header('Location: auth/login.php');
}

$page = isset($_GET["page"]) ? $_GET["page"] : '';
        
switch ($page) {
    case 'user/index':
        include ('page/user/index.php');
        break;
    case 'user/add':
        include ('page/user/add.php');
        break;
    default:
    include ('page/user/default.php');     
    }

    





