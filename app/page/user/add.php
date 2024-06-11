<?php
if (isset($_POST["tambah"])) {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $not_tlp = $_POST["not_tlp"];
    $role = $_POST["role"];

    $pdo = Koneksi::connect();
    $crudUser = new user($pdo);
    $crudUser->tambah($nama, $username, $email, $password, $alamat, $not_tlp, $role);

    Koneksi::disconnect();
}



?>

<div class="section-header">
    <h1>Tambah User</h1>

</div>
<form method="POST">

    <div class="form-group">
        <label for="nama">Name</label>
        <input id="nama" type="text" class="form-control" name="nama" autofocus required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input id="username" type="text" class="form-control" name="username" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" required>
        <div class="invalid-feedback">
        </div>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input id="alamat" type="text" class="form-control" name="alamat" required>
        <div class="invalid-feedback">
        </div>
    </div>

    <div class="form-group">
        <label for="not_tlp">Nomor Telpon</label>
        <input id="not_tlp" type="text" class="form-control" name="not_tlp" required>
        <div class="invalid-feedback">
        </div>
    </div>


    <div class="form-group">
        <label>Role</label>
        <select class="form-control selectric" name="role" required>
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
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="tambah">
            Tambah
        </button>
    </div>
</form>


<?php
