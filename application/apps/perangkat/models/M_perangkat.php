<?php

  class M_perangkat extends CI_Model {

   public function __construct() {
    parent::__construct();
   }

   function getdata_perangkat() {
    $this->db->order_by('id_perangkat');
    $data = $this->db->get('tm_perangkat');
    return $data;
   }

   function insert($data_setup) {
    $insert = $this->db->insert('tm_perangkat', $data_setup);
    if ($insert) {
     return true;
    } else {
     return false;
    }
   }

   function getdata_byid($id) {
    $this->db->where('id_perangkat', $id);
    return $this->db->get('tm_perangkat');
   }

   function getdata_keg_byid($id) {
    $this->db->where('id_perangkat', $id);
    return $this->db->get('tm_kegiatan');
   }

   function update($id, $data_update) {
    $this->db->where('id_perangkat', $id);
    return $this->db->update('tm_perangkat', $data_update);
   }

   function hapus($id) {
    $this->db->where('id_perangkat', $id);
    return $this->db->delete('tm_perangkat');
   }

   function insert_kegiatan($data_kegiatan) {
    $insert = $this->db->insert('tm_kegiatan', $data_kegiatan);
    if ($insert) {
     return true;
    } else {
     return false;
    }
   }

  }
