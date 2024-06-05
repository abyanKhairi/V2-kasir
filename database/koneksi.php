<?php


try {
    $con = new PDO('mysql:host=localhost;dbname=kasir', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
    echo $e->getMessage();
}
include 'class/count.php';
include "class/auth.php";
include "class/user.php";
include "class/costumer.php";
include "class/product.php";


$produk = new produk($con);
$costumer = new costumer($con);
$count = new count($con);
$crudUser = new user($con);
$user = new Auth($con);


