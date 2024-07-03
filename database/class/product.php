<?php

class produk
{

    private $db;
    private $error;


    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }


    public function tambah($nama_produk, $jumlah_produk, $harga_produk, $gambar)
    {
        try {

            //Masukkan costumer baru ke database
            $stmt = $this->db->prepare("INSERT INTO product(id_produk,nama_produk, jumlah_produk, harga_produk, gambar) VALUES(NULL,:nama_produk,:jumlah_produk, :harga_produk, :gambar)");
            $stmt->bindParam(":nama_produk", $nama_produk);
            $stmt->bindParam(":jumlah_produk", $jumlah_produk);
            $stmt->bindParam(":harga_produk", $harga_produk);
            $stmt->bindParam(":gambar", $gambar);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {


            echo $e->getMessage();

            return false;
        }
    }

    public function getID($id_produk)
    {
        $stmt = $this->db->prepare("SELECT * FROM product WHERE id_produk = :id_produk");
        $stmt->execute(array(":id_produk" => $id_produk));

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }



    public function update($id_produk, $nama_produk, $jumlah_produk, $harga_produk)
    {

        try {
            $stmt = $this->db->prepare("UPDATE product SET nama_produk = :nama_produk, jumlah_produk =:jumlah_produk, harga_produk = :harga_produk WHERE id_produk =:id_produk ");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":nama_produk", $nama_produk);
            $stmt->bindParam(":jumlah_produk", $jumlah_produk);
            $stmt->bindParam(":harga_produk", $harga_produk);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id_produk)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM product WHERE id_produk =:id_produk");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
