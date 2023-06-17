<?php
if ($_SESSION['level']!='admin'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]' AND level!='admin'");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}else {
  $baris = mysqli_fetch_array($cek_data);
}
?>
<div class="col-md-4"></div>
<div class="col-md-4">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-12">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $baris['nama_lengkap']; ?>" placeholder="Nama Lengkap" title="Nama Lengkap" required autofocus onfocus="this.value=this.value">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Jenis Kelamin</label> <br>
        <label>
          <input type="radio" name="jk" value="Laki-Laki" <?php if($baris['jk']=="Laki-Laki"){echo "checked";} ?> required> Laki-Laki
        </label>
        &nbsp;
        <label>
          <input type="radio" name="jk" value="Perempuan" <?php if($baris['jk']=="Perempuan"){echo "checked";} ?> required> Perempuan
        </label>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>No. HP</label>
        <input type="number" name="tlp" class="form-control" value="<?php echo $baris['tlp']; ?>" placeholder="No. HP" title="No. HP" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $baris['username']; ?>" placeholder="Username" title="Username" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Password</label>
        <input type="password" name="password" class="form-control" value="<?php echo $baris['password']; ?>" placeholder="Password" title="Password" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Hak Akses (Level)</label>
        <select class="form-control" name="level" required>
          <option value="">- PILIH -</option>
          <option value="adm" <?php if($baris['level']=='adm'){echo "selected";} ?>>Administrasi</option>
          <option value="dokter" <?php if($baris['level']=='dokter'){echo "selected";} ?>>Dokter</option>
          <option value="apotik" <?php if($baris['level']=='apotik'){echo "selected";} ?>>Apotik</option>
          <option value="kasir" <?php if($baris['level']=='kasir'){echo "selected";} ?>>Kasir</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <a href="users?menu=user" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
      </div>
      <div class="col-md-6">
        <button type="submit" name="btnupdate" class="btn btn-info" style="float:right">Update</button>
      </div>
    </div>
  </form>
</div>
<div class="col-md-4"></div>

<?php
if (isset($_POST['btnupdate'])):
  $nama_lengkap = htmlentities(strip_tags($_POST['nama_lengkap']));
  $jk           = htmlentities(strip_tags($_POST['jk']));
  $tlp          = htmlentities(strip_tags($_POST['tlp']));
  $username     = htmlentities(strip_tags($_POST['username']));
  $password     = htmlentities(strip_tags($_POST['password']));
  $level        = htmlentities(strip_tags($_POST['level']));
  $cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE username='$username' AND username!='$baris[username]'");
  if (mysqli_num_rows($cek_data)!=0) {
    echo "<script>alert('Gagal! Username $username sudah ada'); window.location='users?menu=user&aksi=edit&id=$_GET[id]';</script>";
    exit;
  }
  $update = mysqli_query($con, "UPDATE tbl_user SET nama_lengkap='$nama_lengkap', jk='$jk', tlp='$tlp', username='$username', password='$password', level='$level' WHERE id_user='$_GET[id]'");
  if ($update) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='users?menu=user';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=user&aksi=edit&id=$_GET[id]';</script>";
    exit;
  }
endif;
?>
