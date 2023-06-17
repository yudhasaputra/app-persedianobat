<?php if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";} ?>
<?php
$cek_pasien = mysqli_query($con, "SELECT * FROM tbl_pasien");
$cek_resep  = mysqli_query($con, "SELECT * FROM tbl_resep");
$cek_stok   = mysqli_query($con, "SELECT * FROM tbl_stok");
?>
<!-- <div class="col-md-2"></div> -->
<div class="col-md-12">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-6">
        <label>Nama Pasien</label>
        <select class="form-control" name="id_pasien" required>
          <option value="">- PILIH -</option>
          <?php while ($baris = mysqli_fetch_array($cek_pasien)) { ?>
            <option value="<?php echo $baris['id_pasien']; ?>"><?php echo $baris['nama_pasien']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Resep</label>
        <select class="form-control" name="id_resep" required>
          <option value="">- PILIH -</option>
          <?php while ($baris = mysqli_fetch_array($cek_resep)) { ?>
            <option value="<?php echo $baris['id_resep']; ?>"><?php echo $baris['nama_obat']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-6">
        <label>Stok</label>
        <select class="form-control" name="id_stok" required>
          <option value="">- PILIH -</option>
          <?php while ($baris = mysqli_fetch_array($cek_stok)) { ?>
            <option value="<?php echo $baris['id_stok']; ?>"><?php echo $baris['dosis_obat']; ?></option>
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
        <button type="submit" name="btnsimpan" class="btn btn-info" style="float:right">Simpan</button>
      </div>
    </div>
  </form>
</div>
<!-- <div class="col-md-2"></div> -->

<?php
if (isset($_POST['btnsimpan'])):
  $id_pasien = htmlentities(strip_tags($_POST['id_pasien']));
  $id_resep  = htmlentities(strip_tags($_POST['id_resep']));
  $id_stok   = htmlentities(strip_tags($_POST['id_stok']));
  $tanggal   = date('Y-m-d');

  $cek_stok = mysqli_query($con, "SELECT * FROM tbl_stok WHERE id_stok='$id_stok' limit 1");
  if (mysqli_num_rows($cek_stok)==0) {
    $jumlah_harga_jual    = 0;
    $jumlah_harga_satuan  = 0;
  }else {
    $data_stok = mysqli_fetch_array($cek_stok);
    $jumlah_harga_jual    = $data_stok['harga_jual'];
    $jumlah_harga_satuan  = $data_stok['harga_satuan'];
  }

  $simpan = mysqli_query($con, "INSERT INTO tbl_transaksi
                          (id_pasien, id_resep, id_stok, tanggal_transaksi)
                          VALUES
                          ('$id_pasien', '$id_resep', '$id_stok', '$tanggal')
                        ");
  if ($simpan) {
    $cek_data = mysqli_query($con, "SELECT * FROM tbl_transaksi ORDER BY id_transaksi DESC limit 1");
    if (mysqli_num_rows($cek_data)==0) {
      $id_transaksi = 1;
    }else {
      $baris = mysqli_fetch_array($cek_data);
      $id_transaksi = $baris['id_transaksi'];
    }
    $simpan2 = mysqli_query($con, "INSERT INTO tbl_obat_keluar
                            (id_stok, id_transaksi, tanggal_keluar, jumlah_keluar, jumlah_harga_jual, jumlah_harga_satuan)
                            VALUES
                            ('$id_stok', '$id_transaksi', '$tanggal', '1', $jumlah_harga_jual, $jumlah_harga_satuan)
                          ");
    echo "<script>alert('Data berhasil disimpan!'); window.location='users?menu=transaksi';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=transaksi&aksi=tambah';</script>";
    exit;
  }
endif;
?>
