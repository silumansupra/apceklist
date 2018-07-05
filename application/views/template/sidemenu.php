<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
 <!-- sidebar: style can be found in sidebar.less -->
 <section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
   <div class="pull-left image">
    <?= '<img src = "' . base_url() . 'assets/images/noprofile.jpg" class = "img-circle" alt = "Foto Profile">' ?>
   </div>
   <div class="pull-left info">
    <p><?= get_namalengkap() ?></p>
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
   </div>
  </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">

   <?php if (get_level() === "1") { // MENU ADMIN?>
      <li class="header">MENU</li>
      <li>
       <a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
      </li>
      <li>
       <a href="<?= base_url() . "ceklist" ?>"><i class="fa fa-check-square-o"></i><span>Data Ceklist</span></a>
      </li>
      <li>
       <a href="<?= base_url() . "perangkat" ?>"><i class="fa fa-cubes"></i><span>Data Perangkat</span></a>
      </li>
      <li>
       <a href="<?= base_url() . "lokasi" ?>"><i class="fa fa-map-marker"></i><span>Data Lokasi</span></a>
      </li>
      <li class="treeview">
       <a href="#"><i class="fa fa-cogs"></i><span>Setting</span>
        <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
        </span>
       </a>
       <ul class="treeview-menu">
        <li><a href="<?= base_url() . "setting/asman" ?>"><i class="fa fa-angle-right text-success"></i> Data Asman</a></li>
        <li><a href="<?= base_url() . "setting/user" ?>"><i class="fa fa-angle-right text-success"></i> Data User</a></li>
        <li><a href="<?= base_url() . "setting/profil" ?>"><i class="fa fa-angle-right text-success"></i> Edit Profil</a></li>
       </ul>
      </li>

     <?php } elseif (get_level() === "2") { // MENU ADMIN OPD?>
      <li class="header">MENU KARYAWAN</li>
      <li>
       <a href="<?= base_url() . "pegawai/" ?>"><i class="fa fa-users"></i><span>Data Ceklist</span></a>
      </li>
     <?php } ?>
   <li>
    <a href="<?= base_url(); ?>auth/logout"><i class="fa fa-sign-out"></i><span>Logout</span></a>
   </li>
  </ul>
 </section>
 <!-- /.sidebar -->
</aside>