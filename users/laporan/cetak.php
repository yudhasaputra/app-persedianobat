<?php
$link_utama = "../..";
include "$link_utama/config/koneksi.php";
session_start();
if ($_SESSION['level']==''){ echo "<script>window.location='$link_utama/users?menu=login';</script>";}

if (empty($_GET['tgl_1']) or empty($_GET['tgl_2'])) {
  echo "<script>window.location='$link_utama/users?menu=404';</script>";
}
$aksi  = $_GET['aksi'];
if ($aksi=='adm') {
  $judul = "ADMINISTRASI";
}else {
  $judul = strtoupper($aksi);
}
$tgl_1 = date('Y-m-d H:i:s',strtotime($_GET['tgl_1']));
$tgl_2 = date('Y-m-d H:i:s',strtotime($_GET['tgl_2']));
$cek_data = mysqli_query($con, "SELECT * FROM tbl_user WHERE level='$aksi' AND tgl_user BETWEEN '$tgl_1' AND '$tgl_2' ORDER BY id_user DESC");

if ($_GET['tgl_1']==$_GET['tgl_2']) {
  $tgl = $_GET['tgl_1'];
}else {
  $tgl = $_GET['tgl_1'].' - '.$_GET['tgl_2'];
}


function get_data($cek_data,$tgl,$judul)
{
	$output = '
  <center>
    <h2 style="margin-bottom:5px;">LAPORAN '.$judul.'</h2>
    <b>'.$tgl.'</b>
  </center>
  <br>
  <table class="table table-bordered table-striped" width="100%">
    <thead>
      <tr>
        <th width="1">No.</th>
        <th>Nama Lengkap</th>
        <th>Jenis Kelamin</th>
        <th>No. HP</th>
      </tr>
    </thead>
    <tbody>
	';
  $no=1;
  while ($baris = mysqli_fetch_array($cek_data)) {
		$output .= '
			<tr>
        <td valign="top" align="center"><b>'.$no.'</b></td>
        <td valign="top">'.$baris["nama_lengkap"].'</td>
        <td valign="top">'.$baris["jk"].'</td>
        <td valign="top">'.$baris["tlp"].'</td>
			</tr>
		';
    $no++;
	}
	$output .= '
    </tbody>
	</table>
	';
	return $output;
}

if ($_GET['file']=='pdf') {
  include("$link_utama/config/pdf.php");
  $html_code = '<link rel="stylesheet" href="'.$link_utama.'/assets/css/style_print.css">';
	$html_code .= get_data($cek_data,$tgl,$judul);
  $pdf = new Pdf();
  $pdf->load_html($html_code);
  $pdf->setPaper('A4', 'landscape');
  $pdf->render();
  $pdf->stream("DATA $judul $tgl",array("Attachment"=>0));
}else { ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Cetak</title>
      <link rel="icon" type="image/png" href="<?php echo "$link_utama"; ?>/img/favicon.ico"/>
      <link rel="stylesheet" href="<?php echo "$link_utama"; ?>/assets/css/style_print.css">
      <style type="text/css" media="print">
        @page { size: landscape; }
      </style>
    </head>
    <body onload="window.print();setTimeout(window.close, 1000);">

      <?php echo get_data($cek_data,$tgl,$judul); ?>

    </body>
  </html>

<?php
}
?>
