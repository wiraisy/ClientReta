<div class="section">
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Info!</strong> Berikut informasi detail produk yang anda pilih, <strong>Add To Cart</strong> untuk menambahkan ke keranjang anda.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Main Content -->
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid" src="<?= base_url() ?>assets/img/products/produk-pilihan-1.JPG" alt="">
                </div>
                <div class="col-md-6">
                    <h1>Wardah Lotion</h1>
                    <div class="row">
                        <div class="col-md-8">
                            <p>Rp. 30.000</p>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success btn-sm">Andalan</button>
                        </div>
                    </div>
                    <hr>
                    <form action="" method="POST">
                        <div style="display: flex;align-items: center;">
                                <div>
                                    <p class="my-0">Jumlah :</p>
                                </div>
                                <div class="pl-2">
                                    <input type="number" class="form-control" style="width: 100px;" required />
                                </div>
                        </div>
                        <button type="submit" class="mt-4 btn" style="background: #eba0ce;"><span><i class="fas fa-cart-plus"></i></span> Add to Cart</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    