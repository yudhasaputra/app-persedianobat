<?php
$menu = ""; $aksi = "";
if (isset($_GET['menu'])) {
  $menu = $_GET['menu'];
}
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];
}
$level=$_SESSION['level'];
?>
<style>
  .panel-collapse > ul > li{padding-left:20px;}
  .menu_active{background:#337ab7;color:#fff;}
  .submenu_active{background:#f1f1f1;color:#2196f3;}
</style>
<div id="navbar" class="panel panel-success collapse navbar-collapse" style="padding:0px;">
  <div class="panel-heading collapse navbar-collapse">
    <center>
      <a href="users"><img src="img/logo.png" class="img-responsive" width="150" alt=""></a>
    </center>
    <br>
  </div>
  <div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
      <li<?php if($menu==''){echo ' class="active"';}?>>
        <a href="users"><i class="fa fa-home"></i> Beranda</a>
      </li>
    <?php if ($level=='admin' || $level=='adm'): ?>
      <li<?php if($menu=='data_pasien'){echo ' class="active"';}?>>
        <a href="users?menu=data_pasien"><i class="fa fa-database"></i> Data Pasien</a>
      </li>
    <?php endif; ?>
    <?php if ($level=='admin' || $level=='dokter'): ?>
      <li<?php if($menu=='diagnosa_penyakit'){echo ' class="active"';}?>>
        <a href="users?menu=diagnosa_penyakit"><i class="fa fa-clipboard"></i> Diagnosa Penyakit</a>
      </li>
      <li<?php if($menu=='resep_obat'){echo ' class="active"';}?>>
        <a href="users?menu=resep_obat"><i class="fa fa-tags"></i> Resep Obat</a>
      </li>
    <?php endif; ?>
    <?php if ($level=='admin' || $level=='apotik'): ?>
      <li<?php if($menu=='obat_masuk'){echo ' class="active"';}?>>
        <a href="users?menu=obat_masuk"><i class="fa fa-download"></i> Obat Masuk</a>
      </li>
      <li<?php if($menu=='stok'){echo ' class="active"';}?>>
        <a href="users?menu=stok"><i class="fa fa-tasks"></i> Stok Obat </a>
      </li>
      <li<?php if($menu=='transaksi'){echo ' class="active"';}?>>
        <a href="users?menu=transaksi"><i class="fa fa-table"></i> Transaksi Obat </a>
      </li>
      <!-- <li<?php if($menu=='obat_keluar'){echo ' class="active"';}?>>
        <a href="users?menu=obat_keluar"><i class="fa fa-upload"></i> Obat Keluar </a>
      </li> -->
    <?php endif; ?>
    <?php if ($level=='admin' || $level=='kasir'): ?>
      <li<?php if($menu=='pembayaran'){echo ' class="active"';}?>>
        <a href="users?menu=pembayaran"><i class="fa fa-credit-card"></i> Pembayaran </a>
      </li>
    <?php endif; ?>

    <?php if ($level=='admin'): ?>
      <li id="dropdown">
				<a data-toggle="collapse" href="#dropdown-lvl1-2" class="collapsed<?php if($menu=='laporan'){echo ' menu_active';}?>" aria-expanded="false">
						<span class="fa fa-print"></span>  Laporan <span class="caret" style="float:right;margin-top:5px;"></span>
				</a>
				<div id="dropdown-lvl1-2" class="panel-collapse collapse" aria-expanded="false" style="height:0px;">
					<ul class="nav">
            <li<?php if($menu=='laporan' AND $aksi=='adm'){echo ' class="submenu_active"';}?>><a href="users?menu=laporan&aksi=adm"> Administrasi </a></li>
            <li<?php if($menu=='laporan' AND $aksi=='dokter'){echo ' class="submenu_active"';}?>><a href="users?menu=laporan&aksi=dokter"> Dokter </a></li>
            <li<?php if($menu=='laporan' AND $aksi=='apotik'){echo ' class="submenu_active"';}?>><a href="users?menu=laporan&aksi=apotik"> Apotik </a></li>
          </ul>
				</div>
			</li>
        <li><hr style="margin:0px;"> </li>
        <li<?php if($menu=='user'){echo ' class="active"';}?>>
          <a href="users?menu=user"><i class="fa fa-users"></i> User</a>
        </li>
      <?php endif; ?>
      <li><hr style="margin:0px;"> </li>
      <li<?php if($menu=='profile'){echo ' class="active"';}?>>
        <a href="users?menu=profile"><i class="fa fa-user"></i> Profile</a>
      </li>
      <li<?php if($menu=='ubah_pass'){echo ' class="active"';}?>>
        <a href="users?menu=ubah_pass"><i class="fa fa-key"></i> Ubah Password</a>
      </li>
      <li><hr style="margin:0px;"> </li>
      <li>
        <a href="users?menu=logout" onclick="return confirm('Anda Yakin?');"><i class="fa fa-sign-out"></i> Logout</a>
      </li>
    </ul>
  </div>
</div>
