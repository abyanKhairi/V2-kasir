<?php
$pdo = Koneksi::connect();
$produk = new produk($pdo);

$id_produk = $_GET['id'];

if (isset($_POST['update'])) {
    $nama_produk = $_POST['nama_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $harga_produk = $_POST['harga_produk'];

    $produk->update($id_produk, $nama_produk, $jumlah_produk, $harga_produk);


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
$pdo =  Koneksi::disconnect();
?>


<div class="section-header">
    <h1>Product</h1>
</div>
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <form method="post">
                <div class="card-header">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Product</label>
                        <input type="text" class="form-control" name="nama_produk" required value="<?php echo $nama_produk ?>">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Product</label>
                        <input type="number" class="form-control" required name="jumlah_produk" value="<?php echo $jumlah_produk ?>">
                    </div>
                    <div class="form-group">
                        <label>Harga Satuan</label>
                        <input type="number" class="form-control" required name="harga_produk" value="<?php echo $harga_produk ?>">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>