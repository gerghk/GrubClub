<?php

class Grubs_model extends Model{

  var $user_id = "";
  var $grub_title = "";
  var $grub_description = "";
  var $grub_score = "";
  var $grub_post_date = "";
  
  /* CONSTRUCTOR */
  function __construct() {
  
    parent::Model();
    // load database class and connect to MySQL
    $this->load->database();
    $this->load->helper('date');
  }
  
  /* SETTER FUNCTIONS */
  // Create a new grub with the $data associative array
  function createGrub() {
    $this->user_id = $this->input->post('user_id', TRUE);
    $this->grub_title = $this->input->post('grub_title', TRUE);
    $this->grub_description = $this->input->post('grub_description', TRUE);
    $this->grub_score = $this->input->post('grub_score', TRUE);
    $this->grub_post_date = date('Y-m-d H:i:s', local_to_gmt(time()));
    
    $this->db->insert('grubs', $this);
  }
  
  // Update user with $id according to the $data associative array
  function updateGrub($id, $data) {
    
    $this->db->where('grub_id', $id);
    $this->db->set($data);
    $this->db->update('grubs');
  }
  
  /* GETTER FUNCTIONS */
  // Get all users
  function getAllGrubs() {
  
    $query = $this->db->get('grubs');
    if($query->num_rows()>0) {
      // return result set as an associative array
      return $query->result_array();
    }
  }
  
  // Get users based on specified field and value
  function getGrubsWhere($field, $value) {
  
    $this->db->where($field, $value);
    $query = $this->db->get('grubs');
    if($query->num_rows()>0) {
      // return result set as an associative array
      return $query->result_array();
    }
    return false;
  }
  
  // Get total number of users
  function getNumGrubs() {
    return $this->db->count_all('grubs');
  }
  
  // Get user by user_id
  function getGrubById($id) {
  
    $this->db->where('grub_id', $id);
    $query = $this->db->get('users');
    if($query->num_rows()>0) {
      $rows = $query->result_array();
      return $rows[0];
    }
    return false;
  }
  
  // Get all grubs for a given user
  function getGrubsByUserID($id) {
  
    $this->db->where('user_id', $id);
    $query = $this->db->get('grubs');
    if ($query->num_rows() > 0) {
      $rows = $query->result_array();
      return $rows;
    }
    return false;
  }    
  
}


?>
