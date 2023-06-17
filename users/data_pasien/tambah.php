<?php if ($_SESSION['level']!='admin' && $_SESSION['level']!='adm'){ echo "<script>window.location='users?menu=404';</script>";} ?>
<!-- <div class="col-md-2"></div> -->
<div class="col-md-12">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-12">
        <label>Nama Pasien</label>
        <input type="text" name="nama_pasien" class="form-control" value="" placeholder="Nama Pasien" title="Nama Pasien" required autofocus onfocus="this.value=this.value">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control" value="" placeholder="Tempat Lahir" title="Tempat Lahir" required>
      </div>
      <div class="col-md-6">
        <label>Tanggal Lahir</label>
        <input type="text" name="tanggal_lahir" id="tgl_1" class="form-control" value="" placeholder="Tanggal Lahir" title="Tanggal Lahir" required maxlength="10">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Jenis Kelamin</label> <br>
        <label>
          <input type="radio" name="jk_pasien" value="L" required> Laki-Laki
        </label>
        &nbsp;
        <label>
          <input type="radio" name="jk_pasien" value="P" required> Perempuan
        </label>
      </div>
      <div class="col-md-6">
        <label>Alamat</label>
        <input type="text" name="alamat_pasien" class="form-control" value="" placeholder="Alamat" title="Alamat" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Agama</label>
        <input type="text" name="agama" class="form-control" value="" placeholder="Agama" title="Agama" required>
      </div>
      <div class="col-md-6">
        <label>No. HP</label>
        <input type="number" name="tlp_pasien" class="form-control" value="" placeholder="No. HP" title="No. HP" required>
      </div>
    </div>
    <div class="form-group">
      <hr>
      <div class="col-md-6">
        <a href="users?menu=data_pasien" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
      </div>
      <div class="col-md-6">
        <button type="submit" name="btnsimpan" class="btn btn-info" style="float:right">Simpan</button>
      </div>
    </div>
  </form>
</div>
<!-- <div class="col-md-2"></div> -->

<?php
if (isset($_POST['btnsimpan'])):
  $nama_pasien   = htmlentities(strip_tags($_POST['nama_pasien']));
  $tempat_lahir  = htmlentities(strip_tags($_POST['tempat_lahir']));
  $tanggal_lahir = date('Y-m-d',strtotime(htmlentities(strip_tags($_POST['tanggal_lahir']))));
  $jk_pasien     = htmlentities(strip_tags($_POST['jk_pasien']));
  // Convert Ke Date Time
	$biday = new DateTime($tanggal_lahir);
	$today = new DateTime();
	$diff = $today->diff($biday);
  $umur_pasien = $diff->y;
  $alamat_pasien = htmlentities(strip_tags($_POST['alamat_pasien']));
  $agama         = htmlentities(strip_tags($_POST['agama']));
  $tlp_pasien    = htmlentities(strip_tags($_POST['tlp_pasien']));

  $simpan = mysqli_query($con, "INSERT INTO tbl_pasien
                          (nama_pasien, tempat_lahir, tanggal_lahir, jk_pasien, umur_pasien,
                           alamat_pasien, agama, tlp_pasien)
                          VALUES
                          ('$nama_pasien', '$tempat_lahir', '$tanggal_lahir', '$jk_pasien', '$umur_pasien',
                           '$alamat_pasien', '$agama', '$tlp_pasien')
                        ");
  if ($simpan) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='users?menu=data_pasien';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=data_pasien&aksi=tambah';</script>";
    exit;
  }
endif;
?>
