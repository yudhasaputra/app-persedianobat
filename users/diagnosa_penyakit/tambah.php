<?php if ($_SESSION['level']!='admin' && $_SESSION['level']!='dokter'){ echo "<script>window.location='users?menu=404';</script>";} ?>
<?php
$cek_pasien = mysqli_query($con, "SELECT * FROM tbl_pasien");
$cek_dokter = mysqli_query($con, "SELECT * FROM tbl_user WHERE level='dokter'");
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
      <div class="col-md-6">
        <label>Nama Dokter</label>
        <select class="form-control" name="id_dokter" required>
          <option value="">- PILIH -</option>
          <?php while ($baris = mysqli_fetch_array($cek_dokter)) { ?>
            <option value="<?php echo $baris['id_user']; ?>"><?php echo $baris['nama_lengkap']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Nama Penyakit</label>
        <input type="text" name="nama_penyakit" class="form-control" value="" placeholder="Nama Penyakit" title="Nama Penyakit" required>
      </div>
      <div class="col-md-6">
        <label>Jenis Penyakit</label>
        <input type="text" name="jenis_penyakit" class="form-control" value="" placeholder="Jenis Penyakit" title="Jenis Penyakit" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Bagian Sakit</label>
        <input type="text" name="bagian_sakit" class="form-control" value="" placeholder="Bagian Sakit" title="Bagian Sakit" required>
      </div>
      <div class="col-md-6">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" value="" placeholder="Keterangan" title="Keterangan" required>
      </div>
    </div>
    <div class="form-group">
      <hr>
      <div class="col-md-6">
        <a href="users?menu=diagnosa_penyakit" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
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
  $id_pasien      = htmlentities(strip_tags($_POST['id_pasien']));
  $id_dokter      = htmlentities(strip_tags($_POST['id_dokter']));
  $nama_penyakit  = htmlentities(strip_tags($_POST['nama_penyakit']));
  $jenis_penyakit = htmlentities(strip_tags($_POST['jenis_penyakit']));
  $bagian_sakit   = htmlentities(strip_tags($_POST['bagian_sakit']));
  $keterangan     = htmlentities(strip_tags($_POST['keterangan']));

  $simpan = mysqli_query($con, "INSERT INTO tbl_diagnosa_penyakit
                          (id_pasien, id_dokter, nama_penyakit, jenis_penyakit, bagian_sakit,
                           keterangan)
                          VALUES
                          ('$id_pasien', '$id_dokter', '$nama_penyakit', '$jenis_penyakit', '$bagian_sakit',
                           '$keterangan')
                        ");
  if ($simpan) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='users?menu=diagnosa_penyakit';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=diagnosa_penyakit&aksi=tambah';</script>";
    exit;
  }
endif;
?>
