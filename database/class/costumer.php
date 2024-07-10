<?php

class costumer
{

    private $db;

    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInsatance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new costumer($pdo);
        }

        return self::$instance;
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

    public function update($id_pembeli, $nama, $alamat, $no_tlp, $anggota, $id_member)
    {

        try {
            $stmt = $this->db->prepare("UPDATE pembeli, member SET nama = :nama, alamat =:alamat, no_tlp = :no_tlp WHERE id_pembeli =:id_pembeli");
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":no_tlp", $no_tlp);
            $stmt->execute();

            $this->updateMember($anggota, $id_member);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateMember($anggota, $id_member)
    {
        try {
            $stmt = $this->db->prepare("UPDATE member SET keanggotaan = :anggota WHERE id_member = :id_member");
            $stmt->bindParam(":anggota", $anggota);
            $stmt->bindParam(":id_member", $id_member);
            $stmt->execute();

            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function delete($id_pembeli)
    {
        try {
            $stmt = $this->db->prepare("DELETE pembeli.*, member.* FROM pembeli JOIN member ON pembeli.id_member = member.id_member WHERE id_pembeli =:id_pembeli");
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }

    public function addMember($anggota)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO member(keanggotaan) VALUES (:anggota)");
            $stmt->bindParam(":anggota", $anggota);
            $stmt->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function setMemberPembeli($id_pembeli, $id_member)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pembeli SET id_member = :id_member WHERE id_pembeli = :id_pembeli");
            $stmt->bindParam(":id_member", $id_member);
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showMember($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT member.keanggotaan FROM pembeli JOIN member ON pembeli.id_member = member.id_member WHERE id_pembeli = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
