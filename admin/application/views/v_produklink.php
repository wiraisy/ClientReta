<style>
    .bootstrap-select button{
        background: white!important;
        text-transform: inherit!important;
        font-weight: normal!important;
    }
</style>
<div class="header bg-pink pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
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
                        <span class="alert-inner--text"><strong>Info!</strong> Form ini berguna untuk memberikan link produk ke Member. Silahkan pilih beberapa produk yang sesuai lalu klik "Generate Link"</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="row my-2">
                        <div class="col-8">
                            <select class="form-control selectpicker" id="selectProdukUmum" data-live-search="true">
                                <option selected disabled>Pilih Produk Umum</option>
                                <?php if(isset($produkumum)){ ?>
                                    <?php foreach ($produkumum as $row_produkumum) { ?>
                                        <option value="<?= $row_produkumum['idproduk'] ?>"><?= $row_produkumum['namabarang'] ?></option>
                                    <?php } ?>
                                <?php }else{?>
                                        <option disabled>Data Produk Tidak Tersedia</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4"><button type="button" class="btn btn-warning" onclick="generateLinkUmum()">Generate Link</button></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-8">
                            <select class="form-control selectpicker" id="selectProdukAndalan" data-live-search="true">
                                <option selected disabled>Pilih Produk Pendukung</option>
                                <?php if(isset($produkandalan)){ ?>
                                    <?php foreach ($produkandalan as $row_produkandalan) { ?>
                                        <option value="<?= $row_produkandalan['idproduk'] ?>"><?= $row_produkandalan['namabarang'] ?></option>
                                    <?php } ?>
                                <?php }else{?>
                                        <option disabled>Data Produk Tidak Tersedia</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4"><button type="button" class="btn btn-warning" onclick="generateLinkAndalan()">Generate Link</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        $(function () {
            $('#selectProdukAndalan').selectpicker();
            $('#selectProdukUmum').selectpicker();
        });
        
        function generateLinkAndalan(){
            var idproduk = $('#selectProdukAndalan').val();
            if (idproduk) {
                // GET BY IDPRODUK FROM API
                
                var settings = {
                    "url": "https://api-reta.id/reta-api/Produk/GetProdukbyId/"+idproduk,
                    "method": "GET",
                    "timeout": 0,
                    "headers": {
                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                    }
                };

                $.ajax(settings).done(function (response) {
                    if(response.status == true){
                        // Promp alert
                        var alert = prompt("Berikut link detail produk yang anda pilih", `https://shop.reta.co.id/product-detail/${response.idproduk}`);
                    }else{
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        Toast.fire({
                            icon: 'error',
                            title: '&nbsp;Generate Link Produk Gagal!'
                        })
                    }
                });
            } else {
                alert('Silahkan isi field yang tersedia terlebih dahulu.');
            }
        }

        function generateLinkUmum(){
            var idproduk = $('#selectProdukUmum').val();
            console.log(idproduk);
            if (idproduk) {
                // GET BY IDPRODUK FROM API
                
                var settings = {
                    "url": "https://api-reta.id/reta-api/Produk/GetProdukbyId/"+idproduk,
                    "method": "GET",
                    "timeout": 0,
                    "headers": {
                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                    }
                };

                $.ajax(settings).done(function (response) {
                    if(response.status == true){
                        // Promp alert
                        var alert = prompt("Berikut link detail produk yang anda pilih", `https://shop.reta.co.id/product-detail/${response.idproduk}`);
                    }else{
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        Toast.fire({
                            icon: 'error',
                            title: '&nbsp;Generate Link Produk Gagal!'
                        })
                    }
                });
            } else {
                alert('Silahkan isi field yang tersedia terlebih dahulu.');
            }
        }
    </script>