<?php
if ($_SESSION['level']!='admin'){ echo "<script>window.location='users?menu=404';</script>";}

$cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE level!='admin' ORDER BY id_user DESC");
?>
<a href="users?menu=user&aksi=tambah" class="btn btn-primary">+ Data</a>
<hr>
<table id="data_tables" class="table table-bordered table-striped table-hover" width="100%">
  <thead>
    <tr>
      <th width="1%">No.</th>
      <th width="30%">Nama Lengkap</th>
      <th width="9%">Jenis Kelamin</th>
      <th width="10%">No.HP</th>
      <th width="20%">Username</th>
      <th width="10%">Level</th>
      <th width="10%">Tgl. Terdaftar</th>
      <th width="10%">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($baris = mysqli_fetch_array($cek_data)) {?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $baris['nama_lengkap']; ?></td>
        <td><?php echo $baris['jk']; ?></td>
        <td><?php echo $baris['tlp']; ?></td>
        <td><?php echo $baris['username']; ?></td>
        <td><?php echo ucwords($baris['level']); ?></td>
        <td><?php echo date('d-m-Y H:i:s',strtotime($baris['tgl_user'])); ?></td>
        <td class="text-center">
          <a href="users?menu=user&aksi=edit&id=<?php echo $baris['id_user']; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
          <a href="users?menu=user&aksi=hapus&id=<?php echo $baris['id_user']; ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda Yakin?');"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php
    } ?>
  </tbody>
</table>
