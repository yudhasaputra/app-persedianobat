<?php if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";} ?>
<?php
$cek_masuk = mysqli_query($con, "SELECT * FROM tbl_obat_masuk");
?>
<!-- <div class="col-md-2"></div> -->
<div class="col-md-12">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-6">
        <label>Nama Obat</label>
        <select class="form-control" name="id_masuk" required>
          <option value="">- PILIH -</option>
          <?php while ($baris = mysqli_fetch_array($cek_masuk)) { ?>
            <option value="<?php echo $baris['id_masuk']; ?>"><?php echo $baris['nama_obat']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Dosis Obat</label>
        <input type="text" name="dosis_obat" class="form-control" value="" placeholder="Dosis Obat" title="Dosis Obat" required>
      </div>
      <div class="col-md-6">
        <label>Jumlah Obat</label>
        <input type="text" name="jumlah_obat" class="form-control" value="" placeholder="Jumlah Obat" title="Jumlah Obat" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" class="form-control" value="" placeholder="Harga Jual" title="Harga Jual" required>
      </div>
      <div class="col-md-6">
        <label>Harga Satuan</label>
        <input type="number" name="harga_satuan" class="form-control" value="" placeholder="Harga Satuan" title="Harga Satuan" required>
      </div>
    </div>
    <div class="form-group">
      <hr>
      <div class="col-md-6">
        <a href="users?menu=stok" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
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
  $id_masuk      = htmlentities(strip_tags($_POST['id_masuk']));
  $dosis_obat    = htmlentities(strip_tags($_POST['dosis_obat']));
  $jumlah_obat   = htmlentities(strip_tags($_POST['jumlah_obat']));
  $harga_jual    = htmlentities(strip_tags($_POST['harga_jual']));
  $harga_satuan  = htmlentities(strip_tags($_POST['harga_satuan']));

  $simpan = mysqli_query($con, "INSERT INTO tbl_stok
                          (id_masuk, dosis_obat, jumlah_obat, harga_jual, harga_satuan)
                          VALUES
                          ('$id_masuk', '$dosis_obat', '$jumlah_obat', '$harga_jual', '$harga_satuan')
                        ");
  if ($simpan) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='users?menu=stok';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=stok&aksi=tambah';</script>";
    exit;
  }
endif;
?>
