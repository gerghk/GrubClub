<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  
  <head>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/home.css" media="screen" /> -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset-fonts-grids/reset-fonts-grids.css">
    
    <style type="text/css">
      #hd {
        background-image:url('<?php echo base_url(); ?>graphics/header_bg.png');
        background-repeat:no-repeat;
        width:750px;
        height:214px;
        padding:10px;
      }
    </style>
  </head>
  
  <body>
  	
    <div id="doc" class="yui-t1">
    
      <div id="hd">
        <?php
          $this->load->view('header');
        ?>
      </div>
      
      <div id="bd">
        <div id="yui-main">
          <div id="loginbox" class="yui-b">
      
            <?php echo form_open('login/auth'); ?>
        
            <table>
            
              <tr>
                <td>
                  <label for="user_nickname">Nickname: </label>
                </td>
                <td>
                  <?php echo form_input('user_nickname', set_value('user_nickname')); ?>
                </td>
              </tr>
              
              <tr>
                <td>
                  <label for="user_password">Password: </label>
                </td>
                <td>
                  <?php echo form_password('user_password', set_value('user_password')); ?>
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo form_submit('submit', 'Login'); ?>
                </td>
              </tr>
            </table>
            
            <?php echo form_close(); ?>
          </div>
        </div>
        <div id="sidebar" class="yui-b">
          <-- Sidebar Content -->
        </div>
      </div>
      
      <div id="ft">
        <-- Footer Content -->
      </div>
    </div>
  </body>
</html>
