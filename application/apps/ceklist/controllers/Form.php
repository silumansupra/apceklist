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
    $data_lokasi = $this->m_ceklist->getdata_lokasi();
    $data        = array(
      'h1_title'    => "Form Ceklist",
      'h1_subtitle' => "",
      'content'     => 'form/v_index1',
      'data_lokasi' => $data_lokasi->result_array(),
      'data_form'   => $getdata_form,
    );

    $this->load->view('mainview', $data);
   }

   function perangkat() {
    $get  = $this->input->get();
    $idp  = $get['id_perangkat'];
    $idl  = $get['id_lokasi'];
    $tgl  = $get['tanggal'];
    $data = array(
      'h1_title'      => "Form Ceklist",
      'h1_subtitle'   => "",
      'content'       => 'form/v_form_perangkat',
      'data_kegiatan' => $this->m_ceklist->getdata_kegiatan($idp)->result_array(),
    );

    $this->load->view('mainview', $data);
   }

   function edit() {
    $get  = $this->input->get();
    $idp  = $get['id_perangkat'];
    $idl  = $get['id_lokasi'];
    $tgl  = $get['tanggal'];
    $data = array(
      'h1_title'      => "Ceklist",
      'h1_subtitle'   => "Perangkat",
      'content'       => 'form/v_form_edit',
      'data_kegiatan' => $this->m_ceklist->getdata_kegiatan($idp)->result_array(),
    );
    $this->load->view('mainview', $data);
   }

   function simpan() {
    $input   = $this->input->post();
    $idp     = $input['id_perangkat'];
    $idl     = $input['id_lokasi'];
    $tgl     = $input['tanggal'];
    $get_idk = $this->db->query("SELECT id_kegiatan FROM tm_kegiatan WHERE id_perangkat = '$idp'")->result_array();
    if (isset($input['btnSubmit'])) {
//     debug($input);
     foreach ($get_idk as $r) {
      $idk     = $r['id_kegiatan'];
      $val1    = $input[$idk . "_val1"];
      $val2    = $input[$idk . "_val2"];
      $val3    = $input[$idk . "_val3"];
      $val4    = $input[$idk . "_val4"];
      $val5    = $input[$idk . "_val5"];
      $datakeg = array(
        'id_kegiatan'     => $idk,
        'id_lokasi'       => $idl,
        'id_perangkat'    => $idp,
        'petugas_ceklist' => get_userid(),
        'status_ceklist'  => '1',
        'waktu_ceklist'   => date('Y-m-d H:i:s'),
        'thn'             => date('Y'),
        'bln'             => date('m'),
        'tgl'             => date('d'),
        'val1'            => $val1,
        'val2'            => $val2 == '' ? '-' : $val2,
        'val3'            => $val3 == '' ? '-' : $val3,
        'val4'            => $val4 == '' ? '-' : $val4,
        'val5'            => $val5 == '' ? '-' : $val5,
      );
      $insert  = $this->m_ceklist->insert_ceklist($datakeg);
      if ($insert) {
       $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
      } else {
       $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
       $this->session->set_flashdata('class', 'alert-danger');
      }
     }
     redirect('ceklist/form?tanggal=' . $tgl . "&id_lokasi=" . $idl, 'refresh');
    }
   }

   function update() {
    $input   = $this->input->post();
    $idp     = $input['id_perangkat'];
    $idl     = $input['id_lokasi'];
    $tgl     = $input['tanggal'];
    $get_idk = $this->db->query("SELECT id_kegiatan FROM tm_kegiatan WHERE id_perangkat = '$idp'")->result_array();
    if (isset($input['btnSubmit'])) {
//     debug($input);
     foreach ($get_idk as $r) {
      $idk    = $r['id_kegiatan'];
      $val1   = $input[$idk . "_val1"];
      $val2   = $input[$idk . "_val2"];
      $val3   = $input[$idk . "_val3"];
      $val4   = $input[$idk . "_val4"];
      $val5   = $input[$idk . "_val5"];
      $update = array(
        'id_kegiatan'     => $idk,
        'id_lokasi'       => $idl,
        'id_perangkat'    => $idp,
        'petugas_ceklist' => get_userid(),
        'status_ceklist'  => '1',
        'waktu_ceklist'   => date('Y-m-d H:i:s'),
        'val1'            => $val1,
        'val2'            => $val2 == '' ? '-' : $val2,
        'val3'            => $val3 == '' ? '-' : $val3,
        'val4'            => $val4 == '' ? '-' : $val4,
        'val5'            => $val5 == '' ? '-' : $val5,
      );
      $insert = $this->m_ceklist->update_ceklist($update, $idk, $idl, $idp, $tgl);
      if ($insert) {
       $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
      } else {
       $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
       $this->session->set_flashdata('class', 'alert-danger');
      }
     }
     redirect('ceklist/form?tanggal=' . $tgl . "&id_lokasi=" . $idl, 'refresh');
    }
   }

  }
