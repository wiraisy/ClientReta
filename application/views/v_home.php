<style>
    .btn-remove:hover{
        cursor: pointer;
    }
</style>
    <div class="section">
        <div class="container">
            <div class="container-1">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                    <span class="alert-inner--text"><strong>Info!</strong> Silahkan pilih produk yang anda inginkan dengan klik form dibawah ini</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        <div class="card">
            <div class="card-body bg-gradient-pink" style="color: white;">
                <select class="form-control" id="selectPesananSebelum">
                    <option selected disabled>Pilih produk yang anda inginkan</option>
                    <option value="option1">Produk A</option>
                </select>
            </div>
        </div>  
        <div class="card">
            <div class="card-body bg-gradient-pink" style="color: white;">
                <label for="pilih-produk">Pesan Produk Umum</label>
                <select class="form-control" id="product">
                    <option selected disabled>Pilih produk yang anda inginkan</option>
                    <option value="1">Cleanser Whitening</option>
                </select>
            </div>
        </div> 
        <div class="card">
            <div class="card-body bg-gradient-pink" style="color: white;">
                <label for="pilih-produk">Pesan Produk Andalan</label>
                <select class="form-control" id="product">
                    <option selected disabled>Pilih produk yang anda inginkan</option>
                    <option value="1">Cleanser Whitening</option>
                </select>
            </div>
        </div>
        <br>
        <div class="container">
            <!-- List Pesanan -->
            <form action="<?= base_url('checkout-product') ?>" enctype="multipart/form-data" method="POST">
                <div class="list-pesanan">
                    <div class="form-group" id="test1">
                        <div class="row align-items-center bg-secondary mt-2">
                            <div class="col-md-4">
                                <h5>Loose Powder</h5>
                                <input type="hidden" value="Loose Powder" name="nama_product[]"/>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control-sm text-center" />
                            </div>
                            <div class="col-md-3">
                                <h5 style="text-align: right;">Rp. 250.000</h5>
                                <input type="hidden" value="250000" name="harga_product[]"/>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align: right;">
                                    <i id="" class="fa fa-trash btn-remove" ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="test2">
                        <div class="row align-items-center bg-secondary mt-2">
                            <div class="col-md-4">
                                <h5>Loose Serum</h5>
                                <input type="hidden" value="Loose Serum" name="nama_product[]"/>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control-sm text-center" />
                            </div>
                            <div class="col-md-3">
                                <h5 style="text-align: right;">Rp. 450.000</h5>
                                <input type="hidden" value="450000" name="harga_product[]"/>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align: right;">
                                    <i id="" class="fa fa-trash btn-remove" ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div style="text-align: right;"><button type="submit" class="btn btn-outline-danger btn-round">Checkout</button></div>  
            </form>
            <hr>
            <h6 style="text-align: center;">Produk yang mungkin anda sukai</h6>
            <br>
            <!-- Produk Andalan-->
            <div class="row">
                <div class="col-sm-3 col-6">
                    <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: 150px;">
                    <br>
                    <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 1
                    <br>
                    Rp. xxxxx
                    </small>
                </div>
                <div class="col-sm-3 col-6">
                    <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: 150px;">
                    <br>
                    <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 2
                    <br>
                    Rp. xxxxx
                    </small>
                </div>
                <div class="col-sm-3 col-6">
                    <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: 150px;">
                    <br>
                    <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 3
                    <br>
                    Rp. xxxxx
                    </small>
                </div>
                <div class="col-sm-3 col-6">
                    <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: 150px;">
                    <br>
                    <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 4
                    <br>
                    Rp. xxxxx
                    </small>
                </div>
            </div>
            </div>
        </div>
    </div> 

    
    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/js/custom/select-option-pesanan.js"></script>