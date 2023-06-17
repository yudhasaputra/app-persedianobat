<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='kasir'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_transaksi
  INNER JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_transaksi.id_pasien
  INNER JOIN tbl_resep ON tbl_resep.id_resep=tbl_transaksi.id_resep
  INNER JOIN tbl_stok ON tbl_stok.id_stok=tbl_transaksi.id_stok
  ORDER BY tbl_transaksi.id_transaksi DESC");
?>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="20%">Nama Pasien</th>
      <th width="20%">Nama Obat</th>
      <th width="15%">Jumlah Obat</th>
      <th width="15%">Harga Jual</th>
      <th width="19%">Harga Satuan</th>
      <th width="10%"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($baris = mysqli_fetch_array($cek_data)) {
      $q_bayar = mysqli_query($con, "SELECT * FROM tbl_pembayaran WHERE id_transaksi='$baris[id_transaksi]'");
      $bayar = mysqli_num_rows($q_bayar);?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $baris['nama_pasien']; ?></td>
        <td><?php echo $baris['nama_obat']; ?></td>
        <td><?php echo $baris['jumlah_obat']; ?></td>
        <td><?php echo $baris['harga_jual']; ?></td>
        <td><?php echo $baris['harga_satuan']; ?></td>
        <td class="text-center">
          <?php if ($bayar==0){ ?>
            <a href="users?menu=pembayaran&aksi=tambah&id=<?php echo $baris['id_transaksi']; ?>" class="btn btn-primary btn-xs" title="Bayar">Bayar</a>
          <?php }else{
            $id_bayar = mysqli_fetch_array($q_bayar)['id_bayar'];
            ?>
            <i class="fa fa-check text-success"></i>
            &nbsp;
            <a href="users/laporan/pembayaran.php?id=<?php echo $id_bayar; ?>" class="btn btn-primary btn-xs" title="Cetak" target="_blank"><i class="fa fa-print"></i> </a>
          <?php } ?>
        </td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
