<?php

  class M_perangkat extends CI_Model {

   public function __construct() {
    parent::__construct();
   }

   function getdata_perangkat() {
//    $this->db->select('(SELECT COUNT( id_perangkat ) FROM tm_perangkat x LEFT JOIN tm_lokasi y ON y.id_lokasi = x.id_lokasi WHERE x.id_lokasi = b.id_lokasi ) as total_kegiatan');
    $this->db->join('tm_lokasi b', 'b.id_lokasi = a.id_lokasi', 'inner');
    $this->db->order_by('a.id_perangkat');
    $data = $this->db->get('tm_perangkat a');
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

   function hapus_perangkat($id) {
    $this->db->where('id_perangkat', $id);
    if ($this->db->delete('tm_kegiatan')) {
     $this->db->where('id_perangkat', $id);
     return $this->db->delete('tm_perangkat');
    }
   }

   function hapus_kegiatan($id_keg) {
    $this->db->where('id_kegiatan', $id_keg);
    $del = $this->db->delete('tm_kegiatan');
    if ($del) {
     return true;
    } else {
     return false;
    }
   }

   function insert_kegiatan($data_kegiatan) {
    $insert = $this->db->insert('tm_kegiatan', $data_kegiatan);
    if ($insert) {
     return true;
    } else {
     return false;
    }
   }

   function update_kegiatan($id, $data_update) {
    $this->db->where('id_kegiatan', $id);
    $update = $this->db->update('tm_kegiatan', $data_update);
    if ($update) {
     return true;
    } else {
     return false;
    }
   }

  }
