<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title>DASHBOARD | Reta Beauty Clinic</title>
  <link rel="icon" href="<?= base_url() ?>assets/img/brand/favicon.png" >

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  
  <!-- Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

  <!-- Bootstrap CSS -->  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/argon.css?v=1.2.0" type="text/css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">

  <!-- Chat CSS & Links -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/js/select2/css/select2.min.css">

  <!-- Select -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <!-- Magnific PopUp -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/js/magnific-popup/magnific-popup.css">  

  <!-- Toast -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/js/toastr/toastr.min.css">
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
  
    <!-- DataTables -->
    <script src="<?= base_url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.0/js/bootstrap-select.js"></script>

  <style>
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

  <?php $error = $this->session->flashdata('errorMsg');
    if ($error) { ?>
      <script type="text/javascript">
    //   console.log($error);
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

    <?php } ?>
    <?php $success = $this->session->flashdata('successMsg');
    if ($success) { ?>
      <script type="text/javascript">
        //   console.log($success);
        $(function() {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
          Toast.fire({
            icon: 'success',
            title: '&nbsp;<?php echo $success ?>'
          })
        });
      </script>
    <?php } ?>
</head>

<body>
<!-- Section SideNav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header  align-items-center">
        <a href="<?= base_url() ?>" class="navbar-brand" href="javascript:void(0)">
            <img src="<?= base_url() ?>assets/logo-300x167.png" class="navbar-brand-img" alt="...">
        </a>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse menuSideNav" id="sidenav-collapse-main">
                <h5>Menu Admin</h5>
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url() ?>">
                    <i class="fa fa-desktop text-pink"></i>
                    <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('chat') ?>">
                    <i class="fa fa-comments text-pink"></i>
                    <span class="nav-link-text">Chat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('pemesanan') ?>">
                    <i class="fa fa-shopping-cart text-pink"></i>
                    <span class="nav-link-text">Pemesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('order-by-admin') ?>">
                    <i class="fa fa-cart-plus text-pink"></i>
                    <span class="nav-link-text">Order By Admin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('produk-link') ?>">
                    <i class="fa fa-link text-pink"></i>
                    <span class="nav-link-text">Produk Link</span>
                    </a>
                </li>
                </ul>
                <hr>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-outline-danger" onClick="reloadPage()">Sync Data</button>
                    <script>
                        function reloadPage(){
                            window.location.reload();
                        };
                    </script>
                </div>
                <br>
                <div style="text-align: center;">
                    <a href="<?= site_url('export-master') ?>" class="btn btn-outline-warning">Export Data</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Section -->
<div class="main-content" id="panel">
<!-- Section TopNav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-pink border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </form>
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                    <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?= site_url('chat') ?>" role="button">
                    <i class="fas fa-comment-dots"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="<?= base_url() ?>assets/img/theme/team-4.jpg">
                        </span>
                        <div class="media-body  ml-2  d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">Hai, <?= $this->session->userdata('data_admin_reta')['name'] ?></span>
                        </div>
                    </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('auth/logout') ?>" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>