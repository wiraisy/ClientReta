<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title><?= $barTitle ?> | Reta Beauty Clinic</title>
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet" />

    <!-- Argon CSS Files -->
    <link href="<?= base_url() ?>assets/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />
</head>

<body>
    <section class="section section-shaped section-xxl">
        <div class="shape shape-style-1 bg-gradient-pink">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        </div>
        <div class="container pt-lg-7">
        <div class="row justify-content-center">
            <div class="col-lg-5">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <img src="./assets/logo-300x167.png" width="200; alt="centered image">
                    <br>
                    <br>
                    <medium>Silahkan isi form dibawah ini untuk mendaftarkan diri anda menjadi member di Reta Beauty Clinic</medium>
                </div>
                <div class="col-md-12"><label class="labels">Nama</label><input type="text" id="nama" class="form-control" placeholder="Masukkan Nama Anda" value=""></div>
                    <div class="col-md-12"><label class="labels">Nomer Ponsel</label><input type="text" id="nohp" class="form-control" placeholder="Masukkan No. Hp Anda" value=""></div>
                    <div class="col-md-12"><label class="labels">Nomer KTP</label><input type="text" id="noktp" class="form-control" placeholder="Masukkan No. KTP Anda" value=""></div>
                    <div class="col-md-12"><label class="labels">Alamat</label><input type="text" id="alamat" class="form-control" placeholder="Masukkan Alamat Anda" value=""></div>
                    <div class="col-md-12"><label class="labels">Tanggal Lahir</label><input type="text" id="ttl" class="form-control" placeholder="Masukkan Tanggal Lahir Anda" value=""></div>
                    <div class="col-md-12"><label class="labels">Jenis Kelamin</label><input type="text" id="jeniskelamin" class="form-control" placeholder="Masukkan Jenis Kelamin Anda" value=""></div>
                    <hr>
                    <div class="col-12 text-center">
                        <a data-toggle="modal" data-target="#whatsAppModal" class="btn btn-warning btn-block" id="daftarBtn">Daftar</a>
                        <!-- Modal -->
                        <div class="modal fade" id="whatsAppModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Data Pendaftar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <textarea id="datapendaftar" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="sendWhatsApp()">Konfirmasi & Daftar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <small>Sudah punya akun? <a href="<?= site_url('auth/member') ?>">Login</a></small>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

  <!--   JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/plugins/bootstrap-switch.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/plugins/bootstrap-datepicker.min.js"></script>

    <script>
        $(`#daftarBtn`).click(function() {
            var nama = document.getElementById("nama").value;
            var nohp = document.getElementById("nohp").value
            var noktp = document.getElementById("noktp").value
            var ttl = document.getElementById("ttl").value
            var alamat = document.getElementById("alamat").value
            var jeniskelamin = document.getElementById("jeniskelamin").value
            document.getElementById("datapendaftar").value = "Hai Admin, saya ingin mendaftar sebagai member Reta dengan data pribadi sebagai berikut :\nNama : "+nama+"\nNo. HP : "+nohp+"\nNo. KTP : "+noktp+"\nAlamat : "+alamat+"\nTTL : "+ttl+"\nJenis Kelamin : "+jeniskelamin;
        });
        // Send WhatsApp Message
        function sendWhatsApp(){
            var textMessage = document.getElementById("datapendaftar").value;
            var encodedURL = encodeURIComponent(textMessage);
            link = `https://api.whatsapp.com/send?phone=62817786687&text=${encodedURL}`;

            window.open(link);
        }
    </script>
</body>

</html>