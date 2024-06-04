<?php

class user
{

    private $db;


    public function __construct($db_conn)
    {
        $this->db = $db_conn;
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


    public function viewData($query)
    {
        $stmt = $this->db->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
                <li class="media">
                    <img class="mr-3 rounded-circle" width="50" src="../../assets/img/avatar/avatar-4.png" alt="avatar">
                    <div class="media-body">
                        <h6 class="media-title"><?php echo $row["nama"] ?></h6>
                        <div class="text-small text-muted">@<?php echo $row["username"] ?> <div class="bullet"></div> <?php echo $row["email"] ?> <div class="bullet"></div> <span class="text-primary"><?php echo $row["role"] ?></span></div>
                    </div>
                    <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=user/edit&id_user=<?php echo $row["id_user"] ?>" ><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" href="index.php?page=user/hapus&id_user=<?php echo $row["id_user"] ?>" ><i class="fas fa-trash"></i></a>
                    </td>
                </li>
<?php
            }
        }
    }


    public function update($id_user, $nama, $username, $email, $password, $alamat, $not_tlp, $role)
    {

        try {
            $stmt = $this->db->prepare("UPDATE user SET nama = :nama, username = :username, email = :email, password = :password, alamat =:alamat, not_tlp = :not_tlp, role = :role WHERE id_user =:id_user ");
            $stmt->bindParam(":id_user",$id_user);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
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

    public function delete($id_user){
        $stmt = $this->db->prepare("DELETE FROM user WHERE id_user =:id_user");
        $stmt->bindParam(":id_user",$id_user);
        $stmt->execute();
        return true;
    }

}
