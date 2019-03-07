<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->library('calendar');
//    $this->load->model('m_dashboard');
 }

 function index() {
  cek_session_login();
 }

 function admin() {
  $data = array(
      'h1_title'    => "Dashboard Administrator",
      'h1_subtitle' => "",
      'content'     => 'vdash_admin',
  );
  $this->load->view('mainview', $data);
 }

}
