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

  function get_userid() {
   $CI = &get_instance();
   return $CI->session->userdata('userid');
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

  function get_nik() {
   $CI = &get_instance();
   return $CI->session->userdata('nik');
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

  function getnama_bulan($val) {
   if ($val == "01") {
    $x = "JANUARI";
   } elseif ($val == "02") {
    $x = "FEBRUARI";
   } elseif ($val == "03") {
    $x = "MARET";
   } elseif ($val == "04") {
    $x = "APRIL";
   } elseif ($val == "05") {
    $x = "MEI";
   } elseif ($val == "06") {
    $x = "JUNI";
   } elseif ($val == "07") {
    $x = "JULI";
   } elseif ($val == "08") {
    $x = "AGUSTUS";
   } elseif ($val == "09") {
    $x = "SEPTEMBER";
   } elseif ($val == "10") {
    $x = "OKTOBER";
   } elseif ($val == "11") {
    $x = "NOVEMBER";
   } elseif ($val == "12") {
    $x = "DESEMBER";
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

  function jedaWaktu($datetime, $full = false) {
   $now  = new DateTime;
   $ago  = new DateTime($datetime);
   $diff = $now->diff($ago);

   $diff->w = floor($diff->d / 7);
   $diff->d -= $diff->w * 7;

   $string = array(
     'y' => 'tahun',
     'm' => 'bulan',
     'w' => 'minggu',
     'd' => 'hari',
     'h' => 'jam',
     'i' => 'menit',
     's' => 'detik',
   );
   foreach ($string as $k => &$v) {
    if ($diff->$k) {
     $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
    } else {
     unset($string[$k]);
    }
   }

   if (!$full)
    $string = array_slice($string, 0, 1);
   return $string ? implode(', ', $string) . ' yg lalu' : 'sekarang';
  }
