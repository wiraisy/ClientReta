<?php date_default_timezone_set('Asia/Jakarta');  ?>
<div class="section">
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
                    <h5 class="card-title"><img src="<?= base_url() ?>assets/img/favicon-bca.png" alt="Rounded image" style="width: 30px;"> Bank BCA</h5>
                    <h5>a.n Mareta Silviana</h5>
                    <h4>0461433455</h4><button type="button" class="btn btn-link text-success">SALIN</button>
                    <p class="card-text">Setelah melakukan pembayaran, simpan bukti pembayaran dan upload dengan klik tombol dibawah ini.</p>
                    <form action="<?= base_url() ?>transaksi/uploadBukti" method="POST" enctype="multipart/form-data">
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

<!-- CountDown Js -->
<script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
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

                location.replace(`<?= base_url() ?>payment-product/${idpenjualan}`);
            }
    }, 1000);
</script>