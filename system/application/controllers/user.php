<?php
class User extends MY_Controller {

  /* Constructor */
  function User() {

    // User controller needs to authenticate manually
    parent::MY_Controller(false);

    // Load models
    $this->load->model(array('user_model', 'grub_model'));

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
  
  /* Show user with $id's profile */
  function show($id) {
    
    // Make sure user is logged in
    $this->check_auth();
    
    $user = $this->user_model->getUserById($id);
    $health_record = $this->user_model->getHealthRecordById($id);
    
    if($user == false || $health_record == false) {
      
      $this->session->set_flashdata('error', 'No such user.');
      redirect('/');
    }
    else {
      
      $grubs = $this->_getTenMostRecentUserGrubs($id);
      $data = array('user' => $user, 'health_record' => $health_record, 'grubs' => $grubs, 'page' => 'user_public_profile');
      $this->load->view('container', $data);
    }
  }
  
  function mealAnalysis() {
    $data = array('page' => 'user_mealanalysis');
    $this->load->view('t1container', $data);
  }
  
  
  /* Edit user profile */
  function edit() {
  	
  	// Make sure user is logged in
    $this->check_auth();
    
  	$user = $this->session->userdata('user');
    $health_record = $this->user_model->getHealthRecordById($user['user_id']);
    
    $data = array('user' => $user, 'health_record' => $health_record, 'page' => 'user_edit');
    $this->load->view('container', $data);
  }
  
  /* Update user profile */
  function update() {
    
    // Make sure user is logged in
    $this->check_auth();
    $user_session = $this->session->userdata('user');
    
    if($this->_validate_edit_user() == false) {
      
      $this->edit();
      return;
    }
    
    // Gather the new profile information
    $new_user['user_last_update'] = date("Y-m-d H:i:s");
    $new_profile['user_gender'] = $this->input->post('user_gender');
    $new_birthdate = strtotime($this->input->post('user_birthdate'));
    $new_profile['user_birthdate'] = date("Y-m-d H:i:s", $new_birthdate);
    $new_profile['user_ethnicity'] = $this->input->post('user_ethnicity');
    $new_height_feet = $this->input->post('user_height_feet');
    $new_height_inches = $this->input->post('user_height_inches');
    $new_profile['user_height'] = $new_height_feet*12 + $new_height_inches;
    $new_profile['user_weight'] = $this->input->post('user_weight');
    $new_profile['user_weekly_exercise_hours'] = $this->input->post('user_weekly_exercise_hours');
    
    // Update the user
    $this->user_model->updateUser($user_session['user_id'], $new_user);
    
    // Update the health record
    $this->user_model->updateHealthRecord($user_session['user_id'], $new_profile);
    
    redirect('/user/profile');
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
     
    $this->form_validation->set_rules('user_height_feet', 'Height feet', 'is_natural');
    $this->form_validation->set_rules('user_height_inches', 'Height inches', 'is_natural|callback_height_inches_bounds');
    $this->form_validation->set_rules('user_weight', 'Weight', 'is_natural_no_zero');
    $this->form_validation->set_rules('user_weekly_exercise_hours', 'Weekly exercise hours', 'is_natural');
    
    return $this->form_validation->run();
  }
  
  /* Callback for checking that height inches are less than 12 */
  function height_inches_bounds($str) {
    
    $height_inches = (int)$str;
    
    if($height_inches < 12) {
      
      return true;
    }
    else {
      
      $this->form_validation->set_message('height_inches_bounds', 'Height inches must be less than 12');
      return false;
    }
  }

  private function _getTenMostRecentUserGrubs($user_id) {
    
    $this->db->select('*');
    $this->db->from('grubs');
    $this->db->where('grubs.user_id', $user_id);
    $this->db->join('grub_photos', 'grub_photos.grub_id = grubs.grub_id');
    $this->db->order_by('grub_photos.post_date', 'desc');
    $this->db->limit(10);
    
    $query = $this->db->get();
    
    if($query->num_rows()>0) {
      
      return $query->result_array();
    }
    else {
      
      return false;
    }
  }
}

?>
