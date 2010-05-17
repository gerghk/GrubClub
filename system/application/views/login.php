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
