<?php

class Transaksi
{
    private $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    // Mendapatkan transaksi berdasarkan nama, alamat, dan telepon pembeli
    public function getTransaksi($nama, $alamat, $tlp)
    {
        try {
            $stmt = $this->db->prepare("SELECT transaksi.*, pembeli.nama, pembeli.alamat, pembeli.no_tlp 
                FROM transaksi 
                JOIN pembeli ON pembeli.id_pembeli = transaksi.id_pembeli
                WHERE pembeli.nama = :nama AND pembeli.alamat = :alamat AND pembeli.no_tlp = :tlp
            ");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":tlp", $tlp);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Mendapatkan semua data pembeli
    public function getCustomer()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pembeli");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Mendapatkan semua data produk
    public function getProduk()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM product");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Mendapatkan detail transaksi berdasarkan ID transaksi
    public function detailTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("SELECT detail_transaksi.*, product.nama_product, product.harga_product
                FROM detail_transaksi 
                JOIN product ON product.id_product = detail_transaksi.id_product
                WHERE detail_transaksi.id_transaksi = :id_transaksi
            ");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Menambahkan transaksi baru
    public function tambahTransaksi($id_user, $id_pembeli, $total_harga)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO transaksi (id_user, id_pembeli, total_harga, tanggal_transaksi) 
                VALUES (:id_user, :id_pembeli, :total_harga, NOW())
            ");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->bindParam(":total_harga", $total_harga);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Menghapus transaksi berdasarkan ID
    public function hapusTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Menambahkan detail transaksi baru
    public function tambahDetailTransaksi($id_transaksi, $id_product, $total_product)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO detail_transaksi (id_transaksi, id_product, total_product) 
                VALUES (:id_transaksi, :id_product, :total_product)
            ");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":id_product", $id_product);
            $stmt->bindParam(":total_product", $total_product);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Menghapus detail transaksi berdasarkan ID detail transaksi
    public function hapusDetailTransaksi($id_detail_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM detail_transaksi WHERE id_detail_transaksi = :id_detail_transaksi");
            $stmt->bindParam(":id_detail_transaksi", $id_detail_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Menampilkan detail lengkap transaksi berdasarkan ID transaksi
    public function show($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare(" SELECT transaksi.*, pembeli.nama AS nama_pembeli, pembeli.alamat AS alamat_pembeli, pembeli.no_tlp AS no_tlp_pembeli,
                detail_transaksi.id_product, detail_transaksi.total_product, product.nama_product, product.harga_product
                FROM transaksi
                JOIN pembeli ON pembeli.id_pembeli = transaksi.id_pembeli
                JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi
                JOIN product ON product.id_product = detail_transaksi.id_product
                WHERE transaksi.id_transaksi = :id_transaksi
            ");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
