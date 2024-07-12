<?php
$pdo = Koneksi::connect();
$crudUser = user::getInstance($pdo);

$id_user = $_GET["id"];

if (isset($_POST["reset"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($crudUser->resetPassword($id_user, $username, $password, $email)) {
        // echo '<script>window.location.href ="index.php?"</script>';
    } else {
        echo '<script>alert("Gak bisa")</script>';
    }
}

?>

<div class="section-header">
    <h1>Change Password</h1>
</div>
<div class="row">
    <div class="col-8 col-md-8 col-lg-8">
        <div class="card">
            <form method="POST">
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" autocomplete="off" placeholder="Email" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password">New Password</label>
                            <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="New Password" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="reset">
                            Change Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>