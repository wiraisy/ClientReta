<style>
    .btn-remove:hover{
        cursor: pointer;
    }
    .disable-btn:hover{
        cursor: not-allowed!important;
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
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="">PENGATURAN TABEL :</h3>
                            <form action="<?= base_url("order-detail-pageable") ?>" method="POST">
                                <input type="hidden" name="url_pasien" value="<?= $url_pasien ?>">
                                <div class="form-group row mb-1">
                                    <label for="pageSize" class="col-sm-4 col-form-label">Show Entries :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control selectpicker" name="pageSize" id="selectSize" data-live-search="true">
                                            <option value="<?= $datapasien['pageable']['pageSize'] ?>" selected><?= $datapasien['pageable']['pageSize'] ?></option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label for="pageNumber" class="col-sm-4 col-form-label">Spesific Page :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control selectpicker" name="pageNumber" id="selectPage" data-live-search="true" >
                                        <option value="<?= $datapasien['pageable']['pageNumber'] + 1 ?>" selected><?= $datapasien['pageable']['pageNumber'] + 1 ?></option>
                                            <?php if(isset($datapasien)){ ?>
                                                <?php for ($i=1; $i <= $datapasien['totalPages']; $i++) {  ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php } ?>
                                            <?php }else{?>
                                                    <option disabled>Data Page Unavailable</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                            <a href="<?= base_url("order-by-admin") ?>" class="btn btn-success">Cari Pasien Lain</a>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" id="create-listing-form" method="POST">
                        <!-- Step 1 -->
                        <div class="container-fluid create container" id="step-1">
                            <!-- Save CustID Temporary -->
                            <input type="hidden" id="tempCustId">
                            <!-- DataTable Result -->
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <p class="mb-0">Showing <?= $datapasien['pageable']['pageSize'] ?> Entries on Page <?= $datapasien['pageable']['pageNumber'] + 1 ?></p>
                            </div>
						    <hr>
                            <!-- Tabel Admin-->
                            <div class="table-responsive">
                                <table class="table datatable table-flush" id="datatable-pasien">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Customer ID</th>
                                            <th>No. KTP</th>
                                            <th>No. Telepon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Customer ID</th>
                                            <th>No. KTP</th>
                                            <th>No. Telepon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php if($datapasien){ 
                                            $i = 1;
                                            ?>
                                                <?php foreach ($datapasien['content'] as $row) { 
                                                    ?>
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $row['custnama']; ?></td>
                                                        <td><?= $row['custid']; ?></td>
                                                        <td><?= $row['noktp']; ?></td>
                                                        <td><?= $row['hp1']; ?></td>
                                                        <td><?= $row['email']; ?></td>
                                                        <td>
                                                            <!-- Button Pilih Pasien -->
                                                            <input type="hidden" id="CustId" value="<?= $row['custid']; ?>">
                                                            <button type="button" onclick="validateForm1();" class="btn btn-success btn-sm">Pilih</button>
                                                            <script>
                                                                function validateForm1() {
                                                                        var custid = document.getElementById('CustId').value;
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

                                                                    // Next Step
                                                                    $('#step-1').hide();
                                                                    $('#step-2').show();   
                                                                }
                                                            </script>
                                                        </td>
                                                    </tr>
                                                <?php $i++; } ?>
                                            <?php  }else{?>
                                                <tr>
                                                    <td colspan="7" style="text-align:center;"><p style="color:grey;font-size:18px;">Data Belum Tersedia</p></td>
                                                </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
        $(document).ready(function() {
            $('#datatable-pasien').DataTable( {
                paging: false,
                info: false,
            } );
        } );

        $(function () {
            $('#selectPage').selectpicker();
            $('#selectSize').selectpicker();
        });
    </script>

    <script>
        $(function () {
            $('#selectPesananUmum').selectpicker();
            $('#selectPesananAndalan').selectpicker();
        });
    </script>