<?php

class Grub extends Controller {

  /* CONSTRUCTOR */
  function __construct() {
    parent::Controller();
    $this->load->model('grubs_model');
    $this->load->helper(array('form', 'url'));
    $this->load->library('validation');
  }
  
  /* PAGES */
  /* Default */
  function index() {
    echo "Grub index page.";
  }
  
  function viewAll() {
    $grubs = array('grubs' => $this->grubs_model->getAllGrubs());
    if ($grubs) {
      $this->load->view('all_grubs', $grubs);
    } else {
      echo "Sorry, no grubs yet.";
    }
  }
  
  function addGrub() {
    $this->load->view('add_grub');
  }
  
  function addGrubPost() {
    $this->grubs_model->createGrub();  
    redirect('grub/viewAll', 'refresh');
  }
}

?>