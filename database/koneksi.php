<?php
class Koneksi
{
    private static $dbName = 'zkasir';
    private static $dbHost = 'localhost';
    private static $dbUser = 'root';
    private static $dbPass = '';

    private static $instance = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        set_exception_handler(function ($e) {
            error_log($e->getMessage());
            exit('Yang Bener Nulisnya Kocak');
        });

        if (self::$instance == null) {
            try {
                self::$instance = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$instance;
    }
}
