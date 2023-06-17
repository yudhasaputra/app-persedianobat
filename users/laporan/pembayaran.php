<?php
$link_utama = "../..";
include "$link_utama/config/koneksi.php";
session_start();
if ($_SESSION['level']==''){ echo "<script>window.location='$link_utama/users?menu=login';</script>";}

if (empty($_GET['id'])) {
  echo "<script>window.location='$link_utama/users?menu=404';</script>";
}

$tgl=date('d-m-Y');
$id=$_GET['id'];
$cek_data = mysqli_query($con, "SELECT * FROM tbl_pembayaran WHERE id_bayar='$id'");
if (mysqli_num_rows($cek_data)==0) {
  echo "<script>window.location='$link_utama/users?menu=404';</script>";
  exit;
}
$v_data = mysqli_fetch_array($cek_data);
$id_transaksi = $v_data['id_transaksi'];
$cek_data1 = mysqli_query($con, "SELECT * FROM tbl_transaksi
  INNER JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_transaksi.id_pasien
  INNER JOIN tbl_resep ON tbl_resep.id_resep=tbl_transaksi.id_resep
  INNER JOIN tbl_stok ON tbl_stok.id_stok=tbl_transaksi.id_stok
  WHERE tbl_transaksi.id_transaksi='$id_transaksi'
  ORDER BY tbl_transaksi.id_transaksi DESC");
$cek_data2 = mysqli_query($con, "SELECT * FROM tbl_obat_keluar WHERE id_transaksi='$id_transaksi' ORDER BY id_keluar DESC");

function get_data($v_data,$cek_data1,$cek_data2,$tgl,$con='',$id='')
{
	$output = '
  <center>
    <h2 style="margin-bottom:5px;">PEMBAYARAN OBAT</h2>
  </center>
  <br>
  <table class="table table-bordered table-striped" width="100%">
    <thead>
      <tr>
        <th>Nama Pasien</th>
        <th>Nama Obat</th>
        <th>Jumlah Obat</th>
        <th>Harga Jual</th>
        <th>Harga Satuan</th>
      </tr>
    </thead>
    <tbody>
	';
  $no=1;
  while ($baris = mysqli_fetch_array($cek_data1)) {
    $output .= '
			<tr>
        <td valign="top">'.$baris["nama_pasien"].'</td>
        <td valign="top">'.$baris["nama_obat"].'</td>
        <td valign="top">'.$baris["jumlah_obat"].'</td>
        <td valign="top">'.$baris["harga_jual"].'</td>
        <td valign="top">'.$baris["harga_satuan"].'</td>
			</tr>
		';
    $no++;
	}
	$output .= '
    </tbody>
	</table>
  <br>
  <table class="table table-bordered table-striped" width="100%">
    <thead>
      <tr>
        <th width="1">No.</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Sub Total</th>
      </tr>
    </thead>
    <tbody>';
    $no=1; $total=0; $sub_total=0;$t_jumlah=0; $t_total=0;
    while ($baris = mysqli_fetch_array($cek_data2)) {
      $sub_total=$baris['jumlah_keluar']*$baris['jumlah_harga_jual'];
      $output .= '
      <tr>
        <td>'. $no .'</td>
        <td>'. date('d-m-Y',strtotime($baris['tanggal_keluar'])) .'</td>
        <td>'. number_format($baris['jumlah_keluar']) .'</td>
        <td>Rp. '. number_format($baris['jumlah_harga_jual']) .'</td>
        <td>Rp. '. number_format($sub_total) .'</td>
      </tr>';
      $t_jumlah +=$baris['jumlah_keluar'];
      $t_total +=$baris['jumlah_harga_jual'];
      $total+=$sub_total;
    $no++;
    }
    $output .= '
    </tbody>
    <tfoot>
      <tr>
        <th colspan="2" class="text-right">TOTAL</th>
        <th>'.number_format($t_jumlah).'</th>
        <th>Rp. '.number_format($t_total).'</th>
        <th>Rp. '.number_format($total).'</th>
      </tr>
    </tfoot>
  </table>
  <br>
  <table width="100%">
    <tr>
      <td width="120"><b>TOTAL BAYAR </b></td>
      <td width="1"><b>:</b>&nbsp;</td>
      <td> Rp. '.number_format($v_data['total_bayar']).'</td>
    </tr>
    <tr>
      <td><b>PASIEN BAYAR </b></td>
      <td><b>:</b>&nbsp;</td>
      <td> Rp. '.number_format($v_data['pasien_bayar']).'</td>
    </tr>
    <tr>
      <td><b>Kembalian </b></td>
      <td><b>:</b>&nbsp;</td>
      <td> Rp. '.number_format($v_data['kembalian']).' </td>
    </tr>
  </table>
	';
	return $output;
}

if ($_GET['file']=='pdf') {
  include("$link_utama/config/pdf.php");
  $html_code = '<link rel="stylesheet" href="'.$link_utama.'/assets/css/style_print.css">';
	$html_code .= get_data($v_data,$cek_data1,$cek_data2,$tgl,$con,$id);
  $pdf = new Pdf();
  $pdf->load_html($html_code);
  $pdf->setPaper('A4', 'landscape');
  $pdf->render();
  $pdf->stream("Pembayaran Obat $tgl",array("Attachment"=>0));
}else { ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Cetak Pembayaran Obat</title>
      <link rel="icon" type="image/png" href="<?php echo "$link_utama"; ?>/img/favicon.ico"/>
      <link rel="stylesheet" href="<?php echo "$link_utama"; ?>/assets/css/style_print.css">
      <style type="text/css" media="print">
        @page { size: landscape; }
      </style>
    </head>
    <body onload="window.print();setTimeout(window.close, 1000);">

      <?php echo get_data($v_data,$cek_data1,$cek_data2,$tgl,$con,$id); ?>

    </body>
  </html>

<?php
}
?>
