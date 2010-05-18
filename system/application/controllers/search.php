<?php
class Search extends MY_Controller {

  /* Constructor */
  function Search() {

    // Search is open to guests
    parent::MY_Controller(false);

    // Load models
    $this->load->model("tag_model");

    // Load helpers
    $this->load->helper(array('form','url', 'html', 'email_helper'));

    // Load libraries
    $this->load->library('form_validation');
    $this->load->library('unit_test');  
  }
  
  /* Main search index */
  function index() {
    
    $this->load->view('container', array('page' => 'search_main'));
  }
}

?>
