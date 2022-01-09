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
                        <span class="alert-inner--text"><strong>Info!</strong> Halaman ini berguna untuk memasang produk andalan agar tampil pada halaman pembelian produk. Terdapat 4 slot produk unggulan.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- Produk -->
                    <div class="container">
                        <div class="row">
                            <?php 
                                $i = 0;
                                foreach($produk['content'] as $rows){ 
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
                                            <form action="<?= base_url() ?>update-produk/<?= $rows['idproduk'] ?>" method="post" enctype="multipart/form-data">
                                                <label for="formFileLg" class="form-label">Status Produk <?= $rows['namabarang'] ?></label>
                                                <label class="custom-toggle">
                                                    <input type="checkbox" checked="">
                                                    <span class="custom-toggle-slider rounded-circle"></span>
                                                </label>
                                                <input class="form-control mt-1" id="formFileSm" type="file" />
                                                <input type="text" placeholder="Nama Produk" class="form-control mt-1" name="namabarang" value="<?= $rows['namabarang'] ?>">
                                                <input type="number" placeholder="Harga" class="form-control mt-1" name="hargajual" value="<?= $rows['hargajual'] ?>">
                                                <button type="submit" class="btn btn-warning mt-1">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php if($i % 2 == 0): ?>
                                    <br>
                                <?php endif; ?>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>