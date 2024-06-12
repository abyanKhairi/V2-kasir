<?php

class produk
{

    private $db;


    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }


    public function tambah($nama_produk, $jumlah_produk, $harga_produk)
    {
        try {

            //Masukkan costumer baru ke database
            $stmt = $this->db->prepare("INSERT INTO product(id_produk,nama_produk, jumlah_produk, harga_produk) VALUES(NULL,:nama_produk,:jumlah_produk, :harga_produk)");
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

    public function getID($id_produk)
    {
        $stmt = $this->db->prepare("SELECT * FROM product WHERE id_produk = :id_produk");
        $stmt->execute(array(":id_produk" => $id_produk));

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }


    public function viewData($query)
    {
        $stmt = $this->db->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>


                <!-- <a style="cursor: pointer;" data-toggle="tooltip" data-confirm="Yakin Ingin Log Out?" data-confirm-yes="window.location.href='../app/auth/logout.php'" class="dropdown-item has-icon text-danger"> -->
<?php
            }
        }
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
        $stmt = $this->db->prepare("DELETE FROM product WHERE id_produk =:id_produk");
        $stmt->bindParam(":id_produk", $id_produk);
        $stmt->execute();
        return true;
    }
}
