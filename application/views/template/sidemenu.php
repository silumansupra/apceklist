<?php
  $uri1 = $this->uri->segment(1);
  $uri2 = $this->uri->segment(2);
  $uri3 = $this->uri->segment(3);
  $uri4 = $this->uri->segment(4);
  $uri5 = $this->uri->segment(5);
?>
<!--Left side column. contains the sidebar -->
<aside class = "main-sidebar">
 <!--sidebar: style can be found in sidebar.less -->
 <section class = "sidebar">
  <!--Sidebar user panel -->
  <div class = "user-panel">
   <div class = "pull-left image">
    <?= '<img src = "' . base_url() . 'assets/images/noprofile.jpg" class = "img-circle" alt = "Foto Profile">' ?>
   </div>
   <div class="pull-left info">
    <p><?= get_namalengkap() ?></p>
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
   </div>
  </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">

   <?php if (get_level() === "1") { // MENU ADMIN  ?>
      <li class="header">MENU</li>
      <li class="<?= $uri1 == "dashboard" ? "active" : "" ?>">
       <a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
      </li>
      <li class="<?= $uri1 == "ceklist" ? "active" : "" ?>">
       <a href="<?= base_url() . "ceklist" ?>"><i class="fa fa-check-square-o"></i><span>Data Ceklist</span></a>
      </li>
      <li class="<?= $uri1 == "perangkat" ? "active" : "" ?>">
       <a href="<?= base_url() . "perangkat" ?>"><i class="fa fa-cubes"></i><span>Data Perangkat</span></a>
      </li>
      <li class="<?= $uri1 == "lokasi" ? "active" : "" ?>">
       <a href="<?= base_url() . "lokasi" ?>"><i class="fa fa-map-marker"></i><span>Data Lokasi</span></a>
      </li>
      <li class="<?= $uri1 == "setting" ? "active" : "" ?> treeview">
       <a href="#"><i class="fa fa-cogs"></i><span>Setting</span>
        <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
        </span>
       </a>
       <ul class="treeview-menu">
        <li class="<?= $uri2 == "asman" ? "active" : "" ?>"><a href="<?= base_url() . "setting/asman" ?>"><i class="fa fa-angle-right text-success"></i> Setup Asman</a></li>
        <li class="<?= $uri2 == "user" ? "active" : "" ?>"><a href="<?= base_url() . "setting/user" ?>"><i class="fa fa-angle-right text-success"></i> Setup User</a></li>
        <!--<li class="<?= $uri2 == "profil" ? "active" : "" ?>"><a href="<?= base_url() . "setting/profil" ?>"><i class="fa fa-angle-right text-success"></i> Edit Profil</a></li>-->
       </ul>
      </li>

     <?php } elseif (get_level() === "2") { // MENU ADMIN OPD  ?>
      <li class="header">MENU KARYAWAN</li>
      <li class="<?= $uri1 == "ceklist" ? "active" : "" ?>">
       <a href="<?= base_url() . "ceklist/" ?>"><i class="fa fa-users"></i><span>Data Ceklist</span></a>
      </li>
     <?php } ?>
   <li>
    <a href="<?= base_url(); ?>auth/logout"><i class="fa fa-sign-out"></i><span>Logout</span></a>
   </li>
  </ul>
 </section>
 <!-- /.sidebar -->
</aside>