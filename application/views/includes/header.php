<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title><?= $barTitle ?> | Reta Beauty Clinic</title>
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Fontawesome -->
  <link href="<?= base_url() ?>assets/css/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" >

  <!-- Nucleo Icons -->
  <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet" />

  <!-- Bootstrap CSS -->  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <!-- Argon CSS Files -->
  <link href="<?= base_url() ?>assets/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/js/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  
  <!-- Select -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <!-- Toast -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/js/toastr/toastr.min.css">
    
  <!--   JS Files   -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>

</head>
<style>
    .fa-shopping-cart[data-count]:after{
        position:absolute;
        left: 60%;
        bottom: 50%;
        content: attr(data-count);
        font-size:70%;
        border-radius:999px;
        color:#eb81c0;
        text-align:center;
        min-width:1em;
        font-weight:bold;
        background: white;
        border:solid #eb81c0 1px;
    }
    
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #444; 
    }
    
    .btn-light{
        color: grey!important;
    }
</style>

<body class="index-page">
    <!-- Section Navbar -->
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
        <div class="container">
            <a class="navbar-brand mr-lg-5" href="<?= base_url() ?>">
            <img src="<?= base_url() ?>assets/logo-300x167.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/logo-300x167.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        </button>
                    </div>
                    </div>
                </div>
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="<?= site_url('checkout') ?>">
                        <i class="fas fa-shopping-cart fa-lg" id="cartProduct" style="margin-right: 0px!important;" data-count=""></i>
                        <script>
                            var settingscart = {
                                "url": "https://api-reta.id/reta-api/Penjualan/lihatcart/<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>",
                                "method": "GET",
                                "timeout": 0,
                                "async": false,
                                "headers": {
                                    "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                                },
                            };

                            var datacart = $.ajax(settingscart).done(function(response) {
                                return response;
                            }).responseJSON;
                            document.getElementById('cartProduct').dataset.count = parseInt(datacart.length);
                        </script>
                        <span class="nav-link-inner--text">Checkout</span>
                    </a>
                    </li>
                    <br>
                    <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                        <i class="fas fa-user fa-lg" style="margin-right: 0px!important;"></i>
                        <span class="nav-link-inner--text">Profil</span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="<?= site_url('my-profile') ?>" class="dropdown-item">Akun Saya</a>
                        <a href="<?= site_url('my-transaction') ?>" class="dropdown-item">Pesanan Saya</a>
                        <a href="<?= site_url('auth/logout') ?>" class="dropdown-item">Keluar</a>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>