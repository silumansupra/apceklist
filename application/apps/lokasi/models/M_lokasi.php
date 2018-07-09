<?php

  class M_lokasi extends CI_Model {

   public function __construct() {
    parent::__construct();
   }

   function getdata_lokasi() {
    $this->db->join('tm_asman b', 'b.id_asman = a.id_asman', 'left');
    return $this->db->get('tm_lokasi a');
   }

   function insert($data_lokasi) {
    return $this->db->insert('tm_lokasi', $data_lokasi);
   }

   function getdata_byid($id) {
    $this->db->where('id_lokasi', $id);
    return $this->db->get('tm_lokasi')->row();
   }

   function update($id, $data_update) {
    $this->db->where('id_lokasi', $id);
    return $this->db->update('tm_lokasi', $data_update);
   }

   function hapus($id) {
    $this->db->where('id_lokasi', $id);
    return $this->db->delete('tm_lokasi');
   }

  }
