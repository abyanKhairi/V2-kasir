<?php


if (isset($_POST["submit"])) {


    $nama_produk = $_POST['nama_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $harga_produk = $_POST['harga_produk'];

    $produk->tambah($nama_produk, $jumlah_produk, $harga_produk);
}

?>


<div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Product</h1>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <form method="post">
                                    <div class="card-header">
                                        <h4>Tambah Product</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nama Product</label>
                                            <input type="text" class="form-control" name="nama_produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Product</label>
                                            <input type="number" class="form-control" required name="jumlah_produk">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Satuan</label>
                                            <input type="number" class="form-control" required name="harga_produk">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>





</div>
</section>
</div>