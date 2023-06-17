<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='adm'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_pasien WHERE id_pasien='$_GET[id]'");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}else {
  $baris = mysqli_fetch_array($cek_data);
}
?>
<div class="col-md-12">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-12">
        <label>Nama Pasien</label>
        <input type="text" name="nama_pasien" class="form-control" value="<?php echo $baris['nama_pasien']; ?>" placeholder="Nama Pasien" title="Nama Pasien" required autofocus onfocus="this.value=this.value">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $baris['tempat_lahir']; ?>" placeholder="Tempat Lahir" title="Tempat Lahir" required>
      </div>
      <div class="col-md-6">
        <label>Tanggal Lahir</label>
        <input type="text" name="tanggal_lahir" id="tgl_1" class="form-control" value="<?php echo date('d-m-Y',strtotime($baris['tanggal_lahir'])); ?>" placeholder="Tanggal Lahir" title="Tanggal Lahir" required maxlength="10">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Jenis Kelamin</label> <br>
        <label>
          <input type="radio" name="jk_pasien" value="L" <?php if($baris['jk_pasien']=="L"){echo "checked";} ?> required> Laki-Laki
        </label>
        &nbsp;
        <label>
          <input type="radio" name="jk_pasien" value="P" <?php if($baris['jk_pasien']=="P"){echo "checked";} ?> required> Perempuan
        </label>
      </div>
      <div class="col-md-6">
        <label>Alamat</label>
        <input type="text" name="alamat_pasien" class="form-control" value="<?php echo $baris['alamat_pasien']; ?>" placeholder="Alamat" title="Alamat" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Agama</label>
        <input type="text" name="agama" class="form-control" value="<?php echo $baris['agama']; ?>" placeholder="Agama" title="Agama" required>
      </div>
      <div class="col-md-6">
        <label>No. HP</label>
        <input type="number" name="tlp_pasien" class="form-control" value="<?php echo $baris['tlp_pasien']; ?>" placeholder="No. HP" title="No. HP" required>
      </div>
    </div>
    <div class="form-group">
      <hr>
      <div class="col-md-6">
        <a href="users?menu=data_pasien" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
      </div>
      <div class="col-md-6">
        <button type="submit" name="btnupdate" class="btn btn-info" style="float:right">Simpan</button>
      </div>
    </div>
  </form>
</div>

<?php
if (isset($_POST['btnupdate'])):
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
  $update = mysqli_query($con, "UPDATE tbl_pasien SET
                            nama_pasien='$nama_pasien',
                            tempat_lahir='$tempat_lahir',
                            tanggal_lahir='$tanggal_lahir',
                            jk_pasien='$jk_pasien',
                            umur_pasien='$umur_pasien',
                            alamat_pasien='$alamat_pasien',
                            agama='$agama',
                            tlp_pasien='$tlp_pasien'
                        WHERE id_pasien='$_GET[id]'");
  if ($update) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='users?menu=data_pasien';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=data_pasien&aksi=edit&id=$_GET[id]';</script>";
    exit;
  }
endif;
?>
