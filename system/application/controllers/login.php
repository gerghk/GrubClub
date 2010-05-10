<?php

class Login extends Controller {
  
  /* Constructor */
  function Login() {
    parent::Controller();
    $this->load->helper(array('form', 'url'));
    $this->load->model('user_model');
  }
  
  // Main login screen
  function index() {
  
    $user_session = $this->session->userdata('user');
    if($user_session != false) {
    
      $this->session->set_flashdata('error', 'You are already logged in');
      redirect('/');
    }
    
    $this->load->view('login_index');
  }

  // Login with $_POST['nickname'] and $_POST['password']
  function auth() {
  
    $user_session = $this->session->userdata('user');
    if($user_session != false) {
    
      $this->session->set_flashdata('error', 'You are already logged in');
      redirect('/');
    }
  
    $nickname = $this->input->post('user_nickname');
    $password = $this->input->post('user_password');
    
    if($nickname == false || $password == false) {
    
      $this->session->set_flashdata('error', 'You must enter both nickname and password');
      redirect('/login');
    }

    $query = $this->user_model->getUsersWhere('user_nickname', $nickname);
    if($query == false) {
      $this->session->set_flashdata('error', 'That does not appear to be a valid nickname');
      redirect('/login');
    }
    else {
      $user = $query[0];
      $success = $this->user_model->validateUser($user['user_id'], $password);
      if($success == true) {
        $this->session->set_userdata('user', $user);
        redirect('/');
      }
      else {
        $this->session->set_flashdata('error', 'The password was incorrect');
        redirect('/login');
      }
    }
  }
  
  // Logout and destroy session data
  function logout() {
  
    $user_session = $this->session->userdata('user');
    if($user_session == false) {
    
      $this->session->set_flashdata('error', 'You are not even logged in');
      redirect('/login');
    }
    else {
    
      $this->session->unset_userdata('user');
      redirect('/');
    }
  }

}

?>