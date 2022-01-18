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
                            <span class="alert-inner--text"><strong>Info!</strong> Halaman ini berguna untuk menambahkan data produk & pasien melalui import files csv.</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="container">
                            <hr>
                            <h1>Import Data Produk</1>
                            <form action="<?= base_url() ?>import/import_produk" method="POST" enctype="multipart/form-data">
                                <input class="form-control" type="file" name="file" required>
                                <button class="btn btn-info mt-2">Import</button>
                            </form>
                            <hr>
                            <h1>Import Data Pasien</h1>
                            <form action="<?= base_url() ?>import/import_pasien" method="POST" enctype="multipart/form-data">
                                <input class="form-control" type="file" name="file" required>
                                <button type="submit" class="btn btn-info mt-2">Import</button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>   