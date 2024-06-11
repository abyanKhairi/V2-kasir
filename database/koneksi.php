<?php
class Koneksi
{
    private static $dbName = 'kasir';
    private static $dbHost = 'localhost';
    private static $dbUser = 'root';
    private static $dbPass = '';

    private static $con = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        if (null == self::$con) {
            try {
                self::$con = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
            } catch (
                PDOException $e
            ) {
                die($e->getMessage());
            }
        }
        return self::$con;
    }

    public static function disconnect()
    {
        self::$con = null;
    }
}








include 'class/count.php';
include "class/auth.php";
include "class/user.php";
include "class/costumer.php";
include "class/product.php";



// $produk = new produk($kcon);
// $costumer = new costumer($kcon);
// $count = new count($kcon);
// $crudUser = new user($kcon);
// $user = new Auth($data);