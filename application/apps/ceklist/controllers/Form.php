<?php

  if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
  }

  class Form extends CI_Controller {

   public function __construct() {
    parent::__construct();
    $this->load->model('m_ceklist');
   }

   function index() {
    $input = $this->input->get();
    if (isset($input['id_lokasi'])) {
     $getdata_form = $this->m_ceklist->getdata_form($input['id_lokasi'])->result_array();
    } else {
     $getdata_form = "0";
    }
    $getdata_lokasi = $this->m_ceklist->getdata_lokasi();
    $data           = array(
      'h1_title'    => "Lokasi",
      'h1_subtitle' => "Ceklist",
      'content'     => 'form/v_index1',
      'data_lokasi' => $getdata_lokasi->result_array(),
      'data_form'   => $getdata_form,
    );

    $this->load->view('mainview', $data);
   }

   function perangkat() {
    $input = $this->input->get();
    $idp   = $input['id_perangkat'];
    $idl   = $input['id_lokasi'];
    $tgl   = $input['tanggal'];
    $data  = array(
      'h1_title'      => "Ceklist",
      'h1_subtitle'   => "Perangkat",
      'content'       => 'form/v_form_perangkat',
      'data_kegiatan' => $this->m_ceklist->getdata_kegiatan($idp)->result_array(),
    );

    $this->load->view('mainview', $data);
   }

  }
