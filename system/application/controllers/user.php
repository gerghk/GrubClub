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
    echo 'User created.';
  }
  
  /* Show user profile */
  function profile() {
  
    // Make sure user is logged in
    $this->check_auth();
    
    $data = array('user' => $this->session->userdata('user'), 'page' => 'user_profile');
    $this->load->view('t1container', $data);
  }
  
  /* Validate user creation */
  private function _validate_create_user() {
     
    $this->form_validation->set_rules('user_name', 'Real name', 'required');
    $this->form_validation->set_rules('user_nickname', 'Nickname', 'required');
    $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('user_zip_code', 'Zipcode', 'max_length[10]');
    $this->form_validation->set_rules('user_password', 'Password', 'required|matches[retype_password]');
    $this->form_validation->set_rules('retype_password', 'Retype password', 'required');
    
    return $this->form_validation->run();
  }
}

?>
