<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='dokter'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_resep
  INNER JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_resep.id_pasien
  INNER JOIN tbl_user ON tbl_user.id_user=tbl_resep.id_dokter ORDER BY tbl_resep.id_resep DESC");
?>
<a href="users?menu=resep_obat&aksi=tambah" class="btn btn-primary">+ Data</a>
<hr>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="20%">Nama Pasien</th>
      <th width="20%">Dokter</th>
      <th width="15%">Tanggal Resep</th>
      <th width="19%">Nama Obat</th>
      <th width="15%">Jenis Obat</th>
      <th width="10%">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($baris = mysqli_fetch_array($cek_data)) {?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $baris['nama_pasien']; ?></td>
        <td><?php echo $baris['nama_lengkap']; ?></td>
        <td><?php echo date('d-m-Y',strtotime($baris['tanggal_resep'])); ?></td>
        <td><?php echo $baris['nama_obat']; ?></td>
        <td><?php echo $baris['jenis_obat']; ?></td>
        <td class="text-center">
          <a href="users?menu=resep_obat&aksi=edit&id=<?php echo $baris['id_resep']; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
          <a href="users?menu=resep_obat&aksi=hapus&id=<?php echo $baris['id_resep']; ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda Yakin?');"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
