<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='adm'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_pasien ORDER BY id_pasien DESC");
?>
<a href="users?menu=data_pasien&aksi=tambah" class="btn btn-primary">+ Data</a>
<hr>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="47%">Nama Pasien</th>
      <th width="28%">Tempat, Tgl Lahir</th>
      <th width="4%">JK</th>
      <th width="10%">Umur</th>
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
        <td><?php echo $baris['tempat_lahir']; ?>, <?php echo date('d-m-Y', strtotime($baris['tanggal_lahir'])); ?></td>
        <td><?php echo $baris['jk_pasien']; ?></td>
        <td><?php echo $baris['umur_pasien']; ?></td>
        <td class="text-center">
          <a href="users?menu=data_pasien&aksi=edit&id=<?php echo $baris['id_pasien']; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
          <a href="users?menu=data_pasien&aksi=hapus&id=<?php echo $baris['id_pasien']; ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda Yakin?');"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
