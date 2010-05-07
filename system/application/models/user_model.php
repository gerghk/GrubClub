<?php

// Enum for user types
class UserType {
  const All = -1;
  const User = 0;
  const Admin = 1;
}

class user_model extends Model {

  /* CONSTRUCTOR */
  function __construct() {
  
    parent::Model();
    // load database class and connect to MySQL
    $this->load->database();
  }
  
  /* SETTER FUNCTIONS */
  // Create a new user with the $data associative array
  function createUser($data) {
    
    // Hash the password first
    $password = $data['user_password'];
    $hash = $this->hashPassword($password);
    $data['user_password'] = $hash;
    
    $this->db->insert('users', $data);
  }
  // Update user with $id according to the $data associative array
  function updateUser($id, $data) {
    
    $this->db->where('user_id', $id);
    $this->db->set($data);
    $this->db->update('users');
  }
  
  /* GETTER FUNCTIONS */
  // Get all users
  function getAllUsers() {
  
    $query = $this->db->get('users');
    if($query->num_rows()>0) {
      // return result set as an associative array
      return $query->result_array();
    }
  }
  // Get users based on specified field and value
  function getUsersWhere($field, $value) {
  
    $this->db->where($field, $value);
    $query = $this->db->get('users');
    if($query->num_rows()>0) {
      // return result set as an associative array
      return $query->result_array();
    }
    return false;
  }
  // Get total number of users
  function getNumUsers() {
    return $this->db->count_all('users');
  }
  // Get user by user_id
  function getUserById($id) {
  
    $this->db->where('user_id', $id);
    $query = $this->db->get('users');
    if($query->num_rows()>0) {
      $rows = $query->result_array();
      return $rows[0];
    }
    return false;
  }
  
  /* AUTHENTICATION FUNCTIONS */
  // Returns the hash produced by the supplied password
  function hashPassword($password) {
  
    mt_srand((double)microtime()*1000000);
    $salt = mhash_keygen_s2k(MHASH_SHA1,
                             $password,
                             substr(pack('h*', md5(mt_rand())), 0, 8),
                             4);
    $hash = "{SSHA}".base64_encode(mhash(MHASH_SHA1, $password.$salt).$salt);
    return $hash;
  }
  // Validates $password using $hash, returns true if successful, false if not
  function validatePassword($password, $hash) {
  
    $hash = base64_decode(substr($hash, 6));
    $original_hash = substr($hash, 0, 20);
    $salt = substr($hash, 20);
    $new_hash = mhash(MHASH_SHA1, $password . $salt);
    if(strcmp($original_hash, $new_hash) == 0)
      return true;
    else
      return false;
  }
  // Validates user with $id using $password
  function validateUser($id, $password) {
  
    $user = $this->getUserById($id);
    $hash = $user['user_password'];
    return validatePassword($password, $hash);
  }
  
}


?>
