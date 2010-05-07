<html>
<head>
<title>Chow Hub</title>
</head>

<body>
  <?php echo form_open('grub/addGrubPost', array('class' => 'grub_form')); ?>
    <table>
      <tr>
        <td class = 'title_td'><span class = 'input_title'>Title</span></td>
        <td class = 'text_box_td'><?php echo form_input(array('name' => 'grub_title', 'class' => 'input_text_box')); ?></td>
      </tr>
      <tr>
        <td class = 'title_td'><span class = 'input_title'>Description</span></td>
        <td class = 'text_box_td'><?php echo form_input(array('name' => 'grub_description', 'class' => 'input_text_box')); ?></td>
      </tr>
      <tr>
        <td class = 'title_td'><span class = 'input_title'>Score</span></td>
        <td class = 'text_box_td'><?php echo form_input(array('name' => 'grub_score', 'class' => 'input_text_box')); ?></td>
      </tr>
      <tr>
        <td class = 'title_td'><span class = 'input_title'>User ID (temp for dev)</span></td>
        <td class = 'text_box_td'><?php echo form_input(array('name' => 'user_id', 'class' => 'input_text_box')); ?></td>
      </tr>
      <tr>
        <td><?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'class' => 'submit_button')); ?></td>
      </tr>
    </table>
</body>

</html>