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
    @media screen and (max-width: 426px) {
        footer{
            display:none;
        }
    }
</style>
<div class="section" style="height: 100vh">
    <div class="container">
        <div class="container-1">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="belumBayar-tab" data-toggle="tab" href="#belumBayar" role="tab" aria-controls="belumBayar" aria-selected="true">Pembelian Belum Divalidasi / Belum Dibayar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="validasi-tab" data-toggle="tab" href="#validasi" role="tab" aria-controls="validasi" aria-selected="false">Pembayaran Telah Divalidasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Belum Bayar -->
                <div class="tab-pane fade show active" id="belumBayar" role="tabpanel" aria-labelledby="belumBayar-tab">
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                        <span class="alert-inner--text"><strong>Info!</strong> You can make payment to the bank account listed on the checkout page. Please press the checkout menu.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <?php if ($dataBelumBayar['content']) { ?>
                    <div class="table-responsive">
                        <table class="table table-sm text-center" id="datatable-basic">
                            <thead>
                                <tr>
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
                                foreach ($dataBelumBayar['content'] as $row) { 
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
                                    ?>
                                    <tr>
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
                                            <a href="<?= base_url('profil/batalPesan'); ?>/<?= $row['idpenjualan']; ?>" class="btn btn-danger btn-sm mt-2 deleteAlert" ><i class="fas fa-trash-alt deleteBtn" ></i> Batalkan Pesanan</a>
                                        </td>
                                        <td>
                                            <?php if ($databukti == true) { ?>
                                                <button class="btn btn-info btn-sm mt-2" disabled>Menunggu Validasi</button>
                                            <?php } else { ?>
                                                <a href="<?= base_url() ?>payment-product/<?= $row['idpenjualan'] ?>" target="_blank" class="btn btn-warning btn-sm mt-2">Bayar Sekarang</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>    
                    </div>
                    <?php } else { ?>
                        <div class="text-center">
                            <p style="color:grey;font-size:18px;">Data Belum Tersedia</p>
                        </div>
                    <?php } ?>
                </div>
                <!-- Sudah Bayar -->
                <div class="tab-pane fade" id="validasi" role="tabpanel" aria-labelledby="validasi-tab">
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                        <span class="alert-inner--text"><strong>Info!</strong> Payment has been confirmed, Please wait for your order to be send.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <?php if ($dataDibayar['content']) { ?>
                    <div class="table-responsive">
                        <table class="table table-sm text-center" id="datatable-superadmin">
                            <thead>
                                <tr>
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
                                foreach ($dataDibayar['content'] as $row) { ?>
                                    <tr>
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
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-target="#lihatBukti<?= $row['idpenjualan'] ?>" type="button" class="btn btn-info btn-sm mt-2">Lihat Bukti Pembayaran</button>
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
                        <div class="text-center">
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
                    <?php if ($dataDikirim['content']) { ?>    
                    <div class="table-responsive">
                        <table class="table table-sm text-center" id="datatable-admin">
                            <thead>
                                <tr>
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
                                foreach ($dataDikirim['content'] as $row) { ?>
                                    <tr>
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
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-target="#lihatBukti<?= $row['idpenjualan'] ?>" type="button" class="btn btn-info btn-sm mt-2">Lihat Bukti Pembayaran</button>
                                            <a data-toggle="modal" data-target="#lihatResi<?= $row['idpenjualan'] ?>" type="button" class="btn btn-secondary btn-sm mt-2" ><i class="fas fa-plus-circle" ></i> Lihat Resi</a>
                                        </td>
                                        <!-- Modal Bukti -->
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
                        <div class="text-center">
                            <p style="color:grey;font-size:18px;">Data Belum Tersedia</p>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>