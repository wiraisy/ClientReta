<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <!-- Toast -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/toastr/toastr.min.css">
    
    <script src="<?= base_url() ?>assets/js/core/jquery.min.js" type="text/javascript"></script>
</head>
<?php
  $error = $this->session->flashdata('error');
  if ($error) {
  ?>
    <script type="text/javascript">
        $(function() {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });

          Toast.fire({
            icon: 'error',
            title: '&nbsp;<?php echo $error ?>'
          })
        });
    </script>
  <?php }
  ?>
<body>
  <!--pink-->
  <section class="section section-shaped section-xxl" style="height: 100vh">
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
    <div class="container pt-lg-4">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-3">
              <div class="text-center text-muted mb-4">
                <img src="<?= base_url() ?>assets/logo-300x167.png" width="200; alt="centered image">
                <br>
                <br>
                <medium>Silahkan masukkan nomor Handphone anda yang terdaftar sebagai member di Reta Beauty Clinic</medium>
              </div>
              <form method="POST" action="<?= base_url() ?>auth/loginmember">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input class="form-control" placeholder="62xxxxxxxxx" name="hp1" type="number" required>
                  </div>
                </div>
                <div class="form-group mb-3">  
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                    </div>
                    <input class="form-control" name="password" placeholder="password" type="text" required>
                  </div>
                </div>  
                </div>
                <div class="form-group focused">
                  <div class="text-center">
                    <button type="submit" class="btn btn-warning btn-lg">Masuk</button>
                  <br>
                  <br>
                  <small><a href="<?= site_url('verifikasi-password'); ?>">Buat Password / Lupa Password</a></small>
                  
                  <br>
                  <br>
                  <small>Belum jadi member? <a href="<?= site_url('register') ?>">Daftar Sekarang</a></small>
                  <br>
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
    <!-- Toast -->
    <script src="<?= base_url() ?>assets/js/toastr/toastr.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>