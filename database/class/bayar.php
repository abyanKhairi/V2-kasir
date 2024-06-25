<?php

class Bayar
{
    private $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public function hitungTotal($id_transaksi)
    {
        $stmt = $this->db->prepare("SELECT SUM(detail_transaksi.qty * product.harga_produk) as total_harga 
                                    FROM detail_transaksi 
                                    JOIN product ON detail_transaksi.id_produk = product.id_produk 
                                    WHERE detail_transaksi.id_transaksi = :id_transaksi");
        $stmt->bindParam(":id_transaksi", $id_transaksi);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['total_harga'] : 0;
    }

    public function simpanPembayaran($id_transaksi, $total_harga, $jumlah_bayar, $kembalian)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO bayar (id_transaksi, total_harga, jumlah_bayar, kembalian) VALUES (:id_transaksi, :total_harga, :jumlah_bayar, :kembalian)");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":total_harga", $total_harga);
            $stmt->bindParam(":jumlah_bayar", $jumlah_bayar);
            $stmt->bindParam(":kembalian", $kembalian);
            $stmt->execute();


            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function statusUpdate($id_transaksi)
    {

        $stmt = $this->db->prepare("UPDATE transaksi SET status = 'selesai' WHERE id_transaksi = :id_transaksi ");
        $stmt->bindParam(":id_transaksi", $id_transaksi);
        $stmt->execute();
        return true;
    }
    public function getBayar($id_bayar)
    {
        $stmt = $this->db->prepare("SELECT * FROM bayar WHERE id_bayar = :id_bayar");
        $stmt->bindParam(":id_bayar", $id_bayar);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getStruk($id_transaksi)
    {
        $stmt = $this->db->prepare("SELECT detail_transaksi.qty, product.nama_produk, product.harga_produk 
                           FROM detail_transaksi 
                           JOIN product ON detail_transaksi.id_produk = product.id_produk 
                           WHERE detail_transaksi.id_transaksi = :id_transaksi");
        $stmt->bindParam(":id_transaksi", $id_transaksi);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTransaksi($id_transaksi)
    {
        $stmt = $this->db->prepare("SELECT * FROM transaksi WHERE id_transaksi = :id_transaksi");
        $stmt->bindParam(":id_transaksi", $id_transaksi);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
