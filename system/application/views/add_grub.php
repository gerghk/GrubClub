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
    <tr>
      <td class = 'form_title_td' colspan="2">
        <br/>
        <h2>Optional (but helpful) information:</h2>
        <br/>
      </td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Date of consumption</span></td>
      <td class = 'form_text_box_td'>
        <?php echo form_input(array('name' => 'grub_consumption_date', 'id' => 'grub_consumption_date'))?>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#grub_consumption_date').datepicker();
            $('#grub_consumption_date').val('<?php echo date('m/d/Y'); ?>');
          });
        </script>
      </td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Restaurant</span></td>
      <td class = 'form_text_box_td'><?php echo form_input('grub_restaurant', set_value('grub_restaurant')); ?></td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Ingredients</span></td>
      <td class = 'form_text_box_td'><?php echo form_textarea(array('name' => 'grub_ingredients', 'value' => set_value('grub_ingredients'), 'class' => 'input_textarea_box', 'rows' => '4', 'cols' => '50', 'maxlength' => '1000')); ?></td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Estimated calories</span></td>
      <td class = 'form_text_box_td'><?php echo form_input('grub_calories', set_value('grub_calories')); ?></td>
    </tr>
    <tr>
      <td class = 'form_title_td'><span class = 'input_title'>Meal</span></td>
      <td class = 'form_text_box_td'>
        <?php
          $grub_type_options = array(0 => '', 1 => 'Breakfast', 2 => 'Lunch', 3 => 'Dinner', 4 => 'Snack');
          echo form_dropdown('grub_type', $grub_type_options, 0);
        ?>
      </td>
    </tr>
  </table>
<?php echo form_close(); ?>