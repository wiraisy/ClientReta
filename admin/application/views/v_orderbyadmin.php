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
                        <select class="form-control" id="member">
                            <option selected disabled>Pilih Member</option>
                            <option value="1">Arya Stark</option>
                            <option value="2">Missandei</option>
                            <option value="3">Sansa Stark</option>
                            <option value="4">John Snow</option>
                        </select>
                        <hr>
                        <div class="card">
                            <div class="card-body bg-gradient-pink" style="color: white;">
                                <label for="pilih-produk">Pesan Produk Member Sebelumnya</label>
                                <select class="form-control" id="selectPesananSebelum">
                                    <option selected disabled>Pilih produk pilihan member sebelumnya</option>
                                    <option value="optionSebelum1">Produk A</option>
                                    <option value="optionSebelum2">Produk B</option>
                                </select>
                            </div>
                        </div>  
                        <div class="card mt-2">
                            <div class="card-body bg-gradient-pink" style="color: white;">
                                <label for="pilih-produk">Pesan Produk Umum</label>
                                <select class="form-control" id="selectPesananUmum">
                                    <option selected disabled>Pilih produk umum</option>
                                    <option value="optionUmum1">Cleanser Whitening</option>
                                    <option value="optionUmum2">Cleanser Blueing</option>
                                </select>
                            </div>
                        </div> 
                        <div class="card mt-2">
                            <div class="card-body bg-gradient-pink" style="color: white;">
                                <label for="pilih-produk">Pesan Produk Andalan</label>
                                <select class="form-control" id="selectPesananAndalan">
                                    <option selected disabled>Pilih produk andalan</option>
                                    <option value="optionAndalan1">Scarlet Johanson</option>
                                    <option value="optionAndalan2">Scarlet Witch</option>
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