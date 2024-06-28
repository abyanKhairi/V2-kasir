<div class="section-header">
    <h1>Costumers</h1>
</div>
<?php
$pesan =  isset($_GET['pesan']) ? $_GET['pesan'] : '';

switch ($pesan) {
    case 'gagal':
        echo "  <div class='alert alert-danger alert-dismissible show fade'>
            <div class='alert-body'>
                <button class='close' data-dismiss='alert'>
                    <span>&times;</span>
                </button>
                Costumer Gagal Untuk Dihapus Karena Masih Terkait Dengan Transaksi Lainnya
            </div>
            </div>";
        break;
    case 'success':
        echo "  <div class='alert alert-success alert-dismissible show fade'>
    <div class='alert-body'>
        <button class='close' data-dismiss='alert'>
            <span>&times;</span>
        </button>
        Costumer Berhasil Untuk Dihapus
    </div>
    </div>";
        break;
    default:
        break;
}
?>

<div class="col-18 col-md-16 mb-md-2 col-lg-12">
    <form action="" method="post">
        <div class="form-grup">
            <div class="row">
                <div class="col-3">
                    <input type="text" class="form-control" size="5" name="keyword" autocomplete="off" placeholder="Cari Nama Costumer">
                </div>
                <button class="btn btn-primary btn-action mr-1" type="submit" style="cursor: pointer;" name="cari"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
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
                    if (isset($_POST['cari'])) {
                        $key = $_POST['keyword'];
                    }

                    $paging = new Page($pdo, 'pembeli');
                    $rows = $paging->get_data(@$key, 'nama');
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
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=costumer&halaman=<?= $paging->prev_page() ?>" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $pages; $i++) {
                            ?>
                                <a class="page-link" href="index.php?page=costumer&halaman=<?= $i; ?>"><?= $i ?> </a>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=costumer&halaman=<?= $paging->next_page() ?>" tabindex="-1"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>