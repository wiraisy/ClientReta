<div class="section" style="height: 100vh">
    <div class="container">
        <div class="container-1">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="belumBayar-tab" data-toggle="tab" href="#belumBayar" role="tab" aria-controls="belumBayar" aria-selected="true">Belum Dikirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="validasi-tab" data-toggle="tab" href="#validasi" role="tab" aria-controls="validasi" aria-selected="false">Telah Dibayar & Divalidasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="belumBayar" role="tabpanel" aria-labelledby="belumBayar-tab">
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                        <span class="alert-inner--text"><strong>Info!</strong> You can make payment to the bank account listed on the checkout page. Please press the checkout menu.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <table class="table table-sm text-center" id="datatable-basic">
                        <thead>
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga/Produk</th>
                                <th scope="col">Total SubProduk</th>
                                <th scope="col">Jasa Ekspedisi</th>
                                <th scope="col">Biaya Ongkir</th>
                                <th scope="col">Total Pembelian</th>
                                <th scope="col">Tanggal Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($dataPenjualan['content']) { ?>
                            <?php 
                            foreach ($dataPenjualan['content'] as $row) { ?>
                                    <?php 
                                    $tgl_pembelian = $row['tanggalpenjualan'];
                                    $biayapengiriman = $row['biayapengiriman'];
                                    $totalpembelian = $row['grandtotal'];
                                    $namaexpedisi = $row['namaexpedisi'];
                                    foreach ($dataPenjualan['content'][0]['setdetail'] as $rowDetail) {  ?>
                                        <tr>
                                            <td><?= $rowDetail['namabarang'] ?></td>
                                            <td><?= $rowDetail['jumlah'] ?></td>
                                            <td>Rp. <?= number_format($rowDetail['price'],2,',','.') ?></td>
                                            <td>Rp <?= number_format($rowDetail['subtotal'],2,',','.') ?></td>
                                            <td><?= $namaexpedisi ?></td>
                                            <td>Rp. <?= number_format($biayapengiriman,2,',','.') ?></td>
                                            <td>Rp. <?= number_format($totalpembelian,2,',','.') ?></td>
                                            <td><?= date("d-M-Y", ((int)$tgl_pembelian/1000) ) ?></td>
                                        </tr>
                                    <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" style="text-align:center;"><p style="color:grey;font-size:18px;">Data Belum Tersedia</p></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    
                        
                    
                     
                        
                </div>
                <div class="tab-pane fade" id="validasi" role="tabpanel" aria-labelledby="validasi-tab">
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                        <span class="alert-inner--text"><strong>Info!</strong> Please send proof of payment, and then wait for your order to be confirmed.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <table class="table table-sm text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga/Produk</th>
                                <th scope="col">Total SubProduk</th>
                                <th scope="col">Jasa Ekspedisi</th>
                                <th scope="col">Total Pembelian</th>
                                <th scope="col">Tanggal Pembelian</th>
                                <th scope="col">Tanggal Validasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Lip Care</td>
                                <td>2</td>
                                <td>Rp. xxxxx</td>
                                <td>Rp. xxxxx</td>
                                <td>JNE</td>
                                <td>Rp. xxxxx</td>
                                <td>2 Juni 2000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                        <span class="alert-inner--text"><strong>Info!</strong> Payment has been confirmed, please wait for the goods to arrive.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>