<?php

class Transaksi
{

    private $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public function getTransaksi($nama, $alamat, $tlp)
    {
        try {
            $stmt = $this->db->prepare("SELECT transaki.*, pembeli.nama = :nama, pembeli.alamat = :alamat, pembeli.no_tlp = :tlp FROM transaksi JOIN pembeli ON pembeli.id_pembeli = transaki.id_pembeli");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":tlp", $tlp);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    public function getCostumer()
    {
        $stmt = $this->db->prepare("SELECT * FROM pembeli");
    }

    public function getProduk()
    {
        $stmt = $this->db->prepare("SELECT * FROM product");
    }


    public function detailTransaksi()
    {
    }

    public function tambah()
    {
    }

    public function hapus()
    {
    }

    public function tambahDetail()
    {
    }

    public function hapusDetail()
    {
    }
}
