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
                        <span class="alert-inner--text"><strong>Info!</strong> Form ini berguna untuk memberikan link produk ke Member. Silahkan pilih beberapa produk yang sesuai lalu klik "Generate Link"</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-8"><select class="form-control" id="product">
                            <option selected>Pilih produk</option>
                            <option value="1">Cleanser Whitening</option>
                            <option value="2">Handbody UV Protection SPF 50</option>
                            <option value="3">Lip Care</option>
                            <option value="4">Lip Treatment</option>
                            <option value="5">Loose Powder</option>
                            <option value="6">Moizturizer Whitening – Krim Pagi MW</option>
                            <option value="7">Stretch Mark Cream</option>
                            <option value="8">Suncare UV Protection SPF 50 Gold</option>
                            <option value="9">Sunscreen Normal Skin</option>
                            <option value="10">White + Powder</option>
                            <option value="11">Whitening Daily Glow Serum</option>
                        </select>
                        </div>
                        <div class="col-4"><button type="button" class="btn btn-warning">Generate Link</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>