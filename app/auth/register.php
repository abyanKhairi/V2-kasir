<?php

//cek status user

if ($user->isLoggedIn()) {
    header("Location: ../app/index.php");
}

// cek data register yang dikirim


if (isset($_POST["regis"])) {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $not_tlp = $_POST["not_tlp"];
    $role = $_POST["role"];

    $pdo = Koneksi::connect();
    if ($user->register($nama, $username, $email, $password, $alamat, $not_tlp, $role)) {

        $success = true;
    } else {
        $error = $user->getLasrError();
    }
    $pdo = Koneksi::disconnect();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; Stisla</title>

    <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="../assets/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST">

                                    <?php if (isset($error)) : ?>
                                        <div class="error">
                                            <?php echo $error ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($success)) : ?>
                                        <div class="success">
                                            Berhasil mendaftar. Silakan <a href="index.php?auth=login">login</a>.
                                        </div>
                                    <?php endif; ?>

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


                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                                            <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="regis">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Alredy Have account? <a href="index.php?auth=login">Log In</a>
                        </div>
                        <div class="simple-footer">
                            <!--copyright-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="../assets/modules/jquery.min.js"></script>
    <script src="../assets/modules/popper.js"></script>
    <script src="../assets/modules/tooltip.js"></script>
    <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../assets/modules/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>
    <script src="../assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="../assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="../assets/js/page/auth-register.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
</body>

</html>