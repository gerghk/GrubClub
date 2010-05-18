<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  
  <head>
    <title>ChowHub</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/home.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset-fonts-grids/reset-fonts-grids.css">
  </head>
  
  <body>
  	
    <div id="doc2" class="yui-t1">
    
      <div id="hd">
        <?php
          $this->load->view('header');
        ?>
      </div>
      
      <div id="bd">
        <div id="yui-main">
          <div id="t1main" class="yui-b">
      
            <?php 
              $this->load->view($page);
            ?>
          </div>
        </div>
        <div id="t1side" class="yui-b">
          <?php 
            $this->load->view('sidebar');
          ?>
        </div>
      </div>
      
      <div id="ft">
        <?php 
          $this->load->view('footer');
        ?>
      </div>
    </div>
  </body>
</html>
