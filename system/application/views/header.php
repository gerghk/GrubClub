<div id="logo">

  <img src='<?php echo base_url(); ?>graphics/logo.png' width='300'/>
</div>

<div id="login_link">

  <?php
  
    $user_session = $this->session->userdata('user');
    if($user_session != false) {
    
      echo anchor('login/logout', 'Logout');
    }
    else {
      
      echo anchor('login', 'Login');
      echo ' | ';
      echo anchor('user/create', 'Register');
    }
  ?>
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
  #profile_button {
    background-image:url('<?php echo base_url(); ?>graphics/tab_inactive.png');
  }
</style>

<div id="menubar">
  <table>
    <tr>
      <td>
        <div id="home_button">
          <h2><?php echo anchor('grub', 'Home'); ?></h2>
        </div>
      </td>
      <td>
        <div id="search_button">
          <h2>Search</h2>
        </div>
      </td>
      <?php
  
        $user_session = $this->session->userdata('user');
        if($user_session != false) :
      ?>
      <td>
        <div id="profile_button">
          <h2><?php echo anchor('user/profile', 'Profile'); ?></h2>
        </div>
      </td>
      <?php endif; ?>
    </tr>
  </table>
</div>
