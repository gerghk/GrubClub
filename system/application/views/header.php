<div id="logo">

  <h1>ChowHub</h1>
</div>

<div id="flash_errors">

  <?php
    if($this->session->flashdata('error') != false) {
    
      echo $this->session->flashdata('error');
    }
  ?>
</div>

<style type="text/css">
  /* Define background images here to keep paths relative */
  #hd {
    background-image:url('<?php echo base_url(); ?>graphics/header_bg.png');
  }
  #menubar {
    background-image:url('<?php echo base_url(); ?>graphics/menubar.png');
  }
  #home_button {
    background-image:url('<?php echo base_url(); ?>graphics/tab_active.png');
  }
  #search_button {
    background-image:url('<?php echo base_url(); ?>graphics/tab_inactive.png');
  }
</style>

<div id="menubar">
  <table>
    <tr>
      <td>
        <div id="home_button">
          <h2>Home</h2>
        </div>
      </td>
      <td>
        <div id="search_button">
          <h2>Search</h2>
        </div>
      </td>
    </tr>
  </table>
</div>
