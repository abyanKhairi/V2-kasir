<?php

class user
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
            self::$instance = new user($pdo);
        }
        return self::$instance;
    }


    public function tambah($nama, $username, $email, $password, $alamat, $not_tlp, $role)
    {
        try {
            // enkripsi
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
            //Masukkan user baru ke database
            $stmt = $this->db->prepare("INSERT INTO user(id_user ,nama, username,email, password, alamat, not_tlp, role) VALUES(NULL,:nama, :username ,:email, :pass, :alamat, :not_tlp, :role)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $hashPasswd);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":not_tlp", $not_tlp);
            $stmt->bindParam(":role", $role);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_user)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
        $stmt->execute(array(":id_user" => $id_user));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }


    public function update($id_user, $nama, $username, $email, $password, $alamat, $not_tlp, $role)
    {
        try {
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE user SET nama = :nama, username = :username, email = :email, password = :password, alamat =:alamat, not_tlp = :not_tlp, role = :role WHERE id_user =:id_user ");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashPasswd);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":not_tlp", $not_tlp);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id_user)
    {
        $stmt = $this->db->prepare("DELETE FROM user WHERE id_user =:id_user");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->execute();
        return true;
    }
}
