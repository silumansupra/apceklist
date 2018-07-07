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
       <a href="<?= base_url() ?>perangkat/setup" class="btn btn-warning"><i class="fa fa-wrench"></i> Setup Perangkat</a>
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <?= pesan() ?>
      <!--CONTENT START-->
      <table id="tabel" class="table table-responsive table-bordered table-striped table-hover">
       <thead>
        <tr>
         <th>#</th>
         <th>NAMA PERANGKAT</th>
         <th>LOKASI</th>
         <th>STATUS SETUP</th>
         <th>STATUS PERANGKAT</th>
         <th>AKSI</th>
        </tr>
       </thead>
       <tbody>
        <?php
          $no = '1';
          foreach ($data_perangkat as $r) {
           $status_p = $r['status_perangkat'];
           $status_s = $r['status_setup'];
           ?>
           <tr>
            <th class="nomor"><?= $no++ ?></th>
            <td><strong><?= $r['nama_perangkat'] ?></strong></td>
            <td class="tengah"><?= $r['nama_lokasi'] ?></td>
            <td class="tengah"><?= $status_s == "1" ? "<i class='fa fa-check text-success'></i> OK" : "<i class='fa fa-times text-danger'></i> Belum"; ?></td>
            <td class="tengah"><?= $status_p == "1" ? "AKTIF" : "NON-AKTIF"; ?></td>
            <td class="aksi">
             <a title="Edit" href="<?= base_url() . "perangkat/edit/" . $r['id_perangkat'] ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
             <a title="Hapus" onclick="confirm('Apakah Anda akan menghapus perangkat beserta data kegiatan ceklist?')" href="<?= base_url() . "perangkat/hapus_perangkat/" . $r['id_perangkat'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
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