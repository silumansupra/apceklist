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
       <i class="fa fa-wrench"></i> SETUP PERANGKAT
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <!--CONTENT START-->
      <div class="row">
       <div class="col-md-6">
        <h4>Data Perangkat</h4>
        <div class="ln_solid"></div>
        <form action="<?php echo base_url() . "perangkat/setup" ?>" method="post">
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">LOKASI</label>
           </div>
           <div class="col-md-9">
            <select name="id_lokasi" class="form-control">
             <option hidden disabled selected> Pilih Lokasi</option>
             <?php
               $datalokasi = $this->db->get('tm_lokasi')->result_array();
               foreach ($datalokasi as $r) {
                ?>
                <option value="<?= $r['id_lokasi'] ?>"><?= $r['nama_lokasi'] ?></option>
               <?php } ?>
            </select>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">NAMA PERANGKAT</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="nama_perangkat" id="nama_lengkap" placeholder="Nama perangkat" class="form-control" required>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">KETERANGAN</label>
           </div>
           <div class="col-md-9">
            <textarea name="ket_perangkat" id="ket_perangkat" placeholder="Ketereangan tambahan..." class="form-control" rows="3"></textarea>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">STATUS</label>
           </div>
           <div class="col-md-9">
            <select name="status_perangkat" id="status_perangkat" class="form-control">
             <option value="1" selected=""> AKTIF</option>
             <option value="0"> NON-AKTIF</option>
            </select>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <!--button-->
           <div class="col-md-12 text-right">
            <a href="<?= base_url() . "perangkat" ?>" class="btn btn-warning">Kembali</a>
            <input type="submit" value="Simpan Data" class="btn btn-primary" name="btnSimpan">
           </div>
          </div>
         </div>
        </form>
       </div>
       <div class="col-md-6">
        <h4>Data Kegiatan Pengukuran & Variabel</h4>
        <div class="ln_solid"></div>
        <p class="text-muted">
         <i class="fa fa-info-circle"></i> Anda harus menyimpan data perangkat terlebih dahulu untuk menambahkan data kegiatan dan variabel ceklist.
        </p>
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