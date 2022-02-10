<style>
    .btn-remove:hover{
        cursor: pointer;
    }
    .bootstrap-select button{
        background: white!important;
        text-transform: inherit!important;
        font-weight: normal!important;
    }
    .carousel-control-prev{
        left: -60px;
        top: -50px;
    }
    .carousel-control-next{
        right: -60px;
        top: -50px;
    }
    .fa-chevron-left , .fa-chevron-right{
        color: #dc3545;
        font-size: 26px;
    }
    .img-produk-sebelum:hover{
        box-shadow: 0 0 11px rgba(33,33,33,.2); 
        cursor: pointer;
    }
    .title-produk-sebelum:hover{
        cursor: pointer;
        text-decoration: underline;
    }
</style>
    <div class="section">
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Info!</strong> Silahkan pilih produk yang anda inginkan dengan klik form dibawah ini
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body bg-gradient-pink" style="color: white;">
                    <label for="pilih-produk">Pesan Produk Anda Sebelumnya</label>
                    <select class="form-control selectpicker" id="selectPesananSebelum" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                        <option selected disabled>Fitur ini belum tersedia</option>
                    </select>
                </div>
            </div>  
            <div class="card mt-2">
                <div class="card-body bg-gradient-pink" style="color: white;">
                    <label for="pilih-produk">Pesan Produk Umum</label>
                    <select class="form-control selectpicker" id="selectPesananUmum" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                        <option selected disabled>Pilih produk yang anda inginkan</option>
                        <?php if(isset($produkumum)){ ?>
                            <?php foreach ($produkumum as $row_produkumum) { ?>
                                <option value="<?= $row_produkumum['idproduk'] ?>"><?= $row_produkumum['namabarang'] ?></option>
                            <?php } ?>
                        <?php }else{?>
                                <option disabled>Data Produk Umum Tidak Tersedia</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body bg-gradient-pink" style="color: white;">
                    <label for="pilih-produk">Pesan Produk Andalan</label>
                    <select class="form-control selectpicker" id="selectPesananAndalan" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                        <option selected disabled>Pilih produk yang anda inginkan</option>
                        <?php if(isset($produkandalan)){ ?>
                            <?php foreach ($produkandalan as $row_produkandalan) { ?>
                                <option value="<?= $row_produkandalan['idproduk'] ?>"><?= $row_produkandalan['namabarang'] ?></option>
                            <?php } ?>
                        <?php }else{?>
                                <option disabled>Data Produk Andalan Tidak Tersedia</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>

            <div class="container">
                <!-- List Pesanan -->
                <form action="<?= base_url('checkout-product') ?>" enctype="multipart/form-data" method="POST">
                    <div class="list-pesanan">
                        <!-- List Pesanan -->
                    </div>
                    <br>
                    <br>
                    <div style="text-align: right;"><button type="submit" class="btn btn-outline-danger btn-round">Checkout</button></div>  
                </form>
                <hr>
                <h6 style="text-align: center;">Produk yang mungkin anda sukai</h6>
                <!-- Produk Andalan-->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                            $numOfCols = 4;
                            $rowCount = 0;
                            foreach ($produkandalan as $row_produkandalan){
                                if($rowCount % $numOfCols == 0) { ?> <div class="carousel-item py-5 <?= ($rowCount == 0) ? 'active' : ''?>"> <div class="row"> <?php } 
                                    $rowCount++; ?>  
                                        <div class="col-md-3 col-6 text-center">
                                            <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" onclick="window.open('<?= base_url() ?>product-detail/<?= $row_produkandalan['idproduk'] ?>/<?= str_replace(' ','',$row_produkandalan['namabarang']) ?>');" alt="Rounded image" class="img-fluid rounded img-produk-sebelum" style="width: 150px;">
                                            <br>
                                            <small class="d-block text-uppercase font-weight-bold mb-4 title-produk-sebelum"  onclick="window.open('<?= base_url() ?>product-detail/<?= $row_produkandalan['idproduk'] ?>/<?= str_replace(' ','',$row_produkandalan['namabarang']) ?>') ;"><?= $row_produkandalan['namabarang'] ?>
                                            <br>
                                            Rp. <?= $row_produkandalan['hargajual'] ?>
                                            </small>
                                        </div>
                                <?php
                                if($rowCount % $numOfCols == 0) { ?> </div></div> <?php } 
                            } ?>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/js/custom/select-option-pesanan.js"></script>

    <script>
        $(function () {
            $('select').selectpicker();
        });
    </script>

    <script>
        var myHeaders = new Headers();
        myHeaders.append("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");

        var requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow'
        };

        fetch("https://api-reta.id/reta-api/Produk/GetAllProdukbyFilterandPagination", requestOptions)
        .then(response => response.text())
        .then(result => console.log(result))
        .catch(error => console.log('error', error));
    </script>