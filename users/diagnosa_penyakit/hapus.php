<?php
if ($_SESSION['level']!='admin' && $_SESSION['level']!='dokter'){ echo "<script>window.location='users?menu=404';</script>";}

if ($_GET['menu']=='diagnosa_penyakit' && $_GET['aksi']=='hapus' && $_GET['id']!=''){
  $id = htmlentities(strip_tags($_GET['id']));
  $hapus = mysqli_query($con, "DELETE FROM tbl_diagnosa_penyakit WHERE id_penyakit='$id'");
  if ($hapus) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='users?menu=diagnosa_penyakit';</script>";
    exit;
  }else {
    echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='users?menu=diagnosa_penyakit';</script>";
    exit;
  }
}else {
  echo "<script>window.location='users?menu=404';</script>";
  exit;
}
?>
