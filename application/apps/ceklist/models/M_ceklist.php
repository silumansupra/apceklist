<?php

  class M_ceklist extends CI_Model {

   public function __construct() {
    parent::__construct();
   }

   function getdata_ceklists() {
    $this->db->join('tm_lokasi b', 'b.id_lokasi=a.id_lokasi', 'inner');
    $this->db->group_by('SUBSTRING(waktu_ceklist,1,10)', 'ASC');
    $data = $this->db->get('tt_ceklist a');
    return $data;
   }

   function getdata_lokasi() {
    return $this->db->get('tm_lokasi');
   }

   function getdata_form($id) {
    $this->db->where('id_lokasi', $id);
    $get = $this->db->get('tm_perangkat');
    return $get;
   }

   function getdata_kegiatan($idp) {
    $this->db->where('id_perangkat', $idp);
    $get = $this->db->get('tm_kegiatan');
    return $get;
   }

   function getdata_ceklist($idp, $idl) {
    $this->db->where('id_perangkat', $idp);
    $this->db->where('id_lokasi', $idl);
    $get = $this->db->get('tt_ceklist');
    return $get;
   }

   function getdata_cetak($tgl, $idl) {
    $this->db->where('SUBSTRING(waktu_ceklist,1,10)', $tgl);
    $this->db->where('id_lokasi', $idl);
    $get = $this->db->get('tt_ceklist');
    return $get;
   }

   function insert_ceklist($dataceklist) {
    $query = $this->db->insert('tt_ceklist', $dataceklist);
    if ($query) {
     return true;
    } else {
     return false;
    }
   }

   function update_ceklist($update, $idk, $idl, $idp, $tgl) {
    $this->db->where('id_lokasi', $idl);
    $this->db->where('id_perangkat', $idp);
    $this->db->where('id_kegiatan', $idk);
    $this->db->where('SUBSTRING(waktu_ceklist,1,10)', $tgl);
    $query = $this->db->update('tt_ceklist', $update);
    if ($query) {
     return true;
    } else {
     return false;
    }
   }

  }
