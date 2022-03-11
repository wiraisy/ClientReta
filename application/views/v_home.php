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
        left: -100px;
        top: -50px;
    }
    .carousel-control-next{
        right: -100px;
        top: -50px;
    }
    .carousel-control-prev-resp, .carousel-control-next-resp{
        display: none;
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
    .carousel-produk > img {
        width: 200px; /* You can set the dimensions to whatever you want */
        height: 200px;
        object-fit: cover;
    }
    .product-img > img {
        width: 200px; /* You can set the dimensions to whatever you want */
        height: 200px;
        object-fit: cover;
    }
    .input-counter{
        display: flex;
    }
    .counter {
        cursor:pointer; 
    }
    .product-detail > button{
        text-transform: unset!important;
        font-size: 14px;
    }
    .counter-minus, .counter-plus{
        background:#f2f2f2;
        border-radius:4px;
        padding:10px;
        border:1px solid #ddd;
        display: inline-block;
        vertical-align: middle;
        text-align: center;
	}
    .number > input{
        width: 100px;
        text-align: center;
        font-size: 26px;
		border:1px solid #ddd;
		border-radius:4px;
        display: inline-block;
        vertical-align: middle;
    }
    .title-product-car a{
        color: #000;
    }
    .title-product-car a:hover{
        color: grey;
    }
    @media screen and (max-width: 768px) {
        .carousel-produk > img {
            width: 100px; /* You can set the dimensions to whatever you want */
            height: 100px;
        }
        .product-img > img {
            width: 100px; /* You can set the dimensions to whatever you want */
            height: 100px;
        }
        .carousel-control-prev , .carousel-control-next{
            display: none;
        }
        .carousel-control-prev-resp, .carousel-control-next-resp{
            display: initial;
        }
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
                    <select class="form-control selectpicker" name="selectPesananUmum" id="selectPesananUmum" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                        <option selected disabled>Pilih produk yang anda inginkan</option>
                        <?php if($produkumum){ ?>
                            <?php foreach ($produkumum as $row_produkumum) { ?>
                                <option value="<?= $row_produkumum['kodeid'] ?>" class="<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>"><?= $row_produkumum['namabarang'] ?></option>
                            <?php } ?>
                        <?php }else{?>
                                <option disabled>Data Produk Umum Tidak Tersedia</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body bg-gradient-pink" style="color: white;">
                    <label for="pilih-produk">Pesan Produk Pendukung</label>
                    <select class="form-control selectpicker" name="selectPesananAndalan" id="selectPesananAndalan" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                        <option selected disabled>Pilih produk yang anda inginkan</option>
                        <?php if($produkandalan){ ?>
                            <?php foreach ($produkandalan as $row_produkandalan) { ?>
                                <option value="<?= $row_produkandalan['kodeid'] ?>" class="<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>"><?= $row_produkandalan['namabarang'] ?></option>
                            <?php } ?>
                        <?php }else{?>
                                <option disabled>Data Produk Pendukung Tidak Tersedia</option>
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
                    <div style="text-align: right;"><a href="<?= base_url('checkout') ?>" class="btn btn-outline-danger btn-round">Checkout</a></div>  
                </form>
                <hr>
                <h6 style="text-align: center;">Produk yang mungkin anda sukai</h6>
                <!-- Produk Andalan-->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                            $numOfCols = 4;
                            $rowCount = 0;
                            if ($produkandalan) {
                                foreach ($produkandalan as $row_produkandalan){
                                    if($rowCount % $numOfCols == 0) { ?> 
                                        <div class="carousel-item py-2 <?= ($rowCount == 0) ? 'active' : ''?>">
                                            <div class="row"> <?php } $rowCount++; ?>  
                                                <div class="col-md-3 col-6 text-center carousel-produk">
                                                    <?php 
                                                        $curl = curl_init();

                                                        curl_setopt_array($curl, array(
                                                        CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getproductimagebykodeid/'.$row_produkandalan['kodeid'],
                                                        CURLOPT_RETURNTRANSFER => true,
                                                        CURLOPT_ENCODING => '',
                                                        CURLOPT_MAXREDIRS => 10,
                                                        CURLOPT_TIMEOUT => 0,
                                                        CURLOPT_SSL_VERIFYHOST => 0,
                                                        CURLOPT_SSL_VERIFYPEER => 0,
                                                        CURLOPT_FOLLOWLOCATION => true,
                                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                                        CURLOPT_HTTPHEADER => array(
                                                            'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                                        ),
                                                        ));
                                                        $response = curl_exec($curl);
                                                        
                                                        curl_close($curl);
                                                        $src = 'data:image/png;base64,'.base64_encode($response).'';
                                                    ?>
                                                    <img src="<?= $src; ?>" onclick="window.open('<?= base_url() ?>product-detail/<?= $row_produkandalan['idproduk'] ?>');" alt="Rounded image" class="img-fluid rounded img-produk-sebelum">
                                                    <br>
                                                    <small class="d-block text-uppercase font-weight-bold mb-4 title-product-car"><a href="<?= base_url() ?>product-detail/<?= $row_produkandalan['idproduk'] ?>" target="_blanks" class="title-produk-sebelum"><?= $row_produkandalan['namabarang'] ?></a>
                                                    <br>
                                                    Rp. <?= number_format($row_produkandalan['hargajual'],2,',','.') ?>
                                                    </small>
                                                </div>
                                    <?php if($rowCount % $numOfCols == 0) { ?></div></div> <?php } 
                                }
                            } else { ?>
                                <div class="container text-center">
                                    <h2>Data Tidak Tersedia</h2>
                                </div>
                            <?php } ?>
                    </div>
                    <?php if (count($produkandalan) > 4) { ?>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    <?php } ?>
                </div>
                    <?php if (count($produkandalan) > 4) { ?>
                        <div class="text-center">
                            <a class="carousel-control-prev-resp mx-2" href="#myCarousel" role="button" data-slide="prev">
                                <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                            </a>
                            <a class="carousel-control-next-resp mx-2" href="#myCarousel" role="button" data-slide="next">
                                <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                            </a>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Select Option Product -->
    <script src="<?= base_url() ?>assets/js/custom/select-option-pesanan.js"></script>
    

    <script>
        $(function () {
            $('select').selectpicker();
        });
    </script>
    
    
    