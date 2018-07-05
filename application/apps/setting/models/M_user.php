<?php

  class M_user extends CI_Model {

   public function __construct() {
    parent::__construct();
   }

   function getdata_user() {
    return $this->db->get('tm_user');
   }

   function insert($data_user) {
    return $this->db->insert('tm_user', $data_user);
   }

   function getdata_byid($id) {
    $this->db->where('userid', $id);
    return $this->db->get('tm_user')->row();
   }

   function update($id, $data_update) {
    $this->db->where('userid', $id);
    return $this->db->update('tm_user', $data_update);
   }

   function hapus($id) {
    $this->db->where('userid', $id);
    return $this->db->delete('tm_user');
   }

  }
