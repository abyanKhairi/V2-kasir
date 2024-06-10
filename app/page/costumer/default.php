<?php
$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {


    case 'create':
        include('page/costumer/add.php');
        break;
    case 'edit':
        include('page/costumer/edit.php');
        break;
    case 'delete':
        include('page/costumer/hapus.php');
        break;
    default:
        include('index.php');
}
