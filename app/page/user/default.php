<?php
include "../database/class/user.php";
include "../database/class/page.php";
$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {

    case 'create':
        include('add.php');
        break;
    case 'edit':
        include('edit.php');
        break;
    case 'delete':
        include('hapus.php');
        break;
    case 'logout':
        include('userLogout.php');
        break;
    case 'password':
        include('password.php');
        break;
    default:
        include('index.php');
}
