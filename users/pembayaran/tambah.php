<?php if ($_SESSION['level']!='admin' && $_SESSION['level']!='kasir'){ echo "<script>window.location='users?menu=404';</script>";} ?>
<?php
$bayar = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_pembayaran WHERE id_transaksi='$_GET[id]'"));
if ($bayar!=0) {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}
$cek_data = mysqli_query($con, "SELECT * FROM tbl_obat_keluar WHERE id_transaksi='$_GET[id]' ORDER BY id_keluar DESC");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}
$cek_data2 = mysqli_query($con, "SELECT * FROM tbl_transaksi
  INNER JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_transaksi.id_pasien
  INNER JOIN tbl_resep ON tbl_resep.id_resep=tbl_transaksi.id_resep
  INNER JOIN tbl_stok ON tbl_stok.id_stok=tbl_transaksi.id_stok
  WHERE tbl_transaksi.id_transaksi='$_GET[id]'
  ORDER BY tbl_transaksi.id_transaksi DESC");
?>
<table class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="25%">Nama Pasien</th>
      <th width="20%">Nama Obat</th>
      <th width="15%">Jumlah Obat</th>
      <th width="20%">Harga Jual</th>
      <th width="20%">Harga Satuan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($baris = mysqli_fetch_array($cek_data2)) {?>
      <tr>
        <td><?php echo $baris['nama_pasien']; ?></td>
        <td><?php echo $baris['nama_obat']; ?></td>
        <td><?php echo number_format($baris['jumlah_obat']); ?></td>
        <td>Rp. <?php echo number_format($baris['harga_jual']); ?></td>
        <td>Rp. <?php echo number_format($baris['harga_satuan']); ?></td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>

<table class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="19%">Tanggal</th>
      <th width="10%">Jumlah</th>
      <th width="30%">Harga</th>
      <th width="30%">Sub Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1; $total=0; $sub_total=0;$t_jumlah=0; $t_total=0;
    while ($baris = mysqli_fetch_array($cek_data)) {
      $sub_total = $baris['jumlah_keluar']*$baris['jumlah_harga_jual'];?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo date('d-m-Y',strtotime($baris['tanggal_keluar'])); ?></td>
        <td><?php echo number_format($baris['jumlah_keluar']); ?></td>
        <td>Rp. <?php echo number_format($baris['jumlah_harga_jual']); ?></td>
        <td>Rp. <?php echo number_format($sub_total); ?></td>
      </tr>
    <?php
    $t_jumlah +=$baris['jumlah_keluar'];
    $t_total +=$baris['jumlah_harga_jual'];
    $total+=$sub_total;
    } ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="2" class="text-right">TOTAL</th>
      <th><?php echo number_format($t_jumlah); ?></th>
      <th>Rp. <?php echo number_format($t_total); ?></th>
      <th>Rp. <?php echo number_format($total); ?></th>
    </tr>
  </tfoot>
</table>

<form action="" method="post">
  <input type="hidden" name="total_bayar" value="<?php echo $total; ?>">
<table width="100%">
  <tr>
    <td width="120"><b>TOTAL BAYAR </b></td>
    <td width="1"><b>:</b>&nbsp;</td>
    <td> Rp. <?php echo number_format($total); ?></td>
  </tr>
  <tr>
    <td><b>PASIEN BAYAR </b></td>
    <td><b>:</b>&nbsp;</td>
    <td> Rp. <input type="number" name="pasien_bayar" value="" required autofocus onkeyup="hitung()"></td>
  </tr>
  <tr>
    <td><b>Kembalian </b></td>
    <td><b>:</b>&nbsp;</td>
    <td> Rp. <span id="kembalian">0</span> </td>
  </tr>
</table>
<hr>
<a href="users?menu=pembayaran" class="btn btn-default"><i class="fa fa-angle-double-left"></i> </a>
<button type="submit" class="btn btn-primary" name="btnsimpan" style="float:right"><i class="fa fa-print"></i> Print</button>
<button type="reset" class="btn btn-danger" style="float:right;margin-right:10px;"><i class="fa fa-refresh"></i> Reset</button>
</form>

<script type="text/javascript">
  function hitung()
  {
    pasien_bayar = $('[name="pasien_bayar"]').val();
    total_bayar  = $('[name="total_bayar"]').val();
    // if (pasien_bayar!='') {
    //   if (pasien_bayar < total_bayar) {
    //     alert('Gagal! Pasien bayar tidak boleh kurang dari Total pembayar');
    //     return false;
    //   }
    // }
    total = pasien_bayar - total_bayar;
    // if (total < 0) {
    //   total = 0;
    // }
    $('#kembalian').html(total);
  }
</script>

<?php
if (isset($_POST['btnsimpan'])):
  $id = $_GET['id'];
  $total_bayar  = htmlentities(strip_tags($_POST['total_bayar']));
  $pasien_bayar = htmlentities(strip_tags($_POST['pasien_bayar']));
  $kembalian    = $pasien_bayar-$total_bayar;
  $tanggal      = date('Y-m-d');

  if ($pasien_bayar < $total_bayar) {
    echo "<script>alert('Gagal! Pasien bayar tidak boleh kurang dari Total pembayar'); window.location='users?menu=pembayaran&aksi=tambah&id=$id';</script>";
    exit;
  }
  if ($kembalian < 0) { $kembalian = 0; }

  $simpan = mysqli_query($con, "INSERT INTO tbl_pembayaran
                          (id_transaksi, tanggal_bayar, total_bayar, pasien_bayar, kembalian)
                          VALUES
                          ('$id', '$tanggal', '$total_bayar', '$pasien_bayar', '$kembalian')
                        ");
  if ($simpan) {
    $cek_data = mysqli_query($con, "SELECT * FROM tbl_pembayaran ORDER BY id_bayar DESC limit 1");
    if (mysqli_num_rows($cek_data)==0) {
      $id_p = 1;
    }else {
      $baris = mysqli_fetch_array($cek_data);
      $id_p = $baris['id_bayar'];
    }
    echo "<script>alert('Data berhasil disimpan!'); window.open('users/laporan/pembayaran.php?id=$id_p', '_blank'); window.location='users?menu=pembayaran';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=pembayaran&aksi=tambah&id=$id';</script>";
    exit;
  }
endif;
?>
