<div class="section-header">
    <h1>Product</h1>
</div>

<?php
$pesan =  isset($_GET['pesan']) ? $_GET['pesan'] : '';

switch ($pesan) {
    case 'gagal':
        echo "<div class='alert alert-danger alert-dismissible show fade'>
                <div class='alert-body'>
                    <button class='close' data-dismiss='alert'>
                        <span>&times;</span>
                    </button>
                    Product Gagal Untuk Dihapus Karena Masih Terkait Dengan Transaksi Lainnya
                </div>
            </div>";
        break;
    case 'success':
        echo "<div class='alert alert-success alert-dismissible show fade'>
                <div class='alert-body'>
                    <button class='close' data-dismiss='alert'>
                        <span>&times;</span>
                    </button>
                    Product Berhasil Untuk Dihapus
                </div>
            </div>";
        break;
    default:
        break;
}
?>

<form action="" method="post">
    <div class="form-grup">
        <div class="row">
            <div class="col-3 mb-md-2">
                <input type="text" class="form-control" size="5" name="keyword" autocomplete="off" placeholder="Cari Nama Product">
            </div>
            <button class="btn btn-primary btn-action mr-1" type="submit" style="cursor: pointer;" name="cari"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>


<div class="card">

    <div class="card-header">
        <div class="card-header">
            <h4 class="d-inline">Product List</h4>
        </div>
        <div class="text-right">
            <!-- Button trigger modal -->
            <a href="index.php?page=product&act=create"> <button type="button" class="btn btn-primary">
                    Tambah Product
                </button>
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md text-center ">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Product</th>
                    <th scope="col">Jumlah Product</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Action</th>
                </tr>
                <?php
                $pdo = Koneksi::connect();
                $paging = Page::getInstance($pdo, 'product');

                if (isset($_POST['cari'])) {
                    $key = $_POST['keyword'];
                }
                $rows = $paging->get_data(@$key, 'nama_produk');
                $pages = $paging->get_pagination_number();
                $i = 1;
                foreach ($rows as $row) :
                ?>
                    <tr>
                        <td class="align-middle"><?php echo $i ?></td>
                        <td class="align-middle">
                            <img src="page/product/img/<?php echo $row["gambar"] ?>" width="90px" alt="gambar">
                        </td>
                        <td class="align-middle"><?php echo $row["nama_produk"] ?></td>
                        <?php
                        if ($row["jumlah_produk"] == 0) { ?>
                            <td class="align-middle"><span class="badge badge-warning">Habis</span></td>
                        <?php
                        } else {
                        ?>
                            <td class="align-middle"><span class="badge badge-light"><?php echo $row["jumlah_produk"] ?></span></td>
                        <?php } ?>
                        <td class="align-middle">Rp. <?php echo number_format($row["harga_produk"]) ?></td>
                        <td class="align-middle">
                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=product&act=edit&id=<?php echo $row["id_produk"] ?>"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-action tombol-hapus" data-toggle="tooltip" title="Delete" href="index.php?page=product&act=delete&id=<?php echo $row['id_produk'] ?>'"><i class="fas fa-trash"></i></a>
                        </td>
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
                            <a class="page-link" href="index.php?page=product&halaman=<?= $paging->prev_page() ?>" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $pages; $i++) :
                            $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : '';
                            if ($halaman == $i) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link active" href="index.php?page=product&halaman=<?= $i; ?>"><?= $i ?> </a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link active" href="index.php?page=product&halaman=<?= $i; ?>"><?= $i ?> </a>
                                </li>
                        <?php
                            }
                        endfor;
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=product&halaman=<?= $paging->next_page() ?>"><i class="fas fa-chevron-right"></i></a>
                        </li>
                        <?php
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>