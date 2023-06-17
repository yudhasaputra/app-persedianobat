<div class="panel panel-info">
  <div class="panel-heading">
    <b><i class="glyphicon glyphicon-modal-window"></i> <?php echo ucwords($_GET['aksi']); ?> Data User</b>
  </div>
  <div class="panel-body">
    <?php
    if ($_SESSION['level']!='admin'){ echo "<script>window.location='users?menu=404';</script>";}

    if ($_GET['aksi']=='tambah'){
      include "tambah.php";
    }elseif ($_GET['aksi']=='edit'){
      include "edit.php";
    }elseif ($_GET['aksi']=='hapus'){
      include "hapus.php";
    }else{
      include "tabel.php";
    } ?>
  </div>
</div>
