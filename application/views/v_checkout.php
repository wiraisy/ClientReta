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
    [type="radio"]:not(:checked), [type="checkbox"]:checked,
    [type="checkbox"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }
    [type="radio"]:checked + label,
    [type="radio"]:not(:checked) + label ,[type="checkbox"]:checked + label,
    [type="checkbox"]:not(:checked) + label
    {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }
    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:before, [type="checkbox"]:checked + label:before,
    [type="checkbox"]:not(:checked) + label:before {
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
    [type="radio"]:not(:checked) + label:after, [type="checkbox"]:checked + label:after,
    [type="checkbox"]:not(:checked) + label:after {
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
    [type="radio"]:not(:checked) + label:after, [type="checkbox"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    [type="radio"]:checked + label:after, [type="checkbox"]:checked + label:after {
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
<div class="section">
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
            <span class="alert-inner--text"><strong>Info!</strong> Klik tombol edit dibawah ini untuk merubah alamat pengiriman</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <!-- Section Alamat Pengiriman -->
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
                                    <form method="POST" action="<?= base_url() ?>transaksi/addAlamatKirim">
                                        <input type="hidden" name="idAlamatKirim" value="<?= ($dataAlamat) ? $dataAlamat[0]['idkirim'] : '' ?>">
                                        <input type="hidden" id="idpasien" value="<?= $this->session->userdata('data_user_reta')['data']['id_pasien'] ?>">
                                        <div class="col-md-12 mt-2">
                                            <label class="labels">Alamat Penerima</label>
                                            <textarea class="form-control" id="alamatpenerima" name="alamat" required="true" placeholder="Masukkan Alamat Penerima" rows="3"><?= ($dataAlamat) ? $dataAlamat[0]['alamat'] : '' ?></textarea>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="pilih-produk">Pilih Provinsi</label>
                                            <select class="form-control" name="selectProvinsi" id="selectProvinsi" required>
                                            <option value="<?= ($dataAlamat) ? $dataAlamat[0]['idpropinsi'] : '' ?>" selected><?= ($dataAlamat) ? $dataAlamat[0]['propinsi'] : 'Pilih Provinsi' ?></option>
                                                <?php if($dataProvinsi['rajaongkir']['status']['code']===200){ ?>
                                                    <?php foreach ($dataProvinsi['rajaongkir']['results'] as $row_dataProvinsi) { ?>
                                                        <option value="<?= $row_dataProvinsi['province_id'] ?>"><?= $row_dataProvinsi['province'] ?></option>
                                                    <?php } ?>
                                                <?php }else{?>
                                                        <option disabled>Data Provinsi Tidak Tersedia</option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="provinsi" id="hiddenProvinsi">
                                            <script>
                                                document.getElementById('hiddenProvinsi').value=$('#selectProvinsi').find(":selected").text();
                                            </script>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="pilih-produk">Pilih Kota / Kabupaten</label>
                                            <select class="form-control" name="selectKota" id="selectKota" onchange="document.getElementById('hiddenKabupaten').value=this.options[this.selectedIndex].text" required>
                                                <option value="<?= ($dataAlamat) ? $dataAlamat[0]['idkabupaten'] : '' ?>" selected><?= ($dataAlamat) ? $dataAlamat[0]['kabupaten'] : 'Pilih Kota / Kabupaten' ?></option>
                                            </select>
                                            <input type="hidden" name="kabupaten" id="hiddenKabupaten">
                                            <script>
                                                document.getElementById('hiddenKabupaten').value=$('#selectKota').find(":selected").text();
                                            </script>
                                        </div>
                                        <br>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button><button type="submit" id="addAlamatKirim" class="btn btn-primary my-4">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- Section Product Checkout -->
    <div class="container section-cart-checkout">
        <?php if($datacart){ ?>
            <input type="hidden" value="<?php 
                $allQty = 0;
                foreach ($datacart as $rowCount) {
                    $allQty += $rowCount['jumlah'];
                };
                echo $allQty; ?>" id="countAllQty">
            <?php foreach ($datacart as $row) { ?>
                <div class="form-group main-cart" id="<?= $row['kodeid'] ?>">
                    <div class="row align-items-center bg-secondary mt-2 py-4">
                        <div class="col-md-4 product-img text-center">
                            <?php 
                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getproductimagebykodeid/'.$row['kodeid'],
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
                            <div class="row" style="width: 40%;">
                                <div class="col-md-6">
                                    <a data-toggle="modal" data-target="#updateQty<?= $row['kodeid'] ?>" type="button" class="btn btn-success btn-sm mt-1"><i class="fa fa-pencil"></i><span> Edit Jumlah</span></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="updateQty<?= $row['kodeid'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Update Jumlah Produk <strong><?= $row['namabarang'] ?></strong> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('transaksi/updateQty'); ?>" method="POST" >
                                                        <div class="form-group text-center">
                                                            <input type="hidden" name="kodeid" value="<?= $row['kodeid'] ?>">
                                                            <input type="number" class="form-control" name="jumlah" min="1" style="width: 80%;" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-danger btn-sm mt-1" id="remove-<?= $row['kodeid'] ?>"><i class="fa fa-trash"></i><span> Hapus dari Keranjang</span></button>
                                    <script>
                                        $(`#remove-<?= $row['kodeid'] ?>`).click(function() {
                                            var xhr = new XMLHttpRequest();
                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState == 4) {
                                                    if (xhr.status == 200) {
                                                        JSON.parse(xhr.responseText);
                                                    }
                                                }
                                            };
                                            xhr.open("DELETE", "https://api-reta.id/reta-api/Penjualan/removedetailfromcart/<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>/<?= $row['kodeid'] ?>");
                                            xhr.setRequestHeader("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");
                                            xhr.send();
                                            $(`#<?= $row['kodeid'] ?>`).remove();
                                            location.reload();
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
                                        });
                                    </script>  
                                </div>                                  
                            </div>
                        </div>
                    </div>
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

        <!-- Section Jasa Ekspedisi -->
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

        <!-- Section Opsi Asuransi -->
        <div class="card border-success mb-3">
            <div class="card-header">Produk Asuransi</div>
                <div class="card-body text-success">
                <?php if ($dataAlamat) { ?>
                    <div class="col-lg-3 col-sm-6 mt-4 mt-md-0">
                        <!-- Radio buttons -->
                        <p>
                            <input type="checkbox" id="asuransi" name="asuransi" value="5000"/>
                            <label for="asuransi">Rp. 5000</label>
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

        <!-- Section All Detail Cost -->
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
                    <td class="pl-4"><h5 id="costPengiriman">Rp. -</h5></td>
                    <input type="hidden" class="costDeliver">
                </tr>
                <tr>
                    <td class="text-right"><h5>Biaya Asuransi</h5></td>
                    <td class="pl-4"><h5 id="costAsuransi">Rp. -</h5></td>
                    <input type="hidden" class="costAsuransi" value="0">
                </tr>
            </table>
        <?php } else{ ?>
            <div class="text-center">
                <h2>Anda belum menambahkan produk ke dalam keranjang anda.</h2>
                <a href="<?= base_url() ?>" class="btn btn-info btn-round mt-3">Beli Produk</a>
            </div>
        <?php } ?>
        
        <!-- Section Post Penjualan -->
            <nav class="navbar fixed-bottom navbar-light bg-white shadow">
                <div class="container">
                    <h4 id="totalCost"></h4>
                    <input type="hidden" id="namaekspedisi">
                    <input type="hidden" class="totalCost" value=0>
                    <button type="button" class="btn btn-warning btn-round" id="postPenjualan" onclick="postPenjualan()">Lanjut Bayar</button>
                    <script>
                        function postPenjualan() {
                            const button = document.getElementById('postPenjualan');
                            let checkField = document.getElementById("totalCost").innerHTML;
                            let biayapengiriman = document.getElementsByClassName("costDeliver").value;
                            let biayaasuransi = document.getElementsByClassName("costAsuransi").value;
                            let idpasien = <?= $this->session->userdata('data_user_reta')['data']['id_pasien'] ?>;
                            let custid = "<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>";
                            let idalamatkirim = <?= ($dataAlamat) ? $dataAlamat[0]['idkirim'] : '' ?>;
                            let namaekspedisi = document.getElementById("namaekspedisi").value;

                            if (!biayapengiriman) {

                                alert("Alamat Pengiriman, Keranjang, & Jasa Ekspedisi Tidak Boleh Kosong!");
                                return false;

                            } else {

                                button.setAttribute('disabled', '');
                                
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    icon: 'warning',
                                    title: '&nbsp;Loading...'
                                })

                                if (biayaasuransi == undefined) {
                                    totalpengiriman = parseInt(biayapengiriman);
                                } else {
                                    totalpengiriman = parseInt(biayapengiriman) + parseInt(biayaasuransi);
                                }

                                var settingsKodePenjualan = {
                                    "url": "https://api-reta.id/reta-api/Penjualan/generatekodepenjualan",
                                    "method": "GET",
                                    "timeout": 0,
                                    "async" : false,
                                    "headers": {
                                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                    },
                                };
                                var KodePenjualan = $.ajax(settingsKodePenjualan).done(function (res) {
                                    return res;
                                }).responseText;

                                var settingsPost = {
                                    "url": "https://api-reta.id/reta-api/Penjualan/Checkout",
                                    "method": "POST",
                                    "timeout": 0,
                                    "async" : false,
                                    "headers": {
                                        "Content-Type": "application/json",
                                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                    },
                                    "data": JSON.stringify({
                                        "biayapengiriman": biayapengiriman,
                                        "idalamatkirim": idalamatkirim,
                                        "idpasien": idpasien,
                                        "kodetransaksi": KodePenjualan,
                                        "namaexpedisi": namaekspedisi
                                    }),
                                };
                                var responsePost = $.ajax(settingsPost).done(function (response) {
                                    return response;
                                }).responseJSON;

                                var settingsEmpty = {
                                    "url": "https://api-reta.id/reta-api/Penjualan/emptycartuser/"+custid,
                                    "method": "DELETE",
                                    "timeout": 0,
                                    "async" : false,
                                    "headers": {
                                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                    },
                                };
                                var emptyCart = $.ajax(settingsEmpty).done(function (resEmpty) {
                                    return resEmpty;
                                });
                                location.href = "<?= base_url() ?>payment-product/"+responsePost.idpenjualan;
                            }
                        }
                    </script>
                </div>
            </nav>
        </div> 
    </div>
</div>

<!-- Select Option Alamat -->
<script src="<?= base_url() ?>assets/js/custom/select-option-alamat.js"></script>

    