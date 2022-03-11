
    <style>
        .info-lengkap{
            position:absolute;
            bottom: 20px;
        }
        .number-count{
            position:absolute;
            bottom: 50px;
        }
        .text-nowrap:hover{
            text-decoration: underline;
            color:grey;
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
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats" style="height:150px;">
                            <!-- Card body -->
                            <div class="card-body" style="position: relative;">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total pasien</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="number-count h2 font-weight-bold mb-0"><?= ($jumlahpasien['content']) ? $jumlahpasien['totalElements'] : '-' ?></span>
                                <p class="info-lengkap mb-0 text-sm">
                                    <a href="<?= base_url() ?>/pasien" class="text-nowrap">Informasi selengkapnya <span><i class="fa fa-chevron-right"></i></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats" style="height:150px;">
                            <!-- Card body -->
                            <div class="card-body" style="position: relative;">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total produk</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="number-count h2 font-weight-bold mb-0"><?= ($jumlahproduk['content']) ? $jumlahproduk['totalElements'] : '-' ?></span>
                                <p class="info-lengkap mb-0 text-sm">
                                <a href="<?= base_url() ?>" class="text-nowrap">Informasi selengkapnya  <span><i class="fa fa-chevron-right"></i></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats" style="height:150px;">
                            <!-- Card body -->
                            <div class="card-body" style="position: relative;">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Telah dikirim</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="number-count h2 font-weight-bold mb-0"><?= ($jumlahkirim) ? count($jumlahkirim) : '-' ?></span>
                                <p class="info-lengkap mb-0 text-sm">
                                    <a href="<?= base_url() ?>/pemesanan" class="text-nowrap">Informasi selengkapnya  <span><i class="fa fa-chevron-right"></i></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats" style="height:150px;">
                        <!-- Card body -->
                        <div class="card-body" style="position: relative;">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Admin</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="ni ni-chart-bar-32"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="number-count h2 font-weight-bold mb-0"><?= ($jumlahadmin) ? count($jumlahadmin) : '-' ?></span>
                            <p class="info-lengkap mb-0 text-sm">
                                <a href="<?= base_url() ?>/admin" class="text-nowrap">Informasi selengkapnya  <span><i class="fa fa-chevron-right"></i></span></a>
                            </p>
                        </div>
                        </div>
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
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="text-uppercase text-muted ls-1 mb-1">Welcome, <?= $this->session->userdata('data_admin_reta')['name'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="<?= base_url() ?>/assets/dashboard.jpg" alt="" style="width:50%;">
                    </div>
                </div>
            </div>
        </div>