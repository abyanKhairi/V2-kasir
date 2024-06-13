<?php

class Transaksi
{
    private $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    //untuk menggambil data dari tabel transaksi yang berelasi dengan pembeli
    public function getTransaksi()
    {
        try {
            $stmt = $this->db->prepare("SELECT transaksi.*, pembeli.id_pembeli , pembeli.nama ,pembeli.alamat , pembeli.no_tlp           
            FROM transaksi 
            JOIN pembeli 
            ON pembeli.id_pembeli = transaksi.id_pembeli");


            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //untuk mengambil data pembeli agar bisa diinput ke transaksi
    public function getCustomer()
    {
        $stmt =  $this->db->prepare("SELECT * FROM pembeli");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //menambahkan transaksi / menginout data transaksi
    public function tambahTransaksi($id_pembeli, $tanggal)
    {
        try {

            $stmt = $this->db->prepare("INSERT INTO transaksi (id_pembeli, tanggal_transaksi) VALUE ( :id_pembeli , :tanggal )");
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    //mengambil data produk
    public function getProduk($que, $id_transaksi)
    {
        $que = "SELECT * FROM product WHERE id_produk NOT LIKE (SELECT id_produk FROM detail_transaksi WHERE id_transaksi = :id_transaksi)";
        $stmt =  $this->db->prepare($que);
        $stmt->bindParam(':id_transaksi', $id_transaksi);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    //menambahkan detail transaksi
    public function tambahDetail($id_transaksi, $id_produk, $qty,)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO detail_transaksi (id_transaksi, id_produk, qty) VALUE ( :id_transaksi , :id_produk, :qty )");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":qty", $qty);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDetail($query, $id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM detail_transaksi, product WHERE detail_transaksi.id_produk = product.id_produk AND id_transaksi = :idTrk");
            $stmt->bindParam(":idTrk", $id_transaksi);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
