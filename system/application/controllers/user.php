<?php
class User extends MY_Controller {

  /* Constructor */
  function User() {

    // User controller needs to authenticate manually
    parent::MY_Controller(false);

    // Load models
    $this->load->model("user_model");

    // Load helpers
    $this->load->helper(array('form','url', 'html', 'email_helper'));

    // Load libraries
    $this->load->library('form_validation');
    $this->load->library('unit_test');  
  }
  
  /* Create user */
  function create() {
    
    $user_session = $this->session->userdata('user');
    if($user_session != false) {
    
      $this->session->set_flashdata('error', 'You cannot create a new account while logged in');
      redirect('/');
    }
    
    if($this->_validate_create_user() == false) {
      
      $data = array('page' => 'user_create');
      $this->load->view('container', $data);
      return;
    }
     
    // Create the new user
    $new_user['user_name'] = $this->input->post('user_name');
    $new_user['user_nickname'] = $this->input->post('user_nickname');
    $new_user['user_email'] = $this->input->post('user_email');
    $new_user['user_zip_code'] = $this->input->post('user_zip_code');
    $new_user['user_password'] = $this->input->post('user_password');
    $new_user['user_create_date'] = date("Y-m-d H:i:s");
    $new_user['user_last_update'] = date("Y-m-d H:i:s");
    $this->user_model->createUser($new_user);
     
    // Show the new user's profile page
    $query = $this->user_model->getUsersWhere('user_nickname', $new_user['user_nickname']);
    if($query == false) {
      $this->session->set_flashdata('error', 'User creation failed');
      redirect('/user/create');
    }
    else {
      $user = $query[0];
      $this->session->set_userdata('user', $user);
      redirect('/user/profile');
    }
  }
  
  /* Show user profile */
  function profile() {
  
    // Make sure user is logged in
    $this->check_auth();
    
    $user = $this->session->userdata('user');
    $health_record = $this->user_model->getHealthRecordById($user['user_id']);
    
    $data = array('user' => $user, 'health_record' => $health_record, 'page' => 'user_profile');
    $this->load->view('container', $data);
  }
  
  /* Edit user profile */
  function edit() {
  	
  	// Make sure user is logged in
    $this->check_auth();
    
  	if($this->_validate_edit_user() == false) {
      
      $user = $this->session->userdata('user');
      $health_record = $this->user_model->getHealthRecordById($user['user_id']);
      
      $data = array('user' => $user, 'health_record' => $health_record, 'page' => 'user_edit');
      $this->load->view('container', $data);
      return;
    }
    
    
  }
  
  /* Validate user creation */
  private function _validate_create_user() {
     
    $this->form_validation->set_rules('user_name', 'Real name', 'required');
    $this->form_validation->set_rules('user_nickname', 'Nickname', 'required|callback_nickname_unique');
    $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|callback_email_unique');
    $this->form_validation->set_rules('user_zip_code', 'Zipcode', 'max_length[10]');
    $this->form_validation->set_rules('user_password', 'Password', 'required|matches[retype_password]');
    $this->form_validation->set_rules('retype_password', 'Retype password', 'required');
    
    return $this->form_validation->run();
  }
  
  /* Callback for checking nickname uniqueness */
  function nickname_unique($str) {
    
    $query = $this->user_model->getUsersWhere('user_nickname', $str);
    if($query == false) {
      
      return true;
    }
    else {
      
      $this->form_validation->set_message('nickname_unique', 'That nickname has already been taken.');
      return false;
    }
  }
  
  /* Callback for checking email uniqueness */
  function email_unique($str) {
    
    $query = $this->user_model->getUsersWhere('user_email', $str);
    if($query == false) {
      
      return true;
    }
    else {
      
      $this->form_validation->set_message('email_unique', 'That email has already been registered with another user.');
      return false;
    }
  }
  
  /* Validate user edit */
  private function _validate_edit_user() {
     
    return false;
    
    //return $this->form_validation->run();
  }
}

?>
