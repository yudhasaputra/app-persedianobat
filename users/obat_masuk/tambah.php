<?php if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";} ?>
<!-- <div class="col-md-2"></div> -->
<div class="col-md-12">
  <br>
  <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
    <div class="form-group">
      <div class="col-md-6">
        <label>Tanggal Masuk</label>
        <input type="text" name="tanggal_masuk" id="tgl_1" class="form-control" value="" placeholder="Tanggal Masuk" title="Tanggal Masuk" required>
      </div>
      <div class="col-md-6">
        <label>Nama Obat</label>
        <input type="text" name="nama_obat" class="form-control" value="" placeholder="Nama Obat" title="Nama Obat" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Jenis Obat</label>
        <input type="text" name="jenis_obat" class="form-control" value="" placeholder="Jenis Obat" title="Jenis Obat" required>
      </div>
      <div class="col-md-6">
        <label>Bentuk Obat</label>
        <input type="text" name="bentuk_obat" class="form-control" value="" placeholder="Bentuk Obat" title="Bentuk Obat" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" class="form-control" value="" placeholder="Harga Beli" title="Harga Beli" required>
      </div>
      <div class="col-md-6">
        <label>Jumlah Masuk</label>
        <input type="number" name="jumlah_masuk" class="form-control" value="" placeholder="Jumlah Masuk" title="Jumlah Masuk" required>
      </div>
    </div>
    <div class="form-group">
      <hr>
      <div class="col-md-6">
        <a href="users?menu=obat_masuk" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
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
  $tanggal_masuk  = date('Y-m-d',strtotime(htmlentities(strip_tags($_POST['tanggal_masuk']))));
  $nama_obat      = htmlentities(strip_tags($_POST['nama_obat']));
  $jenis_obat     = htmlentities(strip_tags($_POST['jenis_obat']));
  $bentuk_obat    = htmlentities(strip_tags($_POST['bentuk_obat']));
  $harga_beli     = htmlentities(strip_tags($_POST['harga_beli']));
  $jumlah_masuk   = htmlentities(strip_tags($_POST['jumlah_masuk']));

  $simpan = mysqli_query($con, "INSERT INTO tbl_obat_masuk
                          (tanggal_masuk, nama_obat, jenis_obat, bentuk_obat, harga_beli,
                           jumlah_masuk)
                          VALUES
                          ('$tanggal_masuk', '$nama_obat', '$jenis_obat', '$bentuk_obat', '$harga_beli',
                           '$jumlah_masuk')
                        ");
  if ($simpan) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='users?menu=obat_masuk';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=obat_masuk&aksi=tambah';</script>";
    exit;
  }
endif;
?>
