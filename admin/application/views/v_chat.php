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
                    <li class="breadcrumb-item active" aria-current="page"><?=  $title ?></li>
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
                    <!-- Main Chat -->
                    <?php include('includes/chat.php') ?>
                </div>
            </div>
        </div>
    </div>   