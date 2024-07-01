<?php
$pdo = Koneksi::connect();
$produk = new produk($pdo);


if (isset($_POST["tambah"])) {

    $nama_produk = $_POST['nama_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $harga_produk = $_POST['harga_produk'];

    if ($produk->tambah($nama_produk, $jumlah_produk, $harga_produk)) {
        echo "<script>window.location.href = 'index.php?page=product'</script>";
    };
}

$pdo = Koneksi::connect();
$produk = new produk($pdo);
if (isset($_POST['update'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $harga_produk = $_POST['harga_produk'];
    $produk->update($id_produk, $nama_produk, $jumlah_produk, $harga_produk);
}

$pdo =  Koneksi::disconnect();
?>

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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal">
                Tambah Product
            </button>
        </div>
    </div>

    <div class="card-body p-0" style="text-align : center;">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Product</th>
                    <th scope="col">Jumlah Product</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Action</th>
                </tr>
                <?php
                $pdo = Koneksi::connect();
                $paging = new Page($pdo, 'product');

                if (isset($_POST['cari'])) {
                    $key = $_POST['keyword'];
                }
                $rows = $paging->get_data(@$key, 'nama_produk');
                $pages = $paging->get_pagination_number();
                $i = 1;
                foreach ($rows as $row) :
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["nama_produk"] ?></td>
                        <td><?php echo $row["jumlah_produk"] ?></td>
                        <td>Rp. <?php echo number_format($row["harga_produk"]) ?></td>
                        <td>
                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=product&act=edit&id=<?php echo $row["id_produk"] ?>"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-primary btn-action mr-1" data-toggle="modal" title="Edit" data-target="#productModal<?php echo $row['id_produk'] ?>"><i class="fas fa-person"></i></a>
                            <a class="btn btn-danger btn-action tombol-hapus" data-toggle="tooltip" title="Delete" href="index.php?page=product&act=delete&id=<?php echo $row['id_produk'] ?>'"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <!--Edit Modal-->
                    <div class="modal fade" id="productModal<?= $row['id_produk'] ?>" data-backdrop="" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title h5" id="staticBackdropLabel">Edit Data Product</h1>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="hidden" value="<?php echo $row["id_produk"] ?>" name="id_produk">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama Product </label>
                                                <input type="text" autocomplete="off" autofocus class="form-control" name="nama_produk" value="<?php echo $row["nama_produk"] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Product</label>
                                                <input type="number" autocomplete="off" class="form-control" required name="jumlah_produk" value="<?php echo $row["jumlah_produk"] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Satuan</label>
                                                <input type="number" autocomplete="off" class="form-control" required name="harga_produk" value="<?php echo $row["harga_produk"] ?>">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="update">
                                                    Update
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
                    <!--akhir modal edit-->

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
                        for ($i = 1; $i <= $pages; $i++) {
                        ?>
                            <a class="page-link" href="index.php?page=product&halaman=<?= $i; ?>"><?= $i ?> </a>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=product&halaman=<?= $paging->next_page() ?>" tabindex="-1"><i class="fas fa-chevron-right"></i></a>
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


<!--Modal-->
<div class="modal fade" id="productModal" data-backdrop="" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="staticBackdropLabel">Tambah Data Product</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Product</label>
                            <input type="text" autocomplete="off" autofocus class="form-control" name="nama_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Product</label>
                            <input type="number" autocomplete="off" class="form-control" required name="jumlah_produk">
                        </div>

                        <div class="form-group">
                            <label>Harga Satuan</label>
                            <input type="number" autocomplete="off" class="form-control" required name="harga_produk">
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