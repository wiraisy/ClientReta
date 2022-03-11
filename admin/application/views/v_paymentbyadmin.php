<style>
    ::-webkit-file-upload-button {
        display: none;
    }
    ::file-selector-button {
        display: none;
    }
    input[type='file'] {
        color: transparent;
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
                    <div class="container">
                        <div style="text-align: center;">
                            <h5>Lakukan pembayaran sebelum:</h5>
                            <h5 class="display-4 mb-0" id="countdown-section"></h5>
                            <h5>Total pembayaran:</h5>
                            <h4>Rp. <?= number_format($datapenjualan['grandtotal'],2,',','.') ?></h4>
                            <br>
                            <div class="card border-primary mb-3">
                                <div class="card-header">Silahkan transfer ke nomor rekening di bawah ini:</div>
                                <div class="card-body text-primary">
                                    <h5 class="card-title"><img src="<?= base_url() ?>/assets/img/favicon-bca.png" alt="Rounded image" style="width: 30px;"> Bank BCA</h5>
                                    <h5>a.n Mareta Silviana</h5>
                                    <h4>0461433455</h4><button type="button" class="btn btn-link text-success">SALIN</button>
                                    <p class="card-text">Setelah melakukan pembayaran, simpan bukti pembayaran dan upload dengan klik tombol dibawah ini.</p>
                                    <form action="<?= base_url() ?>pemesanan/uploadBukti" method="POST" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="kodetransaksi" value="<?= $datapenjualan['kodetransaksi'] ?>">
                                            <div class="input-group-prepend" style="display: unset!important;">
                                                <button type="submit" class="input-group-text">Upload</button>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="fileBuktiBayar" id="inputGroupFile01" accept="image/jpg, image/jpeg" required>
                                                <label class="custom-file-label" for="inputGroupFile01">Pilih file </label>
                                            </div>
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

<!-- CountDown Js -->
<script>
    
    // Update the count down every 1 second
    const countDownEnd = <?= $datapenjualan['endcounter'] ?>;
    // const testEnd = new Date().getTime() + 60000;
    const idpenjualan = <?= $datapenjualan['idpenjualan'] ?>;
    var x = setInterval(() => {
        let now = new Date().getTime();
        var dist = countDownEnd - now;

        // Time calculations for days, hours, minutes and seconds
        let numOfDays = Math.floor(dist / (1000 * 60 * 60 * 24));

        let hr = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        let min = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));

        let sec = Math.floor((dist % (1000 * 60)) / 1000);

        //   // Output the result in an element with id="demo"
        document.getElementById("countdown-section").innerHTML = numOfDays + "d " + hr + "h " + min + "m " + sec + "s ";

            // If the count down is over, write some text and change url
            if (dist <= 0) {
                clearInterval(x);
                document.getElementById("countdown-section").innerHTML = "EXPIRED";
                // Delete Penjualan di API
                var settings = {
                "url": "https://api-reta.id/reta-api/Penjualan/HapusPenjualanbyid/"+idpenjualan,
                    "method": "DELETE",
                    "timeout": 0,
                    "async": false,
                    "headers": {
                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                    },
                };

                var res = $.ajax(settings).done(function (response) {
                    return response;
                }).responseJSON;

                location.replace(`<?= base_url() ?>payment-by-admin/${idpenjualan}`);
            }
    }, 1000);

</script>