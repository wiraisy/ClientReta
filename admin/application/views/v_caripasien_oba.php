<style>
    .bootstrap-select button{
        background: white!important;
        text-transform: inherit!important;
        font-weight: normal!important;
    }
    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }
    [type="radio"]:checked + label,
    [type="radio"]:not(:checked) + label
    {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }
    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }
    [type="radio"]:checked + label:after,
    [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 12px;
        height: 12px;
        background: #F87DA9;
        position: absolute;
        top: 4px;
        left: 4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
</style>
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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                        <span class="alert-inner--text"><strong>Info!</strong> Form ini berguna untuk menambahkan produk ke dalam pembelian member tertentu. Silahkan pilih member yang ingin diproses sebelum memilih beberapa produk yang diinginkan.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <hr>
                    <!-- Cari Pasien -->
                    <form action="<?= base_url("order-detail") ?>" method="POST">
                        <div class="container-fluid">
                            <h3>Cari Pasien Berdasarkan :</h3>
                            <p>
                                <input type="radio" id="custid" name="searchby" value="custid" checked>
                                <label for="custid">Cust ID</label>
                            </p>
                            <p>
                                <input type="radio" id="name" name="searchby" value="name">
                                <label for="name">Nama</label>
                            </p>
                            <div class="bg-secondary rounded-pill shadow-sm">
                                <div class="input-group">
                                    <input type="search" autocomplete="off" name="keyword" placeholder="Masukkan kata kunci disini" aria-describedby="button-addon1" class="form-control border-0 bg-secondary" style="text-transform:uppercase!important;">
                                    <div class="input-group-append">
                                        <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>