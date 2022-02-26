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
                    <?php 
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getImagebykodeid/'.$detailproduk['kodeid'],
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
                    <img class="img-fluid rounded" src="<?= $src; ?>" >
                </div>
                <div class="col-md-6">
                    <h1><?= $detailproduk['namabarang'] ?></h1>
                    <div class="row">
                        <div class="col-md-8">
                            <p>Rp. <?= $detailproduk['hargajual'] ?></p>
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
    