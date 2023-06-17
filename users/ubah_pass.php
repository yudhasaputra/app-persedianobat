<div class="panel panel-default">
  <div class="panel-body">

    <div class="col-md-4"></div>
    <div class="col-md-4"> <br>
      <center><img src="img/logo.png" width="100" alt=""></center>
      <hr>
      <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password1" class="form-control" value="" placeholder="Password Lama" title="Password Lama" required autofocus>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password2" class="form-control" value="" placeholder="Password Baru" title="Password Baru" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password3" class="form-control" value="" placeholder="Konfirmasi Password Baru" title="Konfirmasi Password Baru" required>
            </div>
          </div>
        </div>
        <button type="submit" name="btnup" class="btn btn-info" style="width:100%">Update</button>
      </form>
      <br><br>
    </div>
    <div class="col-md-4"></div>

  </div>
</div>

<?php
if (isset($_POST['btnup'])):
  $password1 = htmlentities(strip_tags($_POST['password1']));
  $password2 = htmlentities(strip_tags($_POST['password2']));
  $password3 = htmlentities(strip_tags($_POST['password3']));

  $cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' AND password='$password1'");
  if (mysqli_num_rows($cek_data)==0) {
    echo "<script>alert('Gagal! Password Lama tidak cocok'); window.location='users?menu=ubah_pass';</script>";
    exit;
  }else {
    if ($password2 <> $password3) {
      echo "<script>alert('Gagal! Konfirmasi Password Baru tidak cocok'); window.location='users?menu=ubah_pass';</script>";
      exit;
    }else {
      $update = mysqli_query($con, "UPDATE tbl_user SET password='$password2' WHERE id_user='$_SESSION[id_user]'");
      if ($update) {
        echo "<script>alert('Password berhasil diperbarui!'); window.location='users?menu=ubah_pass';</script>";
        exit;
      }else {
        echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=ubah_pass';</script>";
        exit;
      }
    }
  }
endif;
?>
