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
								<form action="#" method="POST">
									<div class="form-group row mb-1">
										<label for="custid" class="col-sm-4 col-form-label">Customer ID</label>
										<div class="col-sm-8">
											<input type="text" id="custid" name="custid" class="form-control" placeholder="Masukkan Customer ID" required>
										</div>
									</div>
                                    <button type="submit" class="btn btn-success">Cari</button>
								</form>
							</div>
							<div class="col-md-6">
								<h3 class="mb-0">PENGATURAN TABEL :</h3>
								<form action="#" method="POST">
									<div class="form-group row mb-1">
										<label for="pageSize" class="col-sm-4 col-form-label">Show Entries :</label>
										<div class="col-sm-8">
											<select class="form-control selectpicker" name="pageSize" id="selectSize" data-live-search="true">
												<option selected disabled>Select Entries</option>
												<option value="10">10</option>
												<option value="25">25</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</div>
									</div>
									<div class="form-group row mb-1">
										<label for="pageNumber" class="col-sm-4 col-form-label">Spesific Page :</label>
										<div class="col-sm-8">
											<select class="form-control selectpicker" id="selectPage" data-live-search="true" >
												<option selected disabled>Select Page</option>
												<?php if(isset($datapasien)){ ?>
													<?php for ($i=1; $i <= $datapasien['totalPages']; $i++) {  ?>
														<option value="<?= $i ?>"><?= $i ?></option>
													<?php } ?>
												<?php }else{?>
														<option disabled>Data Page Unavailable</option>
												<?php } ?>
											</select>
										</div>
									</div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
								</form>
							</div>
						</div>
						<p class="mb-0">Showing <?= $datapasien['pageable']['pageSize'] ?> Entries on Page <?= $datapasien['pageable']['pageNumber'] + 1 ?></p>
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
														TESTING
                                                    </td>
                                                </tr>
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

