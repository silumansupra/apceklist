<?php

  class M_asman extends CI_Model {

   public function __construct() {
    parent::__construct();
   }

   function getdata_asman() {
    return $this->db->get('tm_asman');
   }

   function insert($data_asman) {
    return $this->db->insert('tm_asman', $data_asman);
   }

   function getdata_byid($id) {
    $this->db->where('id_asman', $id);
    return $this->db->get('tm_asman')->row();
   }

   function update($id, $data_update) {
    $this->db->where('id_asman', $id);
    return $this->db->update('tm_asman', $data_update);
   }

   function hapus($id) {
    $this->db->where('id_asman', $id);
    return $this->db->delete('tm_asman');
   }

  }
