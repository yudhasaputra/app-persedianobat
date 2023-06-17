<?php
error_reporting(0);
include "database.php";

function base_url(){
  $currentPath = $_SERVER['PHP_SELF'];
  $pathInfo = pathinfo($currentPath);

  $hostName = $_SERVER['HTTP_HOST'];
  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

  $dir = str_replace($_SERVER["DOCUMENT_ROOT"],'', str_replace('\\','/',__FILE__));

  return $protocol.$hostName.$dir."/../../";
}

function view($data=''){
  $v1 = "Aplikasi Persediaan Obat";
  $v2 = "";
  $v3 = "";
  if ($data=='navbar') {
    $v = "";
  }elseif ($data=='1') {
    $v = $v1;
  }elseif ($data=='2') {
    $v = $v2;
  }elseif ($data=='3') {
    $v = $v3;
  }elseif ($data=='footer') {
    $v = "Copyright &copy; 2020";
  }else {
    $v = "$v1 $v2 $v3";
  }
  return $v;
}

date_default_timezone_set('Asia/Jakarta');
?>
