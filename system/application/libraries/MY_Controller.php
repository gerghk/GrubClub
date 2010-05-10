<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Controller extends Controller {
 
  function MY_Controller($check = true) {
    
    parent::Controller();
    $this->load->helper('url');
        
    if ($check) $this->check_auth();

  }
  
  function check_auth() {
    
    $user_session = $this->session->userdata('user');
    
    if($user_session === false) {
    
      redirect('/login');
    }
  }
}

?>
