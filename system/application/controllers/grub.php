<?php

class Grub extends MY_Controller {

  /* CONSTRUCTOR */
  function Grub() {
    parent::MY_Controller(false);
    $this->load->model(array('grub_model', 'user_model', 'grub_photo_model', 'comment_model'));
    $this->load->helper(array('form', 'url', 'html'));
    $this->load->library(array('form_validation'));
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
    $grubs = $this->_getGrub($grub_id);
    $details = $this->grub_model->getGrubDetailsById($grub_id);
    // Create grub details if it doesn't exist
    if($details === false) {
      
      $this->grub_model->createGrubDetails($grub_id, array());
      $details = $this->grub_model->getGrubDetailsById($grub_id);
    }
    $comments = $this->_getComments($grub_id);
    if ($grubs) {
      $data = array('grub' => $grubs[0], 'details' => $details, 'comments' => $comments, 'page' => 'grub_view');
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
  
  function user() {
    $user = $this->user_model->getUserByID($this->uri->segment(3));
    if (!user) {
      redirect('grub/viewAll');
    } else {
      $grubs = $this->grub_model->getGrubsByUserID($user['user_id']);
      $data = array('page' => 'user_grubs', 'grubs' => $grubs, 'user' => $user);
      $this->load->view('t1container', $data);
    }
  }
  
  // Create a new Grub from the POST data
  function addGrubPost() {
    $this->check_auth();
    
    // Add photo and generate thumbnail
    $url = $this->_addPhoto();
    
    // Make sure form entries are valid
    if (!$this->_validateAddGrub($url)) {
      $this->addGrub();
    } else {
      $grub_id = $this->grub_model->createGrub();
      $this->grub_photo_model->createGrubPhoto($url, $grub_id);
      
      // Create the grub detail record
      $consumption_date = strtotime($this->input->post('grub_consumption_date'));
      $data['grub_consumption_date'] = date("Y-m-d H:i:s", $consumption_date);
      $data['grub_restaurant'] = $this->input->post('grub_restaurant');
      $data['grub_ingredients'] = $this->input->post('grub_ingredients');
      $data['grub_calories'] = (int)$this->input->post('grub_calories');
      $data['grub_type'] = (int)$this->input->post('grub_type');
      $this->grub_model->createGrubDetails($grub_id, $data);
      
      redirect('grub/viewAll', 'refresh');
    }
  }
  
  function addCommentPost() {
    $this->check_auth();
    
    if ($this->_validateAddComment()) {
      $this->comment_model->createComment();
    }
    redirect('grub/view/' . $this->uri->segment(3), 'refresh');
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

      $this->_createThumbnail($filename);
    
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
    $config['source_image'] = 'images/grub_photos/' . $fileName;  
    $config['create_thumb'] = TRUE;  
    $config['maintain_ratio'] = TRUE;  
    $config['width'] = 75;  
    $config['height'] = 75;  
 
    $this->load->library('image_lib', $config);  
    if(!$this->image_lib->resize()) {
      //echo $this->image_lib->display_errors();
      return false;
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
  
  private function _getGrub($grub_id) {
    
    $this->db->select('*');
    $this->db->from('grubs');
    $this->db->where('grubs.grub_id', $grub_id);
    $this->db->join('grub_photos', 'grub_photos.grub_id = grubs.grub_id');
    
    $query = $this->db->get();
    
    if($query->num_rows()>0) {
      return $query->result_array();
    }
    else {
      return false;
    }
  
  }
  
  private function _getComments($grub_id) {
    
    $this->db->select('*');
    $this->db->from('comments');
    $this->db->where('comments.grub_id', $grub_id);
    $this->db->join('users', 'comments.user_id = users.user_id');
    $this->db->order_by('comment_post_date');
    
    $query = $this->db->get();
    return $query->result_array();
    
  }
  
  
  private function _getPhotosByGrubId($grub_id) {
      
  }
  
  private function _validateAddGrub($url) {
    $this->form_validation->set_rules('photo_caption', 'Photo Caption', 'max_length[50]');
    $this->form_validation->set_rules('grub_title', 'Title', 'required|max_length[100]');
    $this->form_validation->set_rules('grub_description', 'Description', 'required|max_length[1000]');
    if (!$url)
      $this->form_validation->set_rules('photo_file', 'Photo File', 'callback_invalid_file');
    
    /* Validate optional information */
    $this->form_validation->set_rules('grub_calories', 'Estimated calories', 'is_natural');
    
    return $this->form_validation->run();
  }
  
  function invalid_file($str) {
    $this->form_validation->set_message('invalid_file', 'Invalid file.  Please try again.');
    return false;
  }
  
  private function _validateAddComment() {
    return true;
  }
}

?>