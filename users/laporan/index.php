<?php
if ($_SESSION['level']==''){ echo "<script>window.location='users?menu=login';</script>";}

if (empty($_GET['aksi']) or $_GET['aksi']!='adm' AND $_GET['aksi']!='dokter' AND $_GET['aksi']!='apotik') {
  echo "<script>window.location='users?menu=404';</script>";
}
if ($_GET['aksi']=='adm') {
  $judul = "Administrasi";
}else {
  $judul = $_GET['aksi'];
}
?>
<div class="panel panel-info">
  <div class="panel-heading">
    <b><i class="fa fa-print"></i> LAPORAN <?php echo strtoupper($judul); ?></b>
  </div>
  <div class="panel-body">

    <div class="col-md-3"></div>
    <div class="col-md-6">
      <br>
      <form action="javascript:;" method="post" data-parsley-validate="true">
          <div class="col-md-6">
            <label>Dari Tanggal</label>
            <input type="text" name="tgl_1" id="tgl_1" class="form-control" value="<?php echo date('01-m-Y'); ?>" required maxlength="10">
          </div>
          <div class="col-md-6">
            <label>Sampai Tanggal</label>
            <input type="text" name="tgl_2" id="tgl_2" class="form-control" value="<?php echo date('t-m-Y'); ?>" required maxlength="10">
          </div>
          <div class="col-md-12">
            <hr style="margin-bottom:5px;">
          </div>
          <div class="col-md-6">
            <button onclick="return cetak('pdf');" class="btn btn-danger" style="width:100%;margin-top:10px;"><i class="fa fa-file-pdf-o"></i> Export PDF</button>
          </div>
          <div class="col-md-6">
            <button onclick="return cetak();" class="btn btn-info" style="width:100%;margin-top:10px;"><i class="fa fa-print"></i> Cetak</button>
            <br><br><br>
          </div>
      </form>
    </div>
    <div class="col-md-3"></div>

  </div>
</div>

<script type="text/javascript">
  function cetak(x='')
  {
    file='';
    tgl_1 = $('#tgl_1').val();
    tgl_2 = $('#tgl_2').val();
    if (x!='') {
      file='&file='+x;
    }
    window.open('users/laporan/cetak.php?aksi=<?php echo $_GET['aksi']; ?>&tgl_1='+tgl_1+'&tgl_2='+tgl_2+file,'_blank');
  }
</script>
