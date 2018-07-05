<?php

  class M_auth extends CI_Model {

   public function __construct() {
    parent::__construct();
    $this->load->library('encrypt');
   }

   function cekdata($username, $password) {
    $this->db->where('username', $username);
    $userdata = $this->db->get('tm_user');
    if ($userdata->num_rows() > 0) {
     $passkey = $this->encrypt->decode($userdata->row()->password);
     if ($password === $passkey) {
      return $userdata->row();
     } else {
      return "0";
     }
    } else {
     return "NULL";
    }
   }

   function insert_logid($data_logid) {
    $this->db->insert('tt_logid', $data_logid);
   }

   function insert_fail_login($data_fail) {
    $this->db->insert('tt_fail_login', $data_fail);
   }

   function update_logid($log_id, $data_logout) {
    $this->db->where('log_id', $log_id);
    $this->db->update('tt_logid', $data_logout);
   }

  }
