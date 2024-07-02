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

    public function update($id_pembeli, $nama, $alamat, $no_tlp, $anggota, $id_member)
    {

        try {
            $stmt = $this->db->prepare("UPDATE pembeli, member SET nama = :nama, alamat =:alamat, no_tlp = :no_tlp WHERE id_pembeli =:id_pembeli");
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":no_tlp", $no_tlp);

            $this->updateMem($anggota, $id_member);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateMem($anggota, $id_member)
    {
        try {
            $stmt = $this->db->prepare("UPDATE member SET keanggotaan = :anggota WHERE id_member = :id_member");
            $stmt->bindParam(":anggota", $anggota);
            $stmt->bindParam(":id_member", $id_member);
            $stmt->execute();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function delete($id_pembeli)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM pembeli WHERE id_pembeli =:id_pembeli");
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
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

    public function memberPembeli($id_pembeli, $id_member)
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

    public function updateMember()
    {
        try {
            $stmt = $this->db->prepare("UPDATE member SET keanggotaan = :keanggotaan WHERE id_member = :id_member");
            $stmt->execute();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
