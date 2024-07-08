<?php

class Auth
{
    private $db;

    private $error;

    private static $instance = null;


    public function __construct($db_conn)
    {
        $this->db = $db_conn;

        @session_start();
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Auth($pdo);
        }

        return self::$instance;
    }

    public function register($nama, $username, $email, $password, $alamat, $not_tlp, $role)
    {
        try {
            // enkripsi
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
            //Masukkan user baru ke database
            $stmt = $this->db->prepare("INSERT INTO user(nama, username,email, password, alamat, not_tlp, role) VALUES(:nama, :username ,:email, :pass, :alamat, :not_tlp, :role)");
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
            if ($e->errorInfo[0] == 23000) {
                $this->error = "Email sudah digunakan!";
                return false;
            } else {
                echo $e->getMessage();
                return false;
            }
        }
    }


    //fungsi login 
    public function login($username, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $data = $stmt->fetch();
            if ($stmt->rowCount()  > 0) {
                //cek password
                if (password_verify($password, $data["password"])) {
                    $_SESSION['user_session'] = $data['id_user'];
                    return true;
                } else {
                    $this->error = 'Username Atau Password Salah';
                    return false;
                }
            } else {
                $this->error = 'Username Atau Password Salah';
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }




    public function isLoggedIn()
    {
        //apakah user_session sudah ada di session
        if (isset($_SESSION["user_session"])) {
            return true;
        }
    }


    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return false;
        }
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $_SESSION['user_session']);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function logout()
    {
        //hapus Session
        unset($_SESSION['user_session']);
        session_destroy();


        return true;
    }

    public function getError()
    {
        return true;
    }
}
