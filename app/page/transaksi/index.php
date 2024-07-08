<!-- Main Content -->
<div class="section-header">
    <h1>Transaksi</h1>
</div>
<?php
if (isset($_POST['cari'])) {
    $key = $_POST['keyword'];
}
$pesan =  isset($_GET['pesan']) ? $_GET['pesan'] : '';

switch ($pesan) {
    case 'gagal':
        echo "  <div class='alert alert-danger alert-dismissible show fade'>
            <div class='alert-body'>
                <button class='close' data-dismiss='alert'>
                    <span>&times;</span>
                </button>
                Transaksi Gagal Untuk Dihapus Karena Masih Terkait Dengan Transaksi Lainnya
            </div>
            </div>";
        break;
    case 'success':
        echo "  <div class='alert alert-success alert-dismissible show fade'>
    <div class='alert-body'>
        <button class='close' data-dismiss='alert'>
            <span>&times;</span>
        </button>
        Transaksi Berhasil Untuk Dihapus
    </div>
    </div>";
        break;
    default:
        break;
}
?>

<div class="col-18 col-md-16 mb-md-3 col-lg-12">
    <div class="text-right">
        <a href="index.php?cetak=transaksi&tanggal=<?= @$key ?>">
            <button class="btn btn-primary btn-action">Cetak</button>
        </a>
    </div>

    <form action="" method="post">
        <div class="">
            <select name="cekStatus">
                <option value="SELESAI">DIbayar</option>
                <option value="PENDING">Belum Bayar</option>
            </select>
            <button class="btn btn-primary btn-action mr-1" type="submit" style="cursor: pointer;" name="cari"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <form action="" method="post">
        <div class="form-grup">
            <div class="row">
                <div class="col-3">
                    <input type='date' class="form-control" name="keyword" autocomplete="off" placeholder="YYYY-MM-DD">
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
                <h4 class="d-inline">Transaksi List</h4>
            </div>
            <div class="text-right">
                <!-- Button trigger modal -->
                <a href="index.php?page=transaksi&act=create"> <button type="button" class="btn btn-primary">
                        Tambah Transaksi
                    </button>
                </a>
            </div>
        </div>

        <div class="card-body p-0" style="text-align : center;">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Costumer</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>

                    <?php
                    $pdo = Koneksi::connect();
                    $transaksi = new Transaksi($pdo);
                    $paging = new Page($pdo, 'transaksi');
                    $rows = $transaksi->getTransaksi(@$key);
                    $pages = $paging->get_pagination_number();
                    $i = 1;
                    foreach ($rows as $row) :
                        $cek = $transaksi->getIdBayar($row['id_transaksi'])
                    ?>
                        <tr>
                            <td class="align-middle"><?php echo $i ?></td>
                            <td class="align-middle"><?php echo $row["tanggal_transaksi"] ?></td>
                            <td class="align-middle"><?php echo $row["nama"] ?></td>
                            <td class="align-middle"><?php echo $transaksi->jumlahT($row["id_transaksi"]) ?></td>
                            <td class="align-middle"><?php echo $row["no_tlp"] ?></td>
                            <td class="align-middle"><?php echo $row["alamat"] ?></td>
                            <?php
                            if ($row["status"] === 'SELESAI') {
                            ?>
                                <td class="align-middle"><span class="badge badge-success">Dibayar</span></td>
                            <?php } else { ?>
                                <td class="align-middle"><span class="badge badge-warning">Belum Dibayar</span></td>
                            <?php } ?>
                            <?php
                            if ($row["status"] === "SELESAI") {
                            ?>
                                <td class="align-middle">
                                    <a class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Struk" href="index.php?page=struk&act=total&id_struk=<?php echo $cek["id_bayar"] ?>"><i class="fas fa-file"></i></a>
                                    <a class="btn btn-danger btn-action tombol-hapus" data-toggle="tooltip" title="Delete" href="index.php?page=transaksi&act=delete&id=<?php echo $row['id_transaksi'] ?>'"><i class="fas fa-trash"></i></a>
                                </td>
                            <?php
                            } else {
                            ?>
                                <td>
                                    <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Detail" href="index.php?page=transaksi&act=detail&id=<?php echo $row["id_transaksi"] ?>"><i class="fas fa-shopping-cart"></i></a>
                                    <a class="btn btn-danger btn-action tombol-hapus" data-toggle="tooltip" title="Delete" href="index.php?page=transaksi&act=delete&id=<?php echo $row['id_transaksi'] ?>'"><i class="fas fa-trash"></i></a>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </table>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item ">
                                <a class="page-link" href="index.php?page=transaksi&halaman=<?= $paging->prev_page() ?>" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $pages; $i++) :
                                $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : '';
                                if ($halaman == $i) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link active" href="index.php?page=transaksi&halaman=<?= $i; ?>"><?= $i ?> </a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link active" href="index.php?page=transaksi&halaman=<?= $i; ?>"><?= $i ?> </a>
                                    </li>
                            <?php
                                }
                            endfor;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=transaksi&halaman=<?= $paging->next_page() ?>"><i class="fas fa-chevron-right"></i></a>
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