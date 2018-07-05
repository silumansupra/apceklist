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
       <i class="fa fa-plus"></i> FORM TAMBAH USER
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <!--CONTENT START-->
      <div class="row">
       <div class="col-md-8">
        <form action="<?php echo base_url() . "setting/asman/tambah" ?>" method="post">
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">NAMA</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap" class="form-control" required>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">NIK</label>
           </div>
           <div class="col-md-9">
            <input name="nik_user" id="nik_user" placeholder="Nomor Induk Karyawan" type="text" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">USERNAME</label>
           </div>
           <div class="col-md-9">
            <input name="username" id="username" placeholder="Username" type="text" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">PASSWORD</label>
           </div>
           <div class="col-md-9">
            <input name="password" id="password" placeholder="Password" type="password" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">PASSWORD (KONFIRMASI)</label>
           </div>
           <div class="col-md-9">
            <input name="password2" id="password2" placeholder="Masukkan password lagi..." type="password" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">JABATAN</label>
           </div>
           <div class="col-md-9">
            <select name="id_jabatan" class="form-control">
             <option hidden disabled selected> Pilih Jabatan</option>
             <?php
               $datajab = $this->db->get('tm_jabatan')->result_array();
               foreach ($datajab as $r) {
                ?>
                <option value="<?= $r['id_jabatan'] ?>"><?= $r['nama_jabatan'] ?></option>
               <?php } ?>
            </select>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">USER LEVEL</label>
           </div>
           <div class="col-md-9">
            <select name="id_level" class="form-control">
             <option hidden disabled selected> Pilih Level</option>
             <?php
               $datalv = $this->db->get('tm_level')->result_array();
               foreach ($datalv as $r) {
                ?>
                <option value="<?= $r['id_level'] ?>"><?= $r['nama_level'] ?></option>
               <?php } ?>
            </select>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">STATUS</label>
           </div>
           <div class="col-md-9">
            <select name="status_user" id="status_user" class="form-control">
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
            <a href="<?= base_url() . "setting/asman" ?>" class="btn btn-warning">Kembali</a>
            <input type="submit" value="Simpan Data" class="btn btn-primary" name="btnSimpan">
           </div>
          </div>
         </div>
        </form>
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