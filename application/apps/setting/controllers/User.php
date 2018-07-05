<?php

  if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
  }

  class User extends CI_Controller {

   public function __construct() {
    parent::__construct();
    $this->load->model('m_user');
   }

   function index() {
    $data = array(
      'h1_title'    => "Data",
      'h1_subtitle' => "User",
      'content'     => 'user/v_list_user',
      'data_user'   => $this->m_user->getdata_user()->result_array(),
    );
    $this->load->view('mainview', $data);
   }

   function edit($id) {
    $data = array(
      'h1_title'    => "Edit Data",
      'h1_subtitle' => "User",
      'content'     => 'user/form/v_edit_user',
      'data_user'   => $this->m_user->getdata_byid($id),
    );
    $this->load->view('mainview', $data);
   }

   function update() {
    $input = $this->input->post();
    $id    = $input['userid'];
    if (isset($input['btnSimpan'])) {
     $data_update = array(
       'id_jabatan'   => anti_xss($input['id_jabatan']),
       'id_level'     => anti_xss($input['id_level']),
       'username'     => anti_xss($input['username']),
       'password'     => anti_xss($input['password']),
       'nama_lengkap' => anti_xss($input['nama_lengkap']),
       'nik'          => anti_xss($input['nik']),
       'status_user'  => anti_xss($input['status_user']),
     );
     if (!empty($input)) {
      if ($this->m_user->update($id, $data_update)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('setting/user/edit/' . $id, 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('setting/user/edit/' . $id, 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('setting/user/edit/' . $id, 'refresh');
     }
    }
   }

   function hapus($id) {
    if ($this->m_user->hapus($id)) {
     //PESAN ERROR
     $this->session->set_flashdata('pesan', 'Data berhasil dihapus');
     $this->session->set_flashdata('class', 'alert-warning');
     redirect('setting/user', 'refresh');
    }
   }

   function tambah() {
    $data  = array(
      'h1_title'    => "Tambah Data",
      'h1_subtitle' => "User",
      'content'     => 'user/form/v_tambah_user',
    );
    $input = $this->input->post();
    if (isset($input['btnSimpan'])) {

     $data_user = array(
       'id_jabatan'   => anti_xss($input['id_jabatan']),
       'id_level'     => anti_xss($input['id_level']),
       'username'     => anti_xss($input['username']),
       'password'     => enc(anti_xss($input['password'])),
       'nama_lengkap' => anti_xss($input['nama_lengkap']),
       'nik_user'     => anti_xss($input['nik_user']),
       'status_user'  => anti_xss($input['status_user']),
     );
//     debug($data_user);
     if (!empty($input)) {
      if ($this->m_user->insert($data_user)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('setting/user', 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('setting/user', 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong !!');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('setting/user', 'refresh');
     }
    }
    $this->load->view('mainview', $data);
   }

  }
