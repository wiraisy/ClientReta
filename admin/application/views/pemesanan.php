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
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-pay-tab" data-bs-toggle="tab" data-bs-target="#nav-pay" type="button" role="tab" aria-controls="nav-pay" aria-selected="true">
                                    Belum dibayar</button>
                                <button class="nav-link" id="nav-ship-tab" data-bs-toggle="tab" data-bs-target="#nav-ship" type="button" role="tab" aria-controls="nav-ship" aria-selected="false">
                                    Menunggu pengiriman</button>
                                <button class="nav-link" id="nav-receive-tab" data-bs-toggle="tab" data-bs-target="#nav-receive" type="button" role="tab" aria-controls="nav-receive" aria-selected="false">
                                    Pesanan dikirim</button>
                                <button class="nav-link" id="nav-completed-tab" data-bs-toggle="tab" data-bs-target="#nav-completed" type="button" role="tab" aria-controls="nav-completed" aria-selected="false">
                                    Selesai</button>  
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-pay" role="tabpanel" aria-labelledby="nav-pay-tab">
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                                    <span class="alert-inner--text"><strong>Info!</strong> Anda bisa mengingatkan user yang belum membayar dengan mengklik tombol chat.</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <table class="table table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">User</th>
                                        <th scope="col">Product & Qty</th>
                                        <th scope="col"><div class="text-center">Yang dapat dilakukan</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Arya Stark</th>
                                        <td>Lip Care 2, White + Powder 3</td>
                                        <td><div class="text-center"><button type="button" class="btn btn-sm btn-danger">Chat</button></div></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sansa Strak</th>
                                        <td>White + Powder 1, Krim Malam 3, Lip Care 2</td>
                                        <td><div class="text-center"><button type="button" class="btn btn-sm btn-danger">Chat</button></div></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">John Snow</th>
                                        <td>Krim Pagi 2, Krim Malam 2</td>
                                        <td><div class="text-center"><button type="button" class="btn btn-sm btn-danger">Chat</button></div></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
                                </div>
                                <div class="tab-pane fade" id="nav-ship" role="tabpanel" aria-labelledby="nav-ship-tab">
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                                    <span class="alert-inner--text"><strong>Info!</strong> Bila member sudah mengirim bukti transfer, silahkan klik tombol kirim</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <table class="table table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">User</th>
                                        <th scope="col">Product & Qty</th>
                                        <th scope="col"><div class="text-center">Yang dapat dilakukan</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Arya Stark</th>
                                        <td>Lip Care 2, White + Powder 3</td>
                                        <td>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger">Detail</button>
                                            <button type="button" class="btn btn-sm btn-danger">Cek</button>
                                            <button type="button" class="btn btn-sm btn-danger">Kirim</button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sansa Strak</th>
                                        <td>White + Powder 1, Krim Malam 3, Lip Care 2</td>
                                        <td>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger">Detail</button>
                                            <button type="button" class="btn btn-sm btn-danger">Cek</button>
                                            <button type="button" class="btn btn-sm btn-danger">Kirim</button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">John Snow</th>
                                        <td>Krim Pagi 2, Krim Malam 2</td>
                                        <td>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger">Detail</button>
                                            <button type="button" class="btn btn-sm btn-danger">Cek</button>
                                            <button type="button" class="btn btn-sm btn-danger">Kirim</button>
                                        </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="tab-pane fade" id="nav-receive" role="tabpanel" aria-labelledby="nav-receive-tab">
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                                    <span class="alert-inner--text"><strong>Info!</strong> Setelah mengisi form silahkan klik update</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <table class="table table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">User</th>
                                        <th scope="col">No. Order</th>
                                        <th scope="col">Nomor Pengiriman</th>
                                        <th scope="col">Jasa Ekspedisi</th>
                                        <th scope="col"><div class="text-center">Yang Dapat Dilakukan</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">04-Feb-2021</th>
                                        <td>Arya Stark</td>
                                        <td>OL00001</td>
                                        <td>
                                        <input type="text" class="form-control form-control-sm" id="noresi1" placeholder="Masukkan No. Resi">
                                        </td>
                                        <td>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Pilih</option>
                                        <option value="1">J&T</option>
                                        <option value="2">Pos</option>
                                        <option value="3">Tiki</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger">Detail</button>
                                        <button type="button" class="btn btn-sm btn-danger">Update</button>
                                        <button type="button" class="btn btn-sm btn-danger">Selesai</button>
                                        </div>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--icon"><i class="fas fa-info"></i></span>
                                    <span class="alert-inner--text"><strong>Info!</strong> Laporan transaksi sukses</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <table class="table table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">User</th>
                                        <th scope="col">No. Order</th>
                                        <th scope="col">Nomor Pengiriman</th>
                                        <th scope="col">Jasa Ekspedisi</th>
                                        <th scope="col"><div class="text-center">Yang Dapat Dilakukan</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">04-Feb-2021</th>
                                        <td>Aaliyah</td>
                                        <td>OL00002</td>
                                        <td>JD00010001</td>
                                        <td>J&T</td>
                                    <td>
                                        <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger">Detail</button>
                                        <button type="button" class="btn btn-sm btn-danger">Cetak</button>
                                        </div>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>  