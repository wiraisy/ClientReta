<style>
    .btn-remove:hover{
        cursor: pointer;
    }
    .bootstrap-select button{
        background: white!important;
        text-transform: inherit!important;
        font-weight: normal!important;
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
                        <option disabled>Pilih produk yang anda inginkan</option>
                        <?php if(isset($produkandalan)){ ?>
                            <?php foreach ($produkumum as $row_produkumum) { ?>
                                <option value="<?= $row_produkumum['idproduk'] ?>"><?= $row_produkumum['namabarang'] ?></option>
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

    <script>
        $(function () {
            $('select').selectpicker();
        });
    </script>

    <script>
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
            console.log(this.responseText);
        }
        });

        xhr.open("GET", "http://202.157.184.70:8080/reta-api/Produk/GetProdukbyId-nre/89");
        xhr.setRequestHeader("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");

        xhr.send();
    </script>