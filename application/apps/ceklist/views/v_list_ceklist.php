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
      <h3 class="box-title">
       $TITLE
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">

      <?= pesan() ?>
      <!--CONTENT START-->
      <div class="row">
       <div class="col-md-12">
        <a href="<?= base_url() ?>ceklist/form" class="btn btn-primary btn-lg pull-right"><i class="fa fa-check-square-o"></i> Ceklist Perangkat</a>
       </div>
      </div>
      <br>
      <div class="row">
       <div class="col-md-12">
        <table id="tabel" class="table table-responsive table-bordered table-striped table-hover">
         <thead>
          <tr>
           <th>#</th>
           <th>TANGGAL</th>
           <th>LOKASI</th>
           <th>PETUGAS</th>
           <th>STATUS CEKLIST</th>
           <th>AKSI</th>
          </tr>
         </thead>
         <tbody>
          <?php
            $no = '1';
            foreach ($data_ceklist as $r) {
             $status       = $r['status_ceklist'];
             $id_petugas   = $r['petugas_ceklist'];
             $nama_petugas = $this->db->query("SELECT nama_lengkap FROM tm_user WHERE userid ='$id_petugas'")->row()->nama_lengkap;
             ?>
             <tr>
              <th class="nomor"><?= $no++ ?></th>
              <td class="tengah"><strong><?= date('d-m-Y', strtotime(substr($r['waktu_ceklist'], 0, 10))) ?></strong></td>
              <td class="tengah"><?= $r['nama_lokasi'] ?></td>
              <td class="tengah"><?= $nama_petugas ?></td>
              <td class="tengah"><?= $status == "1" ? "OK" : "PENDING"; ?></td>
              <td class="aksi">
               <a title="Detail" href="<?= base_url() . "ceklist/form?tanggal=" . substr($r['waktu_ceklist'], 0, 10) . "&id_lokasi=" . $r['id_lokasi'] ?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
               <a title="Cetak" href="<?= base_url() . "ceklist/cetak?tanggal=" . substr($r['waktu_ceklist'], 0, 10) . "&id_lokasi=" . $r['id_lokasi'] ?>" class="btn btn-xs btn-primary"><i class="fa fa-print"></i></a>
              </td>
             </tr>
            <?php } ?>
         </tbody>
        </table>
       </div>
      </div>
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
 <script>
  $(document).ready(function () {
   $('#tabel').DataTable({
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': false,
    "pageLength": 25,
   });
  });
 </script>