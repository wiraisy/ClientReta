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
                            <?php if ($dataAlamat) { ?>
                                <input type="hidden" id="idKotaPengiriman" value="<?= $dataAlamat[0]['idkabupaten'] ?>">
                                <?= $dataPasien['custnama'] ?>, No.Hp : <?= $dataPasien['hp1'] ?>, <?= $dataAlamat[0]['alamat'] ?> ,  <?= $dataAlamat[0]['kabupaten'] ?>, <?= $dataAlamat[0]['propinsi'] ?> 
                            <?php } else { ?>
                                Anda belum mengatur alamat pengiriman , <strong>tambah/ubah</strong> alamat pengiriman melalui tombol disamping.
                            <?php } ?>
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
                                        <form method="POST" action="<?= base_url() ?>pemesanan/addAlamatKirim">
                                            <input type="hidden" name="idAlamatKirim" value="<?= ($dataAlamat) ? $dataAlamat[0]['idkirim'] : '' ?>">
                                            <input type="hidden" id="idpasien" name="idpasien" value="<?= $dataPasien['id_pasien'] ?>">
                                            <input type="hidden" id="custid" name="custid" value="<?= $dataPasien['custid'] ?>">
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
                    <br>
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
                                            <div class="buttonaksi" style="display: flex;">
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
                                                                <form action="<?= base_url('pemesanan/updateQty'); ?>" method="POST" >
                                                                    <div class="form-group text-center">
                                                                        <input type="hidden" name="kodeid" value="<?= $row['kodeid'] ?>">
                                                                        <input type="hidden" name="custid" value="<?= $dataPasien['custid'] ?>">
                                                                        <input type="hidden" name="id_pasien" value="<?= $dataPasien['id_pasien'] ?>">
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
                                                        xhr.open("DELETE", "https://api-reta.id/reta-api/Penjualan/removedetailfromcart/<?= $dataPasien['custid'] ?>/<?= $row['kodeid'] ?>");
                                                        xhr.setRequestHeader("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");
                                                        xhr.send();
                                                        $(`#<?= $row['kodeid'] ?>`).remove();
                                                        location.href = "<?= base_url() ?>order-by-admin/checkout/<?= $dataPasien['id_pasien'] ?>/<?= $dataPasien['custid'] ?>";
                                                        alert("Produk dihapus dari keranjang.");
                                                    });
                                                </script>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <br>
                        <div style="text-align: right;">
                            <a href="<?= base_url(); ?>/order-by-admin" button class="btn btn-icon btn-3 btn-outline-success" type="button">
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
                                <input type="hidden" class="costTotal">
                            </tr>
                        </table>
                        <?php } else{ ?>
                            <div class="text-center">
                                <h2>Anda belum menambahkan produk ke dalam keranjang anda.</h2>
                                <a href="<?= base_url() ?>" class="btn btn-info btn-round mt-3">Beli Produk</a>
                            </div>
                        <?php } ?>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h4 id="totalCost"></h4>
                                </div>
                                <div class="col-md-6 text-right"><input type="hidden" id="namaekspedisi">
                                    <button type="button" class="btn btn-warning btn-round" id="postPenjualan" onclick="postPenjualan()">Lanjut Bayar</button>
                                    <script>
                                        function postPenjualan() {
                                            const button = document.getElementById('postPenjualan');
                                            let checkField = document.getElementById("totalCost").innerHTML;
                                            let biayapengiriman = document.getElementsByClassName("costTotal").value;
                                            let idpasien = <?= $dataPasien['id_pasien'] ?>;
                                            let custid = "<?= $dataPasien['custid'] ?>";
                                            let idalamatkirim = <?= ($dataAlamat) ? $dataAlamat[0]['idkirim'] : '' ?>;
                                            let namaekspedisi = document.getElementById("namaekspedisi").value;

                                            if (checkField == "") {
                                                alert("Alamat Pengiriman, Keranjang, & Jasa Ekspedisi Tidak Boleh Kosong!");
                                                return false;
                                            } else {
                                                button.setAttribute('disabled', '');
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
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/js/custom/select-option-alamat.js"></script>