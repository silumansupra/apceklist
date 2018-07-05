<?php

  if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
  }

  class Lokasi extends CI_Controller {

   public function __construct() {
    parent::__construct();
    $this->load->model('m_lokasi');
   }

   function index() {
    $data = array(
      'h1_title'    => "Data",
      'h1_subtitle' => "Lokasi",
      'content'     => 'v_list_lokasi',
      'data_lokasi' => $this->m_lokasi->getdata_lokasi()->result_array(),
    );
    $this->load->view('mainview', $data);
   }

   function edit($id) {
    $data = array(
      'h1_title'    => "Edit Data",
      'h1_subtitle' => "Lokasi",
      'content'     => 'form/v_edit_lokasi',
      'data_lokasi' => $this->m_lokasi->getdata_byid($id),
    );
    $this->load->view('mainview', $data);
   }

   function update() {
    $input = $this->input->post();
    $id    = $input['id_lokasi'];
    if (isset($input['btnSimpan'])) {
     $data_update = array(
       'nama_lokasi'   => anti_xss($input['nama_lokasi']),
       'ket_lokasi'    => anti_xss($input['ket_lokasi']),
       'status_lokasi' => anti_xss($input['status_lokasi']),
     );
     if (!empty($input)) {
      if ($this->m_lokasi->update($id, $data_update)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('lokasi/edit/' . $id, 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('lokasi/edit/' . $id, 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('lokasi/edit/' . $id, 'refresh');
     }
    }
   }

   function hapus($id) {
    if ($this->m_lokasi->hapus($id)) {
     //PESAN ERROR
     $this->session->set_flashdata('pesan', 'Data berhasil dihapus');
     $this->session->set_flashdata('class', 'alert-warning');
     redirect('lokasi', 'refresh');
    }
   }

   function tambah() {
    $data  = array(
      'h1_title'    => "Tambah Data",
      'h1_subtitle' => "Lokasi",
      'content'     => 'form/v_tambah_lokasi',
    );
    $input = $this->input->post();
    if (isset($input['btnSimpan'])) {
//     debug($input);
     $data_lokasi = array(
       'nama_lokasi'   => anti_xss($input['nama_lokasi']),
       'ket_lokasi'    => anti_xss($input['ket_lokasi']),
       'status_lokasi' => anti_xss($input['status_lokasi']),
     );
     if (!empty($input)) {
      if ($this->m_lokasi->insert($data_lokasi)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('lokasi', 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('lokasi/tambah', 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong !!');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('lokasi/tambah', 'refresh');
     }
    }
    $this->load->view('mainview', $data);
   }

  }
