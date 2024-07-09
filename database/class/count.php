<?php

class count
{
    private $db;

    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new count($pdo);
        }

        return self::$instance;
    }

    public function count($table)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM $table");
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function countUang($table)
    {
        $stmt = $this->db->prepare("SELECT SUM(total_harga) FROM $table");
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function countJual($status)
    {
        $stmt = $this->db->prepare("SELECT SUM(qty) FROM detail_transaksi 
        JOIN transaksi 
        ON detail_transaksi.id_transaksi = transaksi.id_transaksi
        WHERE transaksi.status = :status");
        $stmt->bindParam(":status", $status);
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function chart($status)
    {
        try {
            $stmt = $this->db->prepare("SELECT product.nama_produk, SUM(detail_transaksi.qty) AS total_terjual
            FROM detail_transaksi
            JOIN product ON detail_transaksi.id_produk = product.id_produk
            JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi
            WHERE transaksi.status = :status
            GROUP BY product.nama_produk
            ORDER BY total_terjual DESC");
            $stmt->bindParam(":status", $status);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
