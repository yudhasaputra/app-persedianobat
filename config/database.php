<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname   = "db_obat";
$con = mysqli_connect($hostname, $username, $password, $dbname) or die ('Koneksi Gagal');
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die;
}

?>
