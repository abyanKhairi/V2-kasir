<?php

class costumer
{

    private $db;


    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }


    public function tambah($nama, $alamat, $no_tlp)
    {
        try {

            //Masukkan costumer baru ke database
            $stmt = $this->db->prepare("INSERT INTO pembeli(id_pembeli,nama, alamat, no_tlp) VALUES(NULL,:nama,:alamat, :no_tlp)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":no_tlp", $no_tlp);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {


            echo $e->getMessage();

            return false;
        }
    }

    public function getID($id_costumer)
    {
        $stmt = $this->db->prepare("SELECT * FROM pembeli WHERE id_pembeli = :id_pembeli");
        $stmt->execute(array(":id_pembeli" => $id_costumer));

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update($id_pembeli, $nama, $alamat, $no_tlp)
    {

        try {
            $stmt = $this->db->prepare("UPDATE pembeli SET nama = :nama, alamat =:alamat, no_tlp = :no_tlp WHERE id_pembeli =:id_pembeli ");
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":no_tlp", $no_tlp);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id_pembeli)
    {
        $stmt = $this->db->prepare("DELETE FROM pembeli WHERE id_pembeli =:id_pembeli");
        $stmt->bindParam(":id_pembeli", $id_pembeli);
        $stmt->execute();
        return true;
    }

    public function viewData($query)
    {
        $stmt = $this->db->prepare("SELECT * FROM pembeli");

        $stmt->execute();
        return  $rows = $stmt->fetchAll();
    }
}
