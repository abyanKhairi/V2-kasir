<?php


if (isset($_POST["submit"])) {


    $nama_produk = $_POST['nama_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $harga_produk = $_POST['harga_produk'];

    $extensi = explode(".", $_FILES['gambar']['name']);
    $gambarProduk = "gambar-" . round(microtime(true)) . "." . end($extensi);
    $sumber = $_FILES['gambar']['tmp_name'];
    $upload = move_uploaded_file($sumber, "page/product/img/" . $gambarProduk);

    $pdo = Koneksi::connect();

    $produk = new produk($pdo);
    if ($produk->tambah($nama_produk, $jumlah_produk, $harga_produk, $gambarProduk)) {
        echo "<script>window.location.href = 'index.php?page=product'</script>";
    };

    $pdo =  Koneksi::disconnect();
}

?>


<div class="section-header">
    <h1>Product</h1>
</div>

<div class="row">
    <div class="col-3 col-md-29 offset-lg-4 col-lg-26">
        <div class="card">
            <form method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Tambah Product</h4>
                </div>
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
                    <div class="form-group">
                        <label>Gambar Product</label>
                        <input type="file" autocomplete="off" class="form-control" required name="gambar">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit" id="swal-8" name="submit">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>