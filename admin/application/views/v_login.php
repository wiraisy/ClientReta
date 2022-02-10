<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>LOGIN | Reta Beauty Clinic</title>
  <link rel="icon" href="<?= base_url() ?>assets/img/brand/favicon.png" >

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  
  <!-- Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/argon.css?v=1.2.0" type="text/css">

  <!-- Chat CSS & Links -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/chat.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>

<style>
    .field-icon {
        position: relative;
        background: #fff;
        display: flex;
        align-items: center;
        padding-right: 5%;
        z-index: 2;
    }
    .toggle-password{
        color: lightgrey;
    }
    .toggle-password-after{
        color: grey;
    }
    .toggle-password:hover , .toggle-password-after:hover{
        cursor: pointer;
    }
</style>

<body class="bg-default">

<!-- Main Section -->
<div class="main-content" id="panel">

    <div class="header bg-gradient-pink py-7 py-lg-8 pt-lg-9">
        <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                        <small>Login</small>
                        </div>
                        <form role="form">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control" placeholder="Email" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" placeholder="Password" id="password" type="password">
                            <span class="field-icon">
                                <script>
                                    function pswVisibilty(){
                                        var x = document.getElementById("password");
                                        var element = document.getElementById("togglePsw");
                                        if (x.type === "password") {
                                            x.type = "text";
                                            element.classList.remove("toggle-password");
                                            element.classList.add("toggle-password-after");
                                        } else {
                                            x.type = "password";
                                            element.classList.remove("toggle-password-after");
                                            element.classList.add("toggle-password");
                                        }
                                    }
                                </script>
                                <i class="fas fa-eye toggle-password" id="togglePsw" onclick="pswVisibilty()"></i>
                            </span>
                            </div>
                        </div>
                        <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" id="rememberMe" type="checkbox" value="lsRememberMe">
                            <label class="custom-control-label" for="rememberMe">
                            <span class="text-muted">Ingatkan saya?</span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary my-4">Login</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Argon Scripts -->
<!-- Core -->
<script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="<?= base_url() ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="<?= base_url() ?>assets/js/argon.js?v=1.2.0"></script>


</body>
</html>