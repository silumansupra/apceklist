<?php

  if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
  }

  class Ceklist extends CI_Controller {

   public function __construct() {
    parent::__construct();
    $this->load->model('m_ceklist');
   }

   function index() {
    $data_ceklist = $this->m_ceklist->getdata_ceklists();
    $data         = array(
      'h1_title'     => "Data",
      'h1_subtitle'  => "Ceklist",
      'content'      => 'v_list_ceklist',
      'data_ceklist' => $data_ceklist->result_array(),
    );
    $this->load->view('mainview', $data);
   }

  }
