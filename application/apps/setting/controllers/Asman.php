<?php

  if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
  }

  class Asman extends CI_Controller {

   public function __construct() {
    parent::__construct();
    $this->load->model('m_asman');
   }

   function index() {
    $data = array(
      'h1_title'    => "Data Asman",
      'h1_subtitle' => "",
      'content'     => 'asman/v_list_asman',
      'data_asman'  => $this->m_asman->getdata_asman()->result_array(),
    );
    $this->load->view('mainview', $data);
   }

   function edit($id) {
    $data = array(
      'h1_title'    => "Edit Asman",
      'h1_subtitle' => "",
      'content'     => 'asman/form/v_edit_asman',
      'data_asman'  => $this->m_asman->getdata_byid($id),
    );
    $this->load->view('mainview', $data);
   }

   function update() {
    $input = $this->input->post();
    $id    = $input['id_asman'];
    if (isset($input['btnSimpan'])) {
     $data_update = array(
       'nama_asman'   => anti_xss($input['nama_asman']),
       'nik_asman'    => anti_xss($input['nik_asman']),
       'status_asman' => anti_xss($input['status_asman']),
     );
     if (!empty($input)) {
      if ($this->m_asman->update($id, $data_update)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('setting/asman/edit/' . $id, 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('setting/asman/edit/' . $id, 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('setting/asman/edit/' . $id, 'refresh');
     }
    }
   }

   function hapus($id) {
    if ($this->m_asman->hapus($id)) {
     //PESAN ERROR
     $this->session->set_flashdata('pesan', 'Data berhasil dihapus');
     $this->session->set_flashdata('class', 'alert-warning');
     redirect('setting/asman', 'refresh');
    }
   }

   function tambah() {
    $data  = array(
      'h1_title'    => "Tambah Asman",
      'h1_subtitle' => "",
      'content'     => 'asman/form/v_tambah_asman',
    );
    $input = $this->input->post();
    if (isset($input['btnSimpan'])) {
//     debug($input);
     $data_asman = array(
       'nama_asman'   => anti_xss($input['nama_asman']),
       'nik_asman'    => anti_xss($input['nik_asman']),
       'status_asman' => anti_xss($input['status_asman']),
     );
     if (!empty($input)) {
      if ($this->m_asman->insert($data_asman)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('setting/asman', 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('setting/asman', 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong !!');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('setting/asman', 'refresh');
     }
    }
    $this->load->view('mainview', $data);
   }

  }
