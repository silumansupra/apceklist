<!--CUSTOM CSS-->
<?php
  $tanggal      = $this->input->get('tanggal');
  $id_lokasi    = $this->input->get('id_lokasi');
  $id_perangkat = $this->input->get('id_perangkat');
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
       FORM CEKLIST
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <!--CONTENT START-->
      <div class="row">
       <div class="col-md-12">
        <table class="table">
         <tr>
          <td style="width:150px">NAMA PERANGKAT</td>
          <td>: <?= $this->db->query("SELECT nama_perangkat FROM tm_perangkat WHERE id_perangkat=$id_perangkat")->row()->nama_perangkat; ?></td>
         </tr>
         <tr>
          <td>LOKASI PERANGKAT</td>
          <td>: <?= $this->db->query("SELECT nama_lokasi FROM tm_lokasi WHERE id_lokasi=$id_lokasi")->row()->nama_lokasi; ?></td>
         </tr>
        </table>
        <form method="post" action="<?= base_url() . "ceklist/form/perangkat" ?>" id="fSimpanVal">
         <input type="hidden" name="id_lokasi" value="<?= $id_lokasi ?>">
         <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
         <table class="table table-bordered table-striped table-hover">
          <thead>
           <tr>
            <th>#</th>
            <th>KEGIATAN</th>
            <th>#1</th>
            <th>#2</th>
            <th>#3</th>
            <th>#4</th>
            <th>#5</th>
            <th>KET.</th>
           </tr>
          </thead>
          <tbody>
           <?php
             $no           = 1;
             foreach ($data_kegiatan as $k) {
              ?>
              <tr>
               <td><?= $no++ ?></td>
               <td><?= $k['nama_kegiatan'] . "<br><p class='small text-muted'>" . $k['tolak_ukur'] . "</p>" ?></td>
               <td class="tengah">
                <input style="width: 100px" type="text" class="form-control" placeholder="<?= $k['var1'] == "-" ? "-" : $k['var1'] ?>" name="val1" <?= $k['var1'] == "-" ? "disabled" : "" ?> required >
               </td>
               <td class="tengah">
                <input style="width: 100px" type="text" class="form-control" placeholder="<?= $k['var2'] == "-" ? "-" : $k['var2'] ?>" name="val1" <?= $k['var2'] == "-" ? "disabled" : "" ?> required>
               </td>
               <td class="tengah">
                <input style="width: 100px" type="text" class="form-control" placeholder="<?= $k['var3'] == "-" ? "-" : $k['var3'] ?>" name="val1" <?= $k['var3'] == "-" ? "disabled" : "" ?> required>
               </td>
               <td class="tengah">
                <input style="width: 100px" type="text" class="form-control" placeholder="<?= $k['var4'] == "-" ? "-" : $k['var4'] ?>" name="val1" <?= $k['var4'] == "-" ? "disabled" : "" ?> required>
               </td>
               <td class="tengah">
                <input style="width: 100px" type="text" class="form-control" placeholder="<?= $k['var5'] == "-" ? "-" : $k['var5'] ?>" name="val1" <?= $k['var5'] == "-" ? "disabled" : "" ?> required>
               </td>
               <td style="width: 100px"><small><?= $k['ket_kegiatan'] == "" ? "<center>-</center>" : $k['ket_kegiatan'] ?></small></td>
              </tr>
             <?php } ?>
          </tbody>
         </table>
         <input type="submit" value="SUBMIT" class="btn btn-lg btn-block btn-primary">
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