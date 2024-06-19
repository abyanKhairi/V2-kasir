<?php
include "../database/class/product.php";


$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {

        // Page User
    case 'create':
        include('add.php');
        break;
    case 'edit':
        include('edit.php');
        break;
    case 'delete':
        include('hapus.php');
        break;
    default:
        include('index.php');
}
