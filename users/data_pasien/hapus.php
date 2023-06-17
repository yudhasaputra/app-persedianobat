<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='adm'){ echo "<script>window.location='users?menu=404';</script>";}

if ($_GET['menu']=='data_pasien' && $_GET['aksi']=='hapus' && $_GET['id']!=''){
  $id = htmlentities(strip_tags($_GET['id']));
  $hapus = mysqli_query($con, "DELETE FROM tbl_pasien WHERE id_pasien='$id'");
  if ($hapus) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='users?menu=data_pasien';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=data_pasien';</script>";
    exit;
  }
}else {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}
?>
