<div class="panel panel-info">
  <div class="panel-heading">
    <b><i class="fa fa-table"></i> <?php echo ucwords($_GET['aksi']); ?> Transaksi Obat</b>
  </div>
  <div class="panel-body">
    <?php
    if ($_SESSION['level']!='admin' && $_SESSION['level']!='apotik'){ echo "<script>window.location='users?menu=404';</script>";}

    if ($_GET['aksi']=='tambah'){
      include "tambah.php";
    }elseif ($_GET['aksi']=='edit'){
      include "edit.php";
    }elseif ($_GET['aksi']=='hapus'){
      include "hapus.php";
    }elseif ($_GET['aksi']=='detail'){
      include "detail.php";
    }else{
      include "tabel.php";
    } ?>
  </div>
</div>
