<?php
$pdo = Koneksi::connect();
$crudUser = new user($pdo);

$id_user = $_GET['id'];

if (isset($_POST["edit"])) {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $not_tlp = $_POST["not_tlp"];
    $role = $_POST["role"];
    $crudUser->update($id_user, $nama, $username, $email, $password, $alamat, $not_tlp, $role);

    if ($crudUser->update($id_user, $nama, $username, $email, $password, $alamat, $not_tlp, $role) == true) {

        echo "<script>
            window.location.href = 'index.php?page=user'
        </script>";
    }
}

if (isset($id_user)) {
    extract($crudUser->getID($id_user));
}
$pdo =  Koneksi::disconnect();

?>

<div class="section-header">
    <h1>Edit User</h1>
</div>
<div class="row">
    <div class="col-12 col-md-6 offset-lg-3 col-lg-6">
        <div class="card">
            <form method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Name</label>
                        <input id="nama" type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" value="<?php echo $username; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input id="alamat" type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="not_tlp">Nomor Telpon</label>
                        <input id="not_tlp" type="text" class="form-control" name="not_tlp" value="<?php echo $not_tlp; ?>" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control selectric" name="role" value="<?php echo $role; ?>" required>
                            <option value="admin">admin</option>
                            <option value="superAdmin">superAdmin</option>
                        </select>
                    </div>
                    <div class="form-grup">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="edit">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>