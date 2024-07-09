<?php

$pdo = Koneksi::connect();

$costumer = costumer::getInsatance($pdo);
if (isset($_POST['cari'])) {
    $key = $_POST['keyword'];
}
$paging = Page::getInstance($pdo, 'pembeli');
$rows = $paging->get_data(@$key, 'nama');
$pages = $paging->get_pagination_number();

$pdo = Koneksi::disconnect();
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
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>