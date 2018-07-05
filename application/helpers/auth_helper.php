<?php

  function cek_session() {
   $CI      = &get_instance();
   $session = $CI->session->userdata('status');
   if ($session != 'OK') {
    redirect('auth/login');
   }
  }

  function cek_session_login() {
   $CI     = &get_instance();
   $status = $CI->session->userdata('status');
   $level  = $CI->session->userdata('id_level');

   if (($status == 'OK') && ($level == "1")) {
    redirect('dashboard/admin');
   } elseif (($status == 'OK') && ($level == "2")) {
    redirect('dashboard/karyawan');
   }
  }

  function admin_area() {
   $CI    = &get_instance();
   $level = $CI->session->userdata('id_level');
   if ($level != "1") {
    redirect('error/forbidden');
   }
  }
