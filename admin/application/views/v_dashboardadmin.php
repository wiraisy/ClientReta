
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