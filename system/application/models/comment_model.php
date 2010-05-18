<?php

class Comment_model extends Model {

  var $user_id = "";
  var $grub_id = "";
  var $comment_body = "";
  var $comment_score = "";
  var $comment_post_date = "";
  
  /* CONSTRUCTOR */
  function __construct() {
  
    parent::Model();
    // load database class and connect to MySQL
    $this->load->database();
    $this->load->helper('date');
  }
  
  /* SETTER FUNCTIONS */
  // Create a new grub with the post data
  function createComment() {
    $user_session = $this->session->userdata('user');
    $this->user_id = $user_session['user_id'];
    $this->grub_id = $this->uri->segment(3);
    $this->comment_body = $this->input->post('comment_body', TRUE);
    $this->comment_score = $this->input->post('comment_score', TRUE);
    $this->comment_post_date = date('Y-m-d H:i:s', local_to_gmt(time()));
    
    $this->db->insert('comments', $this);
    
    // Return the new comment_id
    return $this->db->insert_id();
  }
  
  /* GETTER FUNCTIONS */
  // Get all comments
  function getAllComments() {
  
    $query = $this->db->get('comments');
    if($query->num_rows()>0) {
      // return result set as an associative array
      return $query->result_array();
    }
    else {
      return false;
    }
  }
  
  // Get users based on specified field and value
  function getCommentsWhere($field, $value) {
  
    $this->db->where($field, $value);
    $query = $this->db->get('comments');
    if($query->num_rows()>0) {
      // return result set as an associative array
      return $query->result_array();
    }
    return false;
  }
  
  // Get total number of users
  function getNumComments() {
    return $this->db->count_all('comments');
  }
  
}


?>
