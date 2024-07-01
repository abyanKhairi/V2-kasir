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

    $pdo =  Koneksi::disconnect();
}
?>

<!-- Main Content -->
<div class="section-header">
    <h1>User</h1>
</div>

<form action="" method="post">
    <div class="form-grup">
        <div class="row">
            <div class="col-3 mb-md-2">
                <input type="text" class="form-control" size="5" name="keyword" autocomplete="off" placeholder="Cari Nama Costumer">
            </div>
            <button class="btn btn-primary btn-action mr-1" type="submit" style="cursor: pointer;" name="cari"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
<br>
<div class="card">

    <div class="card-header">
        <div class="card-header">
            <h4 class="d-inline">User List</h4>
        </div>
        <div class="text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">
                Tambah user
            </button>
        </div>

    </div>
    <div class="card-body">
        <ul class="list-unstyled list-unstyled-border">
            <?php
            $pdo = Koneksi::connect();
            if (isset($_POST['cari'])) {
                $key = $_POST['keyword'];
            }
            $paging = new Page($pdo, 'user');
            $rows = $paging->get_data(@$key, 'nama');
            $pages = $paging->get_pagination_number();
            foreach ($rows as $row) {
            ?>
                <li class="media">
                    <img class="mr-3 rounded-circle" width="50" src="../../assets/img/avatar/avatar-4.png" alt="avatar">
                    <div class="media-body">
                        <h6 class="media-title"> <span style="cursor:default" data-toggle="tooltip" title="Nama"> <?php echo $row["nama"] ?> </span> </h6>
                        <div class="text-small text-muted"><span style="cursor:default" data-toggle="tooltip" title="Username">@<?php echo $row["username"] ?> </span>
                            <div class="bullet"></div> <span style="cursor:default" data-toggle="tooltip" title="Email"> <?php echo $row["email"] ?> </span>
                            <div class=" bullet"></div> <span style="cursor:default" data-toggle="tooltip" title="role" class="text-primary"><?php echo $row["role"] ?></span>
                        </div>
                    </div>
                    <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=user&act=edit&id=<?php echo $row["id_user"] ?>"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action tombol-hapus" data-toggle="tooltip" title="Delete" href='index.php?page=user&act=delete&id=<?php echo $row['id_user'] ?>'><i class="fas fa-trash"></i></a>
                    </td>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <div class="card-footer text-right">
        <nav class="d-inline-block">
            <ul class="pagination mb-0">
                <li class="page-item ">
                    <?php
                    ?>
                    <a class="page-link" href="index.php?page=user&halaman=<?= $paging->prev_page() ?>" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                </li>
                <?php
                for ($i = 1; $i <= $pages; $i++) {
                ?>
                    <a class="page-link" href="index.php?page=user&halaman=<?= $i; ?>"><?= $i ?> </a>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=user&halaman=<?= $paging->next_page() ?>"><i class="fas fa-chevron-right"></i></a>
                </li>
                <?php
                $pdo =  Koneksi::disconnect();
                ?>
            </ul>
        </nav>
    </div>
</div>


<!-- Modal -->

<div class="modal fade" id="userModal" data-backdrop="" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="staticBackdropLabel">Tambah Data User</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama">Name</label>
                                <input id="nama" type="text" class="form-control" autocomplete="off" name="nama" autofocus required>
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" autocomplete="off" name="username" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" autocomplete="off" name="email" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" type="text" class="form-control" autocomplete="off" name="alamat" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="not_tlp">Nomor Telpon</label>
                                <input id="not_tlp" type="text" class="form-control" autocomplete="off" name="not_tlp" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Role</label>
                                <select class="form-control selectric" name="role" required>
                                    <option value="admin">admin</option>
                                    <option value="superAdmin">superAdmin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="d-block">Password</label>
                            <input id="password" type="password" autocomplete="off" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="tambah">
                                Tambah
                            </button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>