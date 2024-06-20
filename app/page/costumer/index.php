<div class="section-header">
    <h1>Costumers</h1>
</div>

<div class="col-18 col-md-16 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Costumers Information</h4>
        </div>
        <div class="card-body p-0" style="text-align : center;">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Action</th>
                    </tr>
                    <?php
                    $pdo = Koneksi::connect();
                    $costumer = new costumer($pdo);
                    $paging = new Page($pdo, 'pembeli');
                    $rows = $paging->get_data();
                    $pages = $paging->get_pagination_number();
                    $i = 1;
                    foreach ($rows as $row) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["nama"] ?></td>
                            <td><?php echo $row["alamat"] ?></td>
                            <td><?php echo $row["no_tlp"] ?></td>
                            <td>
                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=costumer&act=edit&id=<?php echo $row["id_pembeli"] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-action tombol-hapus" data-toggle="tooltip" title="delete" href='index.php?page=costumer&act=delete&id=<?php echo $row['id_pembeli'] ?>' id="delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                    <?php $i++;
                    }
                    $pdo =  Koneksi::disconnect();
                    ?>
                </table>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $pages; $i++) {
                            ?>
                                <a class="page-link" href="index.php?page=costumer&halaman=<?= $i; ?>"><?= $i ?> </a>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>