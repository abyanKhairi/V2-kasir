<div class="main-content">
    <section class="section">
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
                                <th scope="col">Nama Product</th>
                                <th scope="col">Jumlah Product</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Action</th>
                            </tr>
                            <?php
                            $show = "SELECT * FROM `product`";
                            $produk->viewData($show);

                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

</section>
</div>