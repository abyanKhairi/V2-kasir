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

    $crudUser = user::getInstance($pdo);
    $crudUser->tambah($nama, $username, $email, $password, $alamat, $not_tlp, $role);

    $pdo =  Koneksi::disconnect();
}



?>

<div class="section-header">
    <h1>Tambah User</h1>

</div>

<div class="row">
    <div class="col-12 col-md-6 col-lg-10">
        <div class="card">
            <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nama">Name</label>
                            <input id="nama" type="text" class="form-control" autocomplete="off" name="nama" autofocus required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" autocomplete="off" name="username" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" autocomplete="off" name="email" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="alamat">Alamat</label>
                            <input id="alamat" type="text" class="form-control" autocomplete="off" name="alamat" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="not_tlp">Nomor Telpon</label>
                            <input id="not_tlp" type="text" class="form-control" autocomplete="off" name="not_tlp" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select class="form-control selectric" name="role" required>
                                <option value="admin">admin</option>
                                <option value="superAdmin">superAdmin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password" class="d-block">Password</label>
                            <input id="password" type="password" autocomplete="off" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="tambah">
                            Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
