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
            $rows = $user->viewData();
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
            $pdo =  Koneksi::disconnect();
            ?>
        </ul>
    </div>
</div>