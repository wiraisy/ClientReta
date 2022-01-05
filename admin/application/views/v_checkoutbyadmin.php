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
                    <div class="row">
                        <div class="col-8">Alamat Pengiriman:
                            <br>
                            Arya Stark, 085777666555, Jl. Masjid No. 1 Kanding, Somagede, Kabupaten Banyumas
                        </div>
                        <div class="col-4" style="text-align: right;">
                            <button type="button" class="btn btn-outline-danger btn-round btn-icon" data-toggle="modal" data-target="#modal-form">
                            <span class="btn-inner--icon">
                            <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                            </span>
                            Edit</button>
                        </div>
                    </div>
                    <hr>
                    <!-- Modal Edit Alamat -->
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card-header bg-white pb-5">
                                        <form>
                                            <div class="col-md-12"><label class="labels">Nama Penerima</label><input type="text" class="form-control" required="true" placeholder="Masukkan Nama Penerima" value=""></div>
                                            <div class="col-md-12"><label class="labels">Nomer Ponsel</label><input type="text" class="form-control" required="true" placeholder="Masukkan No. Hp Penerima" value=""></div>
                                            <div class="col-md-12"><label class="labels">Provinsi</label><input type="text" class="form-control" required="true" placeholder="Masukkan Provinsi" value=""></div>
                                            <div class="col-md-12"><label class="labels">Kabupaten</label><input type="text" class="form-control" required="true" placeholder="Masukkan Kabupaten" value=""></div>
                                            <div class="col-md-12"><label class="labels">Kecamatan</label><input type="text" class="form-control" required="true" placeholder="Masukkan Kecamatan" value=""></div>
                                            <div class="col-md-12"><label class="labels">Alamat</label><input type="text" class="form-control" required="true" placeholder="Masukkan Alamat" value=""></div>
                                            <div class="col-md-12"><label class="labels">Kode Pos</label><input type="text" class="form-control" required="true" placeholder="Masukkan Kode Pos" value=""></div>
                                            <div class="col-md-12"><label class="labels">Catatan Tambahan</label><input type="text" class="form-control" required="true" placeholder="Masukkan Catatan Tambahan" value=""></div>
                                            <br>
                                            <!-- Checkbox -->
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" id="customCheck2" type="checkbox" checked="">
                                                <label class="custom-control-label" for="customCheck2">
                                                    <span>Simpan untuk transaksi selanjutnya</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary my-4">Batal</button><button type="button" class="btn btn-primary my-4">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <!-- List Pesanan -->
                        <div class="form-group">
                            <div class="row align-items-center bg-secondary mt-2">
                                <div class="col-md-4">
                                    <h5>Produk Andalan</h5>
                                    <input type="hidden" value="Loose Powder" name="nama_product[]"/>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" id="qty" class="form-control text-center" value="0" style="width: 100px;"/>
                                </div>
                                <div class="col-md-3">
                                    <h5 style="text-align: right;">Rp. 250.000</h5>
                                    <input type="hidden" value="250000" name="harga_product[]"/>
                                </div>
                                <div class="col-md-3">
                                    <div style="text-align: right;"><i id="remove" class="fa fa-trash btn-remove" ></i></div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <a href="./buy-products.html" button class="btn btn-icon btn-3 btn-outline-success" type="button">
                                <span class="btn-inner--icon"><i class="fas fa-cart-plus"></i></span>
                                <span class="btn-inner--text">Tambah Produk Lain</span>
                            </a>
                        </div>
                        <hr>
                        <div class="card border-success mb-3">
                            <div class="card-header">Pilih Jasa Ekspedisi</div>
                                <div class="card-body text-success">
                                <div class="col-lg-3 col-sm-6 mt-4 mt-md-0">
                                    <!-- Radio buttons -->
                                    <div class="custom-control custom-radio mb-3">
                                    <input name="custom-radio-1" class="custom-control-input" id="customRadio1" checked="" type="radio">
                                    <label class="custom-control-label" for="customRadio1">
                                        <span>J&T Express</span>
                                    </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                    <input name="custom-radio-1" class="custom-control-input" id="customRadio2" type="radio">
                                    <label class="custom-control-label" for="customRadio2">
                                        <span>Wahana</span>
                                    </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                    <input name="custom-radio-1" class="custom-control-input" id="customRadio3" type="radio">
                                    <label class="custom-control-label" for="customRadio3">
                                        <span>TIKI</span>
                                    </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                    <input name="custom-radio-1" class="custom-control-input" id="customRadio4" type="radio">
                                    <label class="custom-control-label" for="customRadio4">
                                        <span>POS Indonesia</span>
                                    </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <table style="width: 100%;">
                                <tr>
                                    <th colspan="2" class="text-center">Rincian Biaya</th>
                                </tr>
                                <tr>
                                    <td style="width: 50%;"></td>
                                    <td style="width: 50%;"></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Subtotal Produk</td>
                                    <td class="pl-4">Rp. XXXXXX</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Biaya Pengiriman</td>
                                    <td class="pl-4">Rp. XXXXXX</td>
                                </tr>
                            </table>
                            <nav class="navbar fixed-bottom navbar-light bg-white shadow">
                                <div class="container row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <h4>Total : Rp. XXXXXX</h4>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="<?= site_url('payment-by-admin') ?>"button type="button" class="btn btn-warning btn-round">Lanjut Bayar</a>
                                    </div>
                                </div>
                            </nav>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/js/custom/select-option-pesanan.js"></script>