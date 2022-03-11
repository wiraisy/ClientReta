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
                            <span class="alert-inner--text"><strong>Info!</strong> Halaman ini berguna untuk mencetak data penjualan berdasarkan status dengan format excel.</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="container">
                            <hr>
                            <h1>Export Data Penjualan</h1>
                            <small>Silahkan memilih status penjualan yang ingin dicetak</small>
                            <form action="#" method="POST" class="export-area" enctype="multipart/form-data">
                                <select name="statuspenjualan" id="statuspenjualan" class="form-control">
                                    <?php foreach ($datastatus as $row) { ?>
                                        <option value="<?= $row ?>"><?= $row ?></option>
                                    <?php } ?>
                                </select>
                                <button type="button" id="exportData" class="btn btn-info mt-2">Export</button>
                                <script>
                                    $(document).ready(function() {
                                        $('#exportData').click(function(e) {  
                                            const form = document.querySelector(".export-area");
                                            var statuspenjualan = $('#statuspenjualan').val();

                                            var settings = {
                                                "url": "https://api-reta.id/reta-api/PenjualanDetail/getlaporanpenjulanexcelnoheaderwithvalidationexport/"+statuspenjualan,
                                                "method": "GET",
                                                "timeout": 0,
                                                "async": false,
                                                "headers": {
                                                    "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                                },
                                            };

                                            var res = $.ajax(settings).done(function (response) {
                                                return response;
                                            }).responseJSON;

                                            window.open('https://api-reta.id/reta-api/PenjualanDetail/export-excel/'+statuspenjualan,'_blank');
                                        });
                                    });
                                </script>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>   