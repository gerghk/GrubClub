<?php

class Login extends Controller {
  
  /* Constructor */
  function Login() {
    parent::Controller();
    $this->load->helper('url');
    $this->load->model('user_model');
  }

  // Login with $nickname and $password		
  private function _login($nickname, $password) {

    $query = $this->user_model->getUsersWhere('nickname', $nickname);
    if($query->num_rows() == 0) {
      $this->session->set_flashdata('error', 'That does not appear to be a valid nickname');
      redirect('/');
    }
    else {
      $rows = $query->result_array();
      $user = $rows[0];
      $success = $this->user_model->validateUser($user['user_id'], $password);
      if($success == true) {
        $this->session->set_userdata('user', $user);
        redirect('/');
      }
      else {
        $this->session->set_flashdata('error', 'The password was incorrect');
        redirect('/');
      }
    }
  }
  
  private function _logout() 
  {
    $this->session->sess_destroy();        
    redirect('/');
  }

}

?>