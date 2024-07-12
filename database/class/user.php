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

            if ($this->cekUsernameDanEmail($username, $email)) {
                return false;
            }

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


    public function update($id_user, $nama, $username, $email, $alamat, $not_tlp, $role)
    {
        try {

            $stmt = $this->db->prepare("UPDATE user SET nama = :nama, username = :username, email = :email, alamat =:alamat, not_tlp = :not_tlp, role = :role WHERE id_user =:id_user ");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
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

    //pengecekan sebelum ganti passsoerd apakah password yang lama sesuai dengan milik user
    public function confirmPassword($id_user, $oldPassword)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch();

            if ($stmt->rowCount() == 1) {
                if (password_verify($oldPassword, $data["password"])) {
                    return true;
                } else {
                    return false;
                }
            }

            // return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function resetPassword($id_user, $username, $password, $email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username AND email = :email AND id_user = :id_user");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $this->updatePassword($id_user, $password);
                return true;
            } else {
                echo "Username Dan Email yang dimasukkan tidak sesuai";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updatePassword($id_user, $password)
    {
        try {

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE user SET password = :password WHERE id_user = :id_user");
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // apakah username dan email sudah pernah digunakan
    public function cekUsernameDanEmail($username, $email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username OR email = :email");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getError()
    {
        return true;
    }
}
