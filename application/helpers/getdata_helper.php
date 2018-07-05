<?php

  function debug($data) {
   echo "<pre>";
   print_r($data);
   exit;
  }

  function anti_xss($string) {
   $f = stripslashes(strip_tags(htmlspecialchars($string, ENT_QUOTES)));
   return $f;
  }

  function btnBantuan() {
   echo '
    <div class="box-tools pull-right">
       <button type="button" id="btnBantuan" class="btn btn-box-tool" title="Bantuan">
        <i class="fa fa-question-circle-o"></i></button>
      </div>
    ';
  }

  function assets() {
   echo base_url() . "assets/";
  }

  function url_en($input) {
   return strtr(base64_encode($input), '+/=', '._-');
  }

  function url_de($input) {
   return strtr(base64_decode($input), '+/=', '._-');
  }

  function dec($data) {
   $CI = &get_instance();
   return $CI->encrypt->decode($data);
  }

  function enc($data) {
   $CI = &get_instance();
   return $CI->encrypt->encode($data);
  }

  function get_username() {
   $CI = &get_instance();
   return $CI->session->userdata('username');
  }

  function get_level() {
   $CI = &get_instance();
   return $CI->session->userdata('id_level');
  }

  function get_namalengkap() {
   $CI = &get_instance();
   return $CI->session->userdata('nama_lengkap');
  }

  function getnama_hari($val) {
   if ($val == "0") {
    $x = "Minggu";
   } elseif ($val == "1") {
    $x = "Senin";
   } elseif ($val == "2") {
    $x = "Selasa";
   } elseif ($val == "3") {
    $x = "Rabu";
   } elseif ($val == "4") {
    $x = "Kamis";
   } elseif ($val == "5") {
    $x = "Jumat";
   } elseif ($val == "6") {
    $x = "Sabtu";
   }
   return $x;
  }

  function pesan() {
   $CI    = &get_instance();
   $class = $CI->session->flashdata('class');
   $pesan = $CI->session->flashdata('pesan');
   if (isset($pesan)) {
    return '
    <div class="alert ' . $class . ' alert-dismissible" id="pesan_flash">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     ' . $pesan . '
     </div>
    ';
   }
  }
