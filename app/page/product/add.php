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

    $produk = produk::getInsatance($pdo);
    if ($produk->tambah($nama_produk, $jumlah_produk, $harga_produk, $gambarProduk)) {
        echo "<script>window.location.href = 'index.php?page=product'</script>";
    };
}

?>


<div class="section-header">
    <h1>Product</h1>
</div>

<div class="row">
    <div class="col-3 col-md-6 col-lg-7">
        <div class="card">
            <form method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Tambah Product</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nama Product</label>
                            <input type="text" autocomplete="off" autofocus class="form-control" name="nama_produk" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jumlah Product</label>
                            <input type="number" autocomplete="off" class="form-control" required name="jumlah_produk">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Harga Satuan</label>
                            <input type="number" autocomplete="off" class="form-control" required name="harga_produk">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gambar Product</label>
                            <input type="file" autocomplete="off" class="form-control" required name="gambar">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="swal-8" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>