<div class="header bg-pink pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-10 col-8">
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
                    <div class="container">
                        <div style="text-align: center;">
                            <?php if ($databukti == true) { ?>
                                <h3 class="display-4 mb-0">Mohon bukti pembayaran segera divalidasi.</h3>
                            <?php } else { ?>
                            <h3 class="display-4 mb-0">Transaksi telah kadaluarsa.</h3>
                            <?php } ?>
                            <img class="img-fluid" src="<?= base_url() ?>assets/oops.jpg" alt="" style="width: 50%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
