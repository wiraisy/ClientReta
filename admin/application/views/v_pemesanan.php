<style>
    .product-img > img {
        width: 200px; /* You can set the dimensions to whatever you want */
        height: 200px;
        object-fit: cover;
    }
    .bukti-img > img {
        width: 100%; 
        object-fit: cover;
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
                        <div class="container-1">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="belumBayar-tab" data-toggle="tab" href="#belumBayar" role="tab" aria-controls="belumBayar" aria-selected="true">Pesanan Belum Divalidasi / Belum Dibayar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="validasi-tab" data-toggle="tab" href="#validasi" role="tab" aria-controls="validasi" aria-selected="false">Pesanan Telah Divalidasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Pesanan Sedang Dikirim</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- Belum Bayar -->
                                <div class="tab-pane fade show active" id="belumBayar" role="tabpanel" aria-labelledby="belumBayar-tab">
                                    <br>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                                        <span class="alert-inner--text"><strong>Info!</strong> Please make payment to the bank account listed on the checkout page. Don't forget to validate the payment.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <?php if ($dataBelumBayar) { ?>
                                    <div class="table-responsive py-4">
                                        <table class="table table-sm text-center" id="datatable-basic">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Customer ID</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Total Pembelian</th>
                                                    <th scope="col">Jasa Ekspedisi</th>
                                                    <th scope="col">Biaya Ongkir</th>
                                                    <th scope="col">Tanggal Pembelian</th>
                                                    <th scope="col">Aksi</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($dataBelumBayar as $row) { 
                                                    // Get Status data bukti
                                                    $curl = curl_init();
                                                    curl_setopt_array($curl, array(
                                                    CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/getBuktibayarexist?idpenjualan='.$row['idpenjualan'],
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
                                                        'Accept: application/json',
                                                        'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                                    ),
                                                    ));
                                                    $res_bukti = curl_exec($curl);
                                                    curl_close($curl);
                                                    $databukti = json_decode($res_bukti, true);

                                                    // Get Info Pasien
                                                    $curlPasien = curl_init();
                                                    curl_setopt_array($curlPasien, array(
                                                    CURLOPT_URL => 'https://api-reta.id/reta-api/PasienAPI/cariberdasarkanid/'.$row['id_pasien'],
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
                                                        'Accept: application/json',
                                                        'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                                    ),
                                                    ));
                                                    $res_Pasien = curl_exec($curlPasien);
                                                    curl_close($curlPasien);
                                                    $datapasien = json_decode($res_Pasien, true);
                                                    ?>
                                                    <tr>
                                                        <td><?= $datapasien['custid'] ?></td>
                                                        <td><?= $datapasien['custnama'] ?></td>
                                                        <td><?php foreach ($row['setdetail'] as $rowinner){
                                                            echo $rowinner['namabarang'].', '; 
                                                        } ?></td>
                                                        <td>Rp. <?= number_format($row['grandtotal'],2,',','.') ?></td>
                                                        <td><?= $row['namaexpedisi']; ?></td>
                                                        <td>Rp. <?= number_format($row['biayapengiriman'],2,',','.') ?></td>
                                                        <td><?= date("d-M-Y", ((int)$row['tanggalpenjualan']/1000) ) ?></td>
                                                        <td>
                                                            <a data-toggle="modal" data-target="#detailModal<?= $row['idpenjualan'] ?>" type="button" class="btn btn-success btn-sm mt-2">Detail Pembelian</a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="detailModal<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="addModalLabel">Detail Pembelian</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <?php foreach ($row['setdetail'] as $rowinner) { ?>
                                                                            <div class="form-group main-cart" id="<?= $rowinner['kodeid'] ?>">
                                                                                <div class="row align-items-center bg-secondary mt-2 py-4">
                                                                                    <div class="col-md-4 product-img text-center">
                                                                                        <?php 
                                                                                            $curl = curl_init();

                                                                                            curl_setopt_array($curl, array(
                                                                                            CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getproductimagebykodeid/'.$rowinner['kodeid'],
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
                                                                                        <img src="<?= $src ?>" id="img-<?= $rowinner['kodeid'] ?>" class="rounded">
                                                                                    </div>
                                                                                    <div class="col-md-8 product-detail">
                                                                                        <h4><strong><?= $rowinner['namabarang'] ?></strong></h4>
                                                                                        <h5>Harga Barang : Rp. <?= number_format($rowinner['price'],2,',','.') ?></h5>
                                                                                        <h5>Total : Rp. <?= number_format($rowinner['subtotal'],2,',','.') ?></h5>
                                                                                        <div class="number my-4">
                                                                                            <input class="mx-2 text-center" type="number" value="<?= $rowinner['jumlah'] ?>" disabled/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="<?= base_url('pemesanan/batalPesan'); ?>/<?= $row['idpenjualan']; ?>" class="btn btn-danger btn-sm mt-2 deletePesanan" ><i class="fas fa-trash-alt deleteBtn" ></i> Batalkan Pesanan</a>
                                                            <?php if ($databukti == true) { ?>
                                                            <a href="<?= base_url('pemesanan/validasiDiBayar'); ?>/<?= $row['kodetransaksi']; ?>" class="btn btn-secondary btn-sm mt-2 valdasiPesanan" ><i class="fas fa-clipboard-check" ></i> Validasi Pesanan</a>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($databukti == true) { ?>
                                                                <a data-toggle="modal" data-target="#lihatBukti<?= $row['idpenjualan'] ?>" type="button" class="btn btn-info btn-sm mt-2">Lihat Bukti Pembayaran</button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url() ?>payment-by-admin/<?= $row['idpenjualan'] ?>" target="_blank" class="btn btn-warning btn-sm mt-2">Bayar Sekarang</a>
                                                            <?php } ?>
                                                        </td>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="lihatBukti<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="addModalLabel">Bukti Pembayaran</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="bukti-img text-center">
                                                                            <?php 
                                                                                $curlBukti = curl_init();
                                                                                curl_setopt_array($curlBukti, array(
                                                                                CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/loadBuktibyidpenjualan?idpenjualan='.$row['idpenjualan'],
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
                                                                                $responseBukti = curl_exec($curlBukti);
                                                                                
                                                                                curl_close($curlBukti);
                                                                                $src = 'data:image/jpg;base64,'.base64_encode($responseBukti).'';
                                                                            ?>
                                                                            <img src="<?= $src ?>" class="rounded">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>    
                                    </div>
                                    <?php } else { ?>
                                        <div class="container text-center">
                                            <p style="color:grey;font-size:18px;">Data Belum Tersedia</p>
                                    </div>
                                    <?php } ?>
                                </div>
                                <!-- Sudah Bayar -->
                                <div class="tab-pane fade" id="validasi" role="tabpanel" aria-labelledby="validasi-tab">
                                    <br>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                                        <span class="alert-inner--text"><strong>Info!</strong> All Payment has been confirmed, Please add nomor resi for order to be send.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <?php if ($dataDibayar) { ?>
                                    <div class="table-responsive py-4">
                                        <table class="table table-sm text-center table-divalidasi" >
                                            <thead>
                                                <tr>
                                                    <th scope="col">Customer ID</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Total Pembelian</th>
                                                    <th scope="col">Jasa Ekspedisi</th>
                                                    <th scope="col">Biaya Ongkir</th>
                                                    <th scope="col">Tanggal Pembelian</th>
                                                    <th scope="col">Aksi</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($dataDibayar as $row) { 
                                                    // Get Status data bukti
                                                    $curl = curl_init();
                                                    curl_setopt_array($curl, array(
                                                    CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/getBuktibayarexist?idpenjualan='.$row['idpenjualan'],
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
                                                        'Accept: application/json',
                                                        'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                                    ),
                                                    ));
                                                    $res_bukti = curl_exec($curl);
                                                    curl_close($curl);
                                                    $databukti = json_decode($res_bukti, true);

                                                    // Get Info Pasien
                                                    $curlPasien = curl_init();
                                                    curl_setopt_array($curlPasien, array(
                                                    CURLOPT_URL => 'https://api-reta.id/reta-api/PasienAPI/cariberdasarkanid/'.$row['id_pasien'],
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
                                                        'Accept: application/json',
                                                        'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                                    ),
                                                    ));
                                                    $res_Pasien = curl_exec($curlPasien);
                                                    curl_close($curlPasien);
                                                    $datapasien = json_decode($res_Pasien, true);
                                                    ?>
                                                    <tr>
                                                        <td><?= $datapasien['custid'] ?></td>
                                                        <td><?= $datapasien['custnama'] ?></td>
                                                        <td><?php foreach ($row['setdetail'] as $rowinner){
                                                            echo $rowinner['namabarang'].', '; 
                                                        } ?></td>
                                                        <td>Rp. <?= number_format($row['grandtotal'],2,',','.') ?></td>
                                                        <td><?= $row['namaexpedisi']; ?></td>
                                                        <td>Rp. <?= number_format($row['biayapengiriman'],2,',','.') ?></td>
                                                        <td><?= date("d-M-Y", ((int)$row['tanggalpenjualan']/1000) ) ?></td>
                                                        <td>
                                                            <a data-toggle="modal" data-target="#detailModal<?= $row['idpenjualan'] ?>" type="button" class="btn btn-success btn-sm mt-2">Detail Pembelian</a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="detailModal<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="addModalLabel">Detail Pembelian</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <?php foreach ($row['setdetail'] as $rowinner) { ?>
                                                                            <div class="form-group main-cart" id="<?= $rowinner['kodeid'] ?>">
                                                                                <div class="row align-items-center bg-secondary mt-2 py-4">
                                                                                    <div class="col-md-4 product-img text-center">
                                                                                        <?php 
                                                                                            $curl = curl_init();

                                                                                            curl_setopt_array($curl, array(
                                                                                            CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getproductimagebykodeid/'.$rowinner['kodeid'],
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
                                                                                        <img src="<?= $src ?>" id="img-<?= $rowinner['kodeid'] ?>" class="rounded">
                                                                                    </div>
                                                                                    <div class="col-md-8 product-detail">
                                                                                        <h4><strong><?= $rowinner['namabarang'] ?></strong></h4>
                                                                                        <h5>Harga Barang : Rp. <?= number_format($rowinner['price'],2,',','.') ?></h5>
                                                                                        <h5>Total : Rp. <?= number_format($rowinner['subtotal'],2,',','.') ?></h5>
                                                                                        <div class="number my-4">
                                                                                            <input class="mx-2 text-center" type="number" value="<?= $rowinner['jumlah'] ?>" disabled/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="<?= base_url('pemesanan/batalPesan'); ?>/<?= $row['idpenjualan']; ?>" class="btn btn-danger btn-sm mt-2 deletePesanan" ><i class="fas fa-trash-alt deleteBtn" ></i> Batalkan Pesanan</a>
                                                            <a data-toggle="modal" data-target="#addResi<?= $row['idpenjualan'] ?>" type="button" class="btn btn-secondary btn-sm mt-2" ><i class="fas fa-plus-circle" ></i> Add Resi</a>
                                                        </td>
                                                        <td>
                                                            <?php if ($databukti == true) { ?>
                                                                <a data-toggle="modal" data-target="#lihatBukti<?= $row['idpenjualan'] ?>" type="button" class="btn btn-info btn-sm mt-2">Lihat Bukti Pembayaran</button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url() ?>payment-by-admin/<?= $row['idpenjualan'] ?>" target="_blank" class="btn btn-warning btn-sm mt-2">Bayar Sekarang</a>
                                                            <?php } ?>
                                                        </td>
                                                        <!-- Modal Lihat Bukti -->
                                                        <div class="modal fade" id="lihatBukti<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="addModalLabel">Bukti Pembayaran</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="bukti-img text-center">
                                                                            <?php 
                                                                                $curlBukti = curl_init();
                                                                                curl_setopt_array($curlBukti, array(
                                                                                CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/loadBuktibyidpenjualan?idpenjualan='.$row['idpenjualan'],
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
                                                                                $responseBukti = curl_exec($curlBukti);
                                                                                
                                                                                curl_close($curlBukti);
                                                                                $src = 'data:image/jpg;base64,'.base64_encode($responseBukti).'';
                                                                            ?>
                                                                            <img src="<?= $src ?>" class="rounded">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Add Resi -->
                                                        <div class="modal fade" id="addResi<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addResiLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="addResiLabel">Tambahkan Nomor Resi Pengiriman</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?= base_url() ?>pemesanan/addResi" method="POST">
                                                                            <input type="hidden" name="kodetransaksi" value="<?= $row['kodetransaksi']; ?>">
                                                                            <input type="text" class="form-control" name="noresi" autocomplete="off" required>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success">Save</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table> 
                                    </div>   
                                    <?php } else { ?>
                                        <div class="container text-center">
                                            <p style="color:grey;font-size:18px;">Data Belum Tersedia</p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- Dikirim -->
                                <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                                    <br>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                                        <span class="alert-inner--text"><strong>Info!</strong> Please wait for the goods to arrive.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div> 
                                    <?php if ($dataDikirim) { ?>
                                    <div class="table-responsive py-4">
                                        <table id="table-dikirim" class="table table-sm text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Customer ID</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Total Pembelian</th>
                                                    <th scope="col">Jasa Ekspedisi</th>
                                                    <th scope="col">Biaya Ongkir</th>
                                                    <th scope="col">Tanggal Pembelian</th>
                                                    <th scope="col">Aksi</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($dataDikirim as $row) { 
                                                    // Get Status data bukti
                                                    $curl = curl_init();
                                                    curl_setopt_array($curl, array(
                                                    CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/getBuktibayarexist?idpenjualan='.$row['idpenjualan'],
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
                                                        'Accept: application/json',
                                                        'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                                    ),
                                                    ));
                                                    $res_bukti = curl_exec($curl);
                                                    curl_close($curl);
                                                    $databukti = json_decode($res_bukti, true);

                                                    // Get Info Pasien
                                                    $curlPasien = curl_init();
                                                    curl_setopt_array($curlPasien, array(
                                                    CURLOPT_URL => 'https://api-reta.id/reta-api/PasienAPI/cariberdasarkanid/'.$row['id_pasien'],
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
                                                        'Accept: application/json',
                                                        'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
                                                    ),
                                                    ));
                                                    $res_Pasien = curl_exec($curlPasien);
                                                    curl_close($curlPasien);
                                                    $datapasien = json_decode($res_Pasien, true);
                                                    ?>
                                                    <tr>
                                                        <td><?= $datapasien['custid'] ?></td>
                                                        <td><?= $datapasien['custnama'] ?></td>
                                                        <td><?php foreach ($row['setdetail'] as $rowinner){
                                                            echo $rowinner['namabarang'].', '; 
                                                        } ?></td>
                                                        <td>Rp. <?= number_format($row['grandtotal'],2,',','.') ?></td>
                                                        <td><?= $row['namaexpedisi']; ?></td>
                                                        <td>Rp. <?= number_format($row['biayapengiriman'],2,',','.') ?></td>
                                                        <td><?= date("d-M-Y", ((int)$row['tanggalpenjualan']/1000) ) ?></td>
                                                        <td>
                                                            <a data-toggle="modal" data-target="#detailModal<?= $row['idpenjualan'] ?>" type="button" class="btn btn-success btn-sm mt-2">Detail Pembelian</a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="detailModal<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="addModalLabel">Detail Pembelian</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <?php foreach ($row['setdetail'] as $rowinner) { ?>
                                                                            <div class="form-group main-cart" id="<?= $rowinner['kodeid'] ?>">
                                                                                <div class="row align-items-center bg-secondary mt-2 py-4">
                                                                                    <div class="col-md-4 product-img text-center">
                                                                                        <?php 
                                                                                            $curl = curl_init();

                                                                                            curl_setopt_array($curl, array(
                                                                                            CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/getproductimagebykodeid/'.$rowinner['kodeid'],
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
                                                                                        <img src="<?= $src ?>" id="img-<?= $rowinner['kodeid'] ?>" class="rounded">
                                                                                    </div>
                                                                                    <div class="col-md-8 product-detail">
                                                                                        <h4><strong><?= $rowinner['namabarang'] ?></strong></h4>
                                                                                        <h5>Harga Barang : Rp. <?= number_format($rowinner['price'],2,',','.') ?></h5>
                                                                                        <h5>Total : Rp. <?= number_format($rowinner['subtotal'],2,',','.') ?></h5>
                                                                                        <div class="number my-4">
                                                                                            <input class="mx-2 text-center" type="number" value="<?= $rowinner['jumlah'] ?>" disabled/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="<?= base_url('pemesanan/batalPesan'); ?>/<?= $row['idpenjualan']; ?>" class="btn btn-danger btn-sm mt-2 deletePesanan" ><i class="fas fa-trash-alt deleteBtn" ></i> Hapus Pesanan</a>
                                                        </td>
                                                        <td>
                                                            <?php if ($databukti == true) { ?>
                                                                <a data-toggle="modal" data-target="#lihatBukti<?= $row['idpenjualan'] ?>" type="button" class="btn btn-info btn-sm mt-2">Lihat Bukti Pembayaran</button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url() ?>payment-by-admin/<?= $row['idpenjualan'] ?>" target="_blank" class="btn btn-warning btn-sm mt-2">Bayar Sekarang</a>
                                                            <?php } ?>
                                                                <a data-toggle="modal" data-target="#lihatResi<?= $row['idpenjualan'] ?>" type="button" class="btn btn-secondary btn-sm mt-2" ><i class="fas fa-plus-circle" ></i> Lihat Resi</a>
                                                        </td>
                                                        <!-- Modal Lihat Bukti -->
                                                        <div class="modal fade" id="lihatBukti<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="addModalLabel">Bukti Pembayaran</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="bukti-img text-center">
                                                                            <?php 
                                                                                $curlBukti = curl_init();
                                                                                curl_setopt_array($curlBukti, array(
                                                                                CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/loadBuktibyidpenjualan?idpenjualan='.$row['idpenjualan'],
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
                                                                                $responseBukti = curl_exec($curlBukti);
                                                                                
                                                                                curl_close($curlBukti);
                                                                                $src = 'data:image/jpg;base64,'.base64_encode($responseBukti).'';
                                                                            ?>
                                                                            <img src="<?= $src ?>" class="rounded">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Add Resi -->
                                                        <div class="modal fade" id="lihatResi<?= $row['idpenjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="addResiLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="addResiLabel">Nomor Resi Pengiriman</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container text-center">
                                                                                <h2><?= $row['noresi']; ?></h2>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>    
                                    </div>
                                    <?php } else { ?>
                                        <div class="container text-center">
                                            <p style="color:grey;font-size:18px;">Data Belum Tersedia</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>  