<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  
  <head>
    <title>ChowHub - Add Grub</title>
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
  
            <?php echo form_open_multipart('grub/addGrubPost', array('class' => 'grub_form')); ?>
              <table>
                <tr>
                  <td class = 'form_title_td'><span class = 'input_title'>Photo File</span></td>
                  <td class = 'form_text_box_td'><?php echo form_upload(array('name' => 'photo_file', 'class' => 'input_text_box')); ?></td>
                </tr>
                <tr>
                  <td class = 'form_title_td'><span class = 'input_title'>Photo Caption</span></td>
                  <td class = 'form_text_box_td'><?php echo form_input(array('name' => 'grub_photo_caption', 'class' => 'input_text_box')); ?></td>
                </tr>
                <tr>
                  <td class = 'form_title_td'><span class = 'input_title'>Title</span></td>
                  <td class = 'form_text_box_td'><?php echo form_input(array('name' => 'grub_title', 'class' => 'input_text_box')); ?></td>
                </tr>
                <tr>
                  <td class = 'form_title_td'><span class = 'input_title'>Description</span></td>
                  <td class = 'form_text_box_td'><?php echo form_textarea(array('name' => 'grub_description', 'class' => 'input_textarea_box', 'rows' => '4', 'cols' => '50')); ?></td>
                </tr>
                <tr>
                  <td><?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'class' => 'submit_button')); ?></td>
                </tr>
              </table>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
      
      <div id="ft">
        <-- Footer Content -->
      </div>
      
    </div>
    
  </body>
</html>