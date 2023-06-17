<div class="col-md-4"></div>
<div class="col-md-4">
  <div class="col-md-1"></div>
  <div class="col-md-10">
  <div class="panel panel-success">
    <div class="panel-heading">
      <center>
        <img src="img/logo.png" class="img-responsive" width="150" alt="">
      </center>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;</span>
              <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
          </div>
        </div>
        <button type="submit" name="btnlogin" class="btn btn-info" style="width:100%">Login</button>
      </form>
    </div>
  </div>
  </div>
  <div class="col-md-1"></div>
</div>
<div class="col-md-4"></div>


<?php
if (isset($_POST['btnlogin'])):
  $username = htmlentities(strip_tags($_POST['username']));
  $password = htmlentities(strip_tags($_POST['password']));

  $cek_data = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$username'");
  if (mysqli_num_rows($cek_data)==0) {
    echo "<script>alert('MAAF, Username $username belum terdaftar!'); window.location='';</script>";
    exit;
  }else {
    $baris = mysqli_fetch_array($cek_data);
    $pass = $baris['password'];
    if ($password <> $pass) {
      echo "<script>alert('MAAF, Username atau Password Salah!'); window.location='';</script>";
      exit;
    }else {
      $_SESSION['id_user']  = $baris['id_user'];
      $_SESSION['username'] = $baris['username'];
      $_SESSION['level']    = $baris['level'];
      echo "<script>alert('Berhasil Login, Selamat Beraktifitas!'); window.location='';</script>";
      exit;
    }
  }
endif;
?>
