<?php
include "../config/koneksi.php";
session_start();
if ($_SESSION['id_user']=='' AND $_SESSION['username']=='' AND $_SESSION['level']=='') {
  echo "<script>window.location='../';</script>";
}
$cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]'");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='';</script>";
  exit;
}else {
  $nama_akun = mysqli_fetch_array($cek_data)['nama_lengkap'];
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
    <title><?php echo view(); ?></title>
    <base href="<?php echo base_url(); ?>">
    <link rel="icon" href="img/favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="assets/css/select2.min.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/parsley.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <style>
      .navbar-x{float:left;height: 50px;line-height: 20px;text-decoration:none;color:#f1f1f1;font-size:18px;font-weight:bold;padding: 7px 15px;}
      .navbar-x:hover{text-decoration:none;color:#999;}
      .container-fluid {padding-top:70px;}
      nav > .container{margin-left:0px;margin-right:0px;width:100%}
    </style>
  </head>
  <body style="background:#999;">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href=""> -->
          <a class="navbar-x" href="">
            <img src="img/logo2.png" width="30" alt="">
            <?php echo view('navbar'); ?>
          </a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="users?menu=profile"><i class="fa fa-user"></i> <?php echo $nama_akun; ?></a></li>
            <li><a href="users?menu=logout" onclick="return confirm('Anda Yakin?');"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="col-md-3">
        <?php include "menu.php"; ?>
      </div>
      <div class="col-md-9">
        <?php include "content.php"; ?>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted text-center"><?php echo view('footer'); ?></p>
      </div>
    </footer>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/parsley.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/plugin/datetimepicker/jquery.datetimepicker.css"/>
    <script src="assets/plugin/datetimepicker/jquery.datetimepicker.js"></script>
    <script>
    $('#tgl_1').datetimepicker({
      lang:'en',
      timepicker:false,
      format:'d-m-Y'
    });
    $('#tgl_2').datetimepicker({
      lang:'en',
      timepicker:false,
      format:'d-m-Y'
    });
    </script>
    <script type="text/javascript">
    $(document).ready( function() {
      $( '#data_tables' ).dataTable( {
        "bDestroy": true,
        "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, "All"]],
        "iDisplayLength": 10,
        "columnDefs": [ {
          "targets": [0],
          "orderable": false,
          }],
        "order": []
      } );
    } );
    $(document).ready(function() {
        $('select').select2();
    });
    </script>
  </body>
</html>
