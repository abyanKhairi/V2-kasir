<?php
$pdo = Koneksi::connect();
$crudUser = user::getInstance($pdo);

$id_user = $_GET["id"];

if (isset($_POST["reset"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($crudUser->resetPass($id_user, $username, $password, $email)) {
        echo '<script>alert("bisa")</script>';
    } else {
        echo '<script>alert("Gak bisa")</script>';
    }
}

?>

<div class="section-header">
    <h1>Reset Password</h1>
</div>
<div class="row">
    <div class="col-6 col-md-6 col-lg-6">
        <div class="card">
            <form method="POST">
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <br>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="reset">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>