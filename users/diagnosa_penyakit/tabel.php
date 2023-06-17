<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='dokter'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_diagnosa_penyakit
  INNER JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_diagnosa_penyakit.id_pasien
  INNER JOIN tbl_user ON tbl_user.id_user=tbl_diagnosa_penyakit.id_dokter ORDER BY tbl_diagnosa_penyakit.id_penyakit DESC");
?>
<a href="users?menu=diagnosa_penyakit&aksi=tambah" class="btn btn-primary">+ Data</a>
<hr>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="20%">Nama Pasien</th>
      <th width="20%">Dokter</th>
      <th width="19%">Nama Penyakit</th>
      <th width="15%">Jenis Penyakit</th>
      <th width="15%">Bagian Sakit</th>
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
        <td><?php echo $baris['nama_penyakit']; ?></td>
        <td><?php echo $baris['jenis_penyakit']; ?></td>
        <td><?php echo $baris['bagian_sakit']; ?></td>
        <td class="text-center">
          <a href="users?menu=diagnosa_penyakit&aksi=edit&id=<?php echo $baris['id_penyakit']; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
          <a href="users?menu=diagnosa_penyakit&aksi=hapus&id=<?php echo $baris['id_penyakit']; ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda Yakin?');"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
