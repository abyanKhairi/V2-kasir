<!-- Main Content -->
<div class="section-header">
    <h1>Transaksi</h1>
</div>

<div class="col-18 col-md-16 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Transaksi Information</h4>
        </div>
        <div class="card-body p-0" style="text-align : center;">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Costumer</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Tlp</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Action</th>
                    </tr>
                    <?php
                    $pdo = Koneksi::connect();
                    $transaksi = new Transaksi($pdo);
                    $rows = $transaksi->getTransaksi("transaksi");
                    $i = 1;
                    foreach ($rows as $row) :
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["id_transaksi"] ?></td>
                            <td><?php echo $row["tanggal_transaksi"] ?></td>
                            <td><?php echo $row["nama"] ?></td>
                            <td><?php echo $row["alamat"] ?></td>
                            <td><?php echo $row["no_tlp"] ?></td>
                            <td><?php echo "jumlah" ?></td>
                            <td>
                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Detail" href="index.php?page=transaksi&act=detail&id=<?php echo $row["id_transaksi"] ?>"><i class="fas fa-shopping-cart"></i></a>
                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah Anda Yakin Ingin Menghapus Data Ini?" data-confirm-yes="window.location.href='index.php?page=product&act=delete&id=<?php echo $row['id_transaksi'] ?>'"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    $pdo =  Koneksi::disconnect();
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>