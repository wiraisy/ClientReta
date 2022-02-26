<style>
    .bootstrap-select button{
        background: white!important;
        text-transform: inherit!important;
        font-weight: normal!important;
    }
    .product-img > img {
        width: 200px; /* You can set the dimensions to whatever you want */
        height: 200px;
        object-fit: cover;
    }
    .input-counter{
        display: flex;
    }
    .counter {
        cursor:pointer; 
    }
    .product-detail > button{
        text-transform: unset!important;
        font-size: 14px;
    }
    .number > input{
        width: 100px;
        text-align: center;
        font-size: 26px;
		border:1px solid #ddd;
		border-radius:4px;
        display: inline-block;
        vertical-align: middle;
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
        top: 3px;
        left: 3px;
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
    @media screen and (max-width: 768px) {
        .product-img > img {
            width: 100px; /* You can set the dimensions to whatever you want */
            height: 100px;
        }
    }
</style>
<script>
    function removeProduct(custid, kodeid){
        console.log(kodeid);
        // $(`#${kodeid}`).remove();
        // return false;
    }
</script>
<div class="section">
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
            <span class="alert-inner--text"><strong>Info!</strong> Klik tombol edit dibawah ini untuk merubah alamat pengiriman</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">Alamat Pengiriman:
                        <br>
                        <?php if ($dataAlamat) { ?>
                            <input type="hidden" id="idKotaPengiriman" value="<?= $dataAlamat[0]['idkabupaten'] ?>">
                            <?= $this->session->userdata('data_user_reta')['data']['custnama'] ?>, No.Hp : <?= $this->session->userdata('data_user_reta')['data']['hp1'] ?>, <?= $dataAlamat[0]['alamat'] ?> ,  <?= $dataAlamat[0]['kabupaten'] ?>, <?= $dataAlamat[0]['propinsi'] ?> 
                        <?php } else { ?>
                            Anda belum mengatur alamat pengiriman , <strong>tambah/ubah</strong> alamat pengiriman melalui tombol disamping.
                        <?php } ?>
                    </div>
                    <div class="col-4" style="text-align: center;">
                        <button type="button" class="btn btn-outline-danger btn-round btn-icon" data-toggle="modal" data-target="#modal-form">
                        <span class="btn-inner--icon">
                        <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                        </span>
                        Edit</button>
                    </div>
                </div>
                <!-- Modal Edit Alamat -->
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card-header bg-white pb-5">
                                    <form method="POST" action="<?= base_url() ?>transaksi/">
                                        <input type="hidden" id="idpasien" value="<?= $this->session->userdata('data_user_reta')['data']['id_pasien'] ?>">
                                        <div class="col-md-12 mt-2">
                                            <label class="labels">Alamat Penerima</label>
                                            <textarea class="form-control" id="alamatpenerima" required="true" placeholder="Masukkan Alamat Penerima" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="pilih-produk">Pilih Provinsi</label>
                                            <select class="form-control" name="selectProvinsi" id="selectProvinsi">
                                                <option value="" selected disabled>Pilih Provinsi</option>
                                                <?php if($dataProvinsi['rajaongkir']['status']['code']===200){ ?>
                                                    <?php foreach ($dataProvinsi['rajaongkir']['results'] as $row_dataProvinsi) { ?>
                                                        <option value="<?= $row_dataProvinsi['province_id'] ?>"><?= $row_dataProvinsi['province'] ?></option>
                                                    <?php } ?>
                                                <?php }else{?>
                                                        <option disabled>Data Provinsi Tidak Tersedia</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="pilih-produk">Pilih Kota / Kabupaten</label>
                                            <select class="form-control" name="selectKota" id="selectKota">
                                                <option value="" selected disabled>Pilih Kota / Kabupaten</option>
                                            </select>
                                        </div>
                                        <br>
                                    </form>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button><button type="submit" id="addAlamatKirim" class="btn btn-primary my-4">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <?php if($datacart){ ?>
            <input type="hidden" value="<?php 
                $allQty = 0;
                foreach ($datacart as $rowCount) {
                    $allQty += $rowCount['jumlah'];
                };
                echo $allQty; ?>" id="countAllQty">
            <?php foreach ($datacart as $row) { ?>
                <div class="form-group" id="<?= $row['kodeid'] ?>">
                    <div class="row align-items-center bg-secondary mt-2 py-4">
                        <div class="col-md-4 product-img text-center">
                            <?php 
                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getImagebykodeid/'.$row['kodeid'],
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
                                $src = 'data:image/jpg;base64,'.base64_encode($response).'';
                            ?>
                            <img src="<?= $src ?>" id="img-<?= $row['kodeid'] ?>" class="rounded">
                        </div>
                        <div class="col-md-8 product-detail">
                            <h4><strong><?= $row['namabarang'] ?></strong></h4>
                            <h5>Total Harga Barang : Rp. <?= number_format($row['price'] * $row['jumlah'],2,',','.') ?></h5>
                            <div class="number my-4">
                                <input class="mx-2" id="qty-<?= $row['kodeid'] ?>" type="number" value="<?= $row['jumlah'] ?>" disabled/>
                            </div>
                            <button class="btn btn-danger btn-sm mt-1" id="remove-<?= $row['kodeid'] ?>"><i class="fa fa-trash"></i><span> Hapus dari Keranjang</span></button>
                            <script>
                                $(`#remove-<?= $row['kodeid'] ?>`).click(function() {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("DELETE", "https://api-reta.id/reta-api/Penjualan/removedetailfromcart/<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>/<?= $row['kodeid'] ?>");
                                    xhr.setRequestHeader("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");
                                    xhr.send();
                                    $(`#<?= $row['kodeid'] ?>`).remove();
                                    
                                    alert("Produk dihapus dari keranjang.");

                                    var settingscart = {
                                        "url": "https://api-reta.id/reta-api/Penjualan/lihatcart/<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>",
                                        "method": "GET",
                                        "timeout": 0,
                                        "async": false,
                                        "headers": {
                                            "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                        },
                                    };
                                    var datacart = $.ajax(settingscart).done(function(response) {
                                        return response;
                                    }).responseJSON;
                                    document.getElementById('cartProduct').dataset.count = parseInt(datacart.length);
                                    return false;
                                });
                            </script>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else{ ?>
            <div class="text-center">
                <h2>Anda belum menambahkan produk ke dalam keranjang anda.</h2>
            </div>
        <?php } ?>
        <br>
        <div style="text-align: right;">
            <a href="<?= base_url(); ?>" button class="btn btn-icon btn-3 btn-outline-success" type="button">
                <span class="btn-inner--icon"><i class="fas fa-cart-plus"></i></span>
                <span class="btn-inner--text">Tambah Produk Lain</span>
            </a>
        </div>
        <hr>
        <div class="card border-success mb-3">
            <div class="card-header">Pilih Jasa Ekspedisi</div>
                <div class="card-body text-success">
                <?php if ($dataAlamat) { ?>
                    <div class="col-lg-3 col-sm-6 mt-4 mt-md-0">
                        <!-- Radio buttons -->
                        <p>
                            <input type="radio" id="jne" name="jasaEkspedisi" value="jne">
                            <label for="jne">JNE</label>
                        </p>
                        <p>
                            <input type="radio" id="tiki" name="jasaEkspedisi"  value="tiki">
                            <label for="tiki">TIKI</label>
                        </p>
                        <p>
                            <input type="radio" id="pos" name="jasaEkspedisi" value="pos">
                            <label for="pos">Pos Indonesia</label>
                        </p>
                    </div>
                <?php }else{ ?>
                    <div class="container text-center">
                        <h5>Mohon isi alamat pengiriman anda terlebih dahulu.</h5>
                    </div>
                </div>
                <?php } ?>
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
                    <td class="text-right"><h5>Subtotal Produk</h5></td>
                    <td class="pl-4" id="subtotal"><h5>Rp. <?php
                        $total_produk = 0;
                        if($datacart){
                            foreach ($datacart as $row) {
                                $total_produk += $row['price'] * $row['jumlah'];
                            }
                            echo number_format($total_produk,2,',','.');
                        }else{
                            echo '-';
                        }
                    ?></h5>
                    <input type="hidden" id="subTotal" value="<?php
                        $total_produk = 0;
                        if($datacart){
                            foreach ($datacart as $row) {
                                $total_produk += $row['price'] * $row['jumlah'];
                            }
                            echo $total_produk;
                        }else{
                            echo '-';
                        } ?>">
                    </td>
                </tr>
                <tr>
                    <td class="text-right"><h5>Biaya Pengiriman</h5></td>
                    <td class="pl-4"><h5 id="costPengiriman"></h5></td>
                </tr>
            </table>
            <nav class="navbar fixed-bottom navbar-light bg-white shadow">
                <div class="container">
                    <h4 id="totalCost"></h4>
                    <a href="<?= site_url('payment-product') ?>"button type="button" class="btn btn-warning btn-round">Lanjut Bayar</a>
                </div>
            </nav>
        </div> 
    </div>
</div>

<!-- Select Option Alamat -->
<script src="<?= base_url() ?>assets/js/custom/select-option-alamat.js"></script>

    