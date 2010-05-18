<?php

class Grub extends MY_Controller {

  /* CONSTRUCTOR */
  function Grub() {
    parent::MY_Controller(false);
    $this->load->model(array('grub_model', 'user_model', 'grub_photo_model'));
    $this->load->helper(array('form', 'url', 'html'));
    $this->load->library(array('validation'));
  }
  
  /* PAGES */
  /* Default */
  function index() {
    $this->viewAll();
  }
  
  function viewAll() {
    $grubs = $this->_getTenMostRecentPhotos();
    if ($grubs) {
      $data = array('grubs' => $grubs, 'page' => 'grub_list');
      $this->load->view('t1container', $data);
    } else {
      echo "Sorry, no grubs yet.";
    }
  }
  
  function view() {
    $grub_id = $this->uri->segment(3);
    $grub = $this->_getGrub($grub_id);
    if ($grub) {
      $data = array('grub' => $grub[0], 'page' => 'grub_view');
      $this->load->view('t1container', $data);
    } else {
      echo "Invalid grub id.";
    }
  }
  
  function addGrub() {
    $this->check_auth();
    
    $data = array('page' => 'add_grub');
    $this->load->view('t1container', $data);
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
      $data = array('page' => 'add_grub');
      $this->load->view('t1container', $data);
    } else {
      $grub_id = $this->grub_model->createGrub();
      $this->grub_photo_model->createGrubPhoto($url, $grub_id);
      redirect('grub/viewAll', 'refresh');
    }
  }
  
  // Adapted from:  http://net.tutsplus.com/videos/screencasts/easy-development-with-codeigniter/
  // Add a photo for the logged in user
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
  
  private function _getTenMostRecentPhotos() {
    
    $this->db->select('*');
    $this->db->from('grubs');
    $this->db->join('grub_photos', 'grub_photos.grub_id = grubs.grub_id');
    $this->db->join('users', 'users.user_id = grubs.user_id');
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
  
  private function _getGrub($id) {
    
    $this->db->select('*');
    $this->db->from('grubs');
    $this->db->where('grubs.grub_id', $id);
    $this->db->join('grub_photos', 'grub_photos.grub_id = grubs.grub_id');
    
    $query = $this->db->get();
    
    if($query->num_rows()>0) {
      return $query->result_array();
    }
    else {
      return false;
    }
  
  }
  
  private function _getPhotosByGrubId($grub_id) {
    
    
  }
  
}

?>