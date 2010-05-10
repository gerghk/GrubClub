<div id="flash_errors">
  <?php
    if($this->session->flashdata('error') != false) {
    
      echo $this->session->flashdata('error');
    }
  ?>
</div>
