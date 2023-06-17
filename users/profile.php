<?php
$cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]'");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='';</script>";
  exit;
}else {
  $baris = mysqli_fetch_array($cek_data);
}
?>
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
              <label>Nama Lengkap</label>
              <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $baris['nama_lengkap']; ?>" placeholder="Nama Lengkap" title="Nama Lengkap" required autofocus onfocus="this.value=this.value">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="<?php echo $baris['username']; ?>" placeholder="Username" title="Username" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <label>Jenis Kelamin</label> <br>
              <label>
                <input type="radio" name="jk" value="Laki-Laki" <?php if($baris['jk']=='Laki-Laki'){echo "checked";} ?>> Laki-Laki
              </label>
              &nbsp;
              <label>
                <input type="radio" name="jk" value="Perempuan" <?php if($baris['jk']=='Perempuan'){echo "checked";} ?>> Perempuan
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <label>No. HP</label>
              <input type="number" name="tlp" class="form-control" value="<?php echo $baris['tlp']; ?>" placeholder="No. HP" title="No. HP" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <label>Level</label>
              <input type="text" name="level" class="form-control" value="<?php echo ucwords($baris['level']); ?>" placeholder="Level" title="Level" readonly>
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
  $nama_lengkap = htmlentities(strip_tags($_POST['nama_lengkap']));
  $username     = htmlentities(strip_tags($_POST['username']));
  $jk           = htmlentities(strip_tags($_POST['jk']));
  $tlp          = htmlentities(strip_tags($_POST['tlp']));

  $update = mysqli_query($con, "UPDATE tbl_user SET nama_lengkap='$nama_lengkap',username='$username',jk='$jk',tlp='$tlp' WHERE id_user='$_SESSION[id_user]'");
  if ($update) {
    $_SESSION['username']=$username;
    echo "<script>alert('Profile berhasil diperbarui!'); window.location='users?menu=profile';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=profile';</script>";
    exit;
  }
endif;
?>
