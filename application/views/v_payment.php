
<div class="section">
    <div class="container">
        <div style="text-align: center;">
            <h5>Lakukan pembayaran sebelum:</h5>
            <h5 class="display-4 mb-0" id="countdown-section"></h5>
            <h5>Total pembayaran:</h5>
            <h4>Rp. XXXXXXX</h4>
            <br>
            <div class="card border-primary mb-3">
                <div class="card-header">Silahkan transfer ke nomor rekening di bawah ini:</div>
                <div class="card-body text-primary">
                    <h5 class="card-title"><img src="./assets/img/favicon-bca.png" alt="Rounded image" style="width: 30px;"> Bank BCA</h5>
                    <h5>a.n Mareta Silviana</h5>
                    <h4>0461433455</h4><button type="button" class="btn btn-link text-success">SALIN</button>
                    <p class="card-text">Setelah melakukan pembayaran, simpan bukti pembayaran dan upload dengan klik tombol dibawah ini.</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend" style="display: unset!important;">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Pilih file </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CountDown Js -->
<script>
    var date = new Date();
    var countDownDate = date.getTime() + 3*60000;
    var saved_countdown = localStorage.getItem('saved_countdown');
    var message_countdown = localStorage.getItem('message_countdown');

    // Update the count down every 1 second
    var x = setInterval(() => {

        // Get today's date and time        
        let now = new Date().getTime();

        if (saved_countdown == null) { 
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
        } else {
            // Find the distance between now and the count down date
            var distance =  (countDownDate - now) - parseInt(saved_countdown);
        }

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        //   // Output the result in an element with id="demo"
        document.getElementById("countdown-section").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text and change url
            if (--distance <= 0) {
                clearInterval(x);
                localStorage.removeItem('saved_countdown');
                localStorage.setItem('message_countdown', true);
                document.getElementById("countdown-section").innerHTML = "EXPIRED";
                location.replace("<?= site_url("payment-expired") ?>");
            }else{
                localStorage.setItem('saved_countdown', --distance);
            }
    }, 1000);

</script>