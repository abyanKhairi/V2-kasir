<div class="section-header">
    <h1>Product</h1>
</div>

<div class="col-18 col-md-16 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Product Information</h4>
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
                    $rows = $pdo->query("SELECT * FROM `product`");
                    $i = 1;
                    foreach ($rows as $row) :
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["nama_produk"] ?></td>
                            <td><?php echo $row["jumlah_produk"] ?></td>
                            <td><?php echo $row["harga_produk"] ?></td>
                            <td>
                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="index.php?page=product&act=edit&id=<?php echo $row["id_produk"] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah Anda Yakin Ingin Menghapus Data Ini?" data-confirm-yes="window.location.href='index.php?page=product&act=delete&id=<?php echo $row['id_produk'] ?> Berhasil Di Hapus'"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    Koneksi::disconnect();
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>