<!--CUSTOM CSS-->

</head>
<body class="hold-transition skin-blue sidebar-mini">
 <!-- Site wrapper -->
 <div class="wrapper">
  <!--HEADER & SIDEBAR-->
  <?php
    $this->load->view('template/header');
    $this->load->view('template/sidemenu')
  ?>
  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <h1>
     <?= $h1_title ?>
     <small><?= $h1_subtitle ?></small>
    </h1>
    <!--BREADCRUMB-->
    <?php $this->load->view('template/breadcrumb') ?>
   </section>

   <!-- Main content -->
   <section class="content">
    <!-- Default box -->
    <div class="box">
     <div class="box-header with-border">
      <h3 class="box-title">Tabel Data</h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <!--CONTENT START-->
      <table id="tbl_alat" class="table table-responsive table-bordered table-striped table-hover">
       <thead>
        <tr>
         <th>ID ALAT</th>
         <th>OPD/SKPD</th>
         <th>IP ADDRESS</th>
         <th>PING</th>
         <th>STATUS</th>
         <th>AKSI</th>
        </tr>
       </thead>
       <tbody>
        <?php
//            debug($data_pegawai);
          foreach ($data_perangkat as $r) {
           ?>
           <tr>
            <td class="tengah"><?= $r['id_alat'] ?></td>
            <td><?= getNamaOPD($r['id_opd']) ?></td>
            <td class="tengah"><?= $r['ip_mesin'] ?></td>
            <td class="tengah">
             <?= $status_ping = "1" ? "UP" : "DOWN" ?>
            </td>
            <td class="tengah">
             <?= $status_alat = "1" ? "AKTIF" : "TDK AKTIF" ?>
            </td>
            <td>AKSI</td>
           </tr>
          <?php } ?>
       </tbody>
      </table>
      <!--CONTENT END-->
     </div>
     <!-- /.box-body -->
     <div class="box-footer">
      <!--Footer-->
     </div>
     <!-- /.box-footer-->
    </div>
    <!-- /.box -->
   </section>
   <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--FOOTER-->
  <?php
    $this->load->view('template/footer');
    $this->load->view('template/control_sidebar');
  ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->
 <!--FOOTER SCRIPT-->
 <?php $this->load->view('template/footer_script') ?>
 <!--CUSTOM JS-->