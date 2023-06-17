<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='dokter'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_resep WHERE id_resep='$_GET[id]'");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}else {
  $baris = mysqli_fetch_array($cek_data);
}
$cek_pasien = mysqli_query($con, "SELECT * FROM tbl_pasien");
$cek_dokter = mysqli_query($con, "SELECT * FROM tbl_user WHERE level='dokter'");
?>
<div class="col-md-12">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-6">
        <label>Nama Pasien</label>
        <select class="form-control" name="id_pasien" required>
          <option value="">- PILIH -</option>
          <?php while ($baris2 = mysqli_fetch_array($cek_pasien)) { ?>
            <option value="<?php echo $baris2['id_pasien']; ?>" <?php if($baris2['id_pasien']==$baris['id_pasien']){echo "selected";} ?>><?php echo $baris2['nama_pasien']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-6">
        <label>Nama Dokter</label>
        <select class="form-control" name="id_dokter" required>
          <option value="">- PILIH -</option>
          <?php while ($baris2 = mysqli_fetch_array($cek_dokter)) { ?>
            <option value="<?php echo $baris2['id_user']; ?>" <?php if($baris2['id_user']==$baris['id_dokter']){echo "selected";} ?>><?php echo $baris2['nama_lengkap']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Tanggal Resep</label>
        <input type="text" name="tanggal_resep" id="tgl_1" class="form-control" value="<?php echo date('d-m-Y',strtotime($baris['tanggal_resep'])); ?>" placeholder="Tanggal Resep" title="Tanggal Resep" required>
      </div>
      <div class="col-md-6">
        <label>Nama Obat</label>
        <input type="text" name="nama_obat" class="form-control" value="<?php echo $baris['nama_obat']; ?>" placeholder="Nama Obat" title="Nama Obat" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Jenis Obat</label>
        <input type="text" name="jenis_obat" class="form-control" value="<?php echo $baris['jenis_obat']; ?>" placeholder="Jenis Obat" title="Jenis Obat" required>
      </div>
      <div class="col-md-6">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" value="<?php echo $baris['keterangan']; ?>" placeholder="Keterangan" title="Keterangan" required>
      </div>
    </div>
    <div class="form-group">
      <hr>
      <div class="col-md-6">
        <a href="users?menu=resep_obat" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
      </div>
      <div class="col-md-6">
        <button type="submit" name="btnupdate" class="btn btn-info" style="float:right">Simpan</button>
      </div>
    </div>
  </form>
</div>

<?php
if (isset($_POST['btnupdate'])):
  $id_pasien      = htmlentities(strip_tags($_POST['id_pasien']));
  $id_dokter      = htmlentities(strip_tags($_POST['id_dokter']));
  $tanggal_resep  = date('Y-m-d',strtotime(htmlentities(strip_tags($_POST['tanggal_resep']))));
  $nama_obat      = htmlentities(strip_tags($_POST['nama_obat']));
  $jenis_obat     = htmlentities(strip_tags($_POST['jenis_obat']));
  $keterangan     = htmlentities(strip_tags($_POST['keterangan']));
  $update = mysqli_query($con, "UPDATE tbl_resep SET
                            id_pasien='$id_pasien',
                            id_dokter='$id_dokter',
                            tanggal_resep='$tanggal_resep',
                            nama_obat='$nama_obat',
                            jenis_obat='$jenis_obat',
                            keterangan='$keterangan'
                        WHERE id_resep='$_GET[id]'");
  if ($update) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='users?menu=resep_obat';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=resep_obat&aksi=edit&id=$_GET[id]';</script>";
    exit;
  }
endif;
?>
