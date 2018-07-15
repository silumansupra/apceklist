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
      'h1_title'     => "Data Ceklist",
      'h1_subtitle'  => "",
      'content'      => 'v_list_ceklist',
      'data_ceklist' => $data_ceklist->result_array(),
    );
    $this->load->view('mainview', $data);
   }

   function cetak() {
    $get  = $this->input->get();
    $idl  = $get['id_lokasi'];
    $tgl  = $get['tanggal'];
    $data = array(
      'h1_title'     => "Cetak Ceklist",
      'h1_subtitle'  => "Perangkat",
      'content'      => 'v_print_ceklist',
      'data_ceklist' => $this->m_ceklist->getdata_cetak($tgl, $idl)->result_array(),
      'idl'          => $idl,
      'tgl'          => $tgl,
    );
//    debug($data['data_ceklist']);
    $this->load->view('mainview', $data);
   }

  }
