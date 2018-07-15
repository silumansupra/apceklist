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
      <?= pesan() ?>
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
         -
        </div>
        <div class="col-md-4">
         <?php
           if (isset($id_lokasi)) {
            $total_perangkat    = $this->db->query("SELECT COUNT( id_perangkat ) as totalp FROM tm_perangkat WHERE id_lokasi ='$id_lokasi'")->row()->totalp;
            $total_perangkat_ck = $this->db->query("SELECT id_perangkat FROM tt_ceklist WHERE id_lokasi ='$id_lokasi' AND SUBSTRING(waktu_ceklist,1,10) = '$tanggal' GROUP BY id_perangkat")->num_rows();
            if ($total_perangkat_ck == "0") {
             $persen = "0";
            } else {
             $persen = ($total_perangkat_ck / $total_perangkat) * 100;
            }
            ?>
            <div class="info-box bg-aqua">
             <span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>

             <div class="info-box-content">
              <span class="info-box-text">STATUS CEKLIST <u></u></span>
              <span class="info-box-number">TOTAL: <?= $total_perangkat ?> perangkat</span>
              <div class="progress">
               <div class="progress-bar" style="width: <?= $persen ?>%"></div>
              </div>
              <span class="progress-description">
               <?= round($persen) ?>% ( <b><?= $total_perangkat_ck ?></b> dari <?= $total_perangkat ?> perangkat ).
              </span>
             </div>
             <!-- /.info-box-content -->
            </div>
            <a target="_blank" class="btn btn-info btn-block btn-flat" href="<?= base_url() . "ceklist/cetak?tanggal=" . $tanggal . "&id_lokasi=" . $id_lokasi ?>"><i class="fa fa-print"></i> Print</a>
            <?php
           }
         ?>
        </div>
       </form>
      </div>
      <div class="row">
       <div class="col-md-12">
        <?php if ($data_form !== "0") { ?>
           <h4>DATA PERANGKAT CEKLIST</h4>
           <p>Tanggal : <?= date('d-m-Y') ?></p>
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
              $id_perangkat = $r['id_perangkat'];
              $sql          = "SELECT * FROM tt_ceklist WHERE id_perangkat ='$id_perangkat' AND SUBSTRING(waktu_ceklist,1,10) = '$tanggal'";
              $st_ceklist   = $this->db->query($sql);
              $last_ceklist = empty($st_ceklist->row()->waktu_ceklist) ? "-" : $st_ceklist->row()->waktu_ceklist;
              if ($last_ceklist == "-") {
               $getwkt = "-";
              } else {
               $getwkt = jedaWaktu($last_ceklist);
              }
              ?>
              <tr>
               <th class="nomor"><?= $no++ ?></th>
               <td><?= $r['nama_perangkat'] ?></td>
               <td class="tengah"><?= $getwkt ?></td>
               <td class="tengah"><?= $r['status_perangkat'] == "1" ? "AKTIF" : "NON-AKTIF" ?></td>
               <td class="aksi">
                <?php if ($st_ceklist->num_rows() <= 0) { ?>
                 <a title="Ceklist" href="<?= base_url() . "ceklist/form/perangkat?tanggal=$tanggal&id_lokasi=$id_lokasi&id_perangkat=" . $r['id_perangkat'] ?>" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i> Ceklist</a>
                <?php } else { ?>
                 <a title="Edit" href="<?= base_url() . "ceklist/form/edit?tanggal=$tanggal&id_lokasi=$id_lokasi&id_perangkat=" . $r['id_perangkat'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                <?php } ?>
               </td>
              </tr>
             <?php } ?>
            </tbody>
           </table>
          <?php } else { ?>
           <div class="callout callout-warning disabled">
            <h4><i class="fa fa-exclamation-triangle"></i> Pilih Lokasi Terlebih Dahulu!</h4>
            <p></p>
           </div>
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
  });</script>