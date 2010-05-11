<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  
  <head>
    <title>ChowHub - View Grub</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/home.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset-fonts-grids/reset-fonts-grids.css">
  </head>
  
  <body>
    
    <div id="doc">
    
      <div id="hd">
        <?php
          $this->load->view('header');
        ?>
      </div>
      
      <div id="bd">
      
        <div id="yui-main">
          <div class="yui-b">
            <table>
              <?php foreach($grubs as $grub):?>
                <tr>
                  <td><span class="grub_title"><?php echo $grub['grub_title'];?></span></td>
                  <td><span class="grub_score">Score <?php echo $grub['grub_score'];?></span></td>
                </tr><br/>
                <tr>
                  <td><span class="grub_description"><?php echo $grub['grub_description'];?></span></td>
                </tr><br/><br/>
                
              <?php endforeach;?>
            </table>
          </div>
        </div>
      </div>
      
      <div id="ft">
        <-- Footer Content -->
      </div>
      
    </div>
    
  </body>
</html>
