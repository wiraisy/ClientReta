<style>
    .btn-remove:hover{
        cursor: pointer;
    }
    .bootstrap-select button{
        background: white!important;
        text-transform: inherit!important;
        font-weight: normal!important;
    }
    .countCart[data-count]:after{
        position: absolute;
        left: 85%;
        bottom: 50%;
        content: attr(data-count);
        font-size: 70%;
        border-radius: 999px;
        color: #f5365c;
        text-align: center;
        min-width: 1.2em;
        font-weight: bold;
        background: white;
        border: solid #f5365c 1px;
    }
    .product-img > img {
        width: 200px; /* You can set the dimensions to whatever you want */
        height: 200px;
        object-fit: cover;
    }.input-counter{
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
</style>
<div class="header bg-pink pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-10 col-8">
                    <h6 class="h2 text-white d-inline-block mb-0"><?= $title ?></h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboards</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                        <span class="alert-inner--text"><strong>Info!</strong> Form ini berguna untuk menambahkan produk ke dalam pembelian member tertentu. Silahkan pilih member yang ingin diproses sebelum memilih beberapa produk yang diinginkan.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <hr>
                    <form enctype="multipart/form-data" id="create-listing-form" method="POST">
                        <!-- Step 1 -->
                        <!-- Pilih Pasien -->
                        <div class="container-fluid create container" id="step-1">
                            <h3>Pilih Pasien :</h3>
                            <select class="form-control selectpicker" id="selectMember" data-live-search="true" >
                                <option selected disabled>Pilih Pasien</option>
                                <?php if(isset($datamember)){ ?>
                                    <?php foreach ($datamember as $row_member) { ?>
                                        <option value="<?= $row_member['id_pasien'] ?>"><?= $row_member['custid'] ?> - <?= $row_member['custnama'] ?> - <?= $row_member['gender1'] ?> - <?= $row_member['kota'] ?></option>
                                    <?php } ?>
                                <?php }else{?>
                                        <option disabled>Data Pasien Tidak Tersedia</option>
                                <?php } ?>
                            </select>
                            <input type="hidden" id="tempCustId">
                            <div style="text-align: right;">
                                <button type="button" onclick="validateForm1();" class="btn btn-success mt-4">Next</button>
                            </div>
                            <script>
                                function validateForm1() {
                                    if (!$('#selectMember').val()) {
                                        alert("Silahkan Pilih Pasien!");
                                        return false;
                                    } else {
                                        $('#step-1').hide();
                                        $('#step-2').show();   
                                    }
                                }
                            </script>
                        </div>
                        <!-- Step 2 -->
                        <div class="container-fluid create container" style="display: none;" id="step-2">
                            <div class="card mt-2">
                                <div class="card-body bg-gradient-pink" style="color: white;">
                                    <label for="pilih-produk">Pesan Produk Umum</label>
                                    <select class="form-control selectpicker" name="selectPesananUmum" id="selectPesananUmum" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                                        <option selected disabled>Pilih produk yang anda inginkan</option>
                                        <?php if($produkumum){ ?>
                                            <?php foreach ($produkumum as $row_produkumum) { ?>
                                                <option value="<?= $row_produkumum['kodeid'] ?>"><?= $row_produkumum['namabarang'] ?></option>
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
                                    <select class="form-control selectpicker" name="selectPesananAndalan" id="selectPesananAndalan" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                                        <option selected disabled>Pilih produk yang anda inginkan</option>
                                        <?php if($produkandalan){ ?>
                                            <?php foreach ($produkandalan as $row_produkandalan) { ?>
                                                <option value="<?= $row_produkandalan['kodeid'] ?>"><?= $row_produkandalan['namabarang'] ?></option>
                                            <?php } ?>
                                        <?php }else{?>
                                                <option disabled>Data Produk Umum Tidak Tersedia</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- List Pesanan -->
                            <div class="list-pesanan container"></div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <button type="button" onclick="backtoForm1();" class="btn btn-success">Kembali</button>
                                    <script>
                                        function backtoForm1(){
                                            $('#step-2').hide();
                                            $('#step-1').show();   
                                        }
                                    </script>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-outline-danger btn-round" onclick="checkout();"><span class="countCart" id="countCart" data-count="0">Checkout</span></button>
                                    <script>
                                        function checkout(){
                                            let id_pasien = $('#selectMember').find(":selected").val();
                                            let custid = document.getElementById('tempCustId').value;
                                            location.href = "<?= base_url() ?>order-by-admin/checkout/"+id_pasien+"/"+custid;
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/js/custom/select-option-pesanan.js"></script>
    
    <script>
        $('#selectMember').change(function() {
            let id_pasien = $(this).val();
            var settingsPasien = {
                "url": "https://api-reta.id/reta-api/PasienAPI/cariberdasarkanid/"+id_pasien,
                "method": "GET",
                "timeout": 0,
                "async" : false,
                "headers": {
                    "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                },
            };

            var custid = $.ajax(settingsPasien).done(function (res) {
                return res;
            }).responseJSON.custid;
            var settingscart = {
                "url": "https://api-reta.id/reta-api/Penjualan/lihatcart/"+custid,
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
            document.getElementById('countCart').dataset.count = parseInt(datacart.length);
            document.getElementById('tempCustId').value = custid;
        });
    </script>
    <script>
        $(function () {
            $('#selectMember').selectpicker();
            $('#selectPesananUmum').selectpicker();
            $('#selectPesananAndalan').selectpicker();
        });
    </script>