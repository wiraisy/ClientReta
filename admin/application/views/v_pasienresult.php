<style>
    .bootstrap-select button{
        background: white!important;
        text-transform: inherit!important;
        font-weight: normal!important;
		color: #8898aa!important;
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
                            <span class="alert-inner--text"><strong>Info!</strong> Halaman ini berguna untuk melihat atau mengubah data pasien.</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
						<div class="row">
							<div class="col-md-6">
								<h3 class="mb-0">CARI PASIEN :</h3>
								<form action="<?= base_url("search-pasien") ?>" method="POST">
									<div class="form-group row mb-1">
										<label for="custid" class="col-sm-4 col-form-label">Customer ID</label>
										<div class="col-sm-8">
											<input type="text" id="custid" name="custid" class="form-control" placeholder="Masukkan Customer ID" required>
										</div>
									</div>
                                    <button type="submit" class="btn btn-success">Cari</button>
								</form>
							</div>
							<div class="col-md-6 d-flex align-items-center justify-content-end">
                                <a href="<?= base_url("pasien/1/10") ?>" class="btn btn-secondary">Kembali ke Modul Pasien</a>
							</div>
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
                                                        <a data-toggle="modal" data-target="#editModal<?= $row['id_pasien']; ?>" type="button" class="btn btn-info btn-sm">Ganti Password</a>
                                                        <a data-toggle="modal" data-target="#detailModal<?= $row['id_pasien']; ?>" type="button" class="btn btn-secondary btn-sm">Detail Pasien</a>
                                                        <a href="<?= base_url('pasien/hapus'); ?>/<?= $row['id_pasien']; ?>" class="btn btn-warning btn-sm deleteAlert">Hapus</a>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="editModal<?= $row['id_pasien']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addModalLabel">Data Pasien || Ganti Password</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?= base_url('pasien/ubahPasien'); ?>/<?= $row['id_pasien']; ?>" method="POST"  enctype="multipart/form-data">
                                                                    <input type="hidden" name="id_pasien" value="<?= $row['id_pasien']; ?>">
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
                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="detailModal<?= $row['id_pasien']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addModalLabel">Data Pasien ||<?= $row['custnama']; ?> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Nama Pasien</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['custnama']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Customer ID</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['custid']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">No. KTP</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['noktp']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">TTL</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['tmplahir'].", ".date("d-M-Y", ((int)$row['tgllahir']/1000) ); ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Alamat Domisili</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['alamat']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Kota Domisili</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['kota']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Pekerjaan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['pekerjaan']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['gender1']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Tanggal Bergabung</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= date("d-M-Y", ((int)$row['tglgabung']/1000) ); ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Member / Non-Member</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['member']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control"><?= $row['keterangan']; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">No. Handphone 1</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['hp1']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">No. Handphone 2</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['hp2']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">No. Telepon 1</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['telp1']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">No. Telepon 2</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['telp2']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">BBM</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['bbm']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">E-Mail</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['email']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="" class="col-sm-4 col-form-label">Password</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" value="<?= $row['password']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                </div>
            </div>
        </div>   


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

