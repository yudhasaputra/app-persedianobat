<?php
if(isset($_GET['menu'])){
  $menu = $_GET['menu'];
  $sub_menu = $_GET['sub_menu'];

  if($menu == "data_pasien"){
    include "$menu/index.php";
  }
  else
  if($menu == "diagnosa_penyakit"){
    include "$menu/index.php";
  }
  else
  if($menu == "resep_obat"){
    include "$menu/index.php";
  }
  else
  if($menu == "obat_masuk"){
    include "$menu/index.php";
  }
  else
  if($menu == "stok"){
    include "$menu/index.php";
  }
  else
  if($menu == "transaksi"){
    include "$menu/index.php";
  }
  else
  if($menu == "obat_keluar"){
    include "$menu/index.php";
  }
  else
  if($menu == "pembayaran"){
    include "$menu/index.php";
  }
  else
  if($menu == "laporan"){
    include "$menu/index.php";
  }
  else
  if($menu == "user"){
    include "$menu/index.php";
  }
  else
  if($menu == "profile"){
    include "$menu.php";
  }
  else
  if($menu == "ubah_pass"){
    include "$menu.php";
  }
  else
  if($menu == "logout"){
    include "logout.php";
  }
  else
  if($menu == "404"){
    include "404.php";
  }
  else
  if ($menu == "") {
    include "beranda.php";
  }
  else
  {
    include "404.php";
  }

}else {
  include "beranda.php";
}
?>
