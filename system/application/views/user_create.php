<p>
  Please fill out the following information. (This will be it, you'll have an account created by next page; I promise!)
</p>
<br/>

<div id="create_user_form">

  <div class="validation_errors">
    <?php echo validation_errors(); ?>
  </div>
  
  <?php echo form_open('user/create'); ?>
  
  <table>
  
    <tr>
      <td>
        <label for="user_name">Real name: </label>
      </td>
      <td>
        <?php echo form_input('user_name', set_value('user_name')); ?>
      </td>
    </tr>

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
        <label for="user_email">Email: </label>
      </td>
      <td>
        <?php echo form_input('user_email', set_value('user_email')); ?>
      </td>
    </tr>

    <tr>
      <td>
        <label for="user_zip_code">Zipcode: </label>
      </td>
      <td>
        <?php echo form_input('user_zip_code', set_value('user_zip_code')); ?>
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
        <label for="retype_password">Retype password: </label>
      </td>
      <td>
        <?php echo form_password('retype_password', set_value('retype_password')); ?>
      </td>
    </tr>

    <tr>
      <td>
        <?php echo form_submit('submit', 'Create user'); ?>
      </td>
    </tr>
  </table>
  
  <?php echo form_close(); ?>
