<?php
$pdo = Koneksi::connect();
$produk = produk::getInsatance($pdo);

$id_produk = $_GET['id'];

if (isset($_POST['update'])) {
    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $jumlah_produk = htmlspecialchars($_POST['jumlah_produk']);
    $harga_produk = htmlspecialchars($_POST['harga_produk']);



    if ($produk->update($id_produk, $nama_produk, $jumlah_produk, $harga_produk) == true) {
?>
        <script>
            window.location.href = "index.php?page=product"
        </script>
<?php
    }
}

if (isset($id_produk)) {
    extract($produk->getID($id_produk));
}
?>


<div class="section-header">
    <h1>Product</h1>
</div>
<div class="row">
    <div class="col-3 col-md-6 col-lg-7">
        <div class="card">
            <form method="post">
                <div class="card-header">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nama Product</label>
                            <input type="text" class="form-control" autocomplete="off" name="nama_produk" required value="<?php echo $nama_produk ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jumlah Product</label>
                            <input type="number" class="form-control" autocomplete="off" required name="jumlah_produk" value="<?php echo $jumlah_produk ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Harga Satuan</label>
                            <input type="numer" class="form-control" autocomplete="off" required name="harga_produk" value="<?php echo $harga_produk ?>">
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>