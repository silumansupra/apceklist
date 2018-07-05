<header class="main-header">
 <!-- Logo -->
 <a href="<?= base_url() ?>" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>A</b>C</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Aplikasi </b>Ceklist</span>
 </a>
 <!-- Header Navbar: style can be found in header.less -->
 <nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
   <span class="sr-only">Toggle navigation</span>
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
  </a>

  <div class="navbar-custom-menu">

   <ul class="nav navbar-nav">
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-user"></i>
      <span class="hidden-xs"><?= get_namalengkap() ?></span>
     </a>
     <ul class="dropdown-menu">
      <!-- User image -->
      <li class="user-header">
       <?= '<img src = "' . base_url() . 'assets/images/noprofile.jpg" class = "img-circle" alt = "Foto Profile">' ?>
       <p>
        <?= get_namalengkap() ?>
       </p>
      </li>
      <!-- Menu Body -->
      <li class="user-body">
       <div class="row">
        <div class="col-xs-4 text-center">
         <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
         <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
         <a href="#">Friends</a>
        </div>
       </div>
       <!-- /.row -->
      </li>
      <!-- Menu Footer-->
      <li class="user-footer">
       <div class="pull-left">
        <a href="#" class="btn btn-default btn-flat">Profile</a>
       </div>
       <div class="pull-right">
        <a href="#" class="btn btn-default btn-flat">Sign out</a>
       </div>
      </li>
     </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->
    <li>
     <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
    </li>
   </ul>
  </div>
 </nav>
</header>