<?php


try {
    $con = new PDO('mysql:host=localhost;dbname=kasir', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
    echo $e->getMessage();
}

include "class/auth.php";
include "class/user.php";

$crudUser = new user($con);
$user = new Auth($con);


