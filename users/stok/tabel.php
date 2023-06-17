<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_stok
  INNER JOIN tbl_obat_masuk ON tbl_obat_masuk.id_masuk=tbl_stok.id_masuk ORDER BY tbl_stok.id_stok DESC");
?>
<a href="users?menu=stok&aksi=tambah" class="btn btn-primary">+ Data</a>
<hr>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="20%">Nama Obat</th>
      <th width="20%">Dosis Obat</th>
      <th width="15%">Jumlah Obat</th>
      <th width="15%">Harga Jual</th>
      <th width="19%">Harga Satuan</th>
      <th width="10%">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($baris = mysqli_fetch_array($cek_data)) {?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $baris['nama_obat']; ?></td>
        <td><?php echo $baris['dosis_obat']; ?></td>
        <td><?php echo $baris['jumlah_obat']; ?></td>
        <td><?php echo $baris['harga_jual']; ?></td>
        <td><?php echo $baris['harga_satuan']; ?></td>
        <td class="text-center">
          <a href="users?menu=stok&aksi=edit&id=<?php echo $baris['id_stok']; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
          <a href="users?menu=stok&aksi=hapus&id=<?php echo $baris['id_stok']; ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda Yakin?');"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
