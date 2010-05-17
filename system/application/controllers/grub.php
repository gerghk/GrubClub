<?php

class Grub extends MY_Controller {

  /* CONSTRUCTOR */
  function Grub() {
    parent::MY_Controller(false);
    $this->load->model(array('grub_model', 'user_model', 'grub_photo_model'));
    $this->load->helper(array('form', 'url'));
    $this->load->library(array('validation'));
  }
  
  /* PAGES */
  /* Default */
  function index() {
    echo "Grub index page.";
  }
  
  function viewAll() {
    $grubs = array('grubs' => $this->grub_model->getAllGrubs());
    if ($grubs) {
      $this->load->view('all_grubs', $grubs);
    } else {
      echo "Sorry, no grubs yet.";
    }
  }
  
  function addGrub() {
    $this->check_auth();
    
    $this->load->view('add_grub');
  }
  
  function test() {
    redirect('grub/viewAll');
  }
  
  // Create a new Grub from the POST data
  function addGrubPost() {
    $this->check_auth();
    
    // Add photo and generate thumbnail
    $url = $this->_addPhoto();
    if (!$url) {
      $this->load->view('add_grub');
    } else {
      $grub_id = $this->grub_model->createGrub();
      $this->grub_photo_model->createGrubPhoto($url, $grub_id);
      redirect('grub/viewAll', 'refresh');
    }
  }
  
  // Adapted from:  http://net.tutsplus.com/videos/screencasts/easy-development-with-codeigniter/
  // Add a photo to the 
  function _addPhoto() {
  
    $userfile = $_FILES['photo_file'];
    if ($userfile['size'] == 0) {
      return false;
    } else {
      $filename = $userfile['tmp_name'];
      $handle = fopen($filename, "r");
      $data = fread($handle, filesize($filename));

      // $data is file data
      $pvars = array('image' => base64_encode($data), 'key' => '8817fd2e9910576a313de1c1ffa0eff0');
      $timeout = 30;
      $curl = curl_init();

      curl_setopt($curl, CURLOPT_URL, 'http://imgur.com/api/upload.json');
      curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $response = json_decode(curl_exec($curl), true);

      // print_r($response);
      
      curl_close ($curl);

      $url = $response['rsp']['image']['small_thumbnail'];
      return $url;
    }
    
    /*
    $config['upload_path'] = APPPATH . 'images/grub_photos';  
    $config['allowed_types'] = 'gif|jpg|jpeg|png';  
    $config['max_size'] = '1000';  
    $config['max_width'] = '1920';  
    $config['max_height'] = '1280';                       

    $this->load->library('upload', $config);  
    
    if(!$this->upload->do_upload('photo_file')) {
      echo $this->upload->display_errors();  
    } else {  
      $fInfo = $this->upload->data();  
      //$this->_createThumbnail($fInfo['file_name']);  
   
      return $fInfo;
    }
    return false;
    
    */
  }
  
  function _createThumbnail($fileName) {  
    $config['image_library'] = 'gd';  
    $config['source_image'] = 'images/grub_photos/' . $fileName;  
    $config['create_thumb'] = TRUE;  
    $config['maintain_ratio'] = TRUE;  
    $config['width'] = 75;  
    $config['height'] = 75;  
 
    $this->load->library('image_lib', $config);  
    if(!$this->image_lib->resize()) {
      echo $this->image_lib->display_errors();
    }
  }  
  
}

?>