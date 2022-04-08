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
                            <input type="search" name="kodeid" placeholder="Search by Kode ID Produk..." aria-describedby="button-addon1" class="form-control border-0 rounded-pill" style="background: transparent;" autocomplete="off">
                            <div class="input-group-append">
                                <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                            </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <!-- Produk -->
                    <div class="container scrollable-content">
                        <div class="row">
                            <div class="col-md-6 row mt-2 py-4">
                                <div class="col-md-6" >
                                    <div class="img-wrap">
                                        <?php 
                                            $curl = curl_init();

                                            curl_setopt_array($curl, array(
                                            CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getproductimagebykodeid/'.$produk['kodeid'],
                                            CURLOPT_RETURNTRANSFER => true,
                                            CURLOPT_ENCODING => '',
                                            CURLOPT_MAXREDIRS => 10,
                                            CURLOPT_TIMEOUT => 0,
                                            CURLOPT_SSL_VERIFYHOST => 0,
                                            CURLOPT_SSL_VERIFYPEER => 0,
                                            CURLOPT_FOLLOWLOCATION => true,
                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                            CURLOPT_CUSTOMREQUEST => 'GET',
                                            CURLOPT_HTTPHEADER => array(
                                                'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                            ),
                                            ));
                                            $response = curl_exec($curl);
                                            
                                            curl_close($curl);
                                            $src = 'data:image/png;base64,'.base64_encode($response).'';
                                        ?>
                                        <a class="test-popup-link" href="<?= $src; ?>"><img src="<?= $src; ?>" id="img-produk-<?= $produk['idproduk'] ?>" alt="Rounded image" class="rounded"></a>
                                        <a data-toggle="modal" data-target="#imgModal<?= $produk['idproduk'] ?>" class="action-img" ><i class="fas fa-camera"></i></i></a>
                                    </div>
                                    <!-- Modal Image -->
                                    <div class="modal fade" id="imgModal<?= $produk['idproduk'] ?>" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="border-bottom: 1px solid lightgrey;">
                                                    <h5 class="modal-title" id="imgModalLabel">Tambah / Ubah Foto Produk</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-info" role="alert">File foto produk harus dengan format extensions .jpg / .jpeg !</div>
                                                    <form action="<?= base_url('produkandalan/tambahimg'); ?>" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" value="<?= $produk['kodeid'] ?>" name="kodeid">
                                                        <input type="file" class="form-control" name="img-produk" id="sampul-<?= $produk['idproduk'] ?>" onchange="previewImg(<?= $produk['idproduk'] ?>)" accept="image/jpg, image/jpeg" required>
                                                        <img class="img-thumbnail" id="img-preview-<?= $produk['idproduk'] ?>">
                                                        <script>
                                                            function previewImg(id) {
                                                                const sampule = document.querySelector('#sampul-' + id);
                                                                const imgPreview = document.querySelector('#img-preview-' + id);

                                                                if(sampule.files[0].size > 1000000){
                                                                    alert("File foto produk terlalu besar! , maximum file size : 2MB");
                                                                    sampule.value = "";
                                                                };
                                                                
                                                                const fileSampule = new FileReader();
                                                                fileSampule.readAsDataURL(sampule.files[0]);

                                                                fileSampule.onload = function(e) {
                                                                    imgPreview.src = e.target.result;
                                                                }
                                                            }
                                                        </script>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <small class="d-block text-uppercase font-weight-bold mb-4"><?= $produk['namabarang'] ?>
                                    <br>
                                    Rp. <?= $produk['hargajual'] ?>
                                    </small>
                                </div>
                                <div class="col-md-6" >
                                    <form action="<?= base_url() ?>update-produk-andalan/<?= $produk['idproduk'] ?>" method="post" enctype="multipart/form-data">
                                        <h3 class="mb-0">Status Produk :</h3>
                                        <p class="mb-0"><?= $produk['namabarang'] ?></p>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label class="custom-toggle">
                                                <input type="checkbox" name="status" value="<?= ($produk['status'] == true ) ? 'true' : 'false'; ?>" <?= ($produk['status'] == true ) ? 'checked' : ''; ?> >
                                                    <span class="custom-toggle-slider rounded-circle"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <a href="<?= base_url('produkandalan/hapus'); ?>/<?= $produk['idproduk']; ?>" class="deleteAlert" style="color: red;"><i class="fas fa-trash-alt deleteBtn" ></i></a>
                                            </div>
                                        </div>
                                        <!-- Temporary Hidden Fill -->
                                        <input type="hidden" name="satuan" value="<?= $produk['satuan'] ?>">
                                        <input type="hidden" name="hargacorporate" value="<?= $produk['hargacorporate'] ?>">
                                        <input type="hidden" name="hargamember" value="<?= $produk['hargamember'] ?>">
                                        <input type="hidden" name="hargapromo" value="<?= $produk['hargapromo'] ?>">
                                        <input type="hidden" name="hargapromo1" value="<?= $produk['hargapromo1'] ?>">
                                        <input type="hidden" name="hargapromo2" value="<?= $produk['hargapromo2'] ?>">
                                        <input type="hidden" name="hargapromo3" value="<?= $produk['hargapromo3'] ?>">
                                        <input type="hidden" name="hargapromo4" value="<?= $produk['hargapromo4'] ?>">
                                        <input type="hidden" name="kodeid" value="<?= $produk['kodeid'] ?>">
                                        <input type="hidden" name="kategori" value="<?= $produk['kategori'] ?>">
                                        <!-- Showed Fill -->
                                        <input type="text" placeholder="Nama Produk" class="form-control mt-2" name="namabarang" value="<?= $produk['namabarang'] ?>">
                                        <input type="hidden" name="namabarangdefault" value="<?= $produk['namabarang'] ?>">
                                        <input type="number" placeholder="Harga" class="form-control mt-1" name="hargajual" value="<?= $produk['hargajual'] ?>">
                                        <input type="hidden" name="hargajualdefault" value="<?= $produk['hargajual'] ?>">
                                        <button type="submit" class="btn btn-warning mt-2">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?= base_url() ?>assets/js/magnific-popup/jquery.magnific-popup.js"></script>
<script>
    $(document).ready(function($) {
          $('.test-popup-link').magnificPopup({
            type:'image',
            mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
          enabled: true, // By default it's false, so don't forget to enable it

          duration: 300, // duration of the effect, in milliseconds
          easing: 'ease-in-out', // CSS transition easing function

          // The "opener" function should return the element from which popup will be zoomed in
          // and to which popup will be scaled down
          // By defailt it looks for an image tag:
          opener: function(openerElement) {
            // openerElement is the element on which popup was initialized, in this case its <a> tag
            // you don't need to add "opener" option if this code matches your needs, it's defailt one.
            return openerElement.is('img') ? openerElement : openerElement.find('img');
          }
        }
          });
    });
</script>