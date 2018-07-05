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
       <i class="fa fa-plus"></i> FORM EDIT USER
      </h3>
      <?= btnBantuan() ?>
     </div>
     <div class="box-body">
      <!--CONTENT START-->
      <div class="row">
       <div class="col-md-8">
        <form action="<?php echo base_url() . "setting/user/edit" ?>" method="post">
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">NAMA</label>
           </div>
           <div class="col-md-9">
            <input value="<?= $data_user->nama_lengkap ?>" type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap" class="form-control" required>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">NIK</label>
           </div>
           <div class="col-md-9">
            <input value="<?= $data_user->nik_user ?>" name="nik_user" id="nik_user" placeholder="Nomor Induk Karyawan" type="text" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">USERNAME</label>
           </div>
           <div class="col-md-9">
            <input value="<?= $data_user->username ?>" name="username" id="username" placeholder="Username" type="text" class="form-control">
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">PASSWORD</label>
           </div>
           <div class="col-md-9">
            <input readonly="" name="password" id="password" placeholder="Kosongi jika tidak dirubah" type="password" class="form-control" onkeyup="CheckPasswordStrength();" >
            <p class="text-muted" id="cekstr"></p>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <div class="col-md-3">
            <label class="control-label">PASSWORD (KONFIRMASI)</label>
           </div>
           <div class="col-md-9">
            <input name="password2" id="password2" placeholder="Konfirmasi password" type="password" class="form-control" onChange="checkPasswordMatch();" >
            <p class="text-muted" id="cekmsg"></p>
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
                <option <?= $data_user->id_jabatan == $r['id_jabatan'] ? "selected" : "" ?> value="<?= $r['id_jabatan'] ?>"><?= $r['nama_jabatan'] ?></option>
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
                <option <?= $data_user->id_level == $r['id_level'] ? "selected" : "" ?> value="<?= $r['id_level'] ?>"><?= $r['nama_level'] ?></option>
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
             <option <?= $data_user->status_user == "1" ? "selected" : "" ?> value="1" selected=""> AKTIF</option>
             <option <?= $data_user->status_user == "0" ? "selected" : "" ?> value="0"> NON-AKTIF</option>
            </select>
           </div>
          </div>
         </div>
         <div class="form-group">
          <div class="row">
           <!--button-->
           <div class="col-md-12 text-right">
            <a href="<?= base_url() . "setting/user" ?>" class="btn btn-warning">Kembali</a>
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
 <script>
  function checkPasswordMatch() {
   var password = $("#password").val();
   var confirmPassword = $("#password2").val();

   if (password != confirmPassword)
    $("#cekmsg").html("<text class='text-danger'><strong>Password not match!</strong></text>");
   else
    $("#cekmsg").html("<text class='text-success'><strong>OK.</strong></text>");
  }

  $(document).ready(function () {
   $("#password, #password2").keyup(checkPasswordMatch);
  });

  function CheckPasswordStrength() {
   var password_cek = $("#password").val();
   var password_strength = document.getElementById("cekstr");
   //if textBox is empty
   if (password_cek.length == 0) {
    password_strength.innerHTML = "";
    return;
   }
   //Regular Expressions
   var regex = new Array();
   regex.push("[A-Z]"); //For Uppercase Alphabet
   regex.push("[a-z]"); //For Lowercase Alphabet
   regex.push("[0-9]"); //For Numeric Digits
   regex.push("[$@$!%*#?&]"); //For Special Characters

   var passed = 0;

   //Validation for each Regular Expression
   for (var i = 0; i < regex.length; i++) {
    if ((new RegExp(regex[i])).test(password_cek)) {
     passed++;
    }
   }

   //Validation for Length of Password
   if (passed > 2 && password_cek.length > 8) {
    passed++;
   }

   //Display of Status
   var color = "";
   var passwordStrength = "";
   switch (passed) {
    case 0:
     break;
    case 1:
     passwordStrength = "Password is Weak.";
     color = "Red";
     break;
    case 2:
     passwordStrength = "Password is Good.";
     color = "darkorange";
     break;
    case 3:
     break;
    case 4:
     passwordStrength = "Password is Strong.";
     color = "Green";
     break;
    case 5:
     passwordStrength = "Password is Very Strong.";
     color = "darkgreen";
     break;
   }
   password_strength.innerHTML = passwordStrength;
   password_strength.style.color = color;
  }

 </script>