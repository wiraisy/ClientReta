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
                        <form action="<?= base_url("admin/tambahAdmin") ?>" method="POST">
                            <div class="row">
                                    <div class="col-4">
                                        <input type="text" name="username" placeholder="Username" class="form-control form-control-alternative" required>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="password" placeholder="Password" class="form-control form-control-alternative" required>
                                    </div>
                                        <input type="hidden" name="rule" value="admin">
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                            </div>
                        </form>
                        <hr>
                        <!-- Tabel Admin-->
                        <div class="table-responsive py-4">
                            <table class="table datatable table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php if(isset($datadmin)){ 
                                        $i = 1;
                                        ?>
                                            <?php foreach ($datadmin as $row) { 
                                                ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td>
                                                        <a data-toggle="modal" data-target="#editModal<?= $row['idadmin']; ?>" type="button" class="btn btn-info btn-sm">Ganti Password</a>
                                                        <a href="<?= base_url('admin/hapus'); ?>/<?= $row['idadmin']; ?>" class="btn btn-warning btn-sm deleteAlert">Hapus</a>
                                                    </td>
                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="editModal<?= $row['idadmin']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="addModalLabel">Data Admin || Ganti Password</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url('admin/ubahAdmin'); ?>/<?= $row['idadmin']; ?>" method="POST"  enctype="multipart/form-data">
                                                                        <input type="hidden" name="idadmin" value="<?= $row['idadmin']; ?>">
                                                                        <input type="hidden" name="rule" value="<?= $row['rule']; ?>">
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Password Baru</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" name="password" class="form-control" placeholder="Masukkan Password Baru" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success">Save</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php $i++; } ?>
                                        <?php  }else{?>
                                            <tr>
                                                <td colspan="3" style="text-align:center;"><p style="color:grey;font-size:18px;">Data Belum Tersedia</p></td>
                                            </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>   