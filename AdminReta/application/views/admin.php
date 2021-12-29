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
                            <span class="alert-inner--text"><strong>Info!</strong> Halaman ini berguna untuk menambahkan atau menghapus admin.</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <!-- Tambah Admin-->
                        <div class="row">
                            <div class="col-4">
                                <input type="text" placeholder="Username" class="form-control form-control-alternative">
                            </div>
                            <div class="col-4">
                                <input type="text" placeholder="Password" class="form-control form-control-alternative">
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-warning">Tambah</button>
                            </div>
                        </div>
                        <hr>
                        <!-- Tabel Admin-->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>arya441</td>
                                <td>stark441</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                    <button type="button" class="btn btn-warning btn-sm">Hapus</button>
                                </td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>sansa441</td>
                                <td>stark144</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                    <button type="button" class="btn btn-warning btn-sm">Hapus</button>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>   