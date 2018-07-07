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
       <i class="fa fa-edit"></i> EDIT PERANGKAT
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <?= pesan() ?>
      <!--CONTENT START-->
      <div class="row">
       <div class="col-md-4">
        <h4>Data Perangkat</h4>
        <div class="ln_solid"></div>
        <form action="<?php echo base_url() . "perangkat/update" ?>" method="post">
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">LOKASI</label>
           </div>
           <div class="col-md-9">
            <select name="id_lokasi" class="form-control">
             <?php
               $datalokasi = $this->db->get('tm_lokasi')->result_array();
               foreach ($datalokasi as $r) {
                ?>
                <option <?= $data_perangkat->id_lokasi == $r['id_lokasi'] ? "selected" : "" ?> value="<?= $r['id_lokasi'] ?>"><?= $r['nama_lokasi'] ?></option>
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
            <input value="<?= $data_perangkat->nama_perangkat ?>" type="text" name="nama_perangkat" id="nama_perangkat" placeholder="Nama perangkat" class="form-control" required>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">KETERANGAN</label>
           </div>
           <div class="col-md-9">
            <textarea name="ket_perangkat" id="ket_perangkat" placeholder="Ketereangan tambahan..." class="form-control" rows="3"><?= $data_perangkat->ket_perangkat ?></textarea>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">STATUS</label>
           </div>
           <div class="col-md-9">
            <select name="status_perangkat" id="status_user" class="form-control">
             <option <?= $data_perangkat->status_perangkat == "1" ? "selected" : "" ?> value="1" selected=""> AKTIF</option>
             <option <?= $data_perangkat->status_perangkat == "0" ? "selected" : "" ?> value="0"> NON-AKTIF</option>
            </select>
           </div>
          </div>
         </div>

         <div class="form-group">
          <div class="row">
           <!--button-->
           <div class="col-md-12 text-right">
            <input type="hidden" name="id_perangkat" value="<?= $data_perangkat->id_perangkat ?>" >
            <a href="<?= base_url() . "perangkat" ?>" class="btn btn-warning">Kembali</a>
            <input type="submit" value="Simpan Data" class="btn btn-primary" name="btnSimpan">
           </div>
          </div>
         </div>
        </form>
       </div>
       <div class="col-md-8">
        <h4>Data Kegiatan Pengukuran & Variabel
         <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#myModalSimpanKegiatan"><i class="fa fa-plus-circle"></i> Tambah Data</button>
        </h4>
        <div class="ln_solid"></div>
        <table class="table table-bordered">
         <thead>
          <tr>
           <th>#</th>
           <th>Kegiatan</th>
           <th>TU</th>
           <th>V1</th>
           <th>V2</th>
           <th>V3</th>
           <th>V4</th>
           <th>V5</th>
           <th>Aksi</th>
          </tr>
         </thead>
         <tbody>
          <?php
            $no    = 1;
            $dakeg = $this->db->get_where('tm_kegiatan', array('id_perangkat' => $data_perangkat->id_perangkat))->result_array();
            foreach ($dakeg as $r) {
             $status_keg = $r['status_kegiatan'];
             ?>
             <tr>
              <td class="nomor"><?= $no++ ?></td>
              <td>
               <?= $r['nama_kegiatan'] ?>
               <?= $status_keg == "1" ? "<i class='fa fa-check text-success'></i>" : "<i class='fa fa-times text-danger'></i>" ?>
              </td>
              <td class="tengah"><?= $r['tolak_ukur'] ?></td>
              <td class="tengah"><?= $r['var1'] ?></td>
              <td class="tengah"><?= $r['var2'] ?></td>
              <td class="tengah"><?= $r['var3'] ?></td>
              <td class="tengah"><?= $r['var4'] ?></td>
              <td class="tengah"><?= $r['var5'] ?></td>
              <td class="tengah">
               <!--               <a id="btnEditKegiatan"
                                 data-toggle="modal"
                                 data-target="#myModalEditKegiatan<?= $r['id_kegiatan'] ?>"
                                 title="Edit" href="#" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i>
                              </a>-->
               <a title="Hapus" href="<?= base_url() . "perangkat/hapus_kegiatan/" . $r['id_kegiatan'] . "/" . $r['id_perangkat'] ?>" onclick="confirm('Apakah Anda akan menghapus kegiatan ini?')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
              </td>
             </tr>
             <!-- Modal Edit Kegiatan -->
            <div id="myModalEditKegiatan<?= $r['id_kegiatan'] ?>" class="modal fade" role="dialog">
             <form id="fUpdateKegiatan" action="<?= base_url() . "perangkat/update" ?>" method="post">
              <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Edit Data Kegiatan</h4>
                </div>
                <div class="modal-body">
                 <div class="row">
                  <div class="col-md-12">
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">NAMA KEGIATAN</label>
                     </div>
                     <div class="col-md-9">
                      <input type="text" value="<?= $r['nama_kegiatan'] ?>" name="nama_kegiatan" id="eNamaKegiatan" placeholder="Nama kegiatan" class="form-control" required>
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">TOLAK UKUR</label>
                     </div>
                     <div class="col-md-9">
                      <input type="text" value="<?= $r['tolak_ukur'] ?>" name="tolak_ukur" id="nama_kegiatan" placeholder="Nama kegiatan" class="form-control" required>
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">VAR #1</label>
                     </div>
                     <div class="col-md-9">
                      <input type="text" value="<?= $r['var1'] ?>" name="var1" id="var1" placeholder="Variabel ceklist #1" class="form-control" required>
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">VAR #2</label>
                     </div>
                     <div class="col-md-9">
                      <input type="text" value="<?= $r['var2'] ?>" name="var2" id="var2" placeholder="Variabel ceklist #2" class="form-control">
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">VAR #3</label>
                     </div>
                     <div class="col-md-9">
                      <input type="text" value="<?= $r['var3'] ?>" name="var3" id="var3" placeholder="Variabel ceklist #3" class="form-control">
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">VAR #4</label>
                     </div>
                     <div class="col-md-9">
                      <input type="text" value="<?= $r['var4'] ?>" name="var4" id="var4" placeholder="Variabel ceklist #4" class="form-control">
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">VAR #5</label>
                     </div>
                     <div class="col-md-9">
                      <input type="text" value="<?= $r['var5'] ?>" name="var5" id="var5" placeholder="Variabel ceklist #5" class="form-control">
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">KETERANGAN</label>
                     </div>
                     <div class="col-md-9">
                      <textarea name="ket_kegiatan" id="ket_kegiatan" placeholder="Ketereangan kegiatan..." class="form-control" rows="3"><?= $r['ket_kegiatan'] ?></textarea>
                     </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <div class="row">
                     <div class="col-md-3">
                      <label class="control-label">STATUS</label>
                     </div>
                     <div class="col-md-9">
                      <select name="status_kegiatan" id="status_kegiatan" class="form-control">
                       <option <?= $r['status_kegiatan'] == "1" ? "selected" : "" ?> value="1" selected=""> AKTIF</option>
                       <option <?= $r['status_kegiatan'] == "0" ? "selected" : "" ?> value="0"> NON-AKTIF</option>
                      </select>
                     </div>
                    </div>
                   </div>
                  </div>
                 </div>
                </div>
                <div class="modal-footer">
                 <input type="hidden" name="id_perangkat" value="<?= $data_perangkat->id_perangkat ?>" >
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <input type="submit" name="btnUpdateKegiatan" class="btn btn-primary" value="Update Data">
                </div>
               </div>
              </div>
             </form>
            </div>
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
  <!-- Modal Tambah Kegiatan -->
  <div id="myModalSimpanKegiatan" class="modal fade" role="dialog">
   <form id="fSimpanKegiatan" action="<?= base_url() . "perangkat/update" ?>" method="post">
    <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Tambah Data Kegiatan</h4>
      </div>
      <div class="modal-body">
       <div class="row">
        <div class="col-md-12">
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">NAMA KEGIATAN</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="nama_kegiatan" placeholder="Nama kegiatan" class="form-control" required>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">TOLAK UKUR</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="tolak_ukur" placeholder="Nama kegiatan" class="form-control" required>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">VAR #1</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="var1" placeholder="Variabel ceklist #1" class="form-control" required>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">VAR #2</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="var2" placeholder="Variabel ceklist #2" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">VAR #3</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="var3" placeholder="Variabel ceklist #3" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">VAR #4</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="var4" placeholder="Variabel ceklist #4" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">VAR #5</label>
           </div>
           <div class="col-md-9">
            <input type="text" name="var5" placeholder="Variabel ceklist #5" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">KETERANGAN</label>
           </div>
           <div class="col-md-9">
            <textarea name="ket_kegiatan" placeholder="Ketereangan kegiatan..." class="form-control" rows="3"></textarea>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">STATUS</label>
           </div>
           <div class="col-md-9">
            <select name="status_kegiatan" class="form-control">
             <option value="1" selected=""> AKTIF</option>
             <option value="0"> NON-AKTIF</option>
            </select>
           </div>
          </div>
         </div>
        </div>
       </div>

      </div>
      <div class="modal-footer">
       <input type="hidden" name="id_perangkat" value="<?= $data_perangkat->id_perangkat ?>" >
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <input type="submit" name="btnSimpanKegiatan" class="btn btn-primary" value="Simpan Data">
      </div>
     </div>
    </div>
   </form>
  </div>
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