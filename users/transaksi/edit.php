<?php
echo "<script>window.location='users?menu=404';</script>";
if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_transaksi WHERE id_transaksi='$_GET[id]'");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}else {
  $baris = mysqli_fetch_array($cek_data);
}
$cek_pasien = mysqli_query($con, "SELECT * FROM tbl_pasien");
$cek_resep  = mysqli_query($con, "SELECT * FROM tbl_resep");
$cek_stok   = mysqli_query($con, "SELECT * FROM tbl_stok");
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
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Resep</label>
        <select class="form-control" name="id_resep" required>
          <option value="">- PILIH -</option>
          <?php while ($baris2 = mysqli_fetch_array($cek_resep)) { ?>
            <option value="<?php echo $baris2['id_resep']; ?>" <?php if($baris2['id_resep']==$baris['id_resep']){echo "selected";} ?>><?php echo $baris2['nama_obat']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-6">
        <label>Stok</label>
        <select class="form-control" name="id_stok" required>
          <option value="">- PILIH -</option>
          <?php while ($baris2 = mysqli_fetch_array($cek_stok)) { ?>
            <option value="<?php echo $baris2['id_stok']; ?>" <?php if($baris2['id_stok']==$baris['id_stok']){echo "selected";} ?>><?php echo $baris2['dosis_obat']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <hr>
      <div class="col-md-6">
        <a href="users?menu=transaksi" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
      </div>
      <div class="col-md-6">
        <button type="submit" name="btnupdate" class="btn btn-info" style="float:right">Simpan</button>
      </div>
    </div>
  </form>
</div>

<?php
if (isset($_POST['btnupdate'])):
  $id_pasien = htmlentities(strip_tags($_POST['id_pasien']));
  $id_resep  = htmlentities(strip_tags($_POST['id_resep']));
  $id_stok   = htmlentities(strip_tags($_POST['id_stok']));
  $update = mysqli_query($con, "UPDATE tbl_transaksi SET
                            id_pasien='$id_pasien',
                            id_resep='$id_resep',
                            id_stok='$id_stok'
                        WHERE id_transaksi='$_GET[id]'");
  if ($update) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='users?menu=transaksi';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=transaksi&aksi=edit&id=$_GET[id]';</script>";
    exit;
  }
endif;
?>
