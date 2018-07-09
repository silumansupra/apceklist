<!--CUSTOM CSS-->
<?php
  $tanggal   = $this->input->get('tanggal');
  $id_lokasi = $this->input->get('id_lokasi');
?>
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
       <i class="fa fa-check-square"></i> PILIH LOKASI CEKLIST
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <!--CONTENT START-->
      <div class="row">
       <form method="get" action="<?= base_url() . "ceklist/form" ?>" id="fPilihLokasi">
        <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
        <div class="col-md-4">
         <div class="form-group">
          <label>PILIH LOKASI</label>
          <div class="row">
           <div class="col-md-12">
            <select name="id_lokasi" id="id_lokasi" class="form-control">
             <option selected hidden disabled> Pilih Lokasi Ceklist...</option>
             <?php foreach ($data_lokasi as $r) { ?>
                <option <?= $id_lokasi === $r['id_lokasi'] ? "selected" : "" ?> value="<?= $r['id_lokasi'] ?>"><?= $r['nama_lokasi'] ?></option>
               <?php } ?>
            </select>
           </div>
          </div>
         </div>
        </div>
        <div class="col-md-4">
         <strong>Keterangan</strong><br>
         Waktu Server: <?= date('d-m-Y H:i:s') ?>
        </div>
        <div class="col-md-4">
         <strong>STATUS CEKLIST</strong><br>
         $STATUS_CEKLIST (HARI INI)
        </div>
       </form>
      </div>
      <div class="row">
       <div class="col-md-12">
        <?php if ($data_form !== "0") { ?>
           <h4>DATA PERANGKAT</h4>
           <table class="table table-bordered table-striped">
            <thead>
             <tr>
              <th>#</th>
              <th>NAMA PERANGKAT</th>
              <th>LAST CEKLIST</th>
              <th>STATUS</th>
              <th>CEKLIST</th>
             </tr>
            </thead>
            <tbody>
             <?php
             $no = 1;
             foreach ($data_form as $r) {
              ?>
              <tr>
               <th class="nomor"><?= $no++ ?></th>
               <td><?= $r['nama_perangkat'] ?></td>
               <td class="tengah"><?= "Last Ceklist" ?></td>
               <td class="tengah"><?= $r['status_perangkat'] == "1" ? "AKTIF" : "NON-AKTIF" ?></td>
               <td class="aksi">
                <a title="Isi ceklist sekarang" href="<?= base_url() . "ceklist/form/perangkat?tanggal=$tanggal&id_lokasi=$id_lokasi&id_perangkat=" . $r['id_perangkat'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square-o"></i> Ceklist Perangkat</a>
               </td>
              </tr>
             <?php } ?>
            </tbody>
           </table>
          <?php } else { ?>
           echo "TIDAK ADA";
          <?php } ?>
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
   $('#id_lokasi').change(function () {
    $('#fPilihLokasi').submit();
   });
  });
 </script>