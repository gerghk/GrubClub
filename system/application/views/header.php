<div id="flash_errors">
  <h1>ChowHub</h1>
  <?php
    if($this->session->flashdata('error') != false) {
    
      echo $this->session->flashdata('error');
    }
  ?>
</div>
