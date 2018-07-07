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
    $get_data_perangkat = $this->m_perangkat->getdata_perangkat();
    $data               = array(
      'h1_title'       => "Data",
      'h1_subtitle'    => "Perangkat",
      'content'        => 'v_list_perangkat',
      'data_perangkat' => $get_data_perangkat->result_array(),
    );
    $this->load->view('mainview', $data);
   }

   function setup() {
    $data  = array(
      'h1_title'    => "Setup",
      'h1_subtitle' => "Perangkat",
      'content'     => 'form/v_setup_perangkat',
    );
    $input = $this->input->post();
    if (isset($input['btnSimpan'])) {
     $data_setup = array(
       'id_lokasi'        => anti_xss($input['id_lokasi']),
       'nama_perangkat'   => anti_xss($input['nama_perangkat']),
       'ket_perangkat'    => anti_xss($input['ket_perangkat']),
       'status_perangkat' => anti_xss($input['status_perangkat']),
       'status_setup'     => "0",
     );
//     debug($data_setup);
     if (!empty($input)) {
      if ($this->m_perangkat->insert($data_setup)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('perangkat', 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('perangkat', 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong !!');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('perangkat', 'refresh');
     }
    }
    $this->load->view('mainview', $data);
   }

   function edit($id) {
    $data = array(
      'h1_title'       => "Edit Data",
      'h1_subtitle'    => "Perangkat",
      'content'        => 'form/v_edit_perangkat',
      'data_perangkat' => $this->m_perangkat->getdata_byid($id)->row(),
      'data_kegiatan'  => $this->m_perangkat->getdata_keg_byid($id)->result_array(),
    );
    $this->load->view('mainview', $data);
   }

   function update() {
    $input = $this->input->post();
    $id    = $input['id_perangkat'];
    if (isset($input['btnSimpan'])) {
     $data_update = array(
       'id_lokasi'        => anti_xss($input['id_lokasi']),
       'nama_perangkat'   => anti_xss($input['nama_perangkat']),
       'ket_perangkat'    => anti_xss($input['ket_perangkat']),
       'status_perangkat' => anti_xss($input['status_perangkat']),
     );
     if (!empty($input)) {
      if ($this->m_perangkat->update($id, $data_update)) {
       //PESAN BERHASIL
       $this->session->set_flashdata('pesan', 'Data berhasil diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-info');
       redirect('perangkat/edit/' . $id, 'refresh');
      } else {
       //PESAN ERROR
       $this->session->set_flashdata('pesan', 'Data gagal diupdate ke dalam database');
       $this->session->set_flashdata('class', 'alert-danger');
       redirect('perangkat/edit/' . $id, 'refresh');
      }
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data tidak boleh kosong');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('perangkat/edit/' . $id, 'refresh');
     }
    } elseif (isset($input['btnSimpanKegiatan'])) {
     $isi           = "-";
     $id_perangkat  = $input['id_perangkat'];
     $data_kegiatan = array(
       'id_perangkat'    => anti_xss($input['id_perangkat']),
       'nama_kegiatan'   => anti_xss($input['nama_kegiatan']),
       'tolak_ukur'      => anti_xss($input['tolak_ukur']),
       'ket_kegiatan'    => anti_xss($input['ket_kegiatan']),
       'var1'            => anti_xss($input['var1']),
       'var2'            => $input['var2'] == '' ? $isi : anti_xss($input['var2']),
       'var3'            => $input['var3'] == '' ? $isi : anti_xss($input['var3']),
       'var4'            => $input['var4'] == '' ? $isi : anti_xss($input['var4']),
       'var5'            => $input['var5'] == '' ? $isi : anti_xss($input['var5']),
       'status_kegiatan' => anti_xss($input['status_kegiatan']),
     );
//     debug($data_kegiatan);
     if ($this->m_perangkat->insert_kegiatan($data_kegiatan)) {
      //PESAN BERHASIL
      $this->db->query("UPDATE tm_perangkat SET status_setup = '1' WHERE id_perangkat = '$id_perangkat'");
      $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
      $this->session->set_flashdata('class', 'alert-info');
      redirect('perangkat/edit/' . $id_perangkat, 'refresh');
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('perangkat/edit/' . $id_perangkat, 'refresh');
     }
    } elseif (isset($input['btnUpdateKegiatan'])) {
     $isi          = "-";
     $id_perangkat = $input['id_perangkat'];
     $data_update  = array(
       'nama_kegiatan'   => anti_xss($input['nama_kegiatan']),
       'tolak_ukur'      => anti_xss($input['tolak_ukur']),
       'ket_kegiatan'    => anti_xss($input['ket_kegiatan']),
       'var1'            => anti_xss($input['var1']),
       'var2'            => $input['var2'] == '' ? $isi : anti_xss($input['var2']),
       'var3'            => $input['var3'] == '' ? $isi : anti_xss($input['var3']),
       'var4'            => $input['var4'] == '' ? $isi : anti_xss($input['var4']),
       'var5'            => $input['var5'] == '' ? $isi : anti_xss($input['var5']),
       'status_kegiatan' => anti_xss($input['status_kegiatan']),
     );
     if ($this->m_perangkat->update_kegiatan($id, $data_update)) {
      //PESAN BERHASIL
      $this->session->set_flashdata('pesan', 'Data berhasil dimasukkan ke dalam database');
      $this->session->set_flashdata('class', 'alert-info');
      redirect('perangkat/edit/' . $id_perangkat, 'refresh');
     } else {
      //PESAN ERROR
      $this->session->set_flashdata('pesan', 'Data gagal dimasukkan ke dalam database !!');
      $this->session->set_flashdata('class', 'alert-danger');
      redirect('perangkat/edit/' . $id_perangkat, 'refresh');
     }
    }
   }

   function hapus_kegiatan() {
    $id_keg = $this->uri->segment(3);
    $id_per = $this->uri->segment(4);
    if ($this->m_perangkat->hapus_kegiatan($id_keg)) {
     //PESAN ERROR
     $this->session->set_flashdata('pesan', 'Data berhasil dihapus');
     $this->session->set_flashdata('class', 'alert-warning');
     redirect('perangkat/edit/' . $id_per, 'refresh');
    }
   }

   function getDataKegiatan($id_kegiatan) {
    return $this->db->get_where('tm_kegiatan', array('id_kegiatan', $id_kegiatan))->row();
   }

   function hapus_perangkat($id) {
    if ($this->m_perangkat->hapus_perangkat($id)) {
     //PESAN ERROR
     $this->session->set_flashdata('pesan', 'Data berhasil dihapus');
     $this->session->set_flashdata('class', 'alert-warning');
     redirect('perangkat', 'refresh');
    }
   }

  }
