<?php
class Koneksi
{

    private static $instance = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    public static function connect()
    {

        $dbName = 'kasir';
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';

        if (self::$instance == null) {
            try {
                self::$instance = new \PDO("mysql:host={$dbHost};dbname={$dbName};", "{$dbUser}", "{$dbPass}");
            } catch (
                PDOException $e
            ) {
                die($e->getMessage());
            }
        }
        return self::$instance;
    }
}
