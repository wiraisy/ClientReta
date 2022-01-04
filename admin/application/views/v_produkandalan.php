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
                    <!-- Produk Andalan 1-->
                    <div class="row">
                        <div class="col-sm-3 col-3">
                            <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: auto;">
                            <br>
                            <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 1
                            <br>
                            Rp. xxxxx
                            </small>
                        </div>
                        <div class="col-sm-3 col-3">
                            <label for="formFileLg" class="form-label">Status Produk Andalan 1</label>
                            <label class="custom-toggle">
                            <input type="checkbox" checked="">
                            <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                            <br>
                            <input class="form-control" id="formFileSm" type="file" />
                            <br>
                            <input type="text" placeholder="Nama Produk" class="form-control">
                            <br>
                            <input type="number" placeholder="Harga" class="form-control">
                            <br>
                            <button type="button" class="btn btn-warning">Update</button>
                        </div>
                        <div class="col-sm-3 col-3">
                            <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: auto;">
                            <br>
                            <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 2
                            <br>
                            Rp. xxxxx
                            </small>
                        </div>
                        <div class="col-sm-3 col-3">
                            <label for="formFileLg" class="form-label">Status Produk Andalan 2</label>
                            <label class="custom-toggle">
                            <input type="checkbox" checked="">
                            <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                            <br>
                            <input class="form-control" id="formFileSm" type="file" />
                            <br>
                            <input type="text" placeholder="Nama Produk" class="form-control">
                            <br>
                            <input type="number" placeholder="Harga" class="form-control">
                            <br>
                            <button type="button" class="btn btn-warning">Update</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 col-3">
                            <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: auto;">
                            <br>
                            <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 3
                            <br>
                            Rp. xxxxx
                            </small>
                        </div>
                        <div class="col-sm-3 col-3">
                            <label for="formFileLg" class="form-label">Status Produk Andalan 3</label>
                            <label class="custom-toggle">
                            <input type="checkbox" checked="">
                            <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                            <br>
                            <input class="form-control" id="formFileSm" type="file" />
                            <br>
                            <input type="text" placeholder="Nama Produk" class="form-control">
                            <br>
                            <input type="number" placeholder="Harga" class="form-control">
                            <br>
                            <button type="button" class="btn btn-warning">Update</button>
                        </div>
                        <div class="col-sm-3 col-3">
                            <img src="<?= base_url() ?>assets/img/products/produk-pilihan-1.jpg" alt="Rounded image" class="img-fluid rounded" style="width: auto;">
                            <br>
                            <small class="d-block text-uppercase font-weight-bold mb-4">Produk Alt 4
                            <br>
                            Rp. xxxxx
                            </small>
                        </div>
                        <div class="col-sm-3 col-3">
                            <label for="formFileLg" class="form-label">Status Produk Andalan 4</label>
                            <label class="custom-toggle">
                            <input type="checkbox">
                            <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                            <br>
                            <input class="form-control" id="formFileSm" type="file" />
                            <br>
                            <input type="text" placeholder="Nama Produk" class="form-control">
                            <br>
                            <input type="number" placeholder="Harga" class="form-control">
                            <br>
                            <button type="button" class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>