<?php if ($_SESSION['level']!='admin'){ echo "<script>window.location='users?menu=404';</script>";} ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-12">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" value="" placeholder="Nama Lengkap" title="Nama Lengkap" required autofocus onfocus="this.value=this.value">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Jenis Kelamin</label> <br>
        <label>
          <input type="radio" name="jk" value="Laki-Laki" required> Laki-Laki
        </label>
        &nbsp;
        <label>
          <input type="radio" name="jk" value="Perempuan" required> Perempuan
        </label>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>No. HP</label>
        <input type="number" name="tlp" class="form-control" value="" placeholder="No. HP" title="No. HP" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="" placeholder="Username" title="Username" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Password</label>
        <input type="password" name="password" class="form-control" value="" placeholder="Password" title="Password" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Hak Akses (Level)</label>
        <select class="form-control" name="level" required>
          <option value="">- PILIH -</option>
          <option value="adm">Administrasi</option>
          <option value="dokter">Dokter</option>
          <option value="apotik">Apotik</option>
          <option value="kasir">Kasir</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <a href="users?menu=user" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
      </div>
      <div class="col-md-6">
        <button type="submit" name="btnsimpan" class="btn btn-info" style="float:right">Simpan</button>
      </div>
    </div>
  </form>
</div>
<div class="col-md-4"></div>

<?php
if (isset($_POST['btnsimpan'])):
  $nama_lengkap = htmlentities(strip_tags($_POST['nama_lengkap']));
  $jk           = htmlentities(strip_tags($_POST['jk']));
  $tlp          = htmlentities(strip_tags($_POST['tlp']));
  $username     = htmlentities(strip_tags($_POST['username']));
  $password     = htmlentities(strip_tags($_POST['password']));
  $level        = htmlentities(strip_tags($_POST['level']));
  $tgl_user     = date('Y-m-d H:i:s');
  $cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE username='$username'");
  if (mysqli_num_rows($cek_data)!=0) {
    echo "<script>alert('Gagal! Username $username sudah ada'); window.location='users?menu=user&aksi=tambah';</script>";
    exit;
  }
  $simpan = mysqli_query($con, "INSERT INTO tbl_user (nama_lengkap, jk, tlp, username, password, level, tgl_user) VALUES ('$nama_lengkap', '$jk', '$tlp', '$username', '$password', '$level', '$tgl_user')");
  if ($simpan) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='users?menu=user';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=user&aksi=tambah';</script>";
    exit;
  }
endif;
?>
