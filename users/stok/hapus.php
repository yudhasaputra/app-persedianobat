<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";}

if ($_GET['menu']=='stok' && $_GET['aksi']=='hapus' && $_GET['id']!=''){
  $id = htmlentities(strip_tags($_GET['id']));
  $hapus = mysqli_query($con, "DELETE FROM tbl_stok WHERE id_stok='$id'");
  if ($hapus) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='users?menu=stok';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=stok';</script>";
    exit;
  }
}else {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}
?>
