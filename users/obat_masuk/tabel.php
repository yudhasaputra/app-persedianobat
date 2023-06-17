<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_obat_masuk ORDER BY id_masuk DESC");
?>
<a href="users?menu=obat_masuk&aksi=tambah" class="btn btn-primary">+ Data</a>
<hr>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="15%">Tanggal Masuk</th>
      <th width="20%">Nama Obat</th>
      <th width="20%">Jeni Obat</th>
      <th width="15%">Bentuk Obat</th>
      <th width="15%">Harga Beli</th>
      <th width="4%">Jumlah Masuk</th>
      <th width="10%">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($baris = mysqli_fetch_array($cek_data)) {?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo date('d-m-Y',strtotime($baris['tanggal_masuk'])); ?></td>
        <td><?php echo $baris['nama_obat']; ?></td>
        <td><?php echo $baris['jenis_obat']; ?></td>
        <td><?php echo $baris['bentuk_obat']; ?></td>
        <td><?php echo $baris['harga_beli']; ?></td>
        <td><?php echo $baris['jumlah_masuk']; ?></td>
        <td class="text-center">
          <a href="users?menu=obat_masuk&aksi=edit&id=<?php echo $baris['id_masuk']; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
          <a href="users?menu=obat_masuk&aksi=hapus&id=<?php echo $baris['id_masuk']; ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda Yakin?');"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
