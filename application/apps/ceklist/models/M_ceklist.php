<?php

  class M_ceklist extends CI_Model {

   public function __construct() {
    parent::__construct();
   }

   function getdata_lokasi() {
    $data = $this->db->get('tm_lokasi a');
    return $data;
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

  }
