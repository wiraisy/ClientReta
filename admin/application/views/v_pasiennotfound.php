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
                        <div class="text-center">
                            <h3>Customer ID Pasien <?= $datapasien ?> Tidak Ditemukan.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>   


