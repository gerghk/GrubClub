<div class='validation_errors'><?php echo validation_errors(); ?></div>
<br/>
<?php echo form_open_multipart('grub/addGrubPost', array('class' => 'grub_form')); ?>
  <table>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Photo File</span></td>
      <td class = 'form_text_box_td'><?php echo form_upload(array('name' => 'photo_file', 'value' => set_value('photo_file'), 'class' => 'input_text_box')); ?></td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Photo Caption</span></td>
      <td class = 'form_text_box_td'><?php echo form_input(array('name' => 'grub_photo_caption', 'value' => set_value('grub_photo_caption'), 'class' => 'input_text_box', 'maxlength' => '50')); ?></td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Title</span></td>
      <td class = 'form_text_box_td'><?php echo form_input(array('name' => 'grub_title', 'value' => set_value('grub_title'), 'class' => 'input_text_box', 'maxlength' => '100')); ?></td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Description</span></td>
      <td class = 'form_text_box_td'><?php echo form_textarea(array('name' => 'grub_description', 'value' => set_value('grub_description'), 'class' => 'input_textarea_box', 'rows' => '4', 'cols' => '50', 'maxlength' => '1000')); ?></td>
    </tr>
    <tr>
      <td><?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'class' => 'submit_button')); ?></td>
    </tr>
  </table>
<?php echo form_close(); ?>