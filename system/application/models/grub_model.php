<?php

class Grub_model extends Model{

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
  // Create a new grub with the post data
  function createGrub() {
    $user_session = $this->session->userdata('user');
    $this->user_id = $user_session['user_id'];
    $this->grub_title = $this->input->post('grub_title', TRUE);
    $this->grub_description = $this->input->post('grub_description', TRUE);
    $this->grub_score = $this->input->post('grub_score', TRUE);
    $this->grub_post_date = date('Y-m-d H:i:s', local_to_gmt(time()));
    
    $this->db->insert('grubs', $this);
    
    // Return the new grub_id
    return $this->db->insert_id();
  }
  
  // Create a new grub detail for grub with $id
  function createGrubDetails($id, $data) {
    
    $data['grub_id'] = $id;
    $this->db->insert('grub_details', $data);
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
    else {
      return false;
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
    $query = $this->db->get('grubs');
    if($query->num_rows()>0) {
      $rows = $query->result_array();
      return $rows[0];
    }
    return false;
  }
  
  // Get grub details by grub_id
  function getGrubDetailsById($id) {
    
    $this->db->where('grub_id', $id);
    $query = $this->db->get('grub_details');
    if($query->num_rows()>0) {
      $rows = $query->result_array();
      return $rows[0];
    }
    return false;
  }
  
  // Get all grubs for a given user
  function getGrubsByUserId($id) {
  
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
