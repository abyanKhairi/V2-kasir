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


    public function viewData($query)
    {
        $stmt = $this->db->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
                <tr>
                    <td><?php echo $row["nama"] ?></td>
                    <td><?php echo $row["alamat"] ?></td>
                    <td><?php echo $row["no_tlp"] ?></td>
                    <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=costumer&act=edit&id=<?php echo $row["id_pembeli"] ?>"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah Anda Yakin Ingin Menghapus Data Ini?" data-confirm-yes="window.location.href='index.php?page=costumer&act=hapus&id=<?php echo $row['id_pembeli']?> Berhasil Di Hapus'"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <!-- <a style="cursor: pointer;" data-toggle="tooltip" data-confirm="Yakin Ingin Log Out?" data-confirm-yes="window.location.href='../app/auth/logout.php'" class="dropdown-item has-icon text-danger"> -->
<?php
            }
        }
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
}
