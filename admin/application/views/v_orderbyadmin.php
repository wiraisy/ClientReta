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
                    <form action="<?= base_url('checkout-by-admin') ?>" enctype="multipart/form-data" method="POST">
                        <select class="form-control selectpicker" id="selectMember" data-live-search="true" >
                            <option selected disabled>Pilih Pasien</option>
                            <?php if(isset($datamember['content'])){ ?>
                                <?php foreach ($datamember['content'] as $row_member) { ?>
                                    <option value="<?= $row_member['id_pasien'] ?>"><?= $row_member['custid'] ?> - <?= $row_member['custnama'] ?> - <?= $row_member['gender1'] ?> - <?= $row_member['kota'] ?></option>
                                <?php } ?>
                            <?php }else{?>
                                    <option disabled>Data Pasien Tidak Tersedia</option>
                            <?php } ?>
                        </select>
                        <hr>
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
                                        <?php foreach ($produkumum as $row_produkumum) { ?>
                                            <option value="<?= $row_produkumum['idproduk'] ?>"><?= $row_produkumum['namabarang'] ?></option>
                                        <?php } ?>
                                    <?php }else{?>
                                            <option disabled>Data Produk Andalan Tidak Tersedia</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- List Pesanan -->
                        <div class="list-pesanan container">
                        </div>
                        <br>
                        <br>
                        <div style="text-align: right;"><button type="submit" class="btn btn-outline-danger btn-round">Checkout</button></div>  
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/js/custom/select-option-pesanan.js"></script>
    
    <script>
        $(function () {
            $('#selectPesananSebelum').selectpicker();
            $('#selectMember').selectpicker();
            $('#selectPesananUmum').selectpicker();
            $('#selectPesananAndalan').selectpicker();
        });
    </script>