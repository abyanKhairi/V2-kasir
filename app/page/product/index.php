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
                                            <th scope="col">Harga Product</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        <?php
                                        $show = "SELECT * FROM `product`";
                                        $produk->viewData($show);

                                        ?>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
            </div>

            </section>
        </div>





