<?php $level=$_SESSION['level']; ?>
<div class="wrap">

<?php if ($level=='admin' || $level=='adm'){ ?>
  <div class="col-md-4">
    <a href="users?menu=data_pasien">
      <div class="box bg-blue">
        <div class="bg-icon"><i class="fa fa-database"></i></div>
        <label>Data Pasien</label>
      </div>
    </a>
  </div>
<?php } ?>

<?php if ($level=='admin' || $level=='dokter'){ ?>
  <div class="col-md-4">
    <a href="users?menu=diagnosa_penyakit">
      <div class="box bg-red">
        <div class="bg-icon"><i class="fa fa-clipboard"></i></div>
        <label>Diagnosa Penyakit</label>
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="users?menu=resep_obat">
      <div class="box bg-green">
        <div class="bg-icon"><i class="fa fa-tags"></i></div>
        <label>Resep Obat</label>
      </div>
    </a>
  </div>
<?php } ?>

<?php if ($level=='admin' || $level=='apotik'){ ?>
  <div class="col-md-4">
    <a href="users?menu=obat_masuk">
      <div class="box bg-green">
        <div class="bg-icon"><i class="fa fa-download"></i></div>
        <label>Obat Masuk</label>
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="users?menu=stok">
      <div class="box bg-white">
        <div class="bg-icon"><i class="fa fa-tasks"></i></div>
        <label>Stok Obat</label>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="users?menu=transaksi">
      <div class="box bg-yellow">
        <div class="bg-icon"><i class="fa fa-table"></i></div>
        <label>Transaksi Obat</label>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="users?menu=obat_keluar">
      <div class="box bg-red">
        <div class="bg-icon"><i class="fa fa-upload"></i></div>
        <label>Obat Keluar</label>
      </div>
    </a>
  </div>
<?php } ?>

<?php if ($level=='admin' || $level=='kasir'){ ?>
  <div class="col-md-4">
    <a href="users?menu=pembayaran">
      <div class="box bg-cyan">
        <div class="bg-icon"><i class="fa fa-credit-card"></i></div>
        <label>Pembayaran</label>
      </div>
    </a>
  </div>
<?php } ?>

<?php if ($level=='admin'){ ?>
  <div class="col-md-4">
    <a href="users?menu=user">
      <div class="box bg-blue">
        <div class="bg-icon"><i class="fa fa-users"></i></div>
        <label>User</label>
      </div>
    </a>
  </div>
<?php } ?>

  <div class="col-md-4">
    <a href="users?menu=profile">
      <div class="box bg-purple">
        <div class="bg-icon"><i class="fa fa-user"></i></div>
        <label>Profile</label>
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="users?menu=ubah_pass">
      <div class="box bg-yellow">
        <div class="bg-icon"><i class="fa fa-key"></i></div>
        <label>Ubah Password</label>
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="users?menu=logout" onclick="return confirm('Anda Yakin?');">
      <div class="box bg-black">
        <div class="bg-icon"><i class="fa fa-sign-out"></i></div>
        <label>Logout</label>
      </div>
    </a>
  </div>

</div>
