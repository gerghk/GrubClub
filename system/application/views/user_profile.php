<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  
  <head>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/home.css" media="screen" /> -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset-fonts-grids/reset-min.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/grids/grids-min.css">
  </head>
  
  <body>
  	
    <div id="doc">
    
      <div class="header">
        <?php
          $this->load->view('header');
        ?>
      </div>
      
      <p><?php echo $user['user_name']; ?>'s profile</p>
      
    </div>
  </body>
</html>
