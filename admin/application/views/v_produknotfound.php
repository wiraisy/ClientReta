<style>
    .scrollable-content {
        height: 600px;
        overflow: scroll;
        overflow-x: hidden;
    }
    .deleteBtn:hover{
        color: #8d2f2f;
    }
    .test-popup-link > img{
        object-fit: cover;
    }
    .img-wrap{
        position: relative;
    }
    .test-popup-link > img {
        width: 200px!important; 
        height: 200px!important;
        object-fit: cover;
    }
    .test-popup-link > img:hover{
        box-shadow: 5px 5px 9px 0px lightgrey;
    }
    .img-wrap > .test-popup-link:hover{
        cursor: -moz-zoom-in; 
        cursor: -webkit-zoom-in; 
        cursor: zoom-in;
    }
    .action-img{
        position: absolute;
        top:5%;
        right:5%;
    }
    .action-img > i:hover{
        color: blue;
        cursor: pointer;
    }
    #pagination-custom {
        margin: 0;
        padding: 0;
        text-align: center
    }
    #pagination-custom li {
        display: inline
    }
    #pagination-custom li a {
        display: inline-block;
        text-decoration: none;
        padding: 5px 10px;
        color: #000
    }

    /* Active and Hoverable Pagination */
    #pagination-custom li a {
        border-radius: 5px;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
    }
    #pagination-custom li a.active {
        background-color: #f3a4b5;
        color: #fff
    }
    #pagination-custom li a:hover:not(.active) {
        background-color: #ddd;
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
                        <span class="alert-inner--text"><strong>Info!</strong> Halaman ini berguna untuk mengelola produk hasil pencarian.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- Search Bar -->
                    <form action="<?= base_url('produk-andalan/search') ?>" method="POST" class="text-center">
                        <div class="p-1 rounded rounded-pill shadow-sm mb-4" style="width: 40%;margin: auto;background-color: #efa4b445;">
                            <div class="input-group">
                            <input type="search" name="kodeid" placeholder="Search by Kode ID Produk..." aria-describedby="button-addon1" class="form-control border-0 rounded-pill" style="background: transparent;">
                            <div class="input-group-append">
                                <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                            </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <h3>Produk Kode ID <?= $produk ?> Tidak Ditemukan.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>