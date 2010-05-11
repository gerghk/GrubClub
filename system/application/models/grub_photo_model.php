<?php

class Grub_photo_model extends Model{

  var $grub_photo_url = "";
  var $grub_id = "";
  var $user_id = "";
  var $post_date = "";
  var $grub_photo_caption = "";
  
  /* CONSTRUCTOR */
  function __construct() {
  
    parent::Model();
    // load database class and connect to MySQL
    $this->load->database();
    $this->load->helper('date');
  }
  
  /* SETTER FUNCTIONS */
  // Create a new grub photo with the post data
  function createGrubPhoto($fInfo, $grub_id) {
    $this->user_id = $this->input->post('user_id', TRUE);
    $this->grub_id = $this->grub_id = $grub_id;
    $this->grub_photo_url = 'images/grub_photos/' . $fInfo['raw_name'];  // TODO:  need to guarantee unique names
    $this->grub_photo_caption = $this->input->post('grub_photo_caption', TRUE);
    $this->post_date = date('Y-m-d H:i:s', local_to_gmt(time()));
    
    $this->db->insert('grub_photos', $this);
  }
  
  // Update user with $id according to the $data associative array
  function updateGrubPhoto($id, $data) {
    
    $this->db->where('grub_photo_id', $id);
    $this->db->set($data);
    $this->db->update('grub_photos');
  }
  
  /* GETTER FUNCTIONS */
   
  // Get primary photo for a given grub
  // NOTE:  for now, assumed to be the earliest posted photo
  function getMainPhotoByGrubId($id) {
  
    $this->db->where('grub_id', $id);
    $query = $this->db->get('users');
    if($query->num_rows()>0) {
      $rows = $query->result_array();
      return $rows[0];
    }
    return false;
  }

  // Get all photos for a given grub
  function getPhotosByGrubId($id) {
  
    $this->db->where('grub_id', $id);
    $query = $this->db->get('users');
    if($query->num_rows()>0) {
      $rows = $query->result_array();
      return $rows[0];
    }
    return false;
  }
  
  // Get all photos for a given user
  function getPhotosByUserID($id) {
  
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
