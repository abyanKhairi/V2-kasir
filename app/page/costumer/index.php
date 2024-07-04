<?php

if (isset($_POST["tambah"])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];

    $pdo = Koneksi::connect();

    $costumer = new costumer($pdo);
    if ($costumer->tambah($nama, $alamat, $no_tlp)) {
        echo "<script>window.location.href = 'index.php?page=costumer'</script>";
    };
    $pdo =  Koneksi::disconnect();
}

?>

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
            <div class="card-header">
                <h4 class="d-inline">Costumers List</h4>
            </div>
            <div class="text-right">
                <!-- Button trigger modal -->
                <a href="index.php?page=costumer&act=create"> <button type="button" class="btn btn-primary">
                        Tambah Costumer
                    </button>
                </a>
            </div>
        </div>

        <div class="card-body p-0" style="text-align : center;">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Status Member</th>
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
                        $anggota = $costumer->showMember($row["id_pembeli"])

                    ?>
                        <tr>
                            <td class="align-middle"><?php echo $i ?></td>
                            <td class="align-middle"><?php echo $row["nama"] ?></td>
                            <td class="align-middle"><?php echo $row["alamat"] ?></td>
                            <td class="align-middle"><?php echo $row["no_tlp"] ?></td>
                            <td class="align-middle"><?php echo $anggota ?></td>
                            <td class="align-middle">
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
                            <li class="page-item ">
                                <a class="page-link" href="index.php?page=costumer&halaman=<?= $paging->prev_page() ?>" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $pages; $i++) :
                                $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : '';
                                if ($halaman == $i) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link active" href="index.php?page=costumer&halaman=<?= $i; ?>"><?= $i ?> </a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link active" href="index.php?page=costumer&halaman=<?= $i; ?>"><?= $i ?> </a>
                                    </li>
                            <?php
                                }
                            endfor;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=costumer&halaman=<?= $paging->next_page() ?>"><i class="fas fa-chevron-right"></i></a>
                            </li>
                            <?php
                            $pdo =  Koneksi::disconnect();
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->

<div class="modal fade" id="costumerModal" data-backdrop="" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="staticBackdropLabel">Tambah Data Costumer</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Name</label>
                            <input id="nama" type="text" class="form-control" autocomplete="off" name="nama" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input id="alamat" type="text" class="form-control" autocomplete="off" name="alamat" required>
                        </div>

                        <div class="form-group">
                            <label>Nomor Telpon</label>
                            <input type="text" autocomplete="off" class="form-control" required name="no_tlp">
                        </div>
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