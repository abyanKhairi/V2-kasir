<!-- Main Content -->

<div class="section-header">
    <h1>User</h1>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="d-inline">User List</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled list-unstyled-border">
            <?php
            $pdo = Koneksi::connect();

            $user = new user($pdo);
            $rows = $user->viewData("user");
            foreach ($rows as $row) {
            ?>
                <li class="media">
                    <img class="mr-3 rounded-circle" width="50" src="../../assets/img/avatar/avatar-4.png" alt="avatar">
                    <div class="media-body">
                        <h6 class="media-title"><?php echo $row["nama"] ?></h6>
                        <div class="text-small text-muted">@<?php echo $row["username"] ?> <div class="bullet"></div> <?php echo $row["email"] ?> <div class="bullet"></div> <span style="cursor:default" data-toggle="tooltip" title="role" class="text-primary"><?php echo $row["role"] ?></span></div>
                    </div>
                    <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=user&act=edit&id=<?php echo $row["id_user"] ?>"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action tombol-hapus" data-toggle="tooltip" href='index.php?page=user&act=delete&id=<?php echo $row['id_user'] ?>'><i class="fas fa-trash"></i></a>
                    </td>
                </li>
            <?php
            }
            $pdo =  Koneksi::disconnect();
            ?>
        </ul>
    </div>
</div>