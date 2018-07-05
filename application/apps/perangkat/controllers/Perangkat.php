<?php

  if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
  }

  class Perangkat extends CI_Controller {

   public function __construct() {
    parent::__construct();
    $this->load->model('m_perangkat');
   }

   function index() {
    $data = array(
      'h1_title'    => "Data",
      'h1_subtitle' => "Perangkat",
      'content'     => 'v_list_perangkat',
    );
    $this->load->view('mainview', $data);
   }

  }
