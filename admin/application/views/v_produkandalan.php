<style>
    .scrollable-content {
        height: 600px;
        overflow: scroll;
        overflow-x: hidden;
    }
    .deleteBtn:hover{
        color: #8d2f2f;
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
                <!-- Card stats -->
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
                        <span class="alert-inner--text"><strong>Info!</strong> Halaman ini berguna untuk mengelola produk dengan kategori andalan.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- Produk -->
                    <div class="container scrollable-content">
                        <div class="row">
                        <?php if(isset($produk)){ ?>
                                <?php 
                                    $i = 0;
                                    foreach($produk as $rows){ 
                                        $i++;
                                        ?>
                                        <div class="col-md-6 row mt-4 py-4" style="border-bottom: 1px solid grey;">
                                            <div class="col-md-6" >
                                                <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: auto;">
                                                <br>
                                                <small class="d-block text-uppercase font-weight-bold mb-4"><?= $rows['namabarang'] ?>
                                                <br>
                                                Rp. <?= $rows['hargajual'] ?>
                                                </small>
                                            </div>
                                            <div class="col-md-6" >
                                                <form action="<?= base_url() ?>update-produk-andalan/<?= $rows['idproduk'] ?>" method="post" enctype="multipart/form-data">
                                                    <h3 class="mb-0">Status Produk :</h3>
                                                    <p class="mb-0"><?= $rows['namabarang'] ?></p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="custom-toggle">
                                                                <input type="checkbox">
                                                                <span class="custom-toggle-slider rounded-circle"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <a href="<?= base_url('produkandalan/hapus'); ?>/<?= $rows['idproduk']; ?>" class="deleteAlert" style="color: red;"><i class="fas fa-trash-alt deleteBtn" ></i></a>
                                                        </div>
                                                    </div>
                                                    <!-- Temporary Hidden Fill -->
                                                    <input type="hidden" name="satuan" value="<?= $rows['satuan'] ?>">
                                                    <input type="hidden" name="hargacorporate" value="<?= $rows['hargacorporate'] ?>">
                                                    <input type="hidden" name="hargamember" value="<?= $rows['hargamember'] ?>">
                                                    <input type="hidden" name="hargapromo" value="<?= $rows['hargapromo'] ?>">
                                                    <input type="hidden" name="hargapromo1" value="<?= $rows['hargapromo1'] ?>">
                                                    <input type="hidden" name="hargapromo2" value="<?= $rows['hargapromo2'] ?>">
                                                    <input type="hidden" name="hargapromo3" value="<?= $rows['hargapromo3'] ?>">
                                                    <input type="hidden" name="hargapromo4" value="<?= $rows['hargapromo4'] ?>">
                                                    <input type="hidden" name="kodeid" value="<?= $rows['kodeid'] ?>">
                                                    <input type="hidden" name="kategori" value="<?= $rows['kategori'] ?>">
                                                    <!-- Showed Fill -->
                                                    <input class="form-control mt-1" id="formFileSm" type="file" />
                                                    <input type="text" placeholder="Nama Produk" class="form-control mt-1" name="namabarang" value="<?= $rows['namabarang'] ?>">
                                                    <input type="hidden" name="namabarangdefault" value="<?= $rows['namabarang'] ?>">
                                                    <input type="number" placeholder="Harga" class="form-control mt-1" name="hargajual" value="<?= $rows['hargajual'] ?>">
                                                    <input type="hidden" name="hargajualdefault" value="<?= $rows['hargajual'] ?>">
                                                    <button type="submit" class="btn btn-warning mt-1">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php if($i % 2 == 0): ?>
                                        <br>
                                    <?php endif; ?>
                                <?php } ?>
                            <?php } else{ ?>
                                <div class="col-md-12 text-center">
                                    <h1 style="color: #f3a4b5;">Data is Unavailable.</h1>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    