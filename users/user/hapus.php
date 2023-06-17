<?php
if ($_SESSION['level']!='admin'){ echo "<script>window.location='users?menu=404';</script>";}

if ($_GET['menu']=='user' && $_GET['aksi']=='hapus' && $_GET['id']!=''){
  $id = htmlentities(strip_tags($_GET['id']));
  $hapus = mysqli_query($con, "DELETE FROM tbl_user WHERE id_user='$id' AND level!='admin'");
  if ($hapus) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='users?menu=user';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=user';</script>";
    exit;
  }
}else {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}
?>
