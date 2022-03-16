<style>
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
</style>
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
                        CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getproductimagebykodeid/'.$detailproduk['kodeid'],
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
                            <button type="button" class="btn btn-success btn-sm">Produk Pendukung</button>
                        </div>
                    </div>
                    <hr>
                    <form action="" method="POST">
                        <div style="display: flex;align-items: center;">
                                <div>
                                    <p class="my-0">Jumlah :</p>
                                </div>
                                <div class="pl-2">
                                    <div class="number my-4">
                                        <span class="counter-minus minus counter">-</span>
                                        <input class="mx-2" id="qty" min="1" max="4" type="number" value="1"/>
                                        <span class="counter-plus plus counter">+</span>
                                    </div>
                                    <script>
                                        $(`.minus`).click(function() {
                                            var $input = $(this).parent().find('input');
                                            var count = parseInt($input.val()) - 1;
                                            count = count < 1 ? 1 : count;
                                            $input.val(count);
                                            $input.change();
                                            return false;
                                        });

                                        $(`.plus`).click(function() {
                                            var $input = $(this).parent().find('input');
                                            var countplus = parseInt($input.val()) + 1;
                                            countplus = countplus > 4 ? 4 : countplus;
                                            $input.val(countplus);
                                            $input.change();
                                            return false;
                                        });
                                    </script>
                                </div>
                        </div>
                        <button type="button" id="addToCart" class="mt-4 btn" style="background: #eba0ce;"><span><i class="fas fa-cart-plus"></i></span> Add to Cart</button>
                        <script>
                            $(`#addToCart`).click(function() {
                            var kodeid = "<?= $detailproduk['kodeid'] ?>";
                            var custid = "<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>";
                            
                            // API Add to Cart
                            let settingsadd = {
                                "url": "https://api-reta.id/reta-api/Penjualan/adddetailtocart",
                                "method": "POST",
                                "timeout": 0,
                                "headers": {
                                    "Content-Type": "application/json",
                                    "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                },
                                "data": JSON.stringify({
                                    "custid": custid,
                                    "jumlah": parseInt(document.getElementById(`qty`).value),
                                    "kodeid": kodeid
                                }),
                            };
                            $.ajax(settingsadd).done(function() {
                                return false;
                            });

                            alert("Produk dimasukkan ke dalam keranjang.");

                            var settingscart = {
                                "url": "https://api-reta.id/reta-api/Penjualan/lihatcart/" + custid,
                                "method": "GET",
                                "timeout": 0,
                                "async": false,
                                "headers": {
                                    "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                },
                            };

                            var datacart = $.ajax(settingscart).done(function(response) {
                                return response;
                            }).responseJSON;

                            document.getElementById('cartProduct').dataset.count = parseInt(datacart.length);

                            return false;
                        });
                        </script>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    