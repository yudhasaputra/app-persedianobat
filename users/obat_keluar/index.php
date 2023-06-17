<div class="panel panel-info">
  <div class="panel-heading">
    <b><i class="fa fa-upload"></i> <?php echo ucwords($_GET['aksi']); ?> Obat Keluar</b>
  </div>
  <div class="panel-body">
    <?php
    if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";}
    include "tabel.php"; ?>
  </div>
</div>
