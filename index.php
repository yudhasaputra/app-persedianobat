<?php
include "config/koneksi.php";
session_start();
if ($_SESSION['id_user']!='' AND $_SESSION['username']!='' AND $_SESSION['level']!='') {
  echo "<script>window.location='users';</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo view(); ?>">
    <meta name="keywords" content="<?php echo view(); ?>">
    <meta name="author" content="Daniel Septyadi">
    <title><?= view(); ?></title>
    <base href="<?php echo base_url(); ?>">
    <link rel="icon" href="img/favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/parsley.min.css" rel="stylesheet">
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <style>
  .bg-opacity{
    /* position: relative; */
    background-color: #000;
  }

  .bg-opacity::before{
    content: ' ';
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    opacity: 0.5;
    background: url("img/bgpage.jpg") no-repeat center center;
    background-size: cover;
  }
  </style>
</head>
<body class="bg-opacity">

    <br><br>
    <div class="container-fluid">
      <?php include "login.php"; ?>
    </div>

    <div style="color:#f1f1f1;text-align:center"><?php echo view('footer'); ?></div>

    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/parsley.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
