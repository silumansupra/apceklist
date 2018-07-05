<?php

  if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
  }

  class Auth extends CI_Controller {

   public function __construct() {
    parent::__construct();
    $this->load->model('m_auth');
   }

   function index() {
    redirect('auth/login');
   }

   function login() {
    cek_session_login();
    $data  = array(
      'login_url' => "login",
    );
    $input = $this->input->post();
    if (isset($input['btnLogin'])) {
//     debug($input);
     if (empty($input['username']) || empty($input['password'])) {
      $this->session->set_flashdata('pesan', 'Username/Password tidak boleh kosong !!');
      redirect("auth/login", "refresh");
     } else {
      $username  = $this->input->post('username');
      $password  = $this->input->post('password');
      $cek_data  = $this->m_auth->cekdata(anti_xss($username, TRUE), anti_xss($password, TRUE));
      $data_fail = array(
        'waktu'      => date('Y-m-d H:i:s'),
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        'username'   => anti_xss($username, TRUE),
        'password'   => anti_xss($password, TRUE),
      );
//      debug($cek_data);
      if ($cek_data === "0") {
       //password_salah
       $this->session->set_flashdata('pesan', 'Password salah, Ulangi !!');
       $this->session->set_flashdata('class', 'text-danger');
       $this->m_auth->insert_fail_login($data_fail);
       redirect("auth/login", "refresh");
      } elseif ($cek_data === "NULL") {
       //no_username/idpeg
       $this->session->set_flashdata('pesan', 'Username belum terdaftar !!');
       $this->session->set_flashdata('class', 'text-danger');
       $this->m_auth->insert_fail_login($data_fail);
       redirect("auth/login", "refresh");
      } else {
       $this->session->set_userdata
         (array(
         'log_id'       => $cek_data->userid . "_" . time(),
         'status'       => 'OK',
         'userid'       => $cek_data->userid,
         'username'     => $cek_data->username,
         'nama_lengkap' => $cek_data->nama_lengkap,
         'id_level'     => $cek_data->id_level,
       ));
       $data_login = array(
         'log_id'     => $this->session->userdata('log_id'),
         'userid'     => $this->session->userdata('userid'),
         'ip_address' => $_SERVER['REMOTE_ADDR'],
         'user_agent' => $_SERVER['HTTP_USER_AGENT'],
         'login'      => date('Y-m-d H:i:s'),
         'logout'     => "0",
         'status'     => "1",
       );
       //debug($data_login);
       $this->db->query("UPDATE tm_user SET logged = '1' WHERE userid ='$cek_data->userid'");
       $this->m_auth->insert_logid($data_login);
       cek_session_login();
      }
     }
    }
//    $this->session->set_flashdata('pesan', 'Masukkan IDPEG/USERNAME dan PASSWORD!');
//    $this->session->set_flashdata('class', 'text-info');
    $this->load->view('auth/v_login', $data);
   }

   function logout() {
    $waktu       = date('Y-m-d H:i:s');
    $log_id      = $this->session->userdata('log_id');
    $userid      = $this->session->userdata('userid');
    $data_logout = array(
      'logout' => $waktu,
      'status' => "0",
    );
    //debug($data_logout);
    $this->db->query("UPDATE tm_user SET logged = '0' WHERE userid ='$userid'");
    $this->m_auth->update_logid($log_id, $data_logout);
    $this->session->sess_destroy();
    $this->session->set_flashdata('pesan', 'Anda telah Logout !!');
    $this->session->set_flashdata('class', 'text-warning');
    redirect('auth/login', 'refresh');
   }

  }
