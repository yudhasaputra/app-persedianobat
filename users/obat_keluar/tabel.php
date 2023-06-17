<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_obat_keluar ORDER BY id_keluar DESC");
?>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="19%">Tanggal Keluar</th>
      <th width="80%">Jumlah Keluar</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($baris = mysqli_fetch_array($cek_data)) {?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo date('d-m-Y',strtotime($baris['tanggal_keluar'])); ?></td>
        <td><?php echo $baris['jumlah_keluar']; ?></td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
