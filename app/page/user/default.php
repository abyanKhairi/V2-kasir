<?php
$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {

        // Action User
    case 'create':
        include('add.php');
        break;
    case 'edit':
        include('edit.php');
        break;
    case 'delete':
        include('hapus.php');
        break;
    default :
        include('index.php');
} 


