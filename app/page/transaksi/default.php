<?php

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'create';
        include 'add.php';
        break;
    case '':
        include '';
    case 'detail';
        include 'detail.php';
        break;
    default:
        include 'index.php';
        break;
}
